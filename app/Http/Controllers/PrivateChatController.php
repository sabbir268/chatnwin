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
        $reciverId = User::whereUsername($username)->first()->id;
        $privateChatf = PrivateChat::where('reciver_id', $reciverId)->where('sender_id', auth()->user()->id);
        if ($privateChatf->count() > 0) {
            $privateChat = $privateChatf->first();
        }

        $privateChats = PrivateChat::where('reciver_id', auth()->user()->id)->where('sender_id', $reciverId);

        if ($privateChats->count() > 0) {
            $privateChat = $privateChats->first();
        }

        if (!$privateChat) {
            $privateChat = '';
        }


        return view('frontend.single-chat', compact('reciverId', 'privateChat'));
    }

    public function getAllChat($id)
    {
        return PrivateMessage::where('private_chat_id', $id)->get();
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
            $pm =  PrivateMessage::create([
                'user_id' => $privateChat->sender_id,
                'private_chat_id' => $privateChat->id,
                'message' => $request->message,
                'image' => isset($image) ? $image : null,
            ]);

            return $pm;
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
