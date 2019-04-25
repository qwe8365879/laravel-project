<?php

use Illuminate\Database\Seeder;

class UserGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_groups')->insert([
            [
                'name' => 'admin',
                'permission' => 1
            ],
            [
                'name' => 'manager',
                'permission' => 2
            ],
            [
                'name' => 'contributor',
                'permission' => 3
            ],
            [
                'name' => 'reader',
                'permission' => 4
            ]
        ]);
    }
}
