<?php

use App\Http\Controllers\LoginSessionController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterUserController;

// Guest routes (only accessible when not logged in)
Route::middleware('guest')->group(function () {
    // Login routes
    Route::get('/login', [LoginSessionController::class, 'create'])->name('login');
    Route::post('/login', [LoginSessionController::class, 'store']);
    
    // Register routes
    Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'store']);
});


// Protected routes (only accessible when logged in)
Route::middleware('auth')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/filter', [ProductController::class, 'filter'])->name('products.filter');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::get('/products/{id}', [ProductController::class, 'find'])->name('products.find');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    
    // Logout route
    Route::get('/logout', [LoginSessionController::class, 'destroy'])->name('logout');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/products', [App\Http\Controllers\AdminController::class, 'products'])->name('admin.products');
    Route::get('/orders', [App\Http\Controllers\AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::get('/categories', [App\Http\Controllers\AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/reports', [App\Http\Controllers\AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/settings', [App\Http\Controllers\AdminController::class, 'settings'])->name('admin.settings');
});