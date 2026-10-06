<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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


Route::middleware(['auth'])->group( function () {;

    Route::get('/', [UserController::class,'HomePage'])->name('HomePage');

    Route::get('form', function () {
        return view('posts.form');
    });
    Route::get('edit', function () {
        return view('posts.edit');
    });
    Route::get('/create', [UserController::class,'create'])->name('posts.create');
    Route::post('/create', [UserController::class,'createPost']);

    Route::get('/profileEdit', [UserController::class,'profileEdit'])->name('profileEdit');
    Route::put('/profileEdit', [UserController::class,'updateProfil']);

    Route::get('show', function () {
        return view('posts.show');
    });
    Route::get('/profilAyarlari', [UserController::class,'ayarlar'])->name('profilAyarlari');
    Route::get('/showProfil', [UserController::class,'showProfil'])->name('showProfil');
});
