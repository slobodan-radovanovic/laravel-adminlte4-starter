@props([
    'title',
    'url' => '#',
    'icon' => null,
    'badge' => null,
    'badgeTheme' => 'primary',
])

{{-- A link row in <x-admin.profile-widget layout="list">, with an optional badge on the right. --}}
<li {{ $attributes->merge(['class' => 'nav-item']) }}>
    <a href="{{ $url }}" class="nav-link">
        @if ($icon)
            <i class="{{ $icon }} me-1"></i>
        @endif

        {{ $title }}

        @if ($badge !== null)
            <span class="float-end badge text-bg-{{ $badgeTheme }}">{{ $badge }}</span>
        @endif
    </a>
</li>
