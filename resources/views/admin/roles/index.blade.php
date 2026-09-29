@extends('layouts.admin')

@section('title', 'Roles')

@section('content_header')
    <x-admin.content-header title="Roles" />
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
        <x-admin.datatable id="roles-table" :heads="['Name', 'Permissions', 'Created', ['label' => 'Actions', 'class' => 'text-end', 'sortable' => false]]">
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
                        @if ($role->name === \App\Models\User::SUPER_ADMIN_ROLE)
                            <span class="text-muted small">Protected</span>
                        @else
                            @can('edit roles')
                                <a href="{{ route('roles.edit', $role) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            @endcan

                            @can('delete roles')
                                <x-admin.confirm-delete
                                    id="delete-role-{{ $role->id }}"
                                    :action="route('roles.destroy', $role)"
                                    title="Delete Role"
                                    message="Are you sure you want to delete role {{ $role->name }}?"
                                />
                            @endcan
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-admin.datatable>
        @endif
    </x-admin.card>
@endsection
