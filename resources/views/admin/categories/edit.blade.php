@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="mb-0">Edit Category</h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('categories.index') }}">Categories</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Edit
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <x-admin.card title="Category Details" icon="bi bi-pencil">
                <form method="POST" action="{{ route('categories.update', $category) }}">
                    @csrf
                    @method('PUT')

                    @include('admin.categories._form', ['category' => $category])

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            Update Category
                        </button>

                        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </x-admin.card>
        </div>
    </div>
@endsection
