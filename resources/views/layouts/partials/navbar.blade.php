<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>

            <li class="nav-item d-none d-md-block">
                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto">
            @php
                $themeOptions = [
                    'light' => ['label' => 'Light', 'icon' => 'bi-sun-fill'],
                    'dark' => ['label' => 'Dark', 'icon' => 'bi-moon-stars-fill'],
                    'auto' => ['label' => 'Auto', 'icon' => 'bi-circle-half'],
                ];

                $themeOptions = array_intersect_key(
                    $themeOptions,
                    array_flip(config('adminlte.theme.available', array_keys($themeOptions))),
                );
            @endphp

            @if (count($themeOptions) > 1)
                {{-- Handled by AdminLTE's built-in ColorMode through the data-bs-theme-value and data-lte-theme-icon attributes. --}}
                <li class="nav-item dropdown">
                    <button type="button"
                            class="nav-link btn btn-link dropdown-toggle"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            aria-label="Color mode">
                        @foreach ($themeOptions as $value => $option)
                            <i class="bi {{ $option['icon'] }} d-none" data-lte-theme-icon="{{ $value }}"></i>
                        @endforeach
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        @foreach ($themeOptions as $value => $option)
                            <li>
                                <button type="button"
                                        class="dropdown-item d-flex align-items-center"
                                        data-bs-theme-value="{{ $value }}"
                                        aria-pressed="false">
                                    <i class="bi {{ $option['icon'] }} me-2"></i>
                                    {{ $option['label'] }}
                                    <i class="bi bi-check-lg ms-auto d-none"></i>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-1"></i>
                    {{ Auth::user()->name ?? 'User' }}
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <span class="dropdown-item-text text-muted small">
                            {{ Auth::user()->getRoleNames()->implode(', ') ?: 'No role' }}
                        </span>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person me-2"></i>
                            Profile
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="dropdown-item">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
