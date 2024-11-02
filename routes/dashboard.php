<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('index');

Route::get('/components-accordion', function () {
    return view('dashboard.components-accordion');
})->name('components-accordion');

Route::resource('products', ProductController::class);

Route::post('upload', [ProductController::class, 'upload'])->name('products.upload');