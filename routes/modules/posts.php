<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Post Routes
Route::controller(PostController::class)
    ->prefix('posts/')
    ->as('posts.')
    ->group(function () {
        Route::middleware(['auth','role:admin|author'])->group(function () {
            Route::get('create', 'getCreate')->name('create');
            Route::post('create', 'postCreate');
        });

        Route::get('{user:username}/{postSlug}', 'getShow')->name('show');
    });
