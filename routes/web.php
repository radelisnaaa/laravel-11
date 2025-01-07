<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//route resource for products
Route::resource('/products', \App\Http\Controllers\ProductController::class);
Route::resource('/posts', \App\Http\Controllers\PostController::class);
Route::resource('/students', \App\Http\Controllers\StudentController::class);
Route::resource('/scores', \App\Http\Controllers\ScoreController::class);
Route::resource('/reporters', \App\Http\Controllers\ReporterController::class);
Route::resource('/comments', \App\Http\Controllers\CommentController::class);