<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('adminlte.title', config('app.name', 'AdminLTE Starter')))</title>

    @include('layouts.partials.theme-script')

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>

<body class="login-page bg-body-tertiary">
<main class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ url('/') }}" class="h3 text-decoration-none">
                {{ config('adminlte.name', config('app.name', 'AdminLTE Starter')) }}
            </a>
        </div>

        <div class="card-body login-card-body">
            {{ $slot }}
        </div>
    </div>
</main>
</body>
</html>
