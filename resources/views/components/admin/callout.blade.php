@props([
    'theme' => 'info',
    'title' => null,
    'icon' => null,
])

{{-- AdminLTE callout: a note with a colored left border. --}}
<div {{ $attributes->merge(['class' => 'callout callout-'.$theme]) }}>
    @if ($title)
        <h5>
            @if ($icon)
                <i class="{{ $icon }} me-1"></i>
            @endif
            {{ $title }}
        </h5>
    @endif

    {{ $slot }}
</div>
