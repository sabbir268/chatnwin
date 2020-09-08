<?php

namespace App\Http\Controllers;

use App\Chat;
use App\ChatAsset;
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
        if ($request->image == '') {
            $data = $request->validate([
                'message' => 'required',
                'chat_room_id' => 'required',
            ]);
        } else {
            $data = $request->validate([
                'chat_room_id' => 'required',
                'message' => 'nullable',
            ]);
        }

        $data['user_id'] = auth()->user()->id;

        if ($chat = Chat::create($data)) {
            // return new ChatResource($chat);
            broadcast(new ChatEvent(new ChatResource($chat)))->toOthers();
            if ($request->image != '') {

                $asset = base64_to_image($request->image);
                if ($asset != 'error') {
                    ChatAsset::create([
                        'user_id' => $data['user_id'],
                        'chat_id' => $chat->id,
                        'chat_room_id' => $chat->chat_room_id,
                        'asset' => $asset,
                    ]);
                }
            }
            return new ChatResource($chat);
        } else {
            return 'error';
        }
    }
}
