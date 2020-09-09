<?php

use Illuminate\Support\Str;


function checkJoined($chatRoomId, $userId)
{
    $joined = App\JoinChatRoom::where('chat_room_id', $chatRoomId)->where('user_id', $userId)->count();

    if ($joined == 1) {
        return true;
    } else {
        return false;
    }
}


function chargeClient($userId)
{
    $user = \App\User::find($userId);
    if ($user->hasDefaultPaymentMethod()) {
        $charge = $user->charge(100, $user->defaultPaymentMethod()->id);
        if ($charge->status == "succeeded") {
            return ['status' => 'success', 'message' => 'Payment recived!'];
        } else {
            return ['status' => 'error', 'message' => 'Error happens on payment!'];
        }
    } else {
        return ['status' => 'error', 'message' => 'No payment method found!'];
    }
}


function base64_to_image($base64_string, $location = "uploads")
{
    if (strlen($base64_string) > 100) {
        $local_path = $_SERVER['DOCUMENT_ROOT'];
        $path = $location . "/" . Str::random() . ".jpg";
        //$path = "public/" . $location . "/" . generateRandomString() . ".jpg";
        $output_file = $local_path . "/" . $path; //save to local address

        // open the output file for writing
        $ifp = fopen($output_file, 'wb');

        $data = explode(',', $base64_string);
        // we could add validation here with ensuring count( $data ) > 1
        fwrite($ifp, base64_decode($data[1]));
        // clean up the file resource
        fclose($ifp);

        return str_replace('\\', '', $path);
    } else {
        return 'error';
    }
}


function checkBonus()
{
    return App\Miscellaneous::where('key', 'bonus')->first()->value;
}

function checkComingSoon()
{
    return App\Miscellaneous::where('key', 'comingsoon')->first()->value;
}


function raffleDraw($arr)
{

    $key = array_rand($arr);

    // Display the random array element 
    return $arr[$key];
}

function isWinner($user_id, $onlyCheck = true)
{
    $winner = \App\Winner::where('user_id', $user_id)->where('status', 1);
    if ($winner->count() > 0) {
        if ($onlyCheck) {
            return true;
        } else {
            return $winner->first();
        }
    } else {
        return false;
    }
}


