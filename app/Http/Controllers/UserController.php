<?php

namespace App\Http\Controllers;

use App\User;
use App\Winner;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function account($username)
    {
        $user = User::where('username', $username)->first();
        // $countries = DB::Table('countries')->get();
        return view('frontend.account', compact('user'));
    }

    public function update_account(Request $request , $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zip_code' => 'required',
        ]);

        if($request->old_password != '' && $request->password != '' && $request->password_confirmation != ''){
            if(Hash::check($request->old_password, Auth::user()->password)){
                if($request->password == $request->password_confirmation){
                    $data['password'] = Hash::make($request->password);
                }else{
                    return redirect()->back()->with('match_error', 'Password not match');    
                }
            }else {
                return redirect()->back()->with('old_error', 'Old password not match');
            }
        }

        if($user->update($data)){
            return redirect()->back()->with('success', 'Account information update successfully !');
        }else{
            return redirect()->back()->with('error', 'Failed to update account information, please try again');
        }
    }

    public function value_update(Request $request)
    {
        $id = $request->id;

        $winner = Winner::where('user_id', $id)->first();
        $winner->size = $request->value;

        if($winner->save()){
            return "yes";
        }else {
            return "no";
        }
    }
}
