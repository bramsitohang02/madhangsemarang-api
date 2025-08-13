<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Menampilkan daftar SEMUA restoran untuk admin.
     * Termasuk yang statusnya 'pending' dan 'approved'.
     */
    public function index()
    {
        // Pemeriksaan manual untuk memastikan hanya admin yang bisa mengakses
        if (auth()->user()->is_admin != true) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }

        // withTrashed() disertakan agar data yang soft-deleted juga muncul untuk admin
        $restaurants = Restaurant::withTrashed()->orderBy('status', 'asc')->get();
        return response()->json($restaurants);
    }

    /**
     * Mengubah status restoran menjadi 'approved'.
     */
    public function approve(Restaurant $restaurant)
    {
        // Pemeriksaan manual untuk memastikan hanya admin yang bisa mengakses
        if (auth()->user()->is_admin != true) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }

        $restaurant->status = 'approved';
        $restaurant->save();

        return response()->json([
            'message' => 'Restoran berhasil disetujui.',
            'restaurant' => $restaurant
        ]);
    }
}