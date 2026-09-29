@props([
    'icon' => 'bi bi-circle-fill',
    'theme' => 'primary',
    'title' => null,
    'url' => null,
    'time' => null,
    'footer' => null,
])

{{-- One timeline entry. Without title, slot and footer it renders only the icon (for the end of a timeline). --}}
<div {{ $attributes }}>
    <i class="timeline-icon {{ $icon }} text-bg-{{ $theme }}"></i>

    @if ($title || ! $slot->isEmpty() || $footer)
        <div class="timeline-item">
            @if ($time)
                <span class="time"><i class="bi bi-clock-fill"></i> {{ $time }}</span>
            @endif

            @if ($title)
                <h3 class="timeline-header {{ $slot->isEmpty() && ! $footer ? 'border-0' : '' }}">
                    @if ($url)
                        <a href="{{ $url }}">{{ $title }}</a>
                    @else
                        {{ $title }}
                    @endif
                </h3>
            @endif

            @if (! $slot->isEmpty())
                <div class="timeline-body">{{ $slot }}</div>
            @endif

            @if ($footer)
                <div class="timeline-footer">{{ $footer }}</div>
            @endif
        </div>
    @endif
</div>
