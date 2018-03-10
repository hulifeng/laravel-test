<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zans extends Model
{
    protected $fillable = [
        'user_id',
        'post_id'
    ];
}
