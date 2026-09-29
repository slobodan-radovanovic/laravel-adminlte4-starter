@props([
    'value' => 0,
    'theme' => 'primary',
    'size' => null,
    'striped' => false,
    'animated' => false,
    'showValue' => false,
    'label' => null,
])

{{-- Progress bar. size: sm, xs or xxs (AdminLTE heights). --}}
@php
    $value = max(0, min(100, (float) $value));
    $heights = ['sm' => '10px', 'xs' => '7px', 'xxs' => '3px'];
@endphp

<div class="progress {{ $attributes->get('class') }}" role="progressbar"
     aria-label="{{ $label ?? 'Progress' }}" aria-valuenow="{{ $value }}" aria-valuemin="0" aria-valuemax="100"
     @if (isset($heights[$size])) style="height: {{ $heights[$size] }}" @endif>
    <div class="progress-bar text-bg-{{ $theme }} {{ $striped || $animated ? 'progress-bar-striped' : '' }} {{ $animated ? 'progress-bar-animated' : '' }}"
         style="width: {{ $value }}%">
        @if ($showValue)
            {{ $value }}%
        @endif
    </div>
</div>
