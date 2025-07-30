<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil kedua seeder
        $this->call([
            UserSeeder::class,
            RestaurantSeeder::class,
        ]);
    }
}