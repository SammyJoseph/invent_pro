<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('dashboard');
})->name('index');


Route::get('/components-accordion', function () {
    return view('dashboard.components-accordion');
})->name('components-accordion');