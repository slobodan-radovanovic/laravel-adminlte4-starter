@props([
    'submit' => 'Save',
    'cancelUrl' => null,
    'cancelText' => 'Cancel',
])

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">
        {{ $submit }}
    </button>

    @if ($cancelUrl)
        <a href="{{ $cancelUrl }}" class="btn btn-outline-secondary">
            {{ $cancelText }}
        </a>
    @endif
</div>
