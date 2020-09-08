<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Events\ChatEvent;
use App\Http\Resources\ChatResource;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function getAllByChatroom($chat_room_id)
    {
        $chats = Chat::where('chat_room_id', $chat_room_id)->get();
        return ChatResource::collection($chats);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            return "yes";
        }
        $data = $request->validate([
            'message' => 'required',
            'chat_room_id' => 'required',
        ]);

        if ($request->hasFile('image')) {
            return "yes";
        }

        $data['user_id'] = auth()->user()->id;

        if ($chat = Chat::create($data)) {
            // return new ChatResource($chat);
            broadcast(new ChatEvent(new ChatResource($chat)));
            return 'success';
        } else {
            return 'error';
        }
    }
}
