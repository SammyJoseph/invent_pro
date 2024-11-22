<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class Dashboard extends Component
{
    public $dateRange = '';
    public $startDate;
    public $endDate;

    public function mount()
    {
        /* $this->startDate = Carbon::now()->subDays(30)->format('d-m-Y');
        $this->endDate = Carbon::now()->subDays(15)->format('d-m-Y'); */
        $this->startDate = Carbon::create(2024, 10, 1)->format('d-m-Y');
        $this->endDate = Carbon::create(2024, 10, 31)->format('d-m-Y');
        $this->dateRange = $this->startDate . ' to ' . $this->endDate;
    }

    public function render()
    {
        $sales = $this->getSalesForDateRange();
        $productSales = $this->getProductSales();
        $totalProfit = $productSales->sum('total_profit');
    
        $categoryA = $this->getCategoryA($productSales, $totalProfit);
        $categoryB = $this->getCategoryB($productSales, $totalProfit);
        $categoryC = $this->getCategoryC($productSales, $totalProfit);
        
        return view('livewire.dashboard', compact('sales', 'categoryA', 'categoryB', 'categoryC'));
    }

    public function updatedDateRange($value)
    {
        $dates = explode(' to ', $value);
        $this->startDate = $dates[0] ?? null;
        $this->endDate = $dates[1] ?? null;
    }

    private function loadDataForDateRange($startDate, $endDate)
    {
        // Implementa la lógica para cargar los datos según el rango de fechas
        // Por ejemplo:
        // $this->categoryA = Product::whereBetween('date', [$startDate, $endDate])->where('category', 'A')->get();
        // $this->categoryB = Product::whereBetween('date', [$startDate, $endDate])->where('category', 'B')->get();
        // $this->categoryC = Product::whereBetween('date', [$startDate, $endDate])->where('category', 'C')->get();
    }

    private function getFormattedDates()
    {
        $start = Carbon::createFromFormat('d-m-Y', $this->startDate)->startOfDay();
        $end = Carbon::createFromFormat('d-m-Y', $this->endDate)->endOfDay();
        
        return [
            $start->format('Y-m-d H:i:s'),
            $end->format('Y-m-d H:i:s')
        ];
    }
    
    private function getSalesForDateRange(): Collection
    {
        $query = Sale::query();
        
        if ($this->startDate && $this->endDate) {
            [$start, $end] = $this->getFormattedDates();
            $query->whereBetween('sale_date', [$start, $end]);
        }
        
        return $query->get();
    }
    
    private function getProductSales(): Collection
    {
        $query = Product::select(
                'products.id', 
                'products.name', 
                'products.stock',
                'products.purchase_price',
                DB::raw('SUM(product_sale.quantity) as total_sold'),
                DB::raw('SUM(product_sale.quantity * product_sale.sale_price) as total_amount'),
                DB::raw('SUM(product_sale.quantity * (product_sale.sale_price - products.purchase_price)) as total_profit'),
                DB::raw('GROUP_CONCAT(DISTINCT sales.sale_date ORDER BY sales.sale_date DESC SEPARATOR ", ") as sale_dates')
            )
            ->join('product_sale', 'products.id', '=', 'product_sale.product_id')
            ->join('sales', 'product_sale.sale_id', '=', 'sales.id');
    
        if ($this->startDate && $this->endDate) {
            [$start, $end] = $this->getFormattedDates();
            $query->whereBetween('sales.sale_date', [$start, $end]);
        }
    
        return $query->groupBy('products.id', 'products.name', 'products.stock', 'products.purchase_price')
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
