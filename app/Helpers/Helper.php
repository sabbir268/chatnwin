<?php
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
