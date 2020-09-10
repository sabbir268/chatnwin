<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserBgJoinChatRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('join_chat_rooms', function (Blueprint $table) {
            $table->string('user_bg')->nullable()->after('is_online');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('join_chat_rooms', function (Blueprint $table) {
            //
        });
    }
}
