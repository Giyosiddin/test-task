<?php

namespace Database\Seeders;

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
            [
                'id' => '1',
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
            ],
            [
                'id' => '2',
                'name' => 'Manager 1',
                'email' => 'manager1@gmail.com',
                'password' => bcrypt('12345678'),
            ],
            [
                'id' => '3',
                'name' => 'Manager 2',
                'email' => 'manager2@gmail.com',
                'password' => bcrypt('12345678'),
            ]
        ]);

    }
}
