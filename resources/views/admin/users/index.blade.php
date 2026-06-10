@extends('layouts.admin')

@section('title', 'Users')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="mb-0">Users</h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Users
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <x-admin.card title="Users" icon="bi bi-people">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="text-muted mb-0">
                Manage application users and their roles.
            </p>

            @can('create users')
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i>
                    Create User
                </a>
            @endcan
        </div>

        <table id="users-table" class="table table-bordered table-striped align-middle">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Verified</th>
                <th>Created</th>
                <th class="text-end">Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        <strong>{{ $user->name }}</strong>
                    </td>

                    <td>{{ $user->email }}</td>

                    <td>
                        @forelse ($user->roles as $role)
                            <span class="badge text-bg-primary">
                                    {{ $role->name }}
                                </span>
                        @empty
                            <span class="text-muted">No roles</span>
                        @endforelse
                    </td>

                    <td>
                        @if ($user->email_verified_at)
                            <span class="badge text-bg-success">Yes</span>
                        @else
                            <span class="badge text-bg-warning">No</span>
                        @endif
                    </td>

                    <td>{{ $user->created_at?->format('Y-m-d') }}</td>

                    <td class="text-end">
                        @can('edit users')
                            <a href="{{ route('users.edit', $user) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                        @endcan

                        @can('delete users')
                            @if (! $user->is(auth()->user()))
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#delete-user-{{ $user->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>

                                <div class="modal fade"
                                     id="delete-user-{{ $user->id }}"
                                     tabindex="-1"
                                     aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form method="POST"
                                              action="{{ route('users.destroy', $user) }}"
                                              class="modal-content text-start">
                                            @csrf
                                            @method('DELETE')

                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete User</h5>

                                                <button type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                Are you sure you want to delete user
                                                <strong>{{ $user->name }}</strong>?
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button"
                                                        class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                    Cancel
                                                </button>

                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <span class="text-muted small">Current user</span>
                            @endif
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-admin.card>
@endsection

@push('plugins')
    datatables
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.adminPluginEnabled('datatables')) {
                new DataTable('#users-table');
            }
        });
    </script>
@endpush
