<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'User1',
            'email' => 'user1@email.com',
            'password' => Hash::make( 'password' ),
        ]);

        DB::table('user_user_group')->insert([
            'user_id' => 1,
            'user_group_id' => 1
        ]);
    }
}
