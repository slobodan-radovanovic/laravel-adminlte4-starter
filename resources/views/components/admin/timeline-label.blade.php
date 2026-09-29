@props([
    'text',
    'theme' => 'danger',
])

{{-- A date or group label on the timeline. Use icon-only items at the end: <x-admin.timeline-item icon="bi bi-clock-fill" />. --}}
<div {{ $attributes->merge(['class' => 'time-label']) }}>
    <span class="text-bg-{{ $theme }}">{{ $text }}</span>
</div>
