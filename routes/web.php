<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/product', [AdminController::class, 'product'])->name('admin.product');
    Route::get('/inventory', [AdminController::class, 'inventory'])->name('admin.inventory');
    Route::get('/customers', [AdminController::class, 'customers'])->name('admin.customers');
    Route::get('/supplier', [AdminController::class, 'suppliers'])->name('admin.supplier');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/sales', [AdminController::class, 'sales'])->name('admin.sales');
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
    Route::get('/employee', [AdminController::class, 'employee'])->name('admin.employee');
    Route::get('/stocks', [AdminController::class, 'stocks'])->name('admin.stocks');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});
