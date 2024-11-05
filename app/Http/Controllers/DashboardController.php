<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use stdClass;

class DashboardController extends Controller
{
    public function index(): View
    {
        $productCount = Product::count();

        return view('dashboard', compact('productCount'));
    }
}