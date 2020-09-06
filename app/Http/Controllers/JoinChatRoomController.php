<?php

namespace App\Http\Controllers;

use App\Events\UserOnline;
use App\Events\UserOffline;
use App\JoinChatRoom;
use Illuminate\Http\Request;

class JoinChatRoomController extends Controller
{
    public function getAllMembers($chat_room_id)
    {
        return JoinChatRoom::where('chat_room_id', $chat_room_id)->get()->makeHidden(['type']);
    }

    public function makeOnline($chat_room_id)
    {
        $findJoined = JoinChatRoom::where('chat_room_id', $chat_room_id)->where('user_id', auth()->user()->id)->first();
        $findJoined->is_online = 1;
        $findJoined->save();
        
        broadcast(new UserOnline($findJoined));
    }

    public function makeOffline($chat_room_id)
    {
        $findJoined = JoinChatRoom::where('chat_room_id', $chat_room_id)->where('user_id', auth()->user()->id)->first();
        $findJoined->is_online = 0;
        $findJoined->save();

        broadcast(new UserOffline($findJoined));
    }
}
