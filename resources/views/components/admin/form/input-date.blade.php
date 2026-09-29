@props([
    'name',
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'time' => false,
    'help' => null,
    'config' => [],
])

{{-- Date (or date and time) picker powered by Flatpickr. Extra Flatpickr options go in "config". --}}
@php
    $id = $attributes->get('id', $name);
    $errorName = trim(str_replace(['[', ']'], ['.', ''], $name), '.');
    $config = array_merge([
        'dateFormat' => $time ? 'Y-m-d H:i' : 'Y-m-d',
        'enableTime' => $time,
        'time_24hr' => true,
        'allowInput' => true,
    ], $config);
@endphp

@push('plugins')
    flatpickr
@endpush

<x-admin.form._field :id="$id" :name="$name" :label="$label" :required="$required" :help="$help" :error-name="$errorName">
    <x-slot:prepend><i class="bi {{ $time ? 'bi-calendar-event' : 'bi-calendar3' }}"></i></x-slot:prepend>

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
