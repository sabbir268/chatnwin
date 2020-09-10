<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $guarded = [];

    // public function 

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function chatRoom()
    {
        return $this->belongsTo('App\ChatRoom');
    }
}
