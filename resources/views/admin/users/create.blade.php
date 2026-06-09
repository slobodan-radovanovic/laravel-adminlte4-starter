@extends('layouts.admin')

@section('title', 'Create User')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="mb-0">Create User</h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('users.index') }}">Users</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Create
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="row">
            <div class="col-lg-8">
                <x-admin.card title="User Details" icon="bi bi-person-plus">
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Name <span class="text-danger">*</span>
                        </label>

                        <input id="name"
                               name="name"
                               type="text"
                               value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror"
                               required
                               autofocus>

                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email <span class="text-danger">*</span>
                        </label>

                        <input id="email"
                               name="email"
                               type="email"
                               value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror"
                               required>

                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Password <span class="text-danger">*</span>
                        </label>

                        <input id="password"
                               name="password"
                               type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required>

                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            Confirm Password <span class="text-danger">*</span>
                        </label>

                        <input id="password_confirmation"
                               name="password_confirmation"
                               type="password"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <input type="hidden" name="email_verified" value="0">

                        <div class="form-check form-switch">
                            <input id="email_verified"
                                   name="email_verified"
                                   type="checkbox"
                                   value="1"
                                   class="form-check-input"
                                @checked(old('email_verified', true))>

                            <label for="email_verified" class="form-check-label">
                                Mark email as verified
                            </label>
                        </div>
                    </div>
                </x-admin.card>
            </div>

            <div class="col-lg-4">
                <x-admin.card title="Roles" icon="bi bi-shield-lock">
                    @error('roles')
                    <div class="text-danger small mb-2">{{ $message }}</div>
                    @enderror

                    @foreach ($roles as $roleValue => $roleLabel)
                        <div class="form-check mb-2">
                            <input type="checkbox"
                                   id="role-{{ str($roleValue)->slug() }}"
                                   name="roles[]"
                                   value="{{ $roleValue }}"
                                   class="form-check-input"
                                @checked(in_array($roleValue, old('roles', []), true))>

                            <label for="role-{{ str($roleValue)->slug() }}" class="form-check-label">
                                {{ $roleLabel }}
                            </label>
                        </div>
                    @endforeach
                </x-admin.card>

                <x-admin.card>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            Create User
                        </button>

                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </x-admin.card>
            </div>
        </div>
    </form>
@endsection
