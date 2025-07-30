<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Hapus 'use Gate' jika tidak ada yang lain menggunakannya

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // KOSONGKAN BAGIAN INI DARI GATE
    }
}