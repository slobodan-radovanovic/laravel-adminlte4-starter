@props([
    'title',
    'text' => null,
    'icon' => null,
])

{{-- A centered value with a caption (AdminLTE description block). Works in profile widgets or anywhere. --}}
<div {{ $attributes->merge(['class' => 'description-block']) }}>
    <h5 class="description-header">
        @if ($icon)
            <i class="{{ $icon }} me-1"></i>
        @endif
        {{ $title }}
    </h5>

    @if ($text)
        <span class="description-text">{{ $text }}</span>
    @endif
</div>
