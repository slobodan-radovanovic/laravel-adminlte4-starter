<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="{{ config('adminlte.sidebar.theme', 'dark') }}">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <span class="brand-text fw-light">
                {{ config('adminlte.name', config('app.name', 'Admin Panel')) }}
            </span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" role="menu" data-accordion="false">

                @foreach (config('adminlte.menu', []) as $item)

                    @if (isset($item['header']))
                        <li class="nav-header">
                            {{ $item['header'] }}
                        </li>
                    @else
                        @php
                            $route = $item['route'] ?? null;
                            $isActive = $route && request()->routeIs($route);
                        @endphp

                        <li class="nav-item">
                            <a href="{{ $route ? route($route) : '#' }}"
                               class="nav-link {{ $isActive ? 'active' : '' }}">
                                @if (! empty($item['icon']))
                                    <i class="nav-icon {{ $item['icon'] }}"></i>
                                @endif

                                <p>{{ $item['text'] }}</p>
                            </a>
                        </li>
                    @endif

                @endforeach

            </ul>
        </nav>
    </div>
</aside>
