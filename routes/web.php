<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;


Route::get('/', function () {
    return view('main');
});
//regis
Route::get('/register', [UserController::class, 'showRegisterForm']);
Route::post('/register', [UserController::class, 'register']);

//login
Route::get('/login', [UserController::class, 'showLoginForm']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/main', [UserController::class, 'main']);
Route::get('/profile', [UserController::class, 'showProfileForm']);

Route::get('/menu', [MenuController::class, 'index'])->name('menu.main');


Route::post('/logout', [UserController::class, 'logout'])->name('logout');