@extends('layouts.app')

@section('content')
<h1>Transaction Details</h1>

<p><strong>Product:</strong> {{ $transaction->product->name }}</p>
<p><strong>Type:</strong> {{ ucfirst($transaction->type) }}</p>
<p><strong>Quantity:</strong> {{ $transaction->quantity }}</p>
<p><strong>Total Price:</strong> {{ number_format($transaction->total_price, 2) }}</p>
<p><strong>Date:</strong> {{ $transaction->created_at->format('Y-m-d H:i') }}</p>

<a href="{{ route('transactions.index') }}" class="btn" style="background-color:#555; color:#fff;">Back</a>
@endsection
