<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        // Tambahkan pemeriksaan admin di sini
        if (auth()->user()->is_admin != true) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }

        $restaurants = Restaurant::orderBy('status', 'asc')->get();
        return response()->json($restaurants);
    }

    public function approve(Restaurant $restaurant)
    {
        // Tambahkan pemeriksaan admin di sini
        if (auth()->user()->is_admin != true) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }

        $restaurant->status = 'approved';
        $restaurant->save();

        return response()->json([
            'message' => 'Restoran berhasil disetujui!',
            'restaurant' => $restaurant
        ]);
    }
}