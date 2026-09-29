@props([
    'name',
    'image',
    'message' => null,
    'date' => null,
    'url' => '#',
])

{{-- One contact in the contacts pane of <x-admin.direct-chat>. --}}
<li {{ $attributes }}>
    <a href="{{ $url }}">
        <img class="contacts-list-img" src="{{ $image }}" alt="{{ $name }}">

        <div class="contacts-list-info">
            <span class="contacts-list-name">
                {{ $name }}

                @if ($date)
                    <small class="contacts-list-date float-end">{{ $date }}</small>
                @endif
            </span>

            @if ($message)
                <span class="contacts-list-msg">{{ $message }}</span>
            @endif
        </div>
    </a>
</li>
