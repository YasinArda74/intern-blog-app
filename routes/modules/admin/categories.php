<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;


Route::controller(CategoryController::class)
    ->prefix('categories')
    ->as('categories.')
    ->group(function () {
        Route::get('/', 'getList')->name('list');
        Route::post('/', 'getList');

        Route::delete('{categories}', 'deleteCategory')->name('delete');

        Route::put('{categories}', 'putUpdate')->name('update');
    });
