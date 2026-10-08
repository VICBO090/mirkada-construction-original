<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Victoire Mutomb',
            'email' => 'admin@mirkada.com',
            'password' => Hash::make('mirkada2026'),
            'role' => 'admin',
        ]);
    }
}