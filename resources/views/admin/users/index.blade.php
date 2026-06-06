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
    <div class="row mb-4">
        <div class="col-lg-3 col-6">
            <x-admin.small-box
                title="Users"
                :value="$users->count()"
                icon="bi bi-people"
                color="primary"
            />
        </div>

        <div class="col-lg-3 col-6">
            <x-admin.small-box
                title="Verified"
                :value="$users->whereNotNull('email_verified_at')->count()"
                icon="bi bi-check-circle"
                color="success"
            />
        </div>

        <div class="col-lg-3 col-6">
            <x-admin.small-box
                title="Unverified"
                :value="$users->whereNull('email_verified_at')->count()"
                icon="bi bi-envelope-exclamation"
                color="warning"
            />
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title mb-0">Users</h3>
                </div>

                <div class="card-body">
                    <table id="users-table" class="table table-bordered table-striped align-middle">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Verified</th>
                            <th>Created</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->email_verified_at)
                                        <span class="badge text-bg-success">Yes</span>
                                    @else
                                        <span class="badge text-bg-warning">No</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title mb-0">Example Select2</h3>
                </div>

                <div class="card-body">
                    <label for="example-select2" class="form-label">User</label>

                    <select id="example-select2" class="form-select">
                        <option value="">Choose user</option>

                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }} - {{ $user->email }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title mb-0">Users Chart</h3>
                </div>

                <div class="card-body">
                    <canvas id="users-chart" height="220"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new DataTable('#users-table');

            window.$('#example-select2').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Choose user'
            });

            const usersChart = document.getElementById('users-chart');

            if (usersChart) {
                new Chart(usersChart, {
                    type: 'doughnut',
                    data: {
                        labels: ['Verified', 'Unverified'],
                        datasets: [
                            {
                                data: [
                                    {{ $users->whereNotNull('email_verified_at')->count() }},
                                    {{ $users->whereNull('email_verified_at')->count() }}
                                ]
                            }
                        ]
                    }
                });
            }
        });
    </script>
@endpush
