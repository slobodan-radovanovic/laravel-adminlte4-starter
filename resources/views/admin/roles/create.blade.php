@extends('layouts.admin')

@section('title', 'Create Role')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="mb-0">Create Role</h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('roles.index') }}">Roles</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Create
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ route('roles.store') }}">
        @csrf

        <x-admin.card title="Role Details" icon="bi bi-plus-lg">
            @include('admin.roles._form', [
                'rolePermissions' => [],
            ])

            <x-admin.form.actions
                submit="Create Role"
                :cancel-url="route('roles.index')"
            />
        </x-admin.card>
    </form>
@endsection
