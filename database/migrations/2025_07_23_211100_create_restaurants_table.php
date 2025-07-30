<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
        $table->id(); // Ini adalah shortcut untuk kolom id BIGINT, Primary Key, Auto Increment
        $table->string('name'); // Kolom nama, tipe VARCHAR(255)
        $table->string('location'); // Kolom lokasi, tipe VARCHAR(255)
        $table->string('category', 50); // Kolom kategori, tipe VARCHAR(50)
        $table->text('description'); // Kolom deskripsi, tipe TEXT
        $table->string('image_url')->nullable(); // Kolom link gambar, boleh NULL (kosong)
        $table->timestamps(); // Ini shortcut untuk membuat created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
