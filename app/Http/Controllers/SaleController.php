<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SaleController extends Controller
{
    public function index()
    {
        $products = Product::with(['image', 'categories'])->get()->map(function ($product) {
            $product->image_url = $product->image ? Storage::url($product->image->url) : null;
            $product->category_names = $product->categories->pluck('name')->implode(', ');
            return $product;
        });
    
        return view('sales.index', compact('products'));
    }
}
