<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/product', [AdminController::class, 'product'])->name('admin.product');
    Route::get('/inventory', [AdminController::class, 'inventory'])->name('admin.inventory');
    Route::get('/customers', [AdminController::class, 'customers'])->name('admin.customers');
    Route::get('/suppliers', [AdminController::class, 'suppliers'])->name('admin.suppliers');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/sales', [AdminController::class, 'sales'])->name('admin.sales');
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
    Route::get('/employee', [AdminController::class, 'employee'])->name('admin.employee');
    Route::get('/stocks', [AdminController::class, 'stocks'])->name('admin.stocks');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

// Customer Routes
Route::prefix('customer')->group(function () {
    Route::get('/', [UserController::class, 'home'])->name('customer.home');
    Route::get('/products', [UserController::class, 'products'])->name('customer.products');
    Route::get('/services', [UserController::class, 'services'])->name('customer.services');
    Route::get('/booking', [UserController::class, 'booking'])->name('customer.booking');
    Route::get('/cart', [UserController::class, 'cart'])->name('customer.cart');
    Route::get('/profile', [UserController::class, 'profile'])->name('customer.profile');
    Route::get('/checkout', [UserController::class, 'checkout'])->name('customer.checkout');
    Route::get('/orders', [UserController::class, 'orders'])->name('customer.orders');
    Route::get('/feedback', [UserController::class, 'feedback'])->name('customer.feedback');
    Route::get('/logout', [UserController::class, 'logout'])->name('customer.logout');
});
