<?php

use App\Http\Controllers\API\SelectSearchController;
use Illuminate\Support\Facades\Route;

Route::controller(SelectSearchController::class)
    ->prefix('select-search')
    ->name('select-search.')
    ->group(function () {
        // Search Category
        Route::get('categories', 'getCategories')->name('categories');

        // Search Full Name or Email
        Route::get('users', 'getUsers')->name('users');
    });
