@extends('layouts.app')

@section('content')
<h1>Edit Transaction</h1>

@if($errors->any())
    <div style="color:#f00;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Product:</label>
    <select name="product_id" required>
        @foreach($products as $product)
            <option value="{{ $product->id }}" {{ $transaction->product_id == $product->id ? 'selected' : '' }}>
                {{ $product->name }} (Stock: {{ $product->quantity }})
            </option>
        @endforeach
    </select>

    <label>Type:</label>
    <select name="type" required>
        <option value="in" {{ $transaction->type == 'in' ? 'selected' : '' }}>Stock In</option>
        <option value="out" {{ $transaction->type == 'out' ? 'selected' : '' }}>Stock Out</option>
    </select>

    <label>Quantity:</label>
    <input type="number" name="quantity" value="{{ $transaction->quantity }}" min="1" required>

    <div style="margin-top:10px; display:flex; gap:10px;">
        <button type="submit" class="btn">Update Transaction</button>
        <a href="{{ route('transactions.index') }}" class="btn" style="background-color:#555; color:#fff;">Cancel</a>
    </div>
</form>
@endsection
