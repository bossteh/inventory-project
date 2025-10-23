<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

Route::get('/', function() {
    return redirect()->route('dashboard');
});

// ✅ Use the controller instead of direct view
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('transactions', TransactionController::class);

Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('reports/stock', [ReportController::class, 'stock'])->name('reports.stock');
Route::get('reports/transactions', [ReportController::class, 'transactions'])->name('reports.transactions');
