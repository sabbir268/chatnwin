<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function chatRoom()
    {
        return $this->belongsTo('App\ChatRoom');
    }

    public function chatLike()
    {
        return $this->hasMany('App\ChatLike');
    }

    public function getTotalLikesAttribute()
    {
        return $this->chatLike->where('like', 1)->count();
    }

    public function getTotalDesilkesAttribute()
    {
        return $this->chatLike->where('deslike', 1)->count();
    }

    public function chatReport()
    {
        return $this->hasMany('App\ChatReport');
    }

    public function chatAsset()
    {
        return $this->hasMany('App\ChatAsset');
    }
}
