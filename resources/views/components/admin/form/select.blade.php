@props([
    'name',
    'label' => null,
    'options' => [],
    'selected' => null,
    'placeholder' => null,
    'required' => false,
    'help' => null,
])

@php
    $id = $attributes->get('id', $name);
    $errorName = str_replace(['[', ']'], ['.', ''], $name);
    $selectedValue = old($errorName, $selected);
@endphp

<div class="mb-3">
    @if ($label)
        <label for="{{ $id }}" class="form-label">
            {{ $label }}

            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <select
        id="{{ $id }}"
        name="{{ $name }}"
        @required($required)
        {{ $attributes->merge([
            'class' => 'form-select' . ($errors->has($errorName) ? ' is-invalid' : ''),
        ]) }}
    >
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected((string) $selectedValue === (string) $optionValue)>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>

    @if ($help)
        <div class="form-text">{{ $help }}</div>
    @endif

    @error($errorName)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
