<?php

namespace App\Http\Controllers;

use App\ChatLike;
use Illuminate\Http\Request;

class ChatLikeController extends Controller
{
    public function like($chat_id)
    {
        $chatLikeCheck = ChatLike::where('chat_id', $chat_id)->where('user_id', auth()->user()->id);
        if ($chatLikeCheck->count() > 0) {
            $chatLikeCheck = $chatLikeCheck->first();
            if ($chatLikeCheck->deslike == 1) {
                $chatLikeCheck->deslike = 0;
                $chatLikeCheck->like = 1;
                $chatLikeCheck->save();

                return "success";
            }
        } else {
            $chatLike = ChatLike::create([
                'chat_id' => $chat_id,
                'user_id' => auth()->user()->id,
                'like' => 1,
            ]);

            return "success";
        }
    }

    public function dislike($chat_id)
    {
        $chatLikeCheck = ChatLike::where('chat_id', $chat_id)->where('user_id', auth()->user()->id);
        if ($chatLikeCheck->count() > 0) {
            $chatLikeCheck = $chatLikeCheck->first();
            if ($chatLikeCheck->like == 1) {
                $chatLikeCheck->like = 0;
                $chatLikeCheck->deslike = 1;
                $chatLikeCheck->save();

                return "success";
            }
        } else {
            $chatLike = ChatLike::create([
                'chat_id' => $chat_id,
                'user_id' => auth()->user()->id,
                'deslike' => 1,
            ]);

            return "success";
        }
    }
}
