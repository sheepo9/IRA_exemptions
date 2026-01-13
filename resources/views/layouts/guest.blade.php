<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IRA') }}</title>

    <!-- Fonts (optional) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-sm p-4 w-100" style="max-width: 420px;">

        <div class="text-center mb-3">
                    <x-application-logo class="mx-auto" style="height:80px;" />
    <div class="fw-bold mt-2">{{ config('app.name') }}</div>
        </div>

        {{ $slot }}

    </div>
</div>

</body>
</html>
