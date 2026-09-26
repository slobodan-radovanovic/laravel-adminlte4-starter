<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel AdminLTE 4 Starter</title>

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body class="layout-fixed bg-body-tertiary">
<div class="wrapper min-vh-100 d-flex align-items-center justify-content-center py-5">
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10 col-xxl-9">
                <div class="card border-0 shadow-lg overflow-hidden">
                    <div class="card-body p-0">
                        <div class="row g-0 min-vh-50">
                            <div class="col-lg-7 p-4 p-md-5 d-flex align-items-center">
                                <div class="w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
                                            <span class="badge text-bg-primary px-3 py-2">
                                                Laravel 13
                                            </span>
                                        <span class="badge text-bg-dark px-3 py-2">
                                                AdminLTE 4
                                            </span>
                                        <span class="badge text-bg-secondary px-3 py-2">
                                                Bootstrap 5
                                            </span>
                                    </div>

                                    <h1 class="display-5 fw-bold mb-3">
                                        Laravel AdminLTE 4 Starter
                                    </h1>

                                    <p class="lead text-secondary mb-4">
                                        A clean Laravel admin starter kit with Breeze Blade,
                                        Spatie Permission, CRUD examples, reusable components,
                                        plugins and feature tests.
                                    </p>

                                    <div class="d-flex flex-wrap gap-2 mb-4">
                                        @auth
                                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                                                <i class="bi bi-speedometer2 me-1"></i>
                                                Go to Dashboard
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                                <i class="bi bi-box-arrow-in-right me-1"></i>
                                                Login
                                            </a>

                                            @if (Route::has('register') && config('adminlte.auth.registration'))
                                                <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg">
                                                    <i class="bi bi-person-plus me-1"></i>
                                                    Register
                                                </a>
                                            @endif
                                        @endauth

                                        <a href="https://github.com/slobodan-radovanovic/laravel-adminlte4-starter"
                                           class="btn btn-outline-dark btn-lg"
                                           target="_blank"
                                           rel="noopener noreferrer">
                                            <i class="bi bi-github me-1"></i>
                                            GitHub
                                        </a>
                                    </div>

                                    <div class="alert alert-light border mb-0">
                                        <div class="d-flex gap-3">
                                            <div class="fs-4 text-primary">
                                                <i class="bi bi-info-circle"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold mb-1">Built as a practical starter, not just a theme.</div>
                                                <div class="small text-secondary">
                                                    No AdminLTE wrapper package, no Filament, no Tailwind admin UI.
                                                    The structure stays transparent and easy to customize.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5 bg-body-secondary p-4 p-md-5 d-flex align-items-center">
                                <div class="w-100">
                                    <div class="text-center mb-4">
                                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white shadow-sm"
                                             style="width: 84px; height: 84px;">
                                            <i class="bi bi-window-sidebar fs-1"></i>
                                        </div>

                                        <h2 class="h4 fw-bold mt-3 mb-1">
                                            Included out of the box
                                        </h2>

                                        <p class="text-secondary mb-0">
                                            Everything needed to start an admin project faster.
                                        </p>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="small-box text-bg-primary mb-0">
                                                <div class="inner">
                                                    <h3 class="fs-5">Auth</h3>
                                                    <p>Breeze Blade</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="bi bi-shield-check"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="small-box text-bg-success mb-0">
                                                <div class="inner">
                                                    <h3 class="fs-5">Access</h3>
                                                    <p>Roles & permissions</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="bi bi-person-lock"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="small-box text-bg-warning mb-0">
                                                <div class="inner">
                                                    <h3 class="fs-5">CRUD</h3>
                                                    <p>Users, roles, categories</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="bi bi-table"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="small-box text-bg-info mb-0">
                                                <div class="inner">
                                                    <h3 class="fs-5">Plugins</h3>
                                                    <p>Admin plugin system</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="bi bi-puzzle"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card border-0 shadow-sm mt-4 mb-0">
                                        <div class="card-body">
                                            <h3 class="h6 fw-bold mb-3">Tech stack</h3>

                                            <div class="d-flex flex-wrap gap-2">
                                                <span class="badge text-bg-light border">PHP 8.4</span>
                                                <span class="badge text-bg-light border">Laravel 13</span>
                                                <span class="badge text-bg-light border">AdminLTE 4</span>
                                                <span class="badge text-bg-light border">Bootstrap 5</span>
                                                <span class="badge text-bg-light border">Vite</span>
                                                <span class="badge text-bg-light border">Spatie Permission</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center text-secondary small mt-4">
                    MIT licensed open-source starter kit for practical Laravel admin applications.
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
