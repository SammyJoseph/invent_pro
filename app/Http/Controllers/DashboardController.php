<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use stdClass;

class DashboardController extends Controller
{
    public function index(): View
    {
        $sales = Sale::all();
        $productSales = $this->getProductSales();
        $totalProfit = $productSales->sum('total_profit');

        $categoryA = $this->getCategoryA($productSales, $totalProfit);
        $categoryB = $this->getCategoryB($productSales, $totalProfit);
        $categoryC = $this->getCategoryC($productSales, $totalProfit);

        return view('dashboard', compact('sales', 'categoryA', 'categoryB', 'categoryC'));
    }

    private function getProductSales(): Collection
    {
        return Product::select(
                'products.id', 
                'products.name', 
                'products.purchase_price',
                DB::raw('SUM(product_sale.quantity) as total_sold'),
                DB::raw('SUM(product_sale.quantity * product_sale.sale_price) as total_amount'),
                DB::raw('SUM(product_sale.quantity * (product_sale.sale_price - products.purchase_price)) as total_profit')
            )
            ->join('product_sale', 'products.id', '=', 'product_sale.product_id')
            ->groupBy('products.id', 'products.name', 'products.purchase_price')
            ->orderByDesc('total_profit')
            ->get();
    }

    private function getCategoryA(Collection $productSales, float $totalProfit): Collection
    {
        return $this->getCategoryProducts($productSales, $totalProfit, 0.6);
    }

    private function getCategoryB(Collection $productSales, float $totalProfit): Collection
    {
        $categoryA = $this->getCategoryA($productSales, $totalProfit);
        $remainingProducts = $productSales->whereNotIn('id', $categoryA->pluck('id'));
        return $this->getCategoryProducts($remainingProducts, $totalProfit, 0.3);
    }

    private function getCategoryC(Collection $productSales, float $totalProfit): Collection
    {
        $categoryAB = $this->getCategoryA($productSales, $totalProfit)->merge($this->getCategoryB($productSales, $totalProfit));
        return $productSales->whereNotIn('id', $categoryAB->pluck('id'));
    }

    private function getCategoryProducts(Collection $products, float $totalProfit, float $targetPercentage): Collection
    {
        $category = collect();
        $runningTotal = 0;
        $targetProfit = $totalProfit * $targetPercentage;
    
        foreach ($products as $product) {
            $category->push($product);
            $runningTotal += $product->total_profit;
    
            if ($runningTotal >= $targetProfit) {
                break;
            }
        }
    
        return $category;
    }

}