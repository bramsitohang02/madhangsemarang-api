<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Fungsi untuk menampilkan semua agenda yang sudah disetujui
    public function index()
    {
        return Event::where('status', 'approved')->orderBy('event_date', 'desc')->get();
    }

    // Fungsi untuk pengguna menyarankan agenda baru
    public function suggest(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date',
        ]);

        $event = $request->user()->events()->create($validatedData);

        return response()->json([
            'message' => 'Terima kasih! Saran agenda Anda akan kami tinjau.'
        ], 201);
    }
}