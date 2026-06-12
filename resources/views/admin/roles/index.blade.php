@extends('layouts.admin')

@section('title', 'Roles')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="mb-0">Roles</h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Roles
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <x-admin.card title="Roles" icon="bi bi-shield-lock">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="text-muted mb-0">
                Manage application roles and permissions.
            </p>

            @can('create roles')
                <a href="{{ route('roles.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i>
                    Create Role
                </a>
            @endcan
        </div>
        @if ($roles->isEmpty())
            <x-admin.empty-state
                icon="bi bi-shield-lock"
                title="No roles found"
                message="There are no roles to display yet."
                :action-url="auth()->user()?->can('create roles') ? route('roles.create') : null"
                action-text="Create Role"
            />
        @else
        <table id="roles-table" class="table table-bordered table-striped align-middle">
            <thead>
            <tr>
                <th>Name</th>
                <th>Permissions</th>
                <th>Created</th>
                <th class="text-end">Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>
                        <strong>{{ $role->name }}</strong>
                    </td>

                    <td>
                            <span class="badge text-bg-primary">
                                {{ $role->permissions_count }}
                            </span>
                    </td>

                    <td>{{ $role->created_at?->format('Y-m-d') }}</td>

                    <td class="text-end">
                        @can('edit roles')
                            <a href="{{ route('roles.edit', $role) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                        @endcan

                            @can('delete roles')
                                @if ($role->name !== 'Super Admin')
                                    <x-admin.confirm-delete
                                        id="delete-role-{{ $role->id }}"
                                        :action="route('roles.destroy', $role)"
                                        title="Delete Role"
                                        message="Are you sure you want to delete role {{ $role->name }}?"
                                    />
                                @else
                                    <span class="text-muted small">Protected</span>
                                @endif
                            @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </x-admin.card>
@endsection

@push('plugins')
    datatables
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.adminPluginEnabled('datatables')) {
                new DataTable('#roles-table');
            }
        });
    </script>
@endpush
