<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\InventoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // ✅ FIXED: Use ProductController@index instead of AdminController@product
    Route::get('/product', [ProductController::class, 'index'])->name('admin.product');

    Route::get('/inventory', [AdminController::class, 'inventory'])->name('admin.inventory');
    Route::get('/customers', [AdminController::class, 'customers'])->name('admin.customers');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/sales', [AdminController::class, 'sales'])->name('admin.sales');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/
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

/*
|--------------------------------------------------------------------------
| Admin - Employees
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/{employee}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('/employee/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employee/{employee}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::put('/transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');
});

/*
|--------------------------------------------------------------------------
| Supplier Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/supplier', [SupplierController::class, 'index'])->name('admin.supplier.index');
    Route::post('/supplier', [SupplierController::class, 'store'])->name('admin.supplier.store');
    Route::put('/supplier/{supplier}', [SupplierController::class, 'update'])->name('admin.supplier.update');
    Route::delete('/supplier/{supplier}', [SupplierController::class, 'destroy'])->name('admin.supplier.destroy');
});

/*
|--------------------------------------------------------------------------
| Services Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/services', [ServiceController::class, 'index'])->name('admin.services');
    Route::post('/services', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::put('/services/{serviceId}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('/services/{serviceId}', [ServiceController::class, 'delete'])->name('admin.services.delete');
});

/*
|--------------------------------------------------------------------------
| Bookings Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('admin.bookings');
    Route::put('/bookings/{bookingId}', [BookingController::class, 'update'])->name('admin.bookings.update');
    Route::delete('/bookings/{bookingId}', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');
});

/*
|--------------------------------------------------------------------------
| Product & Category Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // ✅ Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{productId}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{productId}', [ProductController::class, 'destroy'])->name('products.destroy');

    // ✅ Categories
    Route::get('/categories', [CategoryController::class, 'categories'])->name('categories');
    Route::post('/categories/store', [CategoryController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{categoryId}', [CategoryController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{categoryId}', [CategoryController::class, 'deleteCategory'])->name('categories.delete');


    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::post('/inventory/store', [InventoryController::class, 'store'])->name('inventory.store');
    Route::put('/inventory/{inventory}/update', [InventoryController::class, 'update'])->name('inventory.update');
});






    
