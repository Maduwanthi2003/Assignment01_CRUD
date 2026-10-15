<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;

// Authentication routes (accessible only by guests)
Route::middleware('guest')->group(function () {
    // Show login page
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    // Handle login form submission
    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.submit');
});

// Protected routes (require login)
Route::middleware('auth')->group(function () {

    // Dashboard page
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    // Users CRUD routes
    // Show all users
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    // Show add user form
    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create');

    // Save new user
    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');

    // Show edit user form
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit');

    // Update user
    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('users.update');

    // Delete user
    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy');

    // Products CRUD routes
    // Show all products
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    // Show add product form
    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create');

    // Save new product
    Route::post('/products', [ProductController::class, 'store'])
        ->name('products.store');

    // Show edit product form
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');

    // Update product
    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->name('products.update');

    // Delete product
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->name('products.destroy');

    // Customers CRUD routes (index, create, store, edit, update, destroy)
    Route::resource('customers', CustomerController::class)
        ->except(['show']);
});
