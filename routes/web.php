<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VideoLikeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/videos')->controller(VideoController::class)->name('videos.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{video}', 'show')->name('show');
        Route::get('/{video}/edit', 'edit')->name('edit');
        Route::put('/{video}', 'update')->name('update');
        Route::delete('/{video}', 'destroy')->name('destroy');

        /**
         * TODO: Group this
         */
        Route::post('/videos/{video}/like', [VideoLikeController::class, 'like'])->name('videos.like');
        Route::post('/videos/{video}/dislike', [VideoLikeController::class, 'dislike'])->name('videos.dislike');
    });


});

require __DIR__.'/auth.php';
