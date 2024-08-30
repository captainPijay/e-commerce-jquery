<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');
});

Route::middleware(['auth:web'])->prefix('back-office')->group(function () {
    Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
    Route::post('/products/store', [ProductsController::class, 'store'])->name('products.store');
    Route::put('/products/update/{id}', [ProductsController::class, 'update'])->name('products.update');
    Route::delete('/products/destroy/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');

    Route::get('/dashboard', [ProductsController::class, 'dashboard'])->name('products.dashboard');
});

Route::middleware(['auth:customers'])->prefix('front-office')->group(function () {
    Route::post('/save-order', [OrdersController::class, 'store']);
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
});
