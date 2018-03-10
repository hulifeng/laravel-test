<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //评论所属文章
    public function posts()
    {
        return $this->belongsTo('\App\Posts', 'id', 'post_id');
    }
}
