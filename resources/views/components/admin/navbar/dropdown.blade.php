@props([
    'icon' => null,
    'label' => null,
    'badge' => null,
    'badgeTheme' => 'danger',
    'size' => null,
    'header' => null,
])

{{-- Navbar dropdown. Put <x-admin.navbar.dropdown-item> (or any dropdown markup) in the slot. --}}
<li {{ $attributes->merge(['class' => 'nav-item dropdown']) }}>
    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        @if ($icon)
            <i class="{{ $icon }}"></i>
        @endif

        @if ($label)
            <span class="{{ $icon ? 'ms-1' : '' }}">{{ $label }}</span>
        @endif

        @if ($badge !== null && $badge !== '')
            <span class="navbar-badge badge text-bg-{{ $badgeTheme }}">{{ $badge }}</span>
        @endif
    </a>

    <div class="dropdown-menu dropdown-menu-end {{ $size ? 'dropdown-menu-'.$size : '' }}">
        @if ($header)
            <span class="dropdown-item dropdown-header">{{ $header }}</span>
            <div class="dropdown-divider"></div>
        @endif

        {{ $slot }}
    </div>
</li>
