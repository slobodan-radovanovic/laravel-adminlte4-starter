@props([
    'title',
    'value',
    'icon' => 'bi bi-info-circle',
    'color' => 'primary',
])

<div class="info-box">
    <span class="info-box-icon text-bg-{{ $color }} shadow-sm">
        <i class="{{ $icon }}"></i>
    </span>

    <div class="info-box-content">
        <span class="info-box-text">{{ $title }}</span>
        <span class="info-box-number">{{ $value }}</span>
    </div>
</div>
