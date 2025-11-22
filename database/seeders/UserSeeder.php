<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'Admin Makan Dulu',
            'email' => 'admin@gmail.com',
            'phone' => '089612245935',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'Hanssen',
            'email' => 'hanssen@gmail.com',
            'phone' => '0896272839232',
            'password' => Hash::make('password'),
            'role' => 'pembeli',
        ]);
    }
}
