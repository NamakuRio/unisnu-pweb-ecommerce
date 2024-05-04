<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/product');

/**
 * Route for Category
 */
Route::resource('category', CategoryController::class);

/**
 * Route for Product
 */
Route::resource('product', ProductController::class);
