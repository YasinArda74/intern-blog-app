<?php

use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::controller(PostController::class)
    ->prefix('posts')
    ->as('posts.')
    ->group(function () {
        Route::get('/', 'getList')->name('list');
    });
