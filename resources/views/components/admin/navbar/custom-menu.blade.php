@props([
    'url' => '#',
    'icon' => null,
    'text' => null,
    'label' => null,
    'badge' => null,
    'badgeTheme' => 'primary',
    'target' => null,
])

{{-- A single custom link in the navbar, with optional icon and badge. Give icon-only links a "label". --}}
<li {{ $attributes->merge(['class' => 'nav-item']) }}>
    <a href="{{ $url }}" class="nav-link" aria-label="{{ $label ?? $text }}"
       @if ($target) target="{{ $target }}" @endif
       @if ($target === '_blank') rel="noopener" @endif>
        @if ($icon)
            <i class="{{ $icon }}"></i>
        @endif

        @if ($text)
            <span class="{{ $icon ? 'ms-1' : '' }}">{{ $text }}</span>
        @endif

        @if ($badge !== null && $badge !== '')
            <span class="navbar-badge badge text-bg-{{ $badgeTheme }}">{{ $badge }}</span>
        @endif
    </a>
</li>
