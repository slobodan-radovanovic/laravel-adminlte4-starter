@props([
    'title' => null,
    'icon' => null,
    'footer' => null,
])

<div {{ $attributes->merge(['class' => 'card']) }}>
    @if ($title)
        <div class="card-header">
            <h3 class="card-title mb-0">
                @if ($icon)
                    <i class="{{ $icon }} me-1"></i>
                @endif

                {{ $title }}
            </h3>
        </div>
    @endif

    <div class="card-body">
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div>
