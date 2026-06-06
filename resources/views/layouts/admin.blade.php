@php
    $bodyClasses = [
        'bg-body-tertiary',
        config('adminlte.layout.fixed', true) ? 'layout-fixed' : null,
        config('adminlte.layout.navbar_fixed', false) ? 'layout-navbar-fixed' : null,
        config('adminlte.layout.footer_fixed', false) ? 'layout-footer-fixed' : null,
        'sidebar-expand-lg',
        config('adminlte.sidebar.collapsed', false) ? 'sidebar-collapse' : null,
    ];

    $bodyClass = collect($bodyClasses)->filter()->implode(' ');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('adminlte.title', config('app.name', 'Admin Panel')))</title>
    <script>
        (function () {
            const theme = localStorage.getItem('admin-theme') || '{{ config('adminlte.theme.default', 'light') }}';
            document.documentElement.setAttribute('data-bs-theme', theme);
        })();
    </script>
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>

<body class="{{ $bodyClass }}">
<div class="app-wrapper">

    @include('layouts.partials.navbar')

    @include('layouts.partials.sidebar')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                @yield('content_header')
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </main>

    @include('layouts.partials.footer')

</div>
</body>
</html>
