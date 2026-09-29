@props([
    'name',
    'label' => null,
    'value' => '#0d6efd',
    'required' => false,
    'help' => null,
])

{{-- Native color picker with the selected hex value shown next to it. --}}
@php
    $id = $attributes->get('id', $name);
    $errorName = trim(str_replace(['[', ']'], ['.', ''], $name), '.');
    $color = old($errorName, $value);
@endphp

<x-admin.form._field :id="$id" :name="$name" :label="$label" :required="$required" :help="$help" :error-name="$errorName">
    <div class="d-flex align-items-center gap-2">
        <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="color"
            value="{{ $color }}"
            data-admin-output="#{{ $id }}-value"
            @required($required)
            {{ $attributes->merge([
                'class' => 'form-control form-control-color' . ($errors->has($errorName) ? ' is-invalid' : ''),
            ]) }}
        >
        <code id="{{ $id }}-value">{{ $color }}</code>
    </div>
</x-admin.form._field>
