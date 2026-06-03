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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Welcome</h3>
                </div>

                <div class="card-body">
                    You are logged in.
                </div>
            </div>
        </div>
    </div>
@endsection
