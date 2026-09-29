@props([
    'name',
    'label' => null,
    'value' => null,
    'required' => false,
    'help' => null,
    'height' => 320,
    'config' => [],
])

{{--
    Full-featured rich text editor powered by TinyMCE (self-hosted, bundled by Vite).
    TinyMCE 7+ is licensed under GPL 2.0 or later unless you buy a commercial license;
    set the key in adminlte.plugins.tinymce.license_key (TINYMCE_LICENSE_KEY).
    Always sanitize the submitted HTML before displaying it again.
--}}
@php
    $id = $attributes->get('id', $name);
    $errorName = trim(str_replace(['[', ']'], ['.', ''], $name), '.');
    $config = array_merge([
        'license_key' => config('adminlte.plugins.tinymce.license_key', 'gpl'),
        'height' => $height,
    ], $config);
@endphp

@push('plugins')
    tinymce
@endpush

<x-admin.form._field :id="$id" :name="$name" :label="$label" :required="$required" :help="$help" :error-name="$errorName">
    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        data-admin-tinymce="{{ json_encode($config) }}"
        {{ $attributes->merge([
            'class' => 'form-control' . ($errors->has($errorName) ? ' is-invalid' : ''),
        ]) }}
    >{{ old($errorName, $value) }}</textarea>
</x-admin.form._field>
