@extends('layouts.app')

@section('content')
<h1>Add Transaction</h1>

@if($errors->any())
    <div style="color:#f00;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('transactions.store') }}" method="POST">
    @csrf
    <label>Product:</label>
    <select name="product_id" required>
        <option value="">Select Product</option>
        @foreach($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->quantity }})</option>
        @endforeach
    </select>

    <label>Type:</label>
    <select name="type" required>
        <option value="in">Stock In</option>
        <option value="out">Stock Out</option>
    </select>

    <label>Quantity:</label>
    <input type="number" name="quantity" value="1" min="1" required>

    <button type="submit" class="btn">Save Transaction</button>
</form>
@endsection
