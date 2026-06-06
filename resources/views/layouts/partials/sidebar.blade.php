<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="{{ config('adminlte.sidebar.theme', 'dark') }}">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
            @if (config('adminlte.sidebar.brand_logo'))
                <img src="{{ asset(config('adminlte.sidebar.brand_logo')) }}"
                     alt="{{ config('adminlte.sidebar.brand_text', config('adminlte.name')) }}"
                     class="brand-image opacity-75 shadow">
            @endif

            <span class="brand-text fw-light">
                {{ config('adminlte.sidebar.brand_text', config('adminlte.name', config('app.name', 'Admin Panel'))) }}
            </span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" role="menu" data-accordion="false">

                @foreach (config('adminlte.menu', []) as $item)

                    @if (isset($item['can']) && ! auth()->user()?->can($item['can']))
                        @continue
                    @endif

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
