@props([
    'label' => null,
    'type' => 'button',
    'theme' => 'primary',
    'outline' => false,
    'size' => null,
    'icon' => null,
    'url' => null,
])

{{-- A themed button, or a link styled as a button when "url" is set. --}}
@php
    $classes = 'btn btn-' . ($outline ? 'outline-' : '') . $theme . ($size ? ' btn-' . $size : '');
@endphp

@if ($url)
    <a href="{{ $url }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)<i class="{{ $icon }}{{ $label || ! $slot->isEmpty() ? ' me-1' : '' }}"></i>@endif{{ $label }}{{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)<i class="{{ $icon }}{{ $label || ! $slot->isEmpty() ? ' me-1' : '' }}"></i>@endif{{ $label }}{{ $slot }}
    </button>
@endif
