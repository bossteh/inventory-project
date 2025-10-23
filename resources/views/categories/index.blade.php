@extends('layouts.app')

@section('content')
<h1 style="color:#2e2b29;">Categories</h1>

<!-- Top Section: Add Button + Search -->
<div class="top-bar">
    <a href="{{ route('categories.create') }}" class="btn btn-add">Add New Category</a>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search category..." onkeyup="filterTable()">
    </div>
</div>

@if(session('success'))
    <p style="color:#28a745;">{{ session('success') }}</p>
@endif

<table id="categoryTable" style="width:100%; border-collapse: collapse; font-size: 14px; background-color:#fff; color:#2e2b29;">
    <thead>
        <tr style="background-color:#f7f4f0; color:#2e2b29;">
            <th style="padding:8px; border:1px solid #ddd;">ID</th>
            <th style="padding:8px; border:1px solid #ddd;">Name</th>
            <th style="padding:8px; border:1px solid #ddd;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td style="padding:8px; border:1px solid #ddd;">{{ $category->id }}</td>
            <td style="padding:8px; border:1px solid #ddd;">{{ $category->name }}</td>
            <td style="padding:8px; border:1px solid #ddd;">
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-edit">Edit</a>
                
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this category?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Styling -->
<style>
.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.search-container input {
    padding: 7px 12px;
    font-size: 13px;
    border-radius: 5px;
    border: 1px solid #ccc;
    width: 200px;
}

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

/* Add Button (Brown) */
.btn-add {
    background-color: #8b5e3c;
}
.btn-add:hover {
    background-color: #70472a;
}

/* Edit Button (Blue) */
.btn-edit {
    background-color: #0056b3;
}
.btn-edit:hover {
    background-color: #003f7f;
}

/* Delete Button (Red) */
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

<!-- Search Functionality -->
<script>
function filterTable() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const rows = document.querySelectorAll("#categoryTable tbody tr");

    rows.forEach(row => {
        const name = row.cells[1].textContent.toLowerCase();
        row.style.display = name.includes(input) ? "" : "none";
    });
}
</script>
@endsection
