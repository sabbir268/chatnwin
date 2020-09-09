<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
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
}
