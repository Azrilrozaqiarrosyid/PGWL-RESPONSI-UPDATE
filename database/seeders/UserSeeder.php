<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { $user = [
        [
            'name' => 'Admin',
            'phone' => '081615518479',
            'email' => 'admin@gmailcom',
            'password' => bcrypt('admin1234'),
        ],
        [
            'name' => 'User',
            'phone' => '0816155184790',
            'email' => 'user@gmailcom',
            'password' => bcrypt('admin1234'),
        ],
        [
            'name' => 'person',
            'phone' => '0816155184795',
            'email' => 'person@gmailcom',
            'password' => bcrypt('admin1234'),
        ],
    ];

    //insert teh user to database
    DB::table('users')->insert($user);
    }
}
