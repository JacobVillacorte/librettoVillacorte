<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReviewController;

Route::resource('authors', AuthorController::class);
Route::resource('books', BookController::class);
Route::resource('genres', GenreController::class);
Route::resource('reviews', ReviewController::class);

Route::get('/', function () {
    return view('home');
});
