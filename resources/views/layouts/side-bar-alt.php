<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body>
<div id="app" class="d-flex">
    <!-- Sidebar -->
    <nav class="bg-dark text-white vh-100 p-3" style="width: 250px;">
        <h5 class="text-center mb-4">{{ config('app.name', 'Laravel') }}</h5>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="{{ route('operations.index') }}" class="nav-link text-white">
                    <i class="fa-solid fa-gears me-2"></i> Continuous Operations
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('overtime-applications.index') }}" class="nav-link text-white">
                    <i class="fa-solid fa-clock me-2"></i> Overtime Applications
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('exemption-applications.index') }}" class="nav-link text-white">
                    <i class="fa-solid fa-file-circle-exclamation me-2"></i> Exemption Applications
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('exemption_wagers.index') }}" class="nav-link text-white">
                    <i class="fa-solid fa-users-gear me-2"></i> Exemption Wagers
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('exemption_variations.index') }}" class="nav-link text-white">
                    <i class="fa-solid fa-arrows-rotate me-2"></i> Exemption Variations
                </a>
            </li>
            <li class="nav-item mb-4">
                <a href="{{ route('exemption_declarations.index') }}" class="nav-link text-white">
                    <i class="fa-solid fa-scroll me-2"></i> Exemption Declarations
                </a>
            </li>

            <hr class="text-light">

            <li class="nav-item">
                <a href="#" class="nav-link text-white"
                   onclick="event.preventDefault();
                            if(confirm('Are you sure you want to log out?')) document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>

    <!-- Main content -->
    <div class="flex-grow-1">
        <nav class="navbar navbar-light bg-light shadow-sm">
            <div class="container-fluid">
                <span class="navbar-text">Welcome, {{ Auth::user()->name ?? 'Guest' }}</span>
            </div>
        </nav>

        <main class="p-4">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
