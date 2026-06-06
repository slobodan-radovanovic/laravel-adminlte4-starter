@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="mb-0">Dashboard</h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Dashboard
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-lg-3 col-6">
            <x-admin.small-box
                title="Users"
                value="150"
                icon="bi bi-people"
                color="primary"
                :url="route('users.index')"
            />
        </div>

        <div class="col-lg-3 col-6">
            <x-admin.small-box
                title="Orders"
                value="53"
                icon="bi bi-cart"
                color="success"
            />
        </div>

        <div class="col-lg-3 col-6">
            <x-admin.small-box
                title="Reports"
                value="12"
                icon="bi bi-bar-chart"
                color="warning"
            />
        </div>

        <div class="col-lg-3 col-6">
            <x-admin.small-box
                title="Alerts"
                value="4"
                icon="bi bi-bell"
                color="danger"
            />
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <x-admin.info-box
                title="CPU Traffic"
                value="10%"
                icon="bi bi-cpu"
                color="primary"
            />
        </div>

        <div class="col-md-3">
            <x-admin.info-box
                title="Likes"
                value="41,410"
                icon="bi bi-hand-thumbs-up"
                color="success"
            />
        </div>

        <div class="col-md-3">
            <x-admin.info-box
                title="Sales"
                value="760"
                icon="bi bi-cart-check"
                color="warning"
            />
        </div>

        <div class="col-md-3">
            <x-admin.info-box
                title="Members"
                value="2,000"
                icon="bi bi-person-plus"
                color="danger"
            />
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <x-admin.card title="Starter Overview" icon="bi bi-speedometer2">
                <p>
                    This dashboard demonstrates the base AdminLTE layout, Bootstrap components,
                    theme switching, and reusable Blade widgets.
                </p>

                <p class="mb-0">
                    Use this starter as a foundation for future Laravel admin applications.
                </p>
            </x-admin.card>
        </div>

        <div class="col-lg-4">
            <x-admin.card title="Included Features" icon="bi bi-check2-circle">
                <ul class="mb-0">
                    <li>Laravel Breeze authentication</li>
                    <li>AdminLTE 4 layout</li>
                    <li>Config-driven sidebar menu</li>
                    <li>Light/Dark theme switcher</li>
                    <li>DataTables, Select2 and Chart.js examples</li>
                    <li>Reusable Blade widgets</li>
                </ul>
            </x-admin.card>
        </div>
    </div>
@endsection
