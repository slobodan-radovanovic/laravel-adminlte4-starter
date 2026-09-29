@props([
    'name',
    'image',
    'time' => null,
    'end' => false,
])

{{-- One chat message. "end" puts it on the right (messages from the current user). --}}
<div {{ $attributes->merge(['class' => 'direct-chat-msg'.($end ? ' end' : '')]) }}>
    <div class="direct-chat-infos clearfix">
        <span class="direct-chat-name {{ $end ? 'float-end' : 'float-start' }}">{{ $name }}</span>

        @if ($time)
            <span class="direct-chat-timestamp {{ $end ? 'float-start' : 'float-end' }}">{{ $time }}</span>
        @endif
    </div>

    <img class="direct-chat-img" src="{{ $image }}" alt="{{ $name }}">

    <div class="direct-chat-text">{{ $slot }}</div>
</div>
