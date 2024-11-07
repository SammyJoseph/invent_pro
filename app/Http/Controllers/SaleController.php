<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SaleController extends Controller
{
    public function index()
    {
        $products = Product::with(['image', 'categories'])->get()->map(function ($product) {
            $product->image_url = $product->image ? Storage::url($product->image->url) : null;
            $product->categories_list = $product->categories->pluck('name')->toArray();
            return $product;
        });
    
        return view('sales.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
        ]);
    
        /* Log::info('Datos recibidos para registrar venta', [
            'products' => $request->products,
            'total_amount' => $request->total_amount
        ]); */
    
        try {
            DB::beginTransaction();
    
            $totalCost = 0;
            $totalProfit = 0;
            $productDetails = [];
    
            foreach ($request->products as $productData) {
                $product = Product::findOrFail($productData['id']);
                $quantity = $productData['quantity'];
                $salePrice = $productData['price'];
    
                $purchasePrice = $product->purchase_price;
                $totalCost += $purchasePrice * $quantity;
                $totalProfit += ($salePrice - $purchasePrice) * $quantity;
    
                $productDetails[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'purchase_price' => $purchasePrice,
                    'sale_price' => $salePrice,
                    'quantity' => $quantity
                ];
            }
    
            // Log::info('Detalles de los productos para la venta', ['products' => $productDetails]);
    
            $sale = Sale::create([
                'sale_date' => now(),
                'total_amount' => $request->total_amount,
                'total_cost' => $totalCost,
                'total_profit' => $totalProfit,
                'payment_method' => 'efectivo',
                'notes' => null,
            ]);
    
            // Asociar productos a la venta
            foreach ($request->products as $productData) {
                $sale->products()->attach($productData['id'], [
                    'quantity' => $productData['quantity'],
                    'sale_price' => $productData['price'],
                    'purchase_price' => Product::find($productData['id'])->purchase_price
                ]);
    
                $product = Product::find($productData['id']);
                $product->stock -= $productData['quantity'];
                $product->save();
            }
    
            DB::commit();
    
            Log::info('Venta registrada con éxito', [
                'sale_id' => $sale->id, 
                'total_amount' => $sale->total_amount,
                'total_cost' => $sale->total_cost,
                'total_profit' => $sale->total_profit
            ]);
    
            return response()->json([
                'success' => true,
                'data' => [
                    'sale_id' => $sale->id,
                    'total_amount' => $sale->total_amount,
                    'total_cost' => $sale->total_cost,
                    'total_profit' => $sale->total_profit,
                ]
            ]);
    
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al registrar la venta', ['error' => $e->getMessage()]);
    
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la venta: ' . $e->getMessage()
            ], 500);
        }
    }
}
