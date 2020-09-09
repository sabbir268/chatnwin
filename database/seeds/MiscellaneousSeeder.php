<?php

use Illuminate\Database\Seeder;

class MiscellaneousSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('miscellaneouses')->insert([
            'key' => 'bonus',
            'value' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('miscellaneouses')->insert([
            'key' => 'comingsoon',
            'value' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
