<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserVideoController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VideoLikeController;
use App\Http\Middleware\AuthorizeVideoOwner;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/search', [SearchController::class, 'index'])->name('search.index');

    Route::get('/users/{user}', [UserVideoController::class, 'index'])->name('users.videos.index');

    Route::prefix('/videos')->controller(VideoController::class)->name('videos.')->group(function() {

        Route::get('/','index')->name('index');
        Route::view('/create', 'videos.create')->name('create');

        Route::post('/', 'store')->name('store');


        Route::middleware(AuthorizeVideoOwner::class)->group(function () {
            Route::get('/{video}', 'show')->name('show');
            Route::get('/{video}/edit', 'edit')->name('edit');
            Route::put('/{video}', 'update')->name('update');
            Route::delete('/{video}', 'destroy')->name('destroy');
        });

        Route::prefix('{video}')->group(function () {
             Route::post('/like', [VideoLikeController::class, 'like'])->name('like');
             Route::post('/dislike', [VideoLikeController::class, 'dislike'])->name('dislike');
        });
    });
});

require __DIR__.'/auth.php';
