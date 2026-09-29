@props([
    'name',
    'label' => null,
    'accept' => null,
    'multiple' => false,
    'required' => false,
    'help' => null,
])

{{-- Native file input. Remember enctype="multipart/form-data" on the form. --}}
@php
    $id = $attributes->get('id', trim(str_replace(['[', ']'], ['_', ''], $name), '_'));
    $errorName = trim(str_replace(['[', ']'], ['.', ''], $name), '.');
@endphp

<x-admin.form._field :id="$id" :name="$name" :label="$label" :required="$required" :help="$help" :error-name="$errorName">
    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="file"
        @if ($accept) accept="{{ $accept }}" @endif
        @if ($multiple) multiple @endif
        @required($required)
        {{ $attributes->merge([
            'class' => 'form-control' . ($errors->has($errorName) ? ' is-invalid' : ''),
        ]) }}
    >
</x-admin.form._field>
