<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthCheck;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'fetchData']);
Route::get('/Shop', [ProductController::class, 'fetchAllData']);
Route::get('/Login', [UserController::class, 'login'])->name('Login');
Route::post('/Login', [UserController::class, 'loginPost'])->name('login.post');
Route::post('/Registration', [UserController::class, 'RegistrationPost'])->name('Registration.post');
Route::get('/Registration', [UserController::class, 'registration'])->name('Registration');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/Cart', function () {
    return view('cart');
});
Route::middleware([AuthCheck::class])->group(function () {
    Route::get('/delete-cart-product', [ProductController::class, 'deleteProduct'])->name('delete.cart.product');
    Route::post('/Cart/Checkout', [OrderController::class, 'Checkout']);
    Route::get('/book/{id}', [ProductController::class, 'addToCart'])->name('addbook.to.cart');
});


Route::get('/Registration', function () {
    return view('signup');
});

Route::get('/Blog', function () {
    return view('blog');
});
Route::get('/Contact', function () {
    return view('head');
});
Route::get('/Product', function () {
    return view('product');
});
Route::get('/About', function () {
    return view('about');
});