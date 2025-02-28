<?php

use App\Http\Controllers\LoginSessionController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterUserController;

Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/filter', [ProductController::class, 'filter'])->name('products.filter');

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

Route::post('/products', [ProductController::class, 'store'])->name('products.store');

Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

Route::get('/products/{id}', [ProductController::class, 'find'])->name('products.find');

Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

//Auth
//register
Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

//login
Route::get('/login', [LoginSessionController::class, 'create']);
Route::post('/login', [LoginSessionController::class, 'store']);
//login
Route::get('/logout', [LoginSessionController::class, 'destroy']);