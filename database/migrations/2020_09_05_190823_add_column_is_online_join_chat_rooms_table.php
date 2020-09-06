<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsOnlineJoinChatRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('join_chat_rooms', function (Blueprint $table) {
            $table->tinyInteger('is_online')->default(0)->after('type')->comment('1 => online 0 => not online');
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
