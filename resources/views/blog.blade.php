<!-- resources/views/blog/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>All Blog Posts</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
                <tr>
                    <td>{{ $blog->title }}</td>
                    <td><img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" width="100"></td>
                    <td>{{ $blog->created_at->format('F jS, Y') }}</td>
                    <td>
                        <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('blogCreate') }}" class="btn btn-success">Create a new blog post</a>
@endsection
