@props([
    'name',
    'label',
    'checked' => false,
    'value' => 1,
    'uncheckedValue' => 0,
    'help' => null,
    'switch' => true,
])

@php
    $id = $attributes->get('id', $name);
    $errorName = str_replace(['[', ']'], ['.', ''], $name);
    $isChecked = (bool) old($errorName, $checked);
@endphp

<div class="mb-3">
    <input type="hidden" name="{{ $name }}" value="{{ $uncheckedValue }}">

    <div class="form-check {{ $switch ? 'form-switch' : '' }}">
        <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="checkbox"
            value="{{ $value }}"
            @checked($isChecked)
            {{ $attributes->merge([
                'class' => 'form-check-input' . ($errors->has($errorName) ? ' is-invalid' : ''),
            ]) }}
        >

        <label for="{{ $id }}" class="form-check-label">
            {{ $label }}
        </label>

        @error($errorName)
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    @if ($help)
        <div class="form-text">{{ $help }}</div>
    @endif
</div>
