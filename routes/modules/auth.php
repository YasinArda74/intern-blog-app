<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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
