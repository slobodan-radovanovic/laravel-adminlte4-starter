@extends('layouts.admin')

@section('title', 'Profile')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="mb-0">Profile</h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Profile
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">

            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title mb-0">Profile Information</h3>
                </div>

                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title mb-0">Update Password</h3>
                </div>

                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card mb-4 border-danger">
                <div class="card-header">
                    <h3 class="card-title mb-0 text-danger">Delete Account</h3>
                </div>

                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
@endsection
