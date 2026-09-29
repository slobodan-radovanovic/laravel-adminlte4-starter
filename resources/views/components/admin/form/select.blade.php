@props([
    'name',
    'label' => null,
    'options' => [],
    'selected' => null,
    'placeholder' => null,
    'required' => false,
    'multiple' => false,
    'help' => null,
])

@php
    $id = $attributes->get('id', trim(str_replace(['[', ']'], ['_', ''], $name), '_'));
    $errorName = trim(str_replace(['[', ']'], ['.', ''], $name), '.');
    $selectedValue = old($errorName, $selected);
@endphp

<x-admin.form._field :id="$id" :name="$name" :label="$label" :required="$required" :help="$help" :error-name="$errorName">
    <select
        id="{{ $id }}"
        name="{{ $name }}"
        @required($required)
        @if ($multiple) multiple @endif
        {{ $attributes->merge([
            'class' => 'form-select' . ($errors->has($errorName) ? ' is-invalid' : ''),
        ]) }}
    >
        @if ($slot->isEmpty())
            <x-admin.form.options :options="$options" :selected="$selectedValue" :placeholder="$multiple ? null : $placeholder" />
        @else
            {{ $slot }}
        @endif
    </select>
</x-admin.form._field>
