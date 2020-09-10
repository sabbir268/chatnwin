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
}
