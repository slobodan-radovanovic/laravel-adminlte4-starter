@extends('layouts.admin')

@section('title', 'File Manager')

@section('content_header')
    <x-admin.content-header title="File Manager" />
@endsection

@section('content')
    <x-admin.card body-class="p-0">
        {{-- Laravel Filemanager (UniSharp) has its own interface, so it runs in an iframe. --}}
        <iframe
            src="{{ route('unisharp.lfm.show', ['type' => 'file']) }}"
            title="File manager"
            class="d-block w-100 border-0 rounded"
            style="height: calc(100vh - 14rem); min-height: 32rem;"
        ></iframe>
    </x-admin.card>
@endsection
