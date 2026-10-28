<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;


Route::controller(TagController::class)
    ->prefix('tags')
    ->as('tags.')
    ->group(function () {
        Route::get('/', 'getList')->name('list');
        Route::post('/', 'getList');

        Route::get('/create','getCreate')->name('create');
        route::post('/create', 'postCreate')->name('create');

        Route::get('{tag}/delete', 'deleteTag')->name('delete');


        Route::get('{tag}/edit', 'getUpdate')->name('edit');
        Route::put('{tag}/update', 'putUpdate')->name('update');
    });
