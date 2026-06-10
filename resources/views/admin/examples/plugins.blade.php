@extends('layouts.admin')

@section('title', 'Plugin Examples')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="mb-0">Plugin Examples</h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Plugin Examples
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <x-admin.card title="Flatpickr" icon="bi bi-calendar-date">
                <div class="mb-3">
                    <label for="date" class="form-label">Date picker</label>
                    <input id="date"
                           type="text"
                           class="form-control js-flatpickr"
                           placeholder="Choose date">
                </div>
            </x-admin.card>
        </div>

        <div class="col-lg-6">
            <x-admin.card title="Inputmask" icon="bi bi-input-cursor-text">
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone mask</label>
                    <input id="phone"
                           type="text"
                           class="form-control js-phone-mask"
                           placeholder="+381 60 123 4567">
                </div>
            </x-admin.card>
        </div>

        <div class="col-lg-6">
            <x-admin.card title="SweetAlert2" icon="bi bi-exclamation-triangle">
                <button type="button"
                        class="btn btn-primary"
                        id="sweetalert-demo">
                    Show alert
                </button>
            </x-admin.card>
        </div>

        <div class="col-lg-6">
            <x-admin.card title="SortableJS" icon="bi bi-list-ul">
                <ul class="list-group js-sortable">
                    <li class="list-group-item">First item</li>
                    <li class="list-group-item">Second item</li>
                    <li class="list-group-item">Third item</li>
                </ul>
            </x-admin.card>
        </div>

        <div class="col-12">
            <x-admin.card title="Dropzone" icon="bi bi-upload">
                <form action="#"
                      class="dropzone border rounded p-4 text-center"
                      id="dropzone-demo">
                    <div class="dz-message">
                        Drop files here or click to upload.
                    </div>
                </form>
            </x-admin.card>
        </div>
    </div>
@endsection

@push('plugins')
    flatpickr
    inputmask
    sweetalert2
    sortablejs
    dropzone
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.adminPluginEnabled('flatpickr')) {
                window.flatpickr('.js-flatpickr', {
                    dateFormat: 'Y-m-d'
                });
            }

            if (window.adminPluginEnabled('inputmask')) {
                window.Inputmask({
                    mask: '+381 99 999 9999'
                }).mask('.js-phone-mask');
            }

            if (window.adminPluginEnabled('sweetalert2')) {
                document.getElementById('sweetalert-demo')?.addEventListener('click', function () {
                    window.Swal.fire({
                        title: 'Plugin works',
                        text: 'SweetAlert2 is active on this page.',
                        icon: 'success'
                    });
                });
            }

            if (window.adminPluginEnabled('sortablejs')) {
                document.querySelectorAll('.js-sortable').forEach(function (element) {
                    window.Sortable.create(element, {
                        animation: 150
                    });
                });
            }

            if (window.adminPluginEnabled('dropzone')) {
                new window.Dropzone('#dropzone-demo', {
                    url: '/',
                    autoProcessQueue: false,
                    addRemoveLinks: true
                });
            }
        });
    </script>
@endpush
