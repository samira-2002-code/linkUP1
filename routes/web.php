<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;


/*
| HOME → LOGIN
*/
Route::get('/', function () {
    return redirect('/feed');
});

/*
| AUTHENTICATED ROUTES
*/
Route::middleware('auth')->group(function () {

    // Feed
    Route::get('/feed', [PostController::class, 'index'])->name('feed');

    // POSTS CRUD
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
    ->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->name('comments.destroy');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])
    ->name('likes.toggle');

    Route::post('/posts/{post}/pin', [PostController::class, 'togglePin'])
    ->name('posts.togglePin');
});

require __DIR__.'/auth.php';
Route::get('/profile/{id}', [PostController::class, 'profile'])->name('profile.show');
