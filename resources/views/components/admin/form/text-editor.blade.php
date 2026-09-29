@props([
    'name',
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'help' => null,
])

{{--
    Rich text editor powered by Trix. The HTML is submitted in "name".
    Always sanitize it before displaying it again (for example with an HTML purifier).
--}}
@php
    $id = $attributes->get('id', $name);
    $errorName = trim(str_replace(['[', ']'], ['.', ''], $name), '.');
@endphp

@push('plugins')
    trix
@endpush

<x-admin.form._field :id="$id" :name="$name" :label="$label" :required="$required" :help="$help" :error-name="$errorName">
    <input id="{{ $id }}-input" type="hidden" name="{{ $name }}" value="{{ old($errorName, $value) }}">

    <trix-editor
        id="{{ $id }}"
        input="{{ $id }}-input"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'form-control trix-content' . ($errors->has($errorName) ? ' is-invalid' : ''),
        ]) }}
    ></trix-editor>
</x-admin.form._field>
