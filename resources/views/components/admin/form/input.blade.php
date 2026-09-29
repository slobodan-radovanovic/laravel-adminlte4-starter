@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'autofocus' => false,
    'help' => null,
    'prepend' => null,
    'append' => null,
])

{{-- Text-like input. "prepend" and "append" (text or <x-slot:prepend> with an icon) add input-group addons. --}}
@php
    $id = $attributes->get('id', $name);
    $errorName = trim(str_replace(['[', ']'], ['.', ''], $name), '.');
@endphp

<x-admin.form._field :id="$id" :name="$name" :label="$label" :required="$required" :help="$help" :error-name="$errorName"
                     :prepend="$prepend" :append="$append">
    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ $type === 'password' ? '' : old($errorName, $value) }}"
        placeholder="{{ $placeholder }}"
        @required($required)
        @autofocus($autofocus)
        {{ $attributes->merge([
            'class' => 'form-control' . ($errors->has($errorName) ? ' is-invalid' : ''),
        ]) }}
    >
</x-admin.form._field>
