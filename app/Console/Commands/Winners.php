<?php

namespace App\Console\Commands;

use App\ChatRoom;
use App\Winner;
use Illuminate\Console\Command;

class Winners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'winners:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make winners from chatroom';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $test = [];
        $chatRooms = ChatRoom::where('status', 1)->get();
        foreach ($chatRooms as $room) {
            $users = $room->joinChatRoom()->pluck('user_id')->toArray();
            // array_push($test, raffleDraw($users));
            $winner = raffleDraw($users);
            Winner::create([
                'user_id' => $winner,
                'chat_room_id' => $room->id,
                'status' => checkBonus() == 1 ? 1 : 3,
            ]);

            ChatRoom::find($room->id)->update(['status' => 0]);
        }
        // echo json_encode($test);
    }
}
