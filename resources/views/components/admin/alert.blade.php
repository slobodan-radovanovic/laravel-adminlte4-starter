@props([
    'theme' => 'info',
    'title' => null,
    'icon' => null,
    'dismissable' => false,
])

{{-- Bootstrap alert with a default icon per theme. --}}
@php
    $icons = [
        'success' => 'bi bi-check-circle-fill',
        'danger' => 'bi bi-x-octagon-fill',
        'warning' => 'bi bi-exclamation-triangle-fill',
        'info' => 'bi bi-info-circle-fill',
    ];
    $icon ??= $icons[$theme] ?? null;
@endphp

<div role="alert" {{ $attributes->merge(['class' => 'alert alert-'.$theme.($dismissable ? ' alert-dismissible fade show' : '')]) }}>
    <div class="d-flex">
        @if ($icon)
            <i class="{{ $icon }} me-2 flex-shrink-0"></i>
        @endif

        <div>
            @if ($title)
                <h5 class="alert-heading mb-1">{{ $title }}</h5>
            @endif

            {{ $slot }}
        </div>
    </div>

    @if ($dismissable)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>
