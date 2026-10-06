<?php


use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [UserController::class,'login'])->name('login');
Route::post('/login', [UserController::class,'authenticate'])->name('loginPost');


Route::get('/register', [UserController::class,'register'])->name('register');
Route::post('/register', [UserController::class,'store']);



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
    Route::get('logout', [UserController::class,'logout'])->name('logout');

});
