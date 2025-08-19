<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Menampilkan semua agenda untuk admin (termasuk yang pending).
     */
    public function index()
    {
        if (auth()->user()->is_admin != true) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }
        return Event::orderBy('status', 'asc')->orderBy('event_date', 'desc')->get();
    }

    /**
     * Menyimpan agenda baru.
     */
    public function store(Request $request)
    {
        if (auth()->user()->is_admin != true) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date',
        ]);

        // Gabungkan data yang divalidasi dengan ID pengguna yang sedang login
        $dataToCreate = array_merge($validatedData, ['user_id' => auth()->id()]);

        $event = Event::create($dataToCreate);
        return response()->json($event, 201);
    }

    /**
     * Menampilkan satu agenda spesifik.
     */
    public function show(Event $event)
    {
        if (auth()->user()->is_admin != true) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }
        return $event;
    }

    /**
     * Memperbarui agenda.
     */
    public function update(Request $request, Event $event)
    {
        if (auth()->user()->is_admin != true) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date',
        ]);

        $event->update($validatedData);
        return response()->json($event);
    }

    /**
     * Menghapus agenda.
     */
    public function destroy(Event $event)
    {
        if (auth()->user()->is_admin != true) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }

        $event->delete();
        return response()->json(null, 204);
    }

    /**
     * Menyetujui sebuah agenda.
     */
    public function approve(Event $event)
    {
        if (auth()->user()->is_admin != true) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }

        $event->status = 'approved';
        $event->save();

        return response()->json(['message' => 'Agenda berhasil disetujui.']);
    }
}
