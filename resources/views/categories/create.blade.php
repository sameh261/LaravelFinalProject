@extends('layouts.app')


@section('content')


<h2>Create Category</h2>

<form action="{{ route('categories.store') }}" method="POST" class="mt-4" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="name" class="font-weight-bold">Name:</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter category name">
    </div>

    <div class="form-group">
        <label for="slug" class="font-weight-bold">Slug:</label>
        <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter category slug">
    </div>

    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" class="form-control-file" accept="image/*" required>
    </div>

    <button type="submit" class="btn btn-primary btn-block mt-3">Create Category</button>
</form>
@endsection

