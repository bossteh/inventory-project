@extends('layouts.app')

@section('content')
<h1>Stock Report</h1>

<table>
    <thead>
        <tr>
            <th>Product</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ number_format($product->price, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
