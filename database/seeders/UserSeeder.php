<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        // Buat user contoh dan langsung set sebagai admin
        User::create([
            'name' => 'User Contoh',
            'email' => 'user@contoh.com',
            'password' => Hash::make('password'),
            'is_admin' => true, // <-- TAMBAHKAN BARIS INI
        ]);
    }
}