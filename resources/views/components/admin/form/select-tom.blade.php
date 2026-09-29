@props([
    'name',
    'label' => null,
    'options' => [],
    'selected' => null,
    'placeholder' => null,
    'required' => false,
    'multiple' => false,
    'create' => false,
    'help' => null,
    'config' => [],
])

{{-- Lightweight select with search, tagging ("create") and no jQuery, powered by Tom Select. --}}
@php
    $id = $attributes->get('id', trim(str_replace(['[', ']'], ['_', ''], $name), '_'));
    $errorName = trim(str_replace(['[', ']'], ['.', ''], $name), '.');
    $config = array_merge(array_filter([
        'placeholder' => $placeholder,
        'create' => $create,
        'plugins' => $multiple ? ['remove_button'] : [],
    ]), $config);
@endphp

@push('plugins')
    tomselect
@endpush

<x-admin.form._field :id="$id" :name="$name" :label="$label" :required="$required" :help="$help" :error-name="$errorName">
    <select
        id="{{ $id }}"
        name="{{ $name }}"
        data-admin-tomselect="{{ json_encode((object) $config) }}"
        autocomplete="off"
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
