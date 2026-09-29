@props([
    'name',
    'url',
    'label' => null,
    'accept' => null,
    'maxFiles' => null,
    'maxFilesize' => 10,
    'message' => 'Drop files here or click to upload',
    'help' => null,
    'config' => [],
])

{{--
    Drag and drop uploader powered by Dropzone. Each file is uploaded to "url" right away;
    the "path" returned by that endpoint is added to the form as a hidden "{name}[]" input.
--}}
@php
    $id = $attributes->get('id', $name);
    $errorName = trim(str_replace(['[', ']'], ['.', ''], $name), '.');
    $config = array_merge(array_filter([
        'url' => $url,
        'field' => $name.'[]',
        'paramName' => 'file',
        'acceptedFiles' => $accept,
        'maxFiles' => $maxFiles,
        'maxFilesize' => $maxFilesize,
        'addRemoveLinks' => true,
        'dictDefaultMessage' => $message,
    ], fn ($value) => $value !== null), $config);
@endphp

@push('plugins')
    dropzone
@endpush

<div class="mb-3">
    @if ($label)
        <label class="form-label">{{ $label }}</label>
    @endif

    <div
        id="{{ $id }}"
        data-admin-dropzone="{{ json_encode($config) }}"
        {{ $attributes->merge(['class' => 'dropzone border rounded p-4 text-center' . ($errors->has($errorName) ? ' border-danger' : '')]) }}
    ></div>

    @if ($help)
        <div class="form-text">{{ $help }}</div>
    @endif

    @error($errorName)
    <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
