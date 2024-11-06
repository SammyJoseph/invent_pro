<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('index');

Route::get('/components-accordion', function () {
    return view('dashboard.components-accordion');
})->name('components-accordion');

Route::resource('products', ProductController::class);

// plugin de imágenes
Route::post('upload', [ProductController::class, 'upload'])->name('products.upload');

Route::get('sales', [SaleController::class, 'index'])->name('sales.index');