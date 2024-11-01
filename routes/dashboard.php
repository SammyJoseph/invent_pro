<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('dashboard');
})->name('index');


Route::get('/components-accordion', function () {
    return view('dashboard.components-accordion');
})->name('components-accordion');

Route::resource('products', ProductController::class);

Route::post('upload', [ProductController::class, 'upload'])->name('products.upload');