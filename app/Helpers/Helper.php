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
