<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;


Route::controller(CategoryController::class)
    ->prefix('categories')
    ->as('categories.')
    ->group(function () {
        Route::get('/', 'getList')->name('list');
        Route::post('/', 'getList');

        Route::get('/create','getCreate')->name('create');
        route::post('/create', 'postCreate')->name('create');

        Route::get('{category}/delete', 'deleteCategory')->name('delete');


        Route::get('{category}/edit', 'getUpdate')->name('edit');
        Route::put('{category}/update', 'putUpdate')->name('update');
    });
