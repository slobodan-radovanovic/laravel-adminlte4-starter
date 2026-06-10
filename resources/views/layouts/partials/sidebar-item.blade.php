@php
    $user = auth()->user();

    $canView = true;

    if (isset($item['can'])) {
        $canView = $user?->can($item['can']) ?? false;
    }

    if (isset($item['can_any']) && is_array($item['can_any'])) {
        $canView = $user?->canAny($item['can_any']) ?? false;
    }

    $visibleChildren = [];

    if (! empty($item['submenu']) && is_array($item['submenu'])) {
        foreach ($item['submenu'] as $child) {
            $childCanView = true;

            if (isset($child['can'])) {
                $childCanView = $user?->can($child['can']) ?? false;
            }

            if (isset($child['can_any']) && is_array($child['can_any'])) {
                $childCanView = $user?->canAny($child['can_any']) ?? false;
            }

            if ($childCanView) {
                $visibleChildren[] = $child;
            }
        }

        $canView = $canView && count($visibleChildren) > 0;
    }

    $patterns = $item['active'] ?? [];

    if (is_string($patterns)) {
        $patterns = [$patterns];
    }

    $isActive = false;

    foreach ($patterns as $pattern) {
        if (request()->routeIs($pattern) || request()->is($pattern)) {
            $isActive = true;
        }
    }

    if (! $isActive && ! empty($item['route'])) {
        $isActive = request()->routeIs($item['route']);
    }

    $isOpen = $isActive;

    foreach ($visibleChildren as $child) {
        $childPatterns = $child['active'] ?? [];

        if (is_string($childPatterns)) {
            $childPatterns = [$childPatterns];
        }

        foreach ($childPatterns as $pattern) {
            if (request()->routeIs($pattern) || request()->is($pattern)) {
                $isOpen = true;
            }
        }

        if (! empty($child['route']) && request()->routeIs($child['route'])) {
            $isOpen = true;
        }
    }

    $url = '#';

    if (! empty($item['url'])) {
        $url = $item['url'];
    } elseif (! empty($item['route']) && Route::has($item['route'])) {
        $url = route($item['route']);
    }
@endphp

@if ($canView)
    @if (($item['header'] ?? false) === true)
        <li class="nav-header">
            {{ $item['text'] }}
        </li>
    @elseif (! empty($visibleChildren))
        <li class="nav-item {{ $isOpen ? 'menu-open' : '' }}">
            <a href="#"
               class="nav-link {{ $isOpen ? 'active' : '' }}">
                @if (! empty($item['icon']))
                    <i class="nav-icon {{ $item['icon'] }}"></i>
                @endif

                <p>
                    {{ $item['text'] }}

                    @if (! empty($item['badge']))
                        <span class="badge {{ $item['badge']['class'] ?? 'text-bg-secondary' }} ms-2">
                            {{ $item['badge']['text'] }}
                        </span>
                    @endif

                    <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                @foreach ($visibleChildren as $child)
                    @include('layouts.partials.sidebar-item', ['item' => $child])
                @endforeach
            </ul>
        </li>
    @else
        <li class="nav-item">
            <a href="{{ $url }}"
               class="nav-link {{ $isActive ? 'active' : '' }}"
               @if (! empty($item['target'])) target="{{ $item['target'] }}" rel="noopener noreferrer" @endif>
                @if (! empty($item['icon']))
                    <i class="nav-icon {{ $item['icon'] }}"></i>
                @endif

                <p>
                    {{ $item['text'] }}

                    @if (! empty($item['badge']))
                        <span class="badge {{ $item['badge']['class'] ?? 'text-bg-secondary' }} ms-2">
                            {{ $item['badge']['text'] }}
                        </span>
                    @endif
                </p>
            </a>
        </li>
    @endif
@endif
