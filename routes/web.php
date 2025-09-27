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
    Route::get('/services', [AdminController::class, 'services'])->name('admin.services');
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


use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/{employee}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('/employee/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employee/{employee}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
});



Route::get('/admin/services', [ServiceController::class, 'index'])->name('admin.services');
Route::post('/admin/services', [ServiceController::class, 'store'])->name('admin.services.store');
Route::put('/admin/services/{serviceId}', [ServiceController::class, 'update'])->name('admin.services.update');
Route::delete('/admin/services/{serviceId}', [ServiceController::class, 'delete'])->name('admin.services.delete');

// Bookings
Route::get('/admin/bookings', [BookingController::class, 'index'])->name('admin.bookings');
Route::put('/admin/bookings/{bookingId}', [BookingController::class, 'update'])->name('admin.bookings.update');
Route::delete('/admin/bookings/{bookingId}', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');




// Admin routes group
Route::prefix('admin')->name('admin.')->group(function () {

     Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{productId}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{productId}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Category Management
    Route::get('/categories', [CategoryController::class, 'categories'])->name('categories');
    Route::post('/categories/store', [CategoryController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{categoryId}', [CategoryController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{categoryId}', [CategoryController::class, 'deleteCategory'])->name('categories.delete');
});
