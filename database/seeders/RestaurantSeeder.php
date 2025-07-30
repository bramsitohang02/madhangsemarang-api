<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('restaurants')->truncate();
        Schema::enableForeignKeyConstraints();

        $restaurants = [
            ['user_id' => 1, 'name' => 'Soto Ayam Pak Man', 'location' => 'Banyumanik', 'category' => 'Legendaris', 'description' => 'Soto ayam bening legendaris dengan cita rasa otentik.', 'image_url' => 'https://placehold.co/100x100?text=Soto', 'status' => 'approved'],
            ['user_id' => 1, 'name' => 'Gudeg Koyor Mbak Tum', 'location' => 'Peterongan', 'category' => 'Legendaris', 'description' => 'Perpaduan gudeg manis dengan koyor sapi yang gurih.', 'image_url' => 'https://placehold.co/100x100?text=Gudeg', 'status' => 'approved'],
            ['user_id' => 1, 'name' => 'Bakso Daging Sapi Pak Geger', 'location' => 'Tembalang', 'category' => 'Kaki Lima', 'description' => 'Bakso urat yang kenyal dan selalu ramai oleh mahasiswa.', 'image_url' => 'https://placehold.co/100x100?text=Bakso', 'status' => 'approved'],
            ['user_id' => 1, 'name' => 'Mie Kopyok Pak Dhuwur', 'location' => 'Jl. Tanjung', 'category' => 'Legendaris', 'description' => 'Mie khas Semarang dengan kuah bawang putih dan kerupuk gendar.', 'image_url' => 'https://placehold.co/100x100?text=Mie', 'status' => 'approved'],
            ['user_id' => 1, 'name' => 'Tahu Gimbal Pak Edi', 'location' => 'Taman KB', 'category' => 'Jajanan', 'description' => 'Tahu gimbal dengan bumbu kacang yang medok dan porsi besar.', 'image_url' => 'https://placehold.co/100x100?text=Tahu', 'status' => 'approved'],
            ['user_id' => 1, 'name' => 'Moment Coffee & Space', 'location' => 'Tembalang', 'category' => 'Kafe', 'description' => 'Tempat ngopi nyaman dengan pilihan kopi yang beragam.', 'image_url' => 'https://placehold.co/100x100?text=Kopi', 'status' => 'approved'],
        ];

        DB::table('restaurants')->insert($restaurants);
    }
}