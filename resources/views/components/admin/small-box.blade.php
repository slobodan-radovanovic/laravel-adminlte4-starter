@props([
    'title',
    'value',
    'icon' => 'bi bi-circle',
    'color' => 'primary',
    'url' => null,
    'urlText' => 'More info',
])

<div class="small-box text-bg-{{ $color }}">
    <div class="inner">
        <h3>{{ $value }}</h3>
        <p>{{ $title }}</p>
    </div>

    <i class="small-box-icon {{ $icon }}"></i>

    @if ($url)
        <a href="{{ $url }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
            {{ $urlText }}
            <i class="bi bi-link-45deg"></i>
        </a>
    @endif
</div>
