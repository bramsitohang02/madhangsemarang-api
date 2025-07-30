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
        $restaurant->load('reviews.user');
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

    // Tambahkan fungsi baru ini di dalam class RestaurantController
public function suggest(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'category' => 'required|string|max:50',
        'description' => 'required|string',
        // validasi lain jika ada, misal 'image_url'
    ]);

    // Buat restoran baru dengan status 'pending'
    // dan hubungkan dengan user yang sedang login
    $restaurant = $request->user()->restaurants()->create($validatedData);

    return response()->json([
        'message' => 'Terima kasih! Saran Anda akan kami tinjau.',
        'restaurant' => $restaurant
    ], 201);
}
}