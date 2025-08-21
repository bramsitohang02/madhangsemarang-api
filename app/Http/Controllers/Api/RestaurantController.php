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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        dd('Fungsi destroy berhasil dipanggil');
        // Pemeriksaan manual tidak lagi diperlukan karena sudah ada middleware Gate
        // Namun, kita tetap menyimpannya sebagai workaround untuk masalah environment Anda
        if (auth()->user()->is_admin != true) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }

        // Langsung hapus, tidak perlu mencari manual lagi
        $restaurant->delete();

        return response()->json(null, 204);
    }

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('restaurants', 'public');
            $imageUrl = $path;
        }

        unset($validatedData['image']);
        $dataToCreate = array_merge($validatedData, ['image_url' => $imageUrl]);

        $restaurant = $request->user()->restaurants()->create($dataToCreate);

        return response()->json([
            'message' => 'Terima kasih! Saran Anda akan kami tinjau.',
            'restaurant' => $restaurant
        ], 201);
    }
}