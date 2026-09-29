@props([
    'modes' => null,
])

{{--
    Light / Dark / Auto menu for the navbar. AdminLTE's built-in ColorMode handles it through the
    data-bs-theme-value and data-lte-theme-icon attributes. Modes default to adminlte.theme.available.
--}}
@php
    $themeOptions = [
        'light' => ['label' => 'Light', 'icon' => 'bi-sun-fill'],
        'dark' => ['label' => 'Dark', 'icon' => 'bi-moon-stars-fill'],
        'auto' => ['label' => 'Auto', 'icon' => 'bi-circle-half'],
    ];

    $themeOptions = array_intersect_key(
        $themeOptions,
        array_flip($modes ?? config('adminlte.theme.available', array_keys($themeOptions))),
    );
@endphp

@if (count($themeOptions) > 1)
    <li {{ $attributes->merge(['class' => 'nav-item dropdown']) }}>
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
