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
    Schema::table('restaurants', function (Blueprint $table) {
        // Tambahkan kolom baru setelah 'description'
        $table->string('operating_hours')->nullable()->after('description');
        $table->string('price_range')->nullable()->after('operating_hours');
        $table->string('contact_number')->nullable()->after('price_range');
        $table->string('website_url')->nullable()->after('contact_number');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            // Perintah untuk menghapus kolom jika migration di-rollback
            $table->dropColumn(['operating_hours', 'price_range', 'contact_number', 'website_url']);
        });
    }
};