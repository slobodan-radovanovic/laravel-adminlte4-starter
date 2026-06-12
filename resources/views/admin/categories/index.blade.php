@extends('layouts.admin')

@section('title', 'Categories')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="mb-0">Categories</h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Categories
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <x-admin.card title="Categories" icon="bi bi-tags">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="text-muted mb-0">
                Example CRUD module for the starter.
            </p>

            @can('create categories')
                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i>
                    Create Category
                </a>
            @endcan
        </div>
        @if ($categories->isEmpty())
            <x-admin.empty-state
                icon="bi bi-tags"
                title="No categories found"
                message="There are no categories to display yet."
                :action-url="auth()->user()?->can('create categories') ? route('categories.create') : null"
                action-text="Create Category"
            />
        @else
        <table id="categories-table" class="table table-bordered table-striped align-middle">
            <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Created</th>
                <th class="text-end">Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <code>{{ $category->slug }}</code>
                    </td>
                    <td>
                        @if ($category->is_active)
                            <span class="badge text-bg-success">Active</span>
                        @else
                            <span class="badge text-bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $category->created_at->format('Y-m-d') }}</td>
                    <td class="text-end">
                        @can('edit categories')
                            <a href="{{ route('categories.edit', $category) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                        @endcan

                        @can('delete categories')
                            <button type="button"
                                    class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#delete-category-{{ $category->id }}">
                                <i class="bi bi-trash"></i>
                            </button>

                            <div class="modal fade"
                                 id="delete-category-{{ $category->id }}"
                                 tabindex="-1"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST"
                                          action="{{ route('categories.destroy', $category) }}"
                                          class="modal-content text-start">
                                        @csrf
                                        @method('DELETE')

                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Category</h5>

                                            <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            Are you sure you want to delete category
                                            <strong>{{ $category->name }}</strong>?
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
                new DataTable('#categories-table');
            }
        });
    </script>
@endpush
