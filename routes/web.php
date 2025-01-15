<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
//route resource for products
Route::resource('/products', \App\Http\Controllers\ProductController::class);
Route::resource('/posts', \App\Http\Controllers\PostController::class);
Route::resource('/comments', \App\Http\Controllers\CommentController::class);
Route::resource('/reporters', \App\Http\Controllers\ReporterController::class);
Route::resource('/scores', \App\Http\Controllers\ScoreController::class);
Route::resource('/students', \App\Http\Controllers\StudentController::class);
Route::resource('/reviews', \App\Http\Controllers\ReviewController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});

require __DIR__.'/auth.php';
