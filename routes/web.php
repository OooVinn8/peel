<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🏠 Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// 👤 Register & Login
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.post');

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.post');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// 🔐 Route khusus user yang sudah login
Route::middleware(['auth'])->group(function () {

    // Profil
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::get('/history/{id}', [ProfileController::class, 'showHistoryOrder'])->name('history.show');
    Route::put('/profile/orders/{id}/status', [ProfileController::class, 'updateOrderStatus'])->name('profile.updateOrderStatus');

    // Keranjang
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');
    Route::post('/cart/update-note/{id}', [CartController::class, 'updateNote'])->name('cart.updateNote');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

    // Pesanan User
    Route::get('/orders', [UserController::class, 'myOrders'])->name('user.orders');
    Route::get('/orders/{id}', [UserController::class, 'showOrder'])->name('user.orders.show');


    //Order
    Route::post('/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/thankyou/{order}', [CheckoutController::class, 'thankyou'])->name('checkout.thankyou');
});

// Menu, Tentang, & Footer
Route::get('/menu', [MenuController::class, 'index'])->name('menu.main');
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.menu-detail');

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/kebijakan-privasi', [FooterController::class, 'privacy'])->name('privacy');
Route::get('/syarat-dan-ketentuan', [FooterController::class, 'terms'])->name('terms');

// 🧑‍💼 Admin Routes (pakai middleware class langsung)

// ======================
//   ROUTE ADMIN ONLY
// ======================
Route::prefix('admin')
    ->middleware(['auth', IsAdmin::class])
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Orders
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');
        Route::put('/orders/{id}', [AdminOrderController::class, 'update'])->name('orders.update');

        // Categories
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Products
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

        // Users
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    });
