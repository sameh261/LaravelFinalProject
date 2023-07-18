<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-md-2">
                    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="height: 100%;">
                        <a href="/"
                            class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                            <svg class="bi me-2" width="40" height="32">
                                <use xlink:href="#bootstrap"></use>
                            </svg>
                            <span class="fs-4">{{ config('app.name', 'Laravel') }}</span>
                        </a>
                        @guest
                            <ul class="nav nav-pills flex-column mb-auto">
                                <li class="nav-item">
                                    <a class="nav-link link-dark {{ request()->is('login*') ? 'active text-white' : '' }}"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link-dark {{ request()->is('register*') ? 'active text-white' : '' }}"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            </ul>
                        @else
                            <hr>
                            <ul class="nav nav-pills flex-column mb-auto">
                                <li class="nav-item">
                                    <a href="/" class="nav-link link-dark {{ request()->is('/') ? 'active' : '' }}">
                                        Home
                                    </a>
                                </li>
                                @can('admin')
                                <li class="nav-item">
                                    <a href="/users" class="nav-link link-dark {{ request()->is('users') ? 'active' : '' }}">
                                        User Role Management
                                    </a>
                                </li>
                                @endcan
                                <li>
                                    <a href="{{ route('products.index') }}"
                                        class="nav-link link-dark {{ request()->is('products*') ? 'active' : '' }}">
                                        Products
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('categories.index') }}"
                                        class="nav-link link-dark {{ request()->is('categories*') ? 'active' : '' }}">
                                        Categories
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('blog.index') }}"
                                        class="nav-link link-dark {{ request()->is('blog*') ? 'active' : '' }}">
                                        Blog
                                    </a>
                                </li>
                                <hr>
                                <li class="nav-item">
                                    <a class="nav-link link-dark {{ request()->is('logout*') ? 'active' : '' }}"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        @endguest


                        {{-- <li>
                                <div class="dropdown">
                                    <a href="#"
                                        class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="https://github.com/mdo.png" alt="mdo" width="32"
                                            height="32" class="rounded-circle me-2">
                                        <strong>{{ Auth::user()->name }}</strong>
                                    </a>

                                </div>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="container">
                        <h1>@yield('title')</h1>
                        <hr>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<style scoped>
    .nav-link:not(.active):hover {
        background-color: #1b3bd777 !important;
        color: white !important;
    }

    .nav-link:is(.active):hover {
        color: white !important;
    }
    .nav-link:is(.active) {
        color: white !important;
    }
</style>
