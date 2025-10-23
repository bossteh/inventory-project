@extends('layouts.app')

@section('content')
<h1 style="color:#2e2b29;">Transactions</h1>

<!-- Add + Search bar row -->
<!-- Add + Search bar row -->
<!-- Top Section: Add Button + Search -->
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
    <a href="{{ route('transactions.create') }}" class="btn btn-add">Add New Transaction</a>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search transaction..." onkeyup="filterTable()" 
               style="padding:6px 10px; border:1px solid #ccc; border-radius:5px; font-size:13px;">
    </div>
</div>

@if(session('success'))
    <p style="color:#28a745;">{{ session('success') }}</p>
@endif

<table id="transactionsTable" style="width:100%; border-collapse: collapse; font-size: 14px; background-color:#fff; color:#2e2b29;">
    <thead>
        <tr style="background-color:#f7f4f0; color:#2e2b29;">
            <th style="padding:8px; border:1px solid #ddd;">ID</th>
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
            <td style="padding:8px; border:1px solid #ddd;">{{ $t->id }}</td>
            <td style="padding:8px; border:1px solid #ddd;">{{ $t->product->name }}</td>
            <td style="padding:8px; border:1px solid #ddd;">{{ ucfirst($t->type) }}</td>
            <td style="padding:8px; border:1px solid #ddd;">{{ $t->quantity }}</td>
            <td style="padding:8px; border:1px solid #ddd;">{{ number_format($t->total_price, 2) }}</td>
            <td style="padding:8px; border:1px solid #ddd;">{{ $t->created_at->format('Y-m-d') }}</td>
            <td style="padding:8px; border:1px solid #ddd;">
                <a href="{{ route('transactions.show', $t->id) }}" class="btn btn-view">View</a>
                <a href="{{ route('transactions.edit', $t->id) }}" class="btn btn-edit">Edit</a>
                <form action="{{ route('transactions.destroy', $t->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this transaction?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Live Search Script -->
<script>
function filterTable() {
    let input = document.getElementById('searchInput');
    let filter = input.value.toLowerCase();
    let table = document.getElementById('transactionsTable');
    let trs = table.getElementsByTagName('tr');

    for (let i = 1; i < trs.length; i++) { // skip header
        let tds = trs[i].getElementsByTagName('td');
        let match = false;
        for (let j = 0; j < tds.length - 1; j++) { // skip Actions column
            if (tds[j].innerText.toLowerCase().includes(filter)) {
                match = true;
                break;
            }
        }
        trs[i].style.display = match ? '' : 'none';
    }
}
</script>

<!-- Button Styling -->
<style>
.btn {
    font-size: 13px;
    padding: 6px 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 5px;
    text-decoration: none;
    color: #fff;
    transition: background-color 0.3s ease;
}

/* Brown for Add and Search button */
.btn-add {
    background-color: #8b5e3c;
}
.btn-add:hover {
    background-color: #70472a;
}

/* Blue for Edit */
.btn-edit {
    background-color: #0056b3;
}
.btn-edit:hover {
    background-color: #003f7f;
}

/* Green for View */
.btn-view {
    background-color: #388e3c;
}
.btn-view:hover {
    background-color: #2e7030;
}

/* Red for Delete */
.btn-delete {
    background-color: #c0392b;
}
.btn-delete:hover {
    background-color: #922b21;
}

/* Page background */
body {
    background-color: #f9f8f6;
    color: #2e2b29;
}
</style>
@endsection
