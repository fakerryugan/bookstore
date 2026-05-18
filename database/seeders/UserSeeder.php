<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Bookstore',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => 'User Customer',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'costumer',
            'email_verified_at' => now(),
        ]);
    }
}
