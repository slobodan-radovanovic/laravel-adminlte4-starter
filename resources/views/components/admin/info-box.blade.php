@props([
    'title',
    'value',
    'icon' => 'bi bi-info-circle',
    'color' => 'primary',
    'progress' => null,
    'description' => null,
    'filled' => false,
])

{{-- AdminLTE info box. "progress" (0-100) and "description" add a progress bar; "filled" colors the whole box. --}}
<div {{ $attributes->merge(['class' => 'info-box'.($filled ? ' text-bg-'.$color : '')]) }}>
    <span class="info-box-icon {{ $filled ? '' : 'text-bg-'.$color }} shadow-sm">
        <i class="{{ $icon }}"></i>
    </span>

    <div class="info-box-content">
        <span class="info-box-text">{{ $title }}</span>
        <span class="info-box-number">{{ $value }}</span>

        @if ($progress !== null)
            <div class="progress" role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar {{ $filled ? 'bg-white' : 'bg-'.$color }}" style="width: {{ $progress }}%"></div>
            </div>
        @endif

        @if ($description)
            <span class="progress-description">{{ $description }}</span>
        @endif
    </div>
</div>
