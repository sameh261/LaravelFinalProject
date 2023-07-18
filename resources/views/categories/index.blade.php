@extends('layouts.app')

@section('content')



<div class="table-responsive mt-4">
  <table class="table table-striped">
    <thead>
      <tr>
        <th class="fw-bold">Category Name</th>
        <th></th>
        <th class="fw-bold">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categories as $category)
      <tr>
        <td class="align-middle">{{ $category->name }}</td>
        <td class="align-middle">
          <div class="mx-auto" style="width: 100px;">
            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="img-fluid">
          </div>
        </td>
        <td class="align-middle">
          <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary btn-sm me-2">Edit</a>
          <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<a href="{{ route('categories.create') }}" class="btn btn-success mt-3">Create New Category</a>

@endsection

