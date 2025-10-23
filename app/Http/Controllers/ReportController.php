<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;

class ReportController extends Controller
{
    // Reports index page
    public function index()
    {
        return view('reports.index');
    }

    // Stock report
    public function stock()
    {
        // Load all products with their category
        $products = Product::with('category')->get();
        return view('reports.stock', compact('products'));
    }

    // Transaction report
    public function transactions(Request $request)
    {
        $query = Transaction::with('product');

        // Filter by date if provided
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();
        return view('reports.transactions', compact('transactions'));
    }
}
