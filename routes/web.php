<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/lang/{locale}', function (string $locale) {
    abort_unless(in_array($locale, ['en', 'tr'], true), 404);

    session(['locale' => $locale]);

    return back();
})->name('lang.switch');

// Index Routes
Route::get('/', [IndexController::class, 'getHome'])->name('home');

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

// Dashboard Routes
Route::controller(DashboardController::class)
    ->prefix('dashboard')
    ->as('admin.')
    ->group(function () {
        Route::middleware(['auth', 'role:admin'])->group(function () {
            Route::get('', 'dashboard')->name('dashboard');

            Route::get('dashboard/users', 'getUsersIndex')->name('getUsers');
            Route::post('dashboard/users', 'getUsersIndex')->name('getUsers');

            Route::get('dashboard/rolpermissions', 'getRolAsPermissions')->name('getRolAsPermissions');
        });
    });

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::post('permissions/import', [PermissionController::class, 'import'])->name('permissions.import');
});

Route::middleware('auth')->group(function () {
    Route::post('comments', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('comments/{comment}', [CommentController::class, 'delete'])->name('comment.delete');
});
