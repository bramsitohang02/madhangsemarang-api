<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::where('status', 'approved')->get();
        return response()->json($restaurants);
    }

    public function show(Restaurant $restaurant)
    {
        $restaurant->load('reviews.user', 'photos.user');
        return response()->json($restaurant);
    }
    
    public function update(Request $request, Restaurant $restaurant)
    {
        if (auth()->user()->is_admin != true) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'description' => 'required|string',
            'operating_hours' => 'nullable|string|max:255',
            'price_range' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:255',
            'website_url' => 'nullable|string|max:255',
        ]);

        $restaurant->update($validatedData);
        return response()->json($restaurant);
    }

    public function destroy($id)
    {
        if (auth()->user()->is_admin != true) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }
        
        $restaurant = Restaurant::find($id);
        
        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant not found.'], 404);
        }
        
        $restaurant->delete();
        return response()->json(null, 204);
    }

    // --- FUNGSI SUGGEST YANG SUDAH DIPERBARUI ---
    public function suggest(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'description' => 'required|string',
            'operating_hours' => 'nullable|string|max:255',
            'price_range' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:255',
            'website_url' => 'nullable|string|max:255',
            // Tambahkan validasi untuk gambar
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $imageUrl = null;
        // Cek jika ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            // Simpan gambar di folder 'storage/app/public/restaurants'
            // dan dapatkan path-nya untuk disimpan di database.
            $path = $request->file('image')->store('restaurants', 'public');
            $imageUrl = $path;
        }

        // Hapus 'image' dari array karena tidak ada kolom 'image' di tabel
        unset($validatedData['image']);
        // Gabungkan data yang divalidasi dengan path gambar
        $dataToCreate = array_merge($validatedData, ['image_url' => $imageUrl]);

        // Buat restoran baru dengan data yang sudah lengkap
        $restaurant = $request->user()->restaurants()->create($dataToCreate);

        return response()->json([
            'message' => 'Terima kasih! Saran Anda akan kami tinjau.',
            'restaurant' => $restaurant
        ], 201);
    }
}