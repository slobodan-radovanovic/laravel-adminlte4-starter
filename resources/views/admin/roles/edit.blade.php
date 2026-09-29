@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content_header')
    <x-admin.content-header title="Edit Role" :breadcrumbs="['Roles' => route('roles.index'), 'Edit']" />
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
