<?php

namespace Database\Seeders;

use App\Models\Logo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@email.com',
            'password' => bcrypt('superadmin'),
            'role' => 'superadmin',
            'photo' => 'img/profile.jpg'
        ]); 

        User::create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
            'photo' => 'img/profile2.jpg'
        ]); 

        Logo::create([
            'img' => 'logo.png',
        ]);
    }
}
