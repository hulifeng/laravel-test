<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Comments;
use App\Zans;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //文章列表页
    public function index()
    {
        if (Auth::check() == false) {
            return redirect('/login');
        }
        $post = Posts::orderBy('created_at', 'desc')->withCount(['comments', 'zans'])->paginate(10);
        return view('post.index', compact('post'));
    }

    //文章详情页
    public function show(Posts $post)
    {
        return view('post.show', compact('post'));
    }

    //创建文章
    public function create()
    {
        return view('post.create');
    }

    //创建逻辑
    public function store()
    {
        //验证
        $this->validate(\request(),[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ]);
        //逻辑
        $user_id = \Auth::id();
        $params = array_merge(\request(['title', 'content']), compact('user_id'));
        Posts::create($params);
        //渲染
        return redirect('posts');
    }

    //编辑文章
    public function edit(Posts $post)
    {
        return view('post.edit', compact('post'));
    }

    //编辑逻辑
    public function update(Posts $post)
    {
        //验证
        $this->validate(\request(),[
           'title' => 'required|string|min:5|max:100',
           'content' => 'required|string|min:10'
        ]);

        //验证授权
        $this->authorize('update', $post);

        //逻辑
        $post->title = \request('title');
        $post->content = \request('content');
        $post->save();

        //渲染
        return redirect("/posts/{$post->id}");
    }

    //删除文章
    public function delete(Posts $post)
    {
        //验证授权
        $this->authorize('user', $post);

        //逻辑
        $post->delete();

        //渲染
        return redirect('posts');
    }

    //评论文章
    public function comment(Posts $post)
    {
        //验证
        $this->validate(\request(),[
           'content' => 'required|min:10'
        ]);

        //逻辑
        $comment = new Comments();
        $comment->post_id = $post->id;
        $comment->user_id = \Auth::id();
        $comment->content = \request('content');
        $comment->save();

        //渲染
        return back();
    }

    //点赞
    public function zan(Posts $post)
    {
        $params = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id
        ];
        Zans::firstOrCreate($params);
        return back();
    }

    //取消点赞
    public function unzan(Posts $post)
    {
        $post->zan(\Auth::id())->delete();
        return back();
    }

    //搜索文章
    public function search()
    {
        //验证
        $this->validate(\request(),[
            'query' => 'required'
        ]);
        //逻辑
        $query = \request('query');
        $post = Posts::search($query)->paginate(2);
        //结果集的个数
        $num = count($post);
        //渲染
        return view('post.search',compact('query','post','num'));
    }

    //个人主页
    public function user()
    {
        $userId = \Auth::id();
        return view('user.user', compact('userId'));
    }
}
