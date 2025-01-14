<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
    // 
});

require __DIR__.'/auth.php';
