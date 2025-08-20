<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\Admin\RestaurantController as AdminRestaurantController;
use App\Http\Controllers\Api\Admin\EventController as AdminEventController;
use App\Http\Controllers\Api\RestaurantPhotoController;

// --- RUTE PUBLIK ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show']);
Route::get('/topics', [TopicController::class, 'index']);
Route::get('/topics/{topic}', [TopicController::class, 'show']);
Route::get('/events', [EventController::class, 'index']);

// --- RUTE PENGGUNA TERDAFTAR ---
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::post('/topics', [TopicController::class, 'store']);
    Route::post('/comments', [CommentController::class, 'store']);
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::post('/restaurants/suggest', [RestaurantController::class, 'suggest']);
    Route::post('/events/suggest', [EventController::class, 'suggest']);
    Route::post('/restaurants/photos', [RestaurantPhotoController::class, 'store']);
});

// --- RUTE KHUSUS ADMIN ---
// Pemeriksaan admin akan dilakukan secara manual di dalam setiap controller
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    // Rute Admin untuk Restoran
    Route::get('/restaurants', [AdminRestaurantController::class, 'index']);
    Route::patch('/restaurants/{restaurant}/approve', [AdminRestaurantController::class, 'approve']);
    
    // Rute LENGKAP untuk Manajemen Agenda
    Route::get('/events', [AdminEventController::class, 'index']);
    Route::post('/events', [AdminEventController::class, 'store']);
    Route::get('/events/{event}', [AdminEventController::class, 'show']);
    Route::put('/events/{event}', [AdminEventController::class, 'update']);
    Route::delete('/events/{event}', [AdminEventController::class, 'destroy']);
    
    // --- TAMBAHKAN RUTE APPROVE UNTUK AGENDA DI SINI ---
    Route::patch('/events/{event}/approve', [AdminEventController::class, 'approve']);
});
