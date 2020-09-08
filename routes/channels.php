<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('App.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('chat-channel.{chat_room_id}', function ($user, $chat_room_id) {
    $hasUser = \App\JoinChatRoom::where('chat_room_id', $chat_room_id)->where('user_id', $user->id)->count();
    return $hasUser > 0 ? true : false;
});
