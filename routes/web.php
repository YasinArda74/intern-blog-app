<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
        Route::middleware(['auth','role:admin|author'])->group(function () {
            Route::get('create', 'getCreate')->name('create');
            Route::post('create', 'postCreate');

            Route::get('show/{post}', 'getShow')->name('show');
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


//Dashboard Routes
Route::controller(DashboardController::class)
    ->prefix('dashboard')
    ->as('admin.')
    ->group(function () {
        Route::middleware(['auth','role:admin'])->group(function () {
            Route::get('', 'dashboard')->name('dashboard');

            Route::get('dashboard/categories', 'getCategoryIndex')->name('getCategories');
            Route::POST('dashboard/categories', 'postCategoryIndex');

            Route::get('roles/index', 'getRolesIndex')->name('getRoles');
            Route::POST('roles/index', 'postRolesIndex');

        });
    });
