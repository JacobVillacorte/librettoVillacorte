<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\ReviewController;

// ✅ 1. Login route (no token required)
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


// ✅ 2. Protected routes (require Sanctum token)
Route::middleware('auth:sanctum', 'check.token.expiry')->group(function () {
    //Route::post('/logout', [LogoutController::class, 'logout']); // (Optional: implement this)
    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('books', BookController::class);
    Route::apiResource('genres', GenreController::class);
    Route::apiResource('reviews', ReviewController::class);
});
