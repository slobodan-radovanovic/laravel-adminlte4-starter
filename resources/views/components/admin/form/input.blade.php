@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'autofocus' => false,
    'help' => null,
])

@php
    $id = $attributes->get('id', $name);
    $errorName = str_replace(['[', ']'], ['.', ''], $name);
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

    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($errorName, $value) }}"
        placeholder="{{ $placeholder }}"
        @required($required)
        @autofocus($autofocus)
        {{ $attributes->merge([
            'class' => 'form-control' . ($errors->has($errorName) ? ' is-invalid' : ''),
        ]) }}
    >

    @if ($help)
        <div class="form-text">{{ $help }}</div>
    @endif

    @error($errorName)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
