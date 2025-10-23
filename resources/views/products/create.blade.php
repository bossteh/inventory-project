@extends('layouts.app')

@section('content')
<h1>Add Product</h1>

@if($errors->any())
    <div style="color:#f00;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" placeholder="Product Name" required>

    <label>Category:</label>
    <select name="category_id" required>
        <option value="">Select Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <label>Quantity:</label>
    <input type="number" name="quantity" value="0" required>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" value="0.00" required>

    <button type="submit" class="btn">Save</button>
</form>
@endsection
