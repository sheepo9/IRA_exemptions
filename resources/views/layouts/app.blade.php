<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'IRA Application System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-MRCwOro39yB+OZ3W57sYHC6iOvq5EypnXgFzXtZ0l9ejzFZfE6g1c6V5ok2cV+HB"
          crossorigin="anonymous">

    <!-- Laravel Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">

    {{-- Navigation --}}
    @include('layouts.navigation')

    {{-- Page Header --}}
    @isset($header)
        <header class="bg-white border-bottom shadow-sm mb-4">
            <div class="container py-3">
                {{ $header }}
            </div>
        </header>
    @endisset

    {{-- Page Content --}}
    <main class="container mb-5">
        @yield('content')
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2z2p/ykBtk0wIq6qK6P8s1rXJ1hC5B5T5/n92/gGq5mEPR7f4mZH78q3RZ5"
            crossorigin="anonymous"></script>

</body>
</html>
