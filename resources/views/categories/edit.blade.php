@extends('layouts.app')

@section('content')
<h1>Edit Category</h1>

@if($errors->any())
    <div style="color:#f00;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <label>Name:</label>
    <input type="text" name="name" value="{{ $category->name }}" required>

    <div style="margin-top:10px; display:flex; gap:10px;">
        <button type="submit" class="btn">Update</button>
        <a href="{{ route('categories.index') }}" class="btn" style="background-color:#555; color:#fff;">Cancel</a>
    </div>
</form>
@endsection
