<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Posts extends Model
{
    use Searchable;

    //定义索引里面的type
    public function searchableAs()
    {
        return "post";
    }

    //定义有哪些字段需要搜索
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }

    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    //关联用户
    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    //关联评论 并根据时间倒序排列
    public function comments()
    {
        return $this->hasMany('App\Comments', 'post_id' , 'id');
    }

    //关联用户赞
    public function zan($user_id)
    {
        return $this->hasOne('App\Zans', 'post_id', 'id')->where('user_id', $user_id);
    }

    //文章的所有赞
    public function zans()
    {
        return $this->hasMany('App\Zans', 'post_id', 'id');
    }

}
