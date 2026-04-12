<?php
// database/seeders/AdminSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Dr. Ahmed',
            'email' => 'ahmedtest@gmail.com', 
            'password' => Hash::make('password123'), 
            'role'      => 'super_admin',
            'is_active' => true,
        ]);
    }
}