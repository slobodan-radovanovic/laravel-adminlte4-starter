@props([
    'name',
    'label' => null,
    'options' => [],
    'selected' => null,
    'placeholder' => null,
    'required' => false,
    'multiple' => false,
    'help' => null,
    'config' => [],
])

{{-- Select with search, powered by Select2. Extra Select2 options go in "config". --}}
@php
    $id = $attributes->get('id', trim(str_replace(['[', ']'], ['_', ''], $name), '_'));
    $errorName = trim(str_replace(['[', ']'], ['.', ''], $name), '.');
    $config = array_merge(['placeholder' => $placeholder, 'allowClear' => ! $required && $placeholder], $config);
@endphp

@push('plugins')
    select2
@endpush

<x-admin.form._field :id="$id" :name="$name" :label="$label" :required="$required" :help="$help" :error-name="$errorName">
    <select
        id="{{ $id }}"
        name="{{ $name }}"
        data-admin-select2="{{ json_encode($config) }}"
        @required($required)
        @if ($multiple) multiple @endif
        {{ $attributes->merge([
            'class' => 'form-select' . ($errors->has($errorName) ? ' is-invalid' : ''),
        ]) }}
    >
        @if ($slot->isEmpty())
            <x-admin.form.options :options="$options" :selected="old($errorName, $selected)" :placeholder="$multiple ? null : ($placeholder ? '' : null)" />
        @else
            {{ $slot }}
        @endif
    </select>
</x-admin.form._field>
