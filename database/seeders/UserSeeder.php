<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin2023',
            'email' => 'admin2023@gmail.com',
            'role' => 1,
            'phone' => '082355217741',
            'profile' => null,
            'password' => bcrypt('admin2023')
        ]);

        User::create([
            'username' => 'dimas123',
            'email' => 'dimas123@gmail.com',
            'role' => 0,
            'phone' => '082377632817',
            'profile' => null,
            'password' => bcrypt('dimas123')
        ]);
    }
}
