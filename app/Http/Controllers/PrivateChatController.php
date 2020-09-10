<?php

namespace App\Http\Controllers;

use App\PrivateChat;
use App\PrivateMessage;
use App\User;
use Illuminate\Http\Request;

class PrivateChatController extends Controller
{
    public function startChat($username)
    {
        $reciverId = User::whereUsername($username)->first();
        return view('frontend.single-chat', compact('reciverId'));
    }

    public function initChat(Request $request)
    {
        if ($request->image == '') {
            $data = $request->validate([
                'message' => 'required',
                'reciver_id' => 'required',
            ]);
        } else {
            $data = $request->validate([
                'reciver_id' => 'required',
                'message' => 'nullable',
            ]);


            $image = base64_to_image($request->image);
        }


        $privateChat = PrivateChat::create([
            'sender_id' => auth()->user()->id,
            'reciver_id' => $request->reciver_id,
        ]);

        if ($privateChat) {
            PrivateMessage::create([
                'user_id' => $privateChat->sender_id,
                'private_chat_id' => $privateChat->id,
                'message' => $request->message,
                'image' => $image ? $image : null,
            ]);
        }
    }

    public function message(Request $request)
    {
        if ($request->image == '') {
            $data = $request->validate([
                'message' => 'required',
                'private_chat_id' => 'required',
            ]);
        } else {
            $data = $request->validate([
                'private_chat_id' => 'required',
                'message' => 'nullable',
            ]);


            $data['image'] = base64_to_image($request->image);
        }

        $data['user_id'] = auth()->user()->id;

        $pchat = PrivateChat::find($request->private_chat_id);
        if ($pchat->is_accept == 0) {
            if ($pchat->reciver_id == $data['user_id']) {
                $pchat->is_accept = 1;
                $pchat->save();
            }
        }

        if ($pm = PrivateMessage::create($data)) {
            return $pm;
        }
    }

    public function like($id)
    {
        $privateMessage = PrivateMessage::find($id);
        $privateMessage->react = 'like';
        $privateMessage->save();
    }

    public function unlike($id)
    {
        $privateMessage = PrivateMessage::find($id);
        $privateMessage->react = 'unlike';
        $privateMessage->save();
    }
}
