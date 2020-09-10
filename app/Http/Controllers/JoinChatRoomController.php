<?php

namespace App\Http\Controllers;

use App\Events\UserOnline;
use App\Events\UserOffline;
use App\Http\Resources\ChatMember;
use App\JoinChatRoom;
use Illuminate\Http\Request;

class JoinChatRoomController extends Controller
{
    public function getAllMembers($chat_room_id)
    {
        $membersJoin =  JoinChatRoom::where('chat_room_id', $chat_room_id)->take(10)->get()->makeHidden(['type']);
        return ChatMember::collection($membersJoin);
    }
}
