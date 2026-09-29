@props([
    'title' => 'Direct Chat',
    'theme' => 'primary',
    'badge' => null,
    'contacts' => null,
    'footer' => null,
])

{{--
    AdminLTE direct chat card. Slot: <x-admin.direct-chat-msg> messages.
    "contacts" slot: <x-admin.direct-chat-contact> items, toggled with the header button.
    "footer" slot: usually a message form.
--}}
<div {{ $attributes->merge(['class' => 'card direct-chat direct-chat-'.$theme]) }}>
    <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>

        <div class="card-tools">
            @if ($badge)
                <span class="badge text-bg-{{ $theme }}">{{ $badge }}</span>
            @endif

            @if ($contacts)
                <button type="button" class="btn btn-tool" data-lte-toggle="chat-pane" title="Contacts" aria-label="Contacts">
                    <i class="bi bi-chat-text-fill"></i>
                </button>
            @endif
        </div>
    </div>

    <div class="card-body">
        <div class="direct-chat-messages">
            {{ $slot }}
        </div>

        @if ($contacts)
            <div class="direct-chat-contacts">
                <ul class="contacts-list">
                    {{ $contacts }}
                </ul>
            </div>
        @endif
    </div>

    @if ($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div>
