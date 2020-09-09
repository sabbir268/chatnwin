<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'first_name' => 'Sneakly',
            'last_name' => 'Admin',
            'role' => 2,
            'address' => 'Newyork',
            'email'   => 'admin@sneakly.com',
            'api_token'   => Str::random(60),
            'password' => bcrypt(123456789),
        ]);
    }
}
