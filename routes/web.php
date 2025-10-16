<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\FooterController;





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
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.menu-detail');

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/kebijakan-privasi', [FooterController::class, 'privacy'])->name('privacy');
Route::get('/syarat-dan-ketentuan', [FooterController::class, 'terms'])->name('terms');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

