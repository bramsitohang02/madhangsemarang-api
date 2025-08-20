<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RestaurantPhoto;
use Illuminate\Http\Request;

class RestaurantPhotoController extends Controller
{
    /**
     * Menyimpan foto restoran baru yang diunggah oleh pengguna.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk
        $validatedData = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Simpan file gambar terlebih dahulu
        $path = $request->file('image')->store('restaurant_photos', 'public');

        // 3. Buat data foto baru
        $photo = RestaurantPhoto::create([
            'user_id' => $request->user()->id,
            'restaurant_id' => $validatedData['restaurant_id'],
            'image_path' => $path,
        ]);

        // 4. Muat data user untuk ditampilkan di frontend
        $photo->load('user');

        return response()->json($photo, 201);
    }
}