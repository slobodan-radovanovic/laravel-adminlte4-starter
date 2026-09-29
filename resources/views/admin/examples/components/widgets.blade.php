@extends('layouts.admin')

@section('title', 'Widget Components')

@section('content_header')
    <x-admin.content-header title="Widget Components" :breadcrumbs="['Components', 'Widgets']" />
@endsection

@php
    $avatar = fn (int $number) => asset("images/avatars/avatar-{$number}.svg");
@endphp

@section('content')
    <h5 class="mb-3">Boxes</h5>
    <div class="row">
        <div class="col-lg-3 col-6">
            <x-admin.small-box title="New orders" value="150" icon="bi bi-bag" color="info" url="#" />
        </div>
        <div class="col-lg-3 col-6">
            <x-admin.small-box title="Bounce rate" value="53%" icon="bi bi-graph-up" color="success" />
        </div>
        <div class="col-lg-3 col-6">
            <x-admin.info-box title="Bookmarks" value="41,410" icon="bi bi-bookmark-fill" color="warning" />
        </div>
        <div class="col-lg-3 col-6">
            <x-admin.info-box title="Likes" value="41,410" icon="bi bi-hand-thumbs-up-fill" color="danger" filled
                              :progress="70" description="70% increase in 30 days" />
        </div>
    </div>

    <h5 class="mb-3">Cards</h5>
    <div class="row">
        <div class="col-md-4">
            <x-admin.card title="Collapsible" icon="bi bi-arrows-collapse" theme="primary" outline collapsible>
                Click the minus button to collapse this card.
            </x-admin.card>
        </div>
        <div class="col-md-4">
            <x-admin.card title="Removable and maximizable" theme="success" removable maximizable>
                Maximize or remove this card with the header buttons.
            </x-admin.card>
        </div>
        <div class="col-md-4">
            <x-admin.card title="With ribbon and footer" class="position-relative">
                <x-admin.ribbon text="New" theme="danger" />
                The ribbon is a separate component.
                <x-slot:footer>Card footer</x-slot:footer>
            </x-admin.card>
        </div>
    </div>

    <h5 class="mb-3">Alerts and callouts</h5>
    <div class="row">
        <div class="col-md-6">
            <x-admin.alert theme="success" title="Saved">The record was saved.</x-admin.alert>
            <x-admin.alert theme="warning" dismissable>This alert can be closed.</x-admin.alert>
            <x-admin.alert theme="danger" title="Error">Something went wrong.</x-admin.alert>
        </div>
        <div class="col-md-6">
            <x-admin.callout theme="info" title="Note" icon="bi bi-info-circle">Callouts highlight a piece of information.</x-admin.callout>
            <x-admin.callout theme="warning" title="Careful">Double-check before you continue.</x-admin.callout>
            <x-admin.callout theme="success">A callout without a title.</x-admin.callout>
        </div>
    </div>

    <h5 class="mb-3">Progress</h5>
    <div class="row">
        <div class="col-md-6">
            <x-admin.card title="Progress bars">
                <x-admin.progress :value="25" class="mb-3" />
                <x-admin.progress :value="50" theme="success" show-value class="mb-3" />
                <x-admin.progress :value="75" theme="warning" striped animated class="mb-3" />
                <x-admin.progress :value="90" theme="danger" size="xs" />
            </x-admin.card>
        </div>
        <div class="col-md-6">
            <x-admin.card title="Progress groups">
                <x-admin.progress-group label="Add products to cart" :value="160" :max="200" />
                <x-admin.progress-group label="Complete purchase" :value="310" :max="400" theme="danger" />
                <x-admin.progress-group label="Visit premium page" :value="480" :max="800" theme="success" />
            </x-admin.card>
        </div>
    </div>

    <h5 class="mb-3">Profiles</h5>
    <div class="row">
        <div class="col-md-4">
            <x-admin.profile-widget name="Jane Doe" description="Founder and CEO" :image="$avatar(1)" theme="info">
                <x-admin.profile-col-item title="3,200" text="Sales" />
                <x-admin.profile-col-item title="13,000" text="Followers" />
                <x-admin.profile-col-item title="35" text="Products" :border="false" />
            </x-admin.profile-widget>
        </div>
        <div class="col-md-4">
            <x-admin.profile-widget name="Nadia Carmichael" description="Lead Developer" :image="$avatar(4)" theme="warning" layout="list">
                <x-admin.profile-row-item title="Projects" :badge="31" />
                <x-admin.profile-row-item title="Tasks" :badge="5" badge-theme="info" />
                <x-admin.profile-row-item title="Completed" :badge="12" badge-theme="success" />
                <x-admin.profile-row-item title="Followers" :badge="842" badge-theme="danger" />
            </x-admin.profile-widget>
        </div>
        <div class="col-md-4">
            <x-admin.card title="Profile items">
                <div class="row">
                    <div class="col-6"><x-admin.profile-item title="$35,210" text="Total revenue" icon="bi bi-caret-up-fill text-success" /></div>
                    <div class="col-6"><x-admin.profile-item title="1,200" text="Goal completions" /></div>
                </div>
            </x-admin.card>
        </div>
    </div>

    <h5 class="mb-3">Posts, timeline and chat</h5>
    <div class="row">
        <div class="col-lg-4">
            <x-admin.card title="Posts">
                <x-admin.post :image="$avatar(1)" name="Jane Doe" url="#" description="Shared publicly - 7:30 PM today">
                    AdminLTE 4 components rendered from a single Blade tag.
                    <x-slot:footer><i class="bi bi-hand-thumbs-up me-1"></i>Like (5) · Comments (2)</x-slot:footer>
                </x-admin.post>

                <x-admin.post :image="$avatar(2)" name="Adam Price" description="Posted 5 photos - 5 days ago">
                    Another post using the same component.
                </x-admin.post>

                <x-admin.user-block :image="$avatar(3)" name="Sarah Miller" description="User block on its own" size="sm" />
            </x-admin.card>
        </div>

        <div class="col-lg-4">
            <x-admin.timeline>
                <x-admin.timeline-label text="10 Feb 2026" />
                <x-admin.timeline-item icon="bi bi-envelope" title="Support team sent you an email" url="#" time="12:05">
                    Your weekly report is ready to download.
                    <x-slot:footer><x-admin.form.button label="Read more" size="sm" /></x-slot:footer>
                </x-admin.timeline-item>
                <x-admin.timeline-item icon="bi bi-person-fill" theme="success" title="Sarah accepted your friend request" time="5 mins ago" />
                <x-admin.timeline-label text="3 Jan 2026" theme="success" />
                <x-admin.timeline-item icon="bi bi-camera-fill" theme="info" title="Adam uploaded new photos" time="2 days ago">
                    Photos from the team trip.
                </x-admin.timeline-item>
                <x-admin.timeline-item icon="bi bi-clock-fill" theme="secondary" />
            </x-admin.timeline>
        </div>

        <div class="col-lg-4">
            <x-admin.direct-chat title="Direct chat" badge="3" theme="primary">
                <x-admin.direct-chat-msg name="Adam Price" :image="$avatar(2)" time="23 Jan 2:00 pm">
                    Is this template really free? That is unbelievable!
                </x-admin.direct-chat-msg>
                <x-admin.direct-chat-msg name="Jane Doe" :image="$avatar(1)" time="23 Jan 2:05 pm" end>
                    You better believe it!
                </x-admin.direct-chat-msg>

                <x-slot:contacts>
                    <x-admin.direct-chat-contact name="Sarah Miller" :image="$avatar(3)" message="How have you been?" date="2/28/2026" />
                    <x-admin.direct-chat-contact name="Nadia Carmichael" :image="$avatar(4)" message="See you tomorrow." date="2/23/2026" />
                </x-slot:contacts>

                <x-slot:footer>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Type a message..." aria-label="Message">
                        <button type="button" class="btn btn-primary">Send</button>
                    </div>
                </x-slot:footer>
            </x-admin.direct-chat>
        </div>
    </div>

    <h5 class="mb-3">Toasts</h5>
    <x-admin.card>
        <div class="d-flex flex-wrap gap-2">
            <x-admin.form.button label="Show info toast" data-admin-toast="#toast-info" />
            <x-admin.form.button label="Show success toast" theme="success" data-admin-toast="#toast-success" />
        </div>
    </x-admin.card>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <x-admin.toast id="toast-info" title="Heads up" icon="bi bi-info-circle" time="just now">
            Toasts are small notifications that hide themselves.
        </x-admin.toast>
        <x-admin.toast id="toast-success" title="Saved" icon="bi bi-check-circle" theme="success">
            The record was saved.
        </x-admin.toast>
    </div>
@endsection
