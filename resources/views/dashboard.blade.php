@extends('layouts.app')

@section('content')
<div class="container-fluid ">
    <div class="row m-3">
        <div class="col-md-9 m-auto">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>
                <div class="card-body">
                    <p>Welcome to your admin dashboard!</p>
                    <p>Here you can manage your products, orders, and customers.</p>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    Analytics and Reporting
                </div>
                <div class="card-body">
                    <p>Total Products:</p>
                    <h2>{{ $products }}</h2>
                    @can('admin')
                        <p>Total Orders:</p>
                        <h2>{{ $orders }}</h2>
                    @endcan
                    <p>Total Customers:</p>
                    <h2>{{ $customers }}</h2>
                </div>

            </div>
            <div class="card mt-4">
                <div class="card-header">
                    Blog Posts
                </div>
                <div class="card-body">
                    <ul>
                        @foreach ($blogs as $blog)
                            <li>{{ $blog }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        Categories
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach ($categories as $category)
                                <li>{{ $category }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
