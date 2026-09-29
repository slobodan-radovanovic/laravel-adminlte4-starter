@props([
    'name',
    'label' => null,
    'value' => null,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'unit' => '',
    'help' => null,
])

{{-- Range slider with the current value shown next to the label. --}}
@php
    $id = $attributes->get('id', $name);
    $errorName = trim(str_replace(['[', ']'], ['.', ''], $name), '.');
    $current = old($errorName, $value ?? $min);
@endphp

<div class="mb-3">
    @if ($label)
        <label for="{{ $id }}" class="form-label d-flex justify-content-between">
            <span>{{ $label }}</span>
            <span class="badge text-bg-secondary"><span id="{{ $id }}-value">{{ $current }}</span>{{ $unit }}</span>
        </label>
    @endif

    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="range"
        value="{{ $current }}"
        min="{{ $min }}"
        max="{{ $max }}"
        step="{{ $step }}"
        data-admin-output="#{{ $id }}-value"
        {{ $attributes->merge([
            'class' => 'form-range' . ($errors->has($errorName) ? ' is-invalid' : ''),
        ]) }}
    >

    @if ($help)
        <div class="form-text">{{ $help }}</div>
    @endif

    @error($errorName)
    <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
