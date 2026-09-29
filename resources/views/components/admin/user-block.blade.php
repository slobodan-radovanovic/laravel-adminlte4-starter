@props([
    'image',
    'name',
    'url' => null,
    'description' => null,
    'size' => null,
])

{{-- Avatar with name and description, used in posts and comments. size: sm. --}}
<div {{ $attributes->merge(['class' => 'user-block'.($size ? ' user-block-'.$size : '')]) }}>
    <img class="rounded-circle" src="{{ $image }}" alt="{{ $name }}">
    <span class="username">
        @if ($url)
            <a href="{{ $url }}">{{ $name }}</a>
        @else
            {{ $name }}
        @endif
    </span>

    @if ($description)
        <span class="description">{{ $description }}</span>
    @endif
</div>
