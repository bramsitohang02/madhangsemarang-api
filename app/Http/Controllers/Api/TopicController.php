<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topics = Topic::with('user')->latest()->get();
        return response()->json($topics);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $topic = Topic::create([
            'title' => $validatedData['title'],
            'user_id' => $request->user()->id, 
        ]);

        return response()->json($topic, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        // Ambil data topik beserta relasi 'user' (pembuat topik) 
        // dan relasi 'comments' (semua komentar), 
        // dan juga relasi 'user' dari setiap comment.
        $topic->load('user', 'comments.user'); 

        return response()->json($topic);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        //
    }
}