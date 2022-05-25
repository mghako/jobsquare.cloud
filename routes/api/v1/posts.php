<?php

use App\Http\Controllers\API\v1\PostController;
use Illuminate\Support\Facades\Route;


// v1 posts
Route::prefix('v1')->name('posts.')->group(function() {
    Route::get('posts', [PostController::class, 'index'])->name('index');
    Route::post('posts', [PostController::class, 'store'])->name('store');
    Route::get('posts/{id}', [PostController::class, 'show'])->name('show');
    Route::put('posts/{id}', [PostController::class, 'update'])->name('update');
    Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('destroy');
});