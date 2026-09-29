@props([
    'id',
    'name',
    'label' => null,
    'required' => false,
    'help' => null,
    'errorName' => null,
    'prepend' => null,
    'append' => null,
])

{{-- Shared wrapper for form components: label, optional input-group addons, help text and validation error. --}}
<div {{ $attributes->merge(['class' => 'mb-3']) }}>
    @if ($label)
        <label for="{{ $id }}" class="form-label">
            {{ $label }}

            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    @if ($prepend || $append)
        <div class="input-group {{ $errors->has($errorName) ? 'has-validation' : '' }}">
            @if ($prepend)
                <span class="input-group-text">{{ $prepend }}</span>
            @endif

            {{ $slot }}

            @if ($append)
                <span class="input-group-text">{{ $append }}</span>
            @endif

            @error($errorName)
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    @else
        {{ $slot }}

        @error($errorName)
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    @endif

    @if ($help)
        <div class="form-text">{{ $help }}</div>
    @endif
</div>
