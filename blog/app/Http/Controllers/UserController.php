<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Fan;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.regist');
    }

    public function register()
    {
        //验证
        $this->validate(\request(), [
            'name' => 'required|min:3|unique:users,name',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:8|max:16|confirmed'
        ]);
        //逻辑
        $name = \request('name');
        $email = \request('email');
        $password = bcrypt(\request('password'));
        User::create(compact(['name','email','password']));
        //渲染
        return redirect('/login');
    }

    public function show(User $user)
    {
        //获取一个人的所有文章，按照时间倒序获取前十条
        $post = $user->posts()->orderBy('created_at','desc')->take(10)->get();
        //获取这个人文章数 粉丝数 关注的人的数量
        $info = User::withCount(['posts','fans','stars'])->find($user->id);
        //获取他关注的人的 文章数 粉丝数 关注的数量
        $fans = $user->fans()->get();
        //获取他的粉丝的 文章数 粉丝数 关注的数量
        $stars = $user->stars()->get();
        return view('user.user',compact(['post','info','fans','stars']));
    }

    public function doFan(User $user)
    {
        Fan::firstOrCreate(['fan_id' => \Auth::id(), 'star_id' => $user->id]);
        return [
            'error' => 0
        ];
    }

    public function doUnFan(User $user)
    {
        Fan::where('fan_id', \Auth::id())->where('star_id', $user->id)->delete();
        return [
          'error' => 0
        ];
    }
}
