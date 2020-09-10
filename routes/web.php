<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->middleware(['winnercheck', 'comingsoon']);
Route::get('about', function () {
    return view('frontend.about');
});


Route::get('privacy-policy', function () {
    return view('frontend.privacy');
});

Route::get('coming-soon', function () {
    if (checkComingSoon() == 0) {
        return redirect('/');
    }
    return view('frontend.comming_soon');
})->name('comingsoon');


Route::get('terms-services', function () {
    return view('frontend.terms_services');
});

Route::get('registration', function () {
    $user = new \App\User;
    return view('frontend.registration', [
        'intent' => $user->createSetupIntent()
    ]);
});


Auth::routes();


//routes for admin
// Route::get('/admin/chatroom/create', 'Admin\ChatRoomController@index')->name('admin.home')->middleware('auth');

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::resource('chatroom', 'Admin\ChatRoomController');
    Route::post('chatroom/delete', 'Admin\ChatRoomController@destroy')->name('admin.chatroom.delete');
    Route::get('winners', 'Admin\ChatRoomController@winners')->name('winners');
    Route::get('bonus-control', 'MiscellaneousController@bonusControl')->name('bonus.control');
    Route::get('comingsoon-control', 'MiscellaneousController@comingSoon')->name('comingsoon.control');
});


Route::get('chatroom/{slug}', 'Admin\ChatRoomController@enterRoom')->name('chatroom');

Route::group(['middleware' => 'auth', 'winnercheck'], function () {
    /**chat room and chat */
    Route::post('chat', 'ChatController@store');
    Route::get('chat/like/{chat_id}', 'ChatLikeController@like');
    Route::get('chat/dislike/{chat_id}', 'ChatLikeController@dislike');


    Route::get('chat/{chat_room_id}', 'ChatController@getAllByChatroom');

    Route::get('all-members/{chat_room_id}', 'JoinChatRoomController@getAllMembers');

    /** private chat */
    Route::get('private-chatstart/{username}', 'PrivateChatController@startChat');
    Route::post('private-chatinit', 'PrivateChatController@initChat');
    Route::post('private-sendmessage', 'PrivateChatController@message');
    Route::get('private-message/like', 'PrivateChatController@like');
    Route::get('private-message/dislike', 'PrivateChatController@like');

    /**account */
    Route::get('account/{usernanme}', 'UserController@account');
    Route::post('account/update/{id}', 'UserController@update_account');


    /** winner */
    Route::get('result', function () {
        if (isWinner(auth()->user()->id)) {
            return view('frontend.result');
        } else {
            return redirect('/');
        }
    })->name('result');

    Route::post('winner/value_udpate', 'UserController@value_update')->name('winner.value_udpate');
});






Route::get('clear/cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return 'cache cleared';
});

Route::get('winner/make', function () {
    Artisan::call('winners:make');
    return 'winner cleared';
});
Route::get('storage/link', function () {
    Artisan::call('storeage:link');
    return 'Storage link';
});
Route::get('storage/link', function () {
    Artisan::call('db:seed');
    return 'Database seed successfull';
});
