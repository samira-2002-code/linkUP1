<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
| HOME → LOGIN
*/
Route::get('/', function () {
    return redirect('/login');
});

/*
| FEED (after login only)
*/
Route::middleware('auth')->group(function () {

    Route::get('/feed', [PostController::class, 'index'])->name('feed');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';