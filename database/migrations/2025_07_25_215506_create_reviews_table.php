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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // Kunci utama
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Penghubung ke tabel users
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade'); // Penghubung ke tabel restaurants
            $table->unsignedTinyInteger('rating'); // Kolom rating (angka 1-5)
            $table->text('comment'); // Kolom untuk isi komentar ulasan
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};