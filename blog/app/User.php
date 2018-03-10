<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('App\Posts','user_id','id');
    }

    public function fans()
    {
        return $this->hasMany('App\Fan', 'star_id', 'id');
    }

    public function hasFan($uid)
    {
        return $this->fans()->where('fan_id', $uid)->count();
    }

    public function stars()
    {
        return $this->hasMany('App\Fan', 'fan_id', 'id');
    }

    public function hasStar($uid)
    {
        return $this->stars()->where('star_id', $uid)->count();
    }
}
