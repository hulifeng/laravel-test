<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    protected $table = 'fan';

    protected $fillable = [
        'fan_id',
        'star_id'
    ];

    public function fuser()
    {
        return $this->hasOne(\App\User::class, 'id', 'fan_id');
    }

    public function suser()
    {
        return $this->hasOne(\App\User::class, 'id', 'star_id');
    }
}
