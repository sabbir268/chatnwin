<?php

namespace App\Http\Controllers;

use App\ChatRoom;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (auth()->check()) {
            if (auth()->user()->role == 1) {
                if (isWinner(auth()->user()->id)) {
                    return redirect('/result');
                }
            }
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $chatrooms = ChatRoom::where('status', 1)->orderBy('id', 'desc')->paginate(9);
        return view('frontend.index', compact('chatrooms'));
    }
}
