<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\Admin\RestaurantController as AdminRestaurantController;

// Rute Publik
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show']);
Route::get('/topics', [TopicController::class, 'index']);
Route::get('/topics/{topic}', [TopicController::class, 'show']);

// Rute Terproteksi (Untuk Pengguna Biasa yang Login)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::post('/topics', [TopicController::class, 'store']);
    Route::post('/comments', [CommentController::class, 'store']);
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::post('/restaurants/suggest', [RestaurantController::class, 'suggest']);

    // Rute Admin (Workaround)
    Route::post('/restaurants/delete/{id}', [RestaurantController::class, 'destroy']);
    Route::post('/restaurants/update/{restaurant}', [RestaurantController::class, 'update']);
});

// --- GRUP ROUTE ADMIN DENGAN PERBAIKAN ---
// Kita hapus 'can:is-admin' dari sini
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/restaurants', [AdminRestaurantController::class, 'index']);
    Route::patch('/restaurants/{restaurant}/approve', [AdminRestaurantController::class, 'approve']);
});