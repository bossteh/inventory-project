edit here category
@extends('layouts.app')

@section('content')
<h1>Add Category</h1>

@if($errors->any())
    <div style="color:#f00;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" placeholder="Category Name" required>
    <button type="submit" class="btn">Save</button>
</form>
@endsection
