<?php

namespace App\Http\Controllers;

use App\ChatRoom;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Session;

session_start();

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      

        $chatrooms = ChatRoom::where('status', 1)->orderBy('id', 'desc')->paginate(9);
        Session::flash('first_time', 'first time visit!'); 
        return view('frontend.index', compact('chatrooms'));
    }
}
