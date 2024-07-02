<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create(
            [
                'name' => 'krido pambudi',
                'email' => 'krido@ratio.com',
                'password' => bcrypt('krido123'),
                'updated_at' => now(),
                'created_at' => now()
            ]
        );
    }
}
