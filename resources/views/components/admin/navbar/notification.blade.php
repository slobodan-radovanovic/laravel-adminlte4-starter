@props([
    'icon' => 'bi bi-bell',
    'count' => 0,
    'theme' => 'warning',
    'url' => null,
    'label' => 'Notifications',
    'updateUrl' => null,
    'updatePeriod' => 60,
])

{{--
    Notification bell with a counter badge. With a slot it opens a dropdown, otherwise it links to "url".
    With "updateUrl", the counter is refreshed every "updatePeriod" seconds from JSON: {"count": 3}.
--}}
@php
    $updateConfig = $updateUrl ? json_encode(['url' => $updateUrl, 'period' => $updatePeriod]) : null;
@endphp

@if ($slot->isEmpty())
    <li {{ $attributes->merge(['class' => 'nav-item']) }}>
        <a class="nav-link" href="{{ $url ?? '#' }}" aria-label="{{ $label }}"
           @if ($updateConfig) data-admin-notification="{{ $updateConfig }}" @endif>
            <i class="{{ $icon }}"></i>
            <span class="navbar-badge badge text-bg-{{ $theme }} {{ $count ? '' : 'd-none' }}" data-admin-notification-count>{{ $count }}</span>
        </a>
    </li>
@else
    <li {{ $attributes->merge(['class' => 'nav-item dropdown']) }}
        @if ($updateConfig) data-admin-notification="{{ $updateConfig }}" @endif>
        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="{{ $label }}">
            <i class="{{ $icon }}"></i>
            <span class="navbar-badge badge text-bg-{{ $theme }} {{ $count ? '' : 'd-none' }}" data-admin-notification-count>{{ $count }}</span>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
            <span class="dropdown-item dropdown-header">
                <span data-admin-notification-count-text>{{ $count }}</span> {{ $label }}
            </span>
            <div class="dropdown-divider"></div>

            {{ $slot }}

            @if ($url)
                <div class="dropdown-divider"></div>
                <a href="{{ $url }}" class="dropdown-item dropdown-footer text-center">See all</a>
            @endif
        </div>
    </li>
@endif
