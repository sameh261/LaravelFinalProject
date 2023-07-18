@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-layout-grid2 text-success border-success"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Available Products</div>
                            <div class="stat-digit">{{ $products }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-layers-alt text-primary border-primary"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Categories</div>
                            <div class="stat-digit">
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
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-comment-alt text-info border-info"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Blogs</div>
                            <div class="stat-digit">
                                <ul>
                                    @foreach ($blogs as $blog)
                                        <li>{{ $blog }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
