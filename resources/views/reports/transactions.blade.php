@extends('layouts.app')

@section('content')
<h1>Transaction Report</h1>

<!-- Filter Form -->
<form method="GET" action="{{ route('reports.transactions') }}" style="margin-bottom:20px;">
    <label>Start Date: <input type="date" name="start_date" value="{{ request('start_date') }}"></label>
    <label>End Date: <input type="date" name="end_date" value="{{ request('end_date') }}"></label>
    <button class="btn btn-filter">Filter</button>
</form>

<!-- Transactions Table -->
<table style="width:100%; border-collapse: collapse; font-size: 14px;">
    <thead>
        <tr style="background-color:#f2f2f2;">
            <th style="padding:8px; border:1px solid #ddd;">Product</th>
            <th style="padding:8px; border:1px solid #ddd;">Type</th>
            <th style="padding:8px; border:1px solid #ddd;">Quantity</th>
            <th style="padding:8px; border:1px solid #ddd;">Total Price</th>
            <th style="padding:8px; border:1px solid #ddd;">Date</th>
            <th style="padding:8px; border:1px solid #ddd;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $t)
        <tr>
            <td style="padding:8px; border:1px solid #ddd;">{{ $t->product->name }}</td>
            <td style="padding:8px; border:1px solid #ddd;">{{ ucfirst($t->type) }}</td>
            <td style="padding:8px; border:1px solid #ddd;">{{ $t->quantity }}</td>
            <td style="padding:8px; border:1px solid #ddd;">{{ number_format($t->total_price, 2) }}</td>
            <td style="padding:8px; border:1px solid #ddd;">{{ $t->created_at->format('Y-m-d') }}</td>
            <td style="padding:8px; border:1px solid #ddd;">
                <a href="{{ route('transactions.edit', $t->id) }}" class="btn btn-edit">Edit</a>
                <form action="{{ route('transactions.destroy', $t->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
                <a href="{{ route('transactions.show', $t->id) }}" class="btn btn-view">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Optional: CSS Styling -->
<style>
.btn {
    font-size: 14px;
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 5px;
    text-decoration: none;
    color: white;
}

.btn-edit { background-color: #007bff; }
.btn-delete { background-color: #dc3545; }
.btn-view { background-color: #28a745; }
.btn-filter { background-color: #17a2b8; }
</style>
@endsection
