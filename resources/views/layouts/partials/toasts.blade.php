
@php
    $flash = null;

    foreach (['success', 'error', 'warning', 'info'] as $type) {
        if (session()->has($type)) {
            $flash = [
                'type' => $type,
                'message' => session($type),
            ];

            break;
        }
    }

    $flashConfig = [
        'success' => [
            'title' => 'Successfully',
            'icon' => 'bi bi-check-circle-fill',
            'class' => 'text-success',
        ],
        'error' => [
            'title' => 'Error',
            'icon' => 'bi bi-x-circle-fill',
            'class' => 'text-danger',
        ],
        'warning' => [
            'title' => 'Warning',
            'icon' => 'bi bi-exclamation-triangle-fill',
            'class' => 'text-warning',
        ],
        'info' => [
            'title' => 'Information',
            'icon' => 'bi bi-info-circle-fill',
            'class' => 'text-info',
        ],
    ];

    $config = $flash ? $flashConfig[$flash['type']] : null;
@endphp

@if ($flash)
    <div class="admin-flash-overlay" data-admin-flash>
        <div class="admin-flash-card">
            <button type="button"
                    class="btn-close admin-flash-close"
                    aria-label="Close"
                    data-admin-flash-close></button>

            <div class="admin-flash-icon {{ $config['class'] }}">
                <i class="{{ $config['icon'] }}"></i>
            </div>

            <h5 class="admin-flash-title">
                {{ $config['title'] }}
            </h5>

            <p class="admin-flash-message">
                {{ $flash['message'] }}
            </p>
        </div>
    </div>
@endif


{{--
@php
    $toasts = [];

    foreach (['success', 'error', 'warning', 'info'] as $type) {
        if (session()->has($type)) {
            $toasts[] = [
                'type' => $type,
                'message' => session($type),
            ];
        }
    }

    $toastClasses = [
        'success' => 'text-bg-success',
        'error' => 'text-bg-danger',
        'warning' => 'text-bg-warning',
        'info' => 'text-bg-info',
    ];

    $toastIcons = [
        'success' => 'bi bi-check-circle',
        'error' => 'bi bi-x-circle',
        'warning' => 'bi bi-exclamation-triangle',
        'info' => 'bi bi-info-circle',
    ];
@endphp

@if (count($toasts))
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1080;">
        @foreach ($toasts as $toast)
            <div class="toast {{ $toastClasses[$toast['type']] ?? 'text-bg-secondary' }}"
                 role="alert"
                 aria-live="assertive"
                 aria-atomic="true"
                 data-bs-delay="4000">
                <div class="toast-header">
                    <i class="{{ $toastIcons[$toast['type']] ?? 'bi bi-info-circle' }} me-2"></i>

                    <strong class="me-auto">
                        {{ ucfirst($toast['type']) }}
                    </strong>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="toast"
                            aria-label="Close"></button>
                </div>

                <div class="toast-body">
                    {{ $toast['message'] }}
                </div>
            </div>
        @endforeach
    </div>
@endif
--}}
