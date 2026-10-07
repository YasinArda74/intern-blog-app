<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/lang/{locale}', function (string $locale) {
    abort_unless(in_array($locale, ['en', 'tr'], true), 404);

    session(['locale' => $locale]);

    return back();
})->name('lang.switch');

// Index Routes
Route::get('/', [IndexController::class, 'getHome'])->name('home');

// Auth Routes
Route::controller(AuthController::class)->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('login', 'getLogin')->name('login');
        Route::post('login', 'postLogin');

        Route::get('register', 'getRegister')->name('register');
        Route::post('register', 'postRegister');
    });

    Route::get('logout', 'getLogout')->name('logout')->middleware('auth');
});

// Post Routes
Route::controller(PostController::class)
    ->prefix('posts')
    ->as('posts.')
    ->group(function () {
        Route::middleware(['auth'])->group(function () {
            Route::get('create', 'getCreate')->name('create');
            Route::post('create', 'postCreate');
        });
    });

// Profile Routes
Route::controller(ProfileController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::prefix('profile')->as('profile.')->group(function () {
            Route::get('/', 'getProfile')->name('show');

            Route::get('edit', 'getEdit')->name('edit');
            Route::put('edit', 'putEdit');
        });
    });
