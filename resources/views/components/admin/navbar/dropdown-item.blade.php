@props([
    'url' => '#',
    'icon' => null,
    'text' => null,
    'time' => null,
    'divider' => false,
])

{{-- A link inside <x-admin.navbar.dropdown>, with optional icon and right-aligned time. --}}
<a href="{{ $url }}" {{ $attributes->merge(['class' => 'dropdown-item d-flex align-items-center']) }}>
    @if ($icon)
        <i class="{{ $icon }} me-2"></i>
    @endif

    <span class="flex-grow-1">{{ $text }}{{ $slot }}</span>

    @if ($time)
        <span class="text-secondary small ms-3">{{ $time }}</span>
    @endif
</a>

@if ($divider)
    <div class="dropdown-divider"></div>
@endif
