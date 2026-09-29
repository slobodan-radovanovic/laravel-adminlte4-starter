@props([
    'name',
    'label' => null,
    'value' => null,
    'placeholder' => 'Select a date range',
    'required' => false,
    'help' => null,
    'config' => [],
])

{{-- Date range picker powered by Flatpickr. The value is submitted as "Y-m-d to Y-m-d". --}}
@php
    $id = $attributes->get('id', $name);
    $errorName = trim(str_replace(['[', ']'], ['.', ''], $name), '.');
    $config = array_merge([
        'mode' => 'range',
        'dateFormat' => 'Y-m-d',
        'allowInput' => true,
    ], $config);
@endphp

@push('plugins')
    flatpickr
@endpush

<x-admin.form._field :id="$id" :name="$name" :label="$label" :required="$required" :help="$help" :error-name="$errorName">
    <x-slot:prepend><i class="bi bi-calendar-range"></i></x-slot:prepend>

    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="text"
        value="{{ old($errorName, $value) }}"
        placeholder="{{ $placeholder }}"
        data-admin-flatpickr="{{ json_encode($config) }}"
        @required($required)
        {{ $attributes->merge([
            'class' => 'form-control' . ($errors->has($errorName) ? ' is-invalid' : ''),
        ]) }}
    >
</x-admin.form._field>
