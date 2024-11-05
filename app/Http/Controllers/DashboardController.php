<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use stdClass;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard');
    }
}