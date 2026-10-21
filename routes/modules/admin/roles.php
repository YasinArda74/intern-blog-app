<?php

use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::controller(RoleController::class)
    ->prefix('roles')
    ->as('roles.')
    ->group(function () {
        Route::get('/', 'getList')->name('list');

        Route::get('create', 'getCreate')->name('create');
        Route::post('create', 'postCreate');

        Route::get('{role}/edit', 'getEdit')->name('edit');
        Route::put('{role}/update', 'putUpdate')->name('update');

        Route::get('{role}/delete', 'getDelete')->name('delete');
    });
