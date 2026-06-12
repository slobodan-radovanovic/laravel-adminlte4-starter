@props([
    'icon' => 'bi bi-inbox',
    'title' => 'No records found',
    'message' => 'There is no data to display yet.',
    'actionUrl' => null,
    'actionText' => null,
])

<div class="text-center py-5">
    <div class="mb-3">
        <i class="{{ $icon }} display-4 text-muted"></i>
    </div>

    <h5>{{ $title }}</h5>

    <p class="text-muted mb-4">
        {{ $message }}
    </p>

    @if ($actionUrl && $actionText)
        <a href="{{ $actionUrl }}" class="btn btn-primary">
            {{ $actionText }}
        </a>
    @endif
</div>
