
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
    <div class="admin-flash-overlay"
         data-admin-flash
         data-admin-flash-delay="{{ config('adminlte.feedback.delay', 3000) }}">
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
