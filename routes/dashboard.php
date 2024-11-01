<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    $sales = Sale::all();

    // Obtener todos los productos ordenados por monto total vendido
    $productSales = Product::select(
            'products.id', 
            'products.name', 
            DB::raw('SUM(product_sale.quantity) as total_sold'),
            DB::raw('SUM(product_sale.quantity * product_sale.price) as total_amount')
        )
        ->join('product_sale', 'products.id', '=', 'product_sale.product_id')
        ->groupBy('products.id', 'products.name')
        ->orderByDesc('total_amount')
        ->get();

    $totalSales = $productSales->sum('total_amount');
    $targetAmount = $totalSales * 0.6; // 60% del total de ventas

    $categoryA = collect();
    $runningTotal = 0;

    foreach ($productSales as $product) {
        $categoryA->push($product);
        $runningTotal += $product->total_amount;

        if ($runningTotal >= $targetAmount) {
            break;
        }
    }    

    /* $topSellingProducts = Product::select(
            'products.id', 
            'products.name', 
            DB::raw('SUM(product_sale.quantity) as total_sold'),
            DB::raw('SUM(product_sale.quantity * product_sale.price) as total_amount')
        )
        ->join('product_sale', 'products.id', '=', 'product_sale.product_id')
        ->groupBy('products.id', 'products.name')
        ->orderByDesc('total_sold')
        ->limit(5)
        ->get(); */

    return view('dashboard', compact('sales', 'categoryA'));
})->name('index');


Route::get('/components-accordion', function () {
    return view('dashboard.components-accordion');
})->name('components-accordion');

Route::resource('products', ProductController::class);

Route::post('upload', [ProductController::class, 'upload'])->name('products.upload');