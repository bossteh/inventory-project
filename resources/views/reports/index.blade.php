@extends('layouts.app')

@section('content')
<h1 style="color:#2e2b29;">Reports</h1>

<div style="display:flex; gap:20px; margin-top:20px;">
    <a href="{{ route('reports.stock') }}" class="btn btn-report">Stock Report</a>
    <a href="{{ route('reports.transactions') }}" class="btn btn-report">Transaction Report</a>
</div>

<!-- Button Styling -->
<style>
.btn {
    font-size: 13px;
    padding: 8px 15px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    text-decoration: none;
    color: white;
    transition: background-color 0.3s ease;
}

/* Brown theme for report buttons */
.btn-report {
    background-color: #8b5e3c; /* warm brown */
}
.btn-report:hover {
    background-color: #70472a; /* darker brown on hover */
}

/* Background and text colors for the section */
body {
    background-color: #f9f8f6;
    color: #2e2b29;
}
</style>
@endsection
