@extends('layouts.admin')

@section('title', 'Layout and Tool Components')

@section('content_header')
    {{-- The page header itself is <x-admin.content-header>. --}}
    <x-admin.content-header title="Layout and Tools" :breadcrumbs="['Components', 'Layout and Tools']" />
@endsection

@php
    $people = [
        ['Jane Doe', 'jane@example.com', 'Admin', '2026-01-12', true],
        ['Adam Price', 'adam@example.com', 'Editor', '2026-02-03', true],
        ['Sarah Miller', 'sarah@example.com', 'Viewer', '2026-02-18', false],
        ['Nadia Carmichael', 'nadia@example.com', 'Admin', '2026-03-01', true],
        ['Marko Petrović', 'marko@example.com', 'Editor', '2026-03-22', true],
        ['Ana Jovanović', 'ana@example.com', 'Viewer', '2026-04-09', false],
        ['Luka Nikolić', 'luka@example.com', 'Editor', '2026-05-15', true],
        ['Mia Stojanović', 'mia@example.com', 'Viewer', '2026-06-30', true],
        ['Peter Novak', 'peter@example.com', 'Admin', '2026-07-04', false],
        ['Eva Horvat', 'eva@example.com', 'Viewer', '2026-08-19', true],
        ['Ivan Kovač', 'ivan@example.com', 'Editor', '2026-09-02', true],
    ];
@endphp

@section('content')
    <h5 class="mb-3">Navbar components</h5>
    <x-admin.card title="Navbar" icon="bi bi-window-dock" body-class="p-0">
        <nav class="navbar navbar-expand bg-body-tertiary rounded-bottom px-2">
            <ul class="navbar-nav">
                <x-admin.navbar.custom-menu url="#" text="Custom link" icon="bi bi-house" />
                <x-admin.navbar.custom-menu url="https://adminlte.io/docs/4.0/" icon="bi bi-book" label="AdminLTE docs" target="_blank" />
            </ul>

            <ul class="navbar-nav ms-auto">
                <x-admin.navbar.custom-menu url="#" icon="bi bi-chat-text" label="Messages" badge="4" badge-theme="danger" />

                <x-admin.navbar.notification
                    :count="3"
                    :url="route('examples.components.layout')"
                    :update-url="route('examples.components.notifications')"
                    :update-period="15"
                >
                    <x-admin.navbar.dropdown-item icon="bi bi-envelope" text="4 new messages" time="3 mins" divider />
                    <x-admin.navbar.dropdown-item icon="bi bi-people-fill" text="8 friend requests" time="12 hours" divider />
                    <x-admin.navbar.dropdown-item icon="bi bi-file-earmark-fill" text="3 new reports" time="2 days" />
                </x-admin.navbar.notification>

                <x-admin.navbar.dropdown icon="bi bi-grid-3x3-gap" header="Quick links">
                    <x-admin.navbar.dropdown-item :url="route('users.index')" icon="bi bi-people" text="Users" />
                    <x-admin.navbar.dropdown-item :url="route('roles.index')" icon="bi bi-shield-lock" text="Roles" />
                    <x-admin.navbar.dropdown-item :url="route('categories.index')" icon="bi bi-tags" text="Categories" />
                </x-admin.navbar.dropdown>

                <x-admin.navbar.color-mode />
            </ul>
        </nav>

        <x-slot:footer>
            The bell counter refreshes every 15 seconds from a JSON endpoint (<code>update-url</code>).
            The color mode menu is the same component used in the top navbar.
        </x-slot:footer>
    </x-admin.card>

    <h5 class="mb-3">Datatable</h5>
    <x-admin.card title="Team" icon="bi bi-table">
        <x-admin.datatable
            id="people-table"
            :heads="['Name', 'Email', 'Role', 'Joined', 'Status', ['label' => 'Actions', 'class' => 'text-end', 'sortable' => false]]"
            :config="['pageLength' => 5, 'lengthMenu' => [5, 10, 25], 'order' => [[3, 'desc']]]"
        >
            @foreach ($people as [$name, $email, $role, $joined, $active])
                <tr>
                    <td>{{ $name }}</td>
                    <td>{{ $email }}</td>
                    <td>{{ $role }}</td>
                    <td>{{ $joined }}</td>
                    <td><x-admin.status-badge :value="$active" /></td>
                    <td class="text-end">
                        <x-admin.form.button icon="bi bi-eye" size="sm" outline aria-label="View {{ $name }}"
                                             data-bs-toggle="modal" data-bs-target="#modal-default" />
                    </td>
                </tr>
            @endforeach
        </x-admin.datatable>
    </x-admin.card>

    <h5 class="mb-3">Modals</h5>
    <x-admin.card>
        <div class="d-flex flex-wrap gap-2">
            <x-admin.form.button label="Default" data-bs-toggle="modal" data-bs-target="#modal-default" />
            <x-admin.form.button label="Large, centered" theme="info" data-bs-toggle="modal" data-bs-target="#modal-large" />
            <x-admin.form.button label="Static backdrop" theme="warning" data-bs-toggle="modal" data-bs-target="#modal-static" />
            <x-admin.form.button label="With a form" theme="success" data-bs-toggle="modal" data-bs-target="#modal-form" />
        </div>
    </x-admin.card>

    <x-admin.modal id="modal-default" title="Default modal" icon="bi bi-window">
        A modal with the default Close button in the footer.
    </x-admin.modal>

    <x-admin.modal id="modal-large" title="Large modal" size="lg" theme="info" centered>
        <p>Sizes: <code>sm</code>, <code>lg</code>, <code>xl</code> and <code>fullscreen</code>.</p>
        <x-admin.progress-group label="Profile completed" :value="7" :max="10" theme="info" />
    </x-admin.modal>

    <x-admin.modal id="modal-static" title="Static backdrop" theme="warning" static-backdrop>
        Clicking outside does not close this modal.
        <x-slot:footer>
            <x-admin.form.button label="I understand" theme="warning" data-bs-dismiss="modal" />
        </x-slot:footer>
    </x-admin.modal>

    <x-admin.modal id="modal-form" title="Invite a user" theme="success" icon="bi bi-person-plus">
        <x-admin.form.input name="invite_email" type="email" label="Email" placeholder="name@example.com" />
        <x-admin.form.select2 name="invite_role" label="Role (Select2 inside a modal)" placeholder="Choose a role"
                              :options="['admin' => 'Admin', 'editor' => 'Editor', 'viewer' => 'Viewer']" />
        <x-slot:footer>
            <x-admin.form.button label="Cancel" theme="secondary" outline data-bs-dismiss="modal" />
            <x-admin.form.button label="Send invite" theme="success" icon="bi bi-send" data-bs-dismiss="modal" data-admin-toast="#toast-invite" />
        </x-slot:footer>
    </x-admin.modal>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <x-admin.toast id="toast-invite" title="Invite sent" icon="bi bi-check-circle" theme="success">
            This is only a demo; no email was sent.
        </x-admin.toast>
    </div>
@endsection
