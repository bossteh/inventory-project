@extends('layouts.app')

@section('content')
<h1>Product Details</h1>

<p><strong>Name:</strong> {{ $product->name }}</p>
<p><strong>Category:</strong> {{ $product->category->name }}</p>
<p><strong>Quantity:</strong> {{ $product->quantity }}</p>
<p><strong>Price:</strong> {{ number_format($product->price, 2) }}</p>

<a href="{{ route('products.index') }}" class="btn" style="background-color:#555; color:#fff;">Back</a>
@endsection
