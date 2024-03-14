<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Fetch data for charts
        $productSalesData = $this->getProductSalesData();
        return view('admin.index', [
            'productSalesData' => $productSalesData,
        ]);
    }

    // Function to get product sales data
    private function getProductSalesData()
    {
        $products = Product::select('id')
            ->withCount('orders')
            ->orderByDesc('orders_count')
            ->limit(5)
            ->get();

        $labels = $products->pluck('id');
        $name = $products->pluck('name');
        $data = $products->pluck('orders_count');

        return [
            'labels' => $labels,
            'data' => $data,
            'name' =>$name,
        ];
    }
}

