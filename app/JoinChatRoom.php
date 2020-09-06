<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JoinChatRoom extends Model
{
    protected $guarded = [];
    protected $appends = ['username'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getUsernameAttribute()
    {
        return $this->user->username;
    }

}
