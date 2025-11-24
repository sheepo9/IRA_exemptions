<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body { background-color: #fff; }
        .navbar { background-color: #cce5ff !important; }
        .navbar-brand, .nav-link, .dropdown-item { color: #004085 !important; }
        .card { background-color: #f8f9fa; border: 1px solid #b8daff; }
        .card-body { color: #004085; }
        .btn-primary {
            background-color: #339af0; border-color: #339af0;
        }
        .btn-primary:hover {
            background-color: #228be6; border-color: #228be6;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px; margin-right: 10px;">
                    Ministry of Justice and Labour Relations 
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto"></ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @else
                                                       <!-- Simple logout button -->
                  <p>
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" 
         viewBox="0 0 16 16" style="margin-right:5px;">
        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm4-3a4 4 0 1 1-8 0 4 4 0 0 1 8 0z"/>
        <path d="M14 14s-1-4-6-4-6 4-6 4 1 1 6 1 6-1 6-1z"/>
    </svg>
    {{ Auth::user()->name }}
</p>
                                                <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="nav-link btn btn-link"
                                        style="color: #004085; text-decoration: none;"
                                        onclick="return confirm('Are you sure you want to log out?')">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
