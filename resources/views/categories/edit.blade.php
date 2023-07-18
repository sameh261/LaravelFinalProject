@extends('layouts.app')

@section('content')
    <h2>Edit Category</h2>

    <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $category->name }}">
        <label for="slug">Slug:</label>
        <input type="text" name="slug" id="slug" value="{{ $category->slug }}">
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" class="form-control-file" accept="image/*" required>
            <br>
            @if($category->image)
                <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}" style="max-width: 200px;">
            @else
                <p>No image found</p>
            @endif
        </div>

        <button type="submit">Update</button>
    </form>
@endsection
