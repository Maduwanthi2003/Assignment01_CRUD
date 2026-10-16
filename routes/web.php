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

    // Dashboard page (accessible to all authenticated users)
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    // Users management routes (restricted to Admin only)
    Route::middleware('role:admin')->group(function () {
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
    });

    // Products routes
    // Show all products (view-only for Staff, full access for Admin and Manager)
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    // Products mutation routes (restricted to Admin and Manager)
    Route::middleware('role:admin,manager')->group(function () {
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
    });

    // Customers routes
    // Show all customers (view-only for Staff, full access for Admin and Manager)
    Route::get('/customers', [CustomerController::class, 'index'])
        ->name('customers.index');

    // Customers mutation routes (restricted to Admin and Manager)
    Route::middleware('role:admin,manager')->group(function () {
        // Show add customer form
        Route::get('/customers/create', [CustomerController::class, 'create'])
            ->name('customers.create');

        // Save new customer
        Route::post('/customers', [CustomerController::class, 'store'])
            ->name('customers.store');

        // Show edit customer form
        Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])
            ->name('customers.edit');

        // Update customer
        Route::put('/customers/{customer}', [CustomerController::class, 'update'])
            ->name('customers.update');

        // Delete customer
        Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])
            ->name('customers.destroy');
    });
});
