@extends('layouts.app')

@section('content')
<h1>Edit Product</h1>

@if($errors->any())
    <div style="color:#f00;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <label>Name:</label>
    <input type="text" name="name" value="{{ $product->name }}" required>

    <label>Category:</label>
    <select name="category_id" required>
        <option value="">Select Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <label>Quantity:</label>
    <input type="number" name="quantity" value="{{ $product->quantity }}" required>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" value="{{ $product->price }}" required>

    <div style="margin-top:10px; display:flex; gap:10px;">
        <button type="submit" class="btn">Update</button>
        <a href="{{ route('products.index') }}" class="btn" style="background-color:#555; color:#fff;">Cancel</a>
    </div>
</form>
@endsection
