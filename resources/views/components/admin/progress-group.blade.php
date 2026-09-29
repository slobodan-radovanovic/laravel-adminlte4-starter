@props([
    'label',
    'value',
    'max' => 100,
    'theme' => 'primary',
])

{{-- Labeled progress bar with "value/max" on the right, as used in AdminLTE dashboards. --}}
@php
    $percent = $max > 0 ? round($value / $max * 100) : 0;
@endphp

<div {{ $attributes->merge(['class' => 'progress-group']) }}>
    {{ $label }}
    <span class="float-end"><b>{{ $value }}</b>/{{ $max }}</span>

    <x-admin.progress :value="$percent" :theme="$theme" size="sm" :label="$label" />
</div>
