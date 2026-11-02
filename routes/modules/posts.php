<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Post Routes
Route::controller(PostController::class)
    ->prefix('posts/')
    ->as('posts.')
    ->group(function () {
        Route::middleware(['auth', 'role:admin|author'])->group(function () {
            Route::get('create', 'getCreate')->name('create');
            Route::post('create', 'postCreate');
            Route::post('images', 'postImage')->name('images');

            Route::get('{user:username}/{postSlug}/edit', 'getEdit')->name('edit');
            Route::put('{user:username}/{postSlug}/update', 'putUpdate')->name('update');

            Route::delete('{user:username}/{postSlug}/delete', 'postDelete')->name('delete');
        });

        Route::get('{user:username}/{postSlug}', 'getShow')->name('show');
    });
