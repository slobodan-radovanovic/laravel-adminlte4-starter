@props([
    'text',
    'theme' => 'primary',
    'size' => null,
])

{{--
    Corner ribbon. Place it inside an element with "position-relative" (for example a card).
    size: lg or xl for longer text.
--}}
<div class="ribbon-wrapper {{ $size ? 'ribbon-'.$size : '' }}">
    <div {{ $attributes->merge(['class' => 'ribbon text-bg-'.$theme]) }}>{{ $text }}</div>
</div>
