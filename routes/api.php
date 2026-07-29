<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Health
Route::get('/health', function () {
    return response()->json([
        'message' => 'API is working 🚀'
    ], 200);
});

// DB Test
Route::get('/connectivity', function () {
    try {
        DB::connection()->getPdo();

        return response()->json([
            'message' => 'Database connected successfully ✅'
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Database connection failed ❌',
            'details' => $e->getMessage()
        ], 500);
    }
});

// Auth
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // Accessible to all users
    Route::get('/users', [UserController::class, 'index']);
    Route::put('/users/{id}', [UserController::class, 'update']);

    // Admin only
    Route::middleware('admin')->group(function () {
        Route::post('/users', [UserController::class, 'store']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
    });
});

