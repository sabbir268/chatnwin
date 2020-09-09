<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $guarded = [];

    public function chat()
    {
        return $this->hasMany('App\Chat');
    }

    public function joinChatRoom()
    {
        return $this->hasMany('App\JoinChatRoom');
    }
}
