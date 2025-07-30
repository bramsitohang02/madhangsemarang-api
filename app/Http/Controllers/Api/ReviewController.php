<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        // Buat ulasan baru, hubungkan dengan user yang sedang login
        $review = $request->user()->reviews()->create($validatedData);

        // Muat data user untuk ditampilkan di frontend
        $review->load('user');

        // Kembalikan response sukses
        return response()->json($review, 201);
    }
}