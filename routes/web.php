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

use App\Chat;
use App\Events\ChatEvent;

Route::get('/', 'HomeController@index');
Route::get('about', function () {
    return view('frontend.about');
});

Route::get('result', function () {
    return view('frontend.result');
});
Route::get('privacy-policy', function () {
    return view('frontend.privacy');
});
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

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin',], function () {
    Route::resource('chatroom', 'Admin\ChatRoomController');
    Route::post('chatroom/delete', 'Admin\ChatRoomController@destroy')->name('admin.chatroom.delete');
    Route::get('winners', 'Admin\ChatRoomController@winners')->name('winners');
});


Route::get('chatroom/{slug}', 'Admin\ChatRoomController@enterRoom')->name('chatroom');

Route::group(['middleware' => 'auth'], function () {
    /**chat room and chat */
    Route::post('chat', 'ChatController@store');
    Route::get('chat/like/{chat_id}', 'ChatLikeController@like');
    Route::get('chat/dislike/{chat_id}', 'ChatLikeController@dislike');


    Route::get('chat/{chat_room_id}', 'ChatController@getAllByChatroom');

    Route::get('all-members/{chat_room_id}', 'JoinChatRoomController@getAllMembers');
    Route::get('online/{chat_room_id}', 'JoinChatRoomController@makeOnline');
    Route::get('offline/{chat_room_id}', 'JoinChatRoomController@makeOffline');
    /**account */
    Route::get('account/{usernanme}', 'UserController@account');
    Route::post('account/update/{id}', 'UserController@update_account');

    Route::get('single-chat', function () {
        return view('frontend.single-chat');
    });
});




Route::get('clear/cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return 'cache cleared';
});


Route::get('test-stripe', function () {
    $user = auth()->user();
    //  dd($user->hasPaymentMethod());
    return dd($user->charge(100, $user->defaultPaymentMethod()->id)->status);
});
