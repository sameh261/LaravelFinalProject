@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="mb-4">All Products</h1>
    <a href="{{ route('products.create') }}" class="btn btn-success mb-4">Create Product</a>
<form action="{{ route('products.index') }}" method="GET" class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search"
        value="{{ old('search', $search) }}">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>

<form action="{{ route('products.index') }}" method="GET">
    <div class="form-group mt-4">
        <label for="category">Filter by category:</label>
        <select id="category" name="category_id" class="form-control" onchange="this.form.submit()">
            <option value="">All categories</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</form>



<div class="row mt-4">
    @foreach ($products as $product)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="text-center mb-4">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" width="100">
                </div>
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="{{ route('products.show', $product->id) }}"
                        class="btn btn-sm btn-outline-secondary">View</a>
                    <a href="{{ route('products.edit', $product->id) }}"
                        class="btn btn-sm btn-outline-secondary">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-secondary">Delete</button>
                    </form>
                </div>
                <div>
                    <span class="text-muted mr-2">${{ $product->price }}</span>
                    <span class="text-muted">{{ $product->quantity }}</span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="pagination-wrapper mt-4">
    {{ $products->appends(request()->query())->links() }}
</div>
</div>
<style>
    .pagination-wrapper {
        display: flex;
        justify-content: center;
    }

    .pagination-wrapper ul {
        margin: 0;
    }

    .pagination-wrapper li {
        margin: 0 5px;
    }

    .pagination-wrapper li .page-link {
        padding: 5px 10px;
    }
</style>
@endsection
