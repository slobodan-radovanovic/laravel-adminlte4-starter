@props([
    'inverse' => false,
])

{{-- AdminLTE timeline. Put <x-admin.timeline-label> and <x-admin.timeline-item> in the slot. --}}
<div {{ $attributes->merge(['class' => 'timeline'.($inverse ? ' timeline-inverse' : '')]) }}>
    {{ $slot }}
</div>
