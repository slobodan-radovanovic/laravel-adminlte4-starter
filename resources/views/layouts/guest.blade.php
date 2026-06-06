<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('adminlte.name', config('app.name', 'AdminLTE Starter')))</title>

    <script>
        (function () {
            const theme = localStorage.getItem('admin-theme') || '{{ config('adminlte.theme.default', 'light') }}';
            document.documentElement.setAttribute('data-bs-theme', theme);
        })();
    </script>

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
