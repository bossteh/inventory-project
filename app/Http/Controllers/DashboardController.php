<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();

        $lowStockCount = Product::where('quantity', '>', 0)
            ->where('quantity', '<', 5)
            ->count();

        $outOfStockCount = Product::where('quantity', '=', 0)->count();

        $lowStockProducts = Product::where('quantity', '>', 0)
            ->where('quantity', '<', 5)
            ->get();

        $outOfStockProducts = Product::where('quantity', '=', 0)->get();

        $latestProducts = Product::orderBy('created_at', 'desc')->take(5)->get();
        $latestCategories = Category::orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'lowStockCount',
            'outOfStockCount',
            'lowStockProducts',
            'outOfStockProducts',
            'latestProducts',
            'latestCategories'
        ));
    }
}
