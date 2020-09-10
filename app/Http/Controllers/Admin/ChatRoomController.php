<?php

namespace App\Http\Controllers\Admin;

use App\ChatRoom;
use App\Winner;
use App\Http\Controllers\Controller;
use App\JoinChatRoom;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ChatRoomController extends Controller
{
    public function index()
    {
        $chatrooms = ChatRoom::orderBy('id', 'desc')->paginate(10);
        return view('admin.chatroom.index', compact('chatrooms'));
    }
    public function create()
    {
        return view('admin.chatroom.create');
    }

    public function store(Request $request)
    {
        $catroom = new ChatRoom();

        $data = $request->validate([
            'name' => 'required|unique:chat_rooms|string',
            'photo' => 'required|mimes:png,jpg,jpeg',
        ]);
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($data['name'], '-') . '-' .  strtolower(Str::random(5));;
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->photo->store('uploads/chatroom/', 'public');
        }

        if (ChatRoom::create($data)) {
            return redirect()->back()->with('success', 'Chatroom added successfully !');
        } else {
            return redirect()->back()->with('error', 'Failed to add Chatroom !');
        }
    }

    public function edit($id)
    {
        $chatroom = ChatRoom::findOrFail($id);
        return view('admin.chatroom.edit', compact('chatroom'));
    }

    public function update(Request $request, $id)
    {
        $chatroom = ChatRoom::findorFail($id);

        $data = $request->validate([
            'name' => 'required|string',
            'photo' => 'mimes:png,jpg,jpeg',
        ]);

        $data['slug'] = Str::slug($data['name'], '-') . '-' .  strtolower(Str::random(5));;
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->photo->store('uploads/chatroom/', 'public');
        }

        if ($chatroom->update($data)) {
            return redirect()->back()->with('success', 'Chatroom updated successfully !');
        } else {
            return redirect()->back()->with('error', 'Failed to adupdate Chatroom !');
        }
    }

    public function destroy(Request $request)
    {
        $chatroom = ChatRoom::findOrFail($request->id);
        if ($chatroom->delete()) {
            // return Storage::delete('app/public/'.$chatroom->photo);
            return 1;
        } else {
            return 2;
        }
    }

    public function enterRoom($slug)
    {
        $chatRoom = ChatRoom::whereSlug($slug)->first();
        if (auth()->check()) {
            if (session()->has('chat_init')) {
                session()->forget('chat_init');
            }
            if (!checkJoined($chatRoom->id, auth()->user()->id)) {
                $charge = chargeClient(auth()->user()->id);
                if ($charge['status'] == 'success') {
                    $join = JoinChatRoom::create([
                        'chat_room_id' => $chatRoom->id,
                        'user_id' => auth()->user()->id,
                        'is_online' => 1,
                        'type' => 1,
                        'user_bg' => random_color(),
                    ]);

                    if ($join) {
                        return view('frontend.chat', compact('chatRoom'));
                    } else {
                        return 'Something went wrong';
                    }
                } else {
                    return $charge['message'];
                }
            } else {
                JoinChatRoom::where('chat_room_id', $chatRoom->id)->where('user_id', auth()->user()->id)->update(['is_online' => 1]);
                return view('frontend.chat', compact('chatRoom'));
            }
        } else {
            session()->put('chat_init', $chatRoom->slug);
            return redirect('/registration');
        }
    }

    public function winners()
    {
        // $previous_week = strtotime("-1 week +1 day");
        // $start_week = strtotime("last sunday midnight", $previous_week);
        // $end_week = strtotime("next saturday", $start_week);
        // $start_week = date("Y-m-d", $start_week);
        // $end_week = date("Y-m-d", $end_week);
        // $winners = Winner::whereBetween('created_at', [$start_week, $end_week])->where('size', '!=', '')->orWhereNotNull('size')->get();

        $winners = Winner::where('size', '!=', '')->orWhereNotNull('size')->orderBy('id', 'DESC')->get();
        return view('admin.winners', compact('winners'));
    }
}
