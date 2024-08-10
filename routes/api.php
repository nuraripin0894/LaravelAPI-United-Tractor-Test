<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;

// Route::post('/login', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index');
    Route::post('/products', 'store');
    Route::get('/products/{id}', 'show');
    Route::patch('/products/{id}', 'update');
    Route::delete('/products/{id}', 'destroy');
});

Route::controller(ProductCategoryController::class)->group(function () {
    Route::get('/categories', 'index');
    Route::post('/categories', 'store');
    Route::get('/categories/{id}', 'show');
    Route::put('/categories/{id}', 'update');
    Route::delete('/categories/{id}', 'destroy');
});
