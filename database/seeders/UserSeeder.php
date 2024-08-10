<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
            [
                'email' => 'user1@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'email' => 'user2@example.com',
                'password' => Hash::make('password456'),
            ],
        ]);
    }
}
