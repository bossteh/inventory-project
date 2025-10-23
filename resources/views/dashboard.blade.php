@extends('layouts.app')

@section('content')
<h1 class="dashboard-title">Dashboard</h1>

<div class="dashboard-grid">
    <!-- Categories -->
    <div class="dashboard-card">
        <i class="fas fa-tags icon"></i>
        <div>
            <h2>Categories</h2>
            <p>{{ \App\Models\Category::count() }}</p>
        </div>
    </div>

    <!-- Products -->
    <div class="dashboard-card">
        <i class="fas fa-boxes icon"></i>
        <div>
            <h2>Products</h2>
            <p>{{ \App\Models\Product::count() }}</p>
        </div>
    </div>

    <!-- Transactions -->
    <div class="dashboard-card">
        <i class="fas fa-exchange-alt icon"></i>
        <div>
            <h2>Transactions</h2>
            <p>{{ \App\Models\Transaction::count() }}</p>
        </div>
    </div>

    <!-- Low Stock -->
    @php
        $lowStockCount = \App\Models\Product::where('quantity', '<=', 5)->where('quantity', '>', 0)->count();
        $outStockCount = \App\Models\Product::where('quantity', '=', 0)->count();
    @endphp

    <div class="dashboard-card clickable {{ $lowStockCount > 0 ? 'blink-warning' : '' }}" id="lowStockCard">
        <i class="fas fa-triangle-exclamation icon warning"></i>
        <div>
            <h2>Low Stock</h2>
            <p>{{ $lowStockCount }}</p>
        </div>
    </div>

    <!-- Out of Stock -->
    <div class="dashboard-card clickable {{ $outStockCount > 0 ? 'blink-danger' : '' }}" id="outOfStockCard">
        <i class="fas fa-box-open icon danger"></i>
        <div>
            <h2>Out of Stock</h2>
            <p>{{ $outStockCount }}</p>
        </div>
    </div>

    <!-- Total Inventory Value -->
    <div class="dashboard-card">
        <i class="fas fa-money-bill-wave icon success"></i>
        <div>
            <h2>Total Inventory Value</h2>
            <p>₱{{ number_format(\App\Models\Product::sum(\DB::raw('price * quantity')), 2) }}</p>
        </div>
    </div>
</div>

<!-- Low Stock Table -->
<div id="lowStockTable" class="hidden-table">
    <h2>⚠️ Low Stock Products</h2>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach(\App\Models\Product::where('quantity', '<=', 5)->where('quantity', '>', 0)->get() as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>{{ $product->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Out of Stock Table -->
<div id="outOfStockTable" class="hidden-table">
    <h2>📦 Out of Stock Products</h2>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach(\App\Models\Product::where('quantity', '=', 0)->get() as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>{{ $product->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Recent Transactions -->
<div style="margin-top:40px;">
    <h2>Recent Transactions</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Product</th>
                <th>Type</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach(\App\Models\Transaction::latest()->take(5)->get() as $txn)
                <tr>
                    <td>{{ $txn->created_at->format('Y-m-d') }}</td>
                    <td>{{ $txn->product->name ?? 'N/A' }}</td>
                    <td>
                        <span class="txn-type {{ strtolower($txn->type) }}">
                            {{ ucfirst($txn->type) }}
                        </span>
                    </td>
                    <td>{{ $txn->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
/* 🔹 Dashboard Layout Styles */
.dashboard-title {
    font-size: 28px;
    font-weight: 700;
    color: #1e293b;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 20px;
    margin-top: 25px;
}

.dashboard-card {
    background-color: #ffffff;
    border-left: 4px solid #8B4513;
    border-radius: 8px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 2px 6px rgba(139, 69, 19, 0.15);
    transition: all 0.3s ease;
}

.dashboard-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(139, 69, 19, 0.35);
}

.dashboard-card h2 {
    margin: 0;
    font-size: 16px;
    color: #1e293b;
}

.dashboard-card p {
    margin: 4px 0 0;
    font-size: 18px;
    font-weight: 600;
    color: #8B4513;
}

.dashboard-card .icon {
    font-size: 30px;
    color: #8B4513;
}

.dashboard-card .icon.warning { color: #f59e0b; }
.dashboard-card .icon.danger { color: #dc2626; }
.dashboard-card .icon.success { color: #16a34a; }

.clickable { cursor: pointer; }

/* 🔹 Table Style */
.hidden-table {
    display: none;
    margin-top: 25px;
    animation: fadeSlide 0.3s ease;
}

@keyframes fadeSlide {
    from { opacity: 0; transform: translateY(-5px); }
    to { opacity: 1; transform: translateY(0); }
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

table th, table td {
    border: 1px solid #e5e7eb;
    padding: 10px;
    text-align: left;
}

table th {
    background-color: #f8fafc;
    color: #1e293b;
    text-transform: uppercase;
    font-size: 13px;
    letter-spacing: 0.5px;
}

table tr:hover { background-color: #f1f5f9; }

.txn-type.in { color: #16a34a; font-weight: 600; }
.txn-type.out { color: #dc2626; font-weight: 600; }

/* 🔸 Blinking Animations */
@keyframes blink-warning {
    0%, 100% { box-shadow: 0 0 10px 3px rgba(245, 158, 11, 0.6); }
    50% { box-shadow: 0 0 5px 2px rgba(245, 158, 11, 0.2); }
}

@keyframes blink-danger {
    0%, 100% { box-shadow: 0 0 10px 3px rgba(220, 38, 38, 0.6); }
    50% { box-shadow: 0 0 5px 2px rgba(220, 38, 38, 0.2); }
}

.blink-warning { animation: blink-warning 1.2s infinite; }
.blink-danger { animation: blink-danger 1.2s infinite; }
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const lowStockCard = document.getElementById('lowStockCard');
    const lowStockTable = document.getElementById('lowStockTable');
    const outOfStockCard = document.getElementById('outOfStockCard');
    const outOfStockTable = document.getElementById('outOfStockTable');

    const toggleTable = (tableToShow, tableToHide) => {
        if (tableToShow.style.display === 'block') {
            tableToShow.style.display = 'none';
        } else {
            tableToShow.style.display = 'block';
            tableToHide.style.display = 'none';
            window.scrollTo({ top: tableToShow.offsetTop - 80, behavior: 'smooth' });
        }
    };

    lowStockCard.addEventListener('click', () => toggleTable(lowStockTable, outOfStockTable));
    outOfStockCard.addEventListener('click', () => toggleTable(outOfStockTable, lowStockTable));
});
</script>
@endsection
