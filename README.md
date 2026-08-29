# Laravel AdminLTE 4 Starter

A modern Laravel admin starter kit built with Laravel 13, AdminLTE 4, Bootstrap 5, Breeze Blade, Vite and Spatie Laravel Permission.

This starter is designed for developers who want a clean AdminLTE 4 admin panel without using a Laravel AdminLTE wrapper package.

It provides authentication, a Bootstrap/AdminLTE layout, role and permission management, example CRUD modules, reusable components, a plugin system and feature tests.

---

## Features

- Laravel 13 application structure
- PHP 8.4 ready
- AdminLTE 4 manually integrated through npm and Vite
- Bootstrap 5 based admin UI
- Laravel Breeze Blade authentication
- Admin-styled auth pages
- Dashboard page
- Config-driven admin layout
- Sidebar menu with submenu support
- Light/dark theme switcher
- Spatie Laravel Permission integration
- First Super Admin creation command
- Users CRUD
- Roles CRUD
- Categories CRUD example
- Reusable admin form components
- Reusable feedback components
- Centered flash popup for success/error/info messages
- Admin plugin system
- Plugin examples page
- Feature tests for core starter behavior

---

## Tech Stack

- Laravel 13
- PHP 8.4
- MySQL
- Blade
- Bootstrap 5
- AdminLTE 4
- Vite
- Laravel Breeze
- Spatie Laravel Permission

Frontend plugins included:

- DataTables
- Select2
- Chart.js
- Flatpickr
- SweetAlert2
- Inputmask
- SortableJS
- Dropzone

---

## What This Starter Is Not

This project intentionally avoids:

- Filament
- Tailwind CSS for the admin UI
- `jeroennoten/laravel-adminlte`
- AdminLTE Laravel wrapper packages
- Full CMS complexity
- SaaS boilerplate complexity
- API-first architecture

AdminLTE is integrated manually so the project structure stays transparent and easy to customize.

---

## Requirements

- PHP 8.4 or newer
- Composer
- Node.js and npm
- MySQL or MariaDB

---

## Installation

Clone the repository:

```bash
git clone https://github.com/slobodan-radovanovic/laravel-adminlte4-starter.git
cd laravel-adminlte4-starter

Install PHP dependencies:

composer install

Install frontend dependencies:

npm install

Create the environment file:

cp .env.example .env

Generate the application key:

php artisan key:generate

Configure your database in .env, then run migrations and seeders:

php artisan migrate --seed

Build frontend assets:

npm run build

For local development:

npm run dev
Creating the First Super Admin User

This starter does not include default admin credentials.

After running migrations and seeders, create the first Super Admin user manually:

php artisan admin:create-user

The command will ask for:

name
email
password

The created user will be assigned the Super Admin role.

Authentication

Laravel Breeze Blade is used as the authentication foundation.

Included authentication features:

login
registration
forgot password
reset password
email verification
password confirmation
profile update
password update
account deletion

The Breeze views are adapted to match the AdminLTE/Bootstrap UI.

Roles and Permissions

This starter uses Spatie Laravel Permission.

Default roles:

Super Admin
Admin

Example permissions include:

view users
create users
edit users
delete users
view roles
create roles
edit roles
delete roles
view categories
create categories
edit categories
delete categories

The Super Admin role receives all permissions.

Safety rules included:

the Super Admin role cannot be deleted
the last Super Admin user cannot be deleted
the last Super Admin role cannot be removed from the last Super Admin user
a user cannot delete their own account
Admin Modules
Users

The Users module provides a full CRUD interface.

Super Admin users can:

list users
create users
edit users
update passwords
mark email as verified/unverified
assign roles
delete users
Roles

The Roles module provides role management with permission assignment.

It also demonstrates the reusable admin form components.

Categories

The Categories module is a simple CRUD example.

It intentionally stays closer to plain Blade so developers can compare a manual CRUD approach with the reusable component approach used in the Roles module.

AdminLTE Configuration

The main AdminLTE configuration file is:

config/adminlte.php

It contains configuration for:

application name
layout options
navbar
sidebar
footer
menu
plugins
feedback behavior
Sidebar Menu

The sidebar menu is configured in:

config/adminlte.php

Supported menu features:

headers
icons
routes
external URLs
badges
submenu items
active route patterns
permission checks with can
permission checks with can_any

Example:

[
    'text' => 'Access Control',
    'icon' => 'bi bi-shield-lock',
    'can_any' => ['view users', 'view roles'],
    'active' => ['users.*', 'roles.*'],
    'submenu' => [
        [
            'text' => 'Users',
            'route' => 'users.index',
            'icon' => 'bi bi-people',
            'can' => 'view users',
            'active' => ['users.*'],
        ],
        [
            'text' => 'Roles',
            'route' => 'roles.index',
            'icon' => 'bi bi-shield-lock',
            'can' => 'view roles',
            'active' => ['roles.*'],
        ],
    ],
],
Admin Form Components

Reusable admin form components are located in:

resources/views/components/admin/form

Included components:

input
textarea
checkbox
select
actions

Example:

<x-admin.form.input
    name="name"
    label="Name"
    required
    autofocus
/>

<x-admin.form.actions
    submit="Save"
    :cancel-url="route('roles.index')"
/>
Feedback Popup

Flash messages are displayed as a centered popup.

Supported message types:

success
error
warning
info

Example controller usage:

return redirect()
    ->route('roles.index')
    ->with('success', 'Role created successfully.');

Feedback configuration is available in:

config/adminlte.php

Example:

'feedback' => [
    'type' => 'popup',
    'auto_close' => true,
    'delay' => 3000,
],
Plugin System

Plugins can be enabled globally from:

config/adminlte.php

Example:

'plugins' => [
    'datatables' => [
        'enabled' => false,
    ],
    'select2' => [
        'enabled' => false,
    ],
],

Plugins can also be activated per page using a Blade stack:

@push('plugins')
datatables
@endpush

Then check if the plugin is active:

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.adminPluginEnabled('datatables')) {
            new DataTable('#users-table');
        }
    });
</script>
@endpush

A plugin examples page is included at:

/examples/plugins
Testing

Run tests:

php artisan test

Run frontend build:

npm run build

This starter includes feature tests for:

dashboard access
protected admin routes
permissions
users management
roles management
categories access
first admin user command

The test database is configured in phpunit.xml.

Useful Commands

Clear cache:

php artisan optimize:clear

Fresh database with seeders:

php artisan migrate:fresh --seed

Create first admin user:

php artisan admin:create-user

Run tests:

php artisan test

Build assets:

npm run build
Project Structure

Important files and folders:

app/Console/Commands/CreateAdminUserCommand.php
app/Http/Controllers/Admin
app/Http/Requests/Admin
config/adminlte.php
resources/css/admin.css
resources/js/admin.js
resources/views/layouts/admin.blade.php
resources/views/layouts/partials
resources/views/components/admin
resources/views/admin
tests/Feature
Using as a Starter Template

This project is intended to be used as a starting point for Laravel admin applications.

Recommended workflow:

Create a new repository from this starter.
Configure .env.
Run migrations and seeders.
Create the first Super Admin user.
Replace or extend the example modules.
Adjust config/adminlte.php for your application.
Add your own business modules.
Roadmap

Possible future improvements:

optional feedback type selection: popup, toast or inline alert
dynamic plugin imports
more AdminLTE components
optional screenshots
additional tests
reusable CRUD generator patterns
License

This project is open-sourced software licensed under the MIT license.
