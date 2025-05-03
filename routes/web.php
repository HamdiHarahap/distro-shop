<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        $products = Product::orderBy('id', 'desc')->limit(4)->get();
        return view('home', compact('products'));
    })->name('home');

    Route::get('/products', [ProductController::class, 'index'])->name('posts');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('post');
    Route::get('/products/{category}', [ProductController::class, 'category'])->name('posts.category');

    Route::get('/keranjang', [CartController::class, 'index'])->name('cart');
    Route::post('/keranjang', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/keranjang/{key}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('checkout.process');
});

