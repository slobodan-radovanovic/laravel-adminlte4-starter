@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="mb-0">Edit Role</h1>
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
                    Edit
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ route('roles.update', $role) }}">
        @csrf
        @method('PUT')

        <x-admin.card title="Role Details" icon="bi bi-pencil">
            @include('admin.roles._form', [
                'role' => $role,
                'rolePermissions' => $rolePermissions,
            ])

            <x-admin.form.actions
                submit="Update Role"
                :cancel-url="route('roles.index')"
            />
        </x-admin.card>
    </form>
@endsection
