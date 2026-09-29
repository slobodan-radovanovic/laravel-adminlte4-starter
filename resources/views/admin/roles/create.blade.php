@extends('layouts.admin')

@section('title', 'Create Role')

@section('content_header')
    <x-admin.content-header title="Create Role" :breadcrumbs="['Roles' => route('roles.index'), 'Create']" />
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
