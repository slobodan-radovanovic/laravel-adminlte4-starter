# Laravel AdminLTE 4 Starter

A modern Laravel starter project for building administration panels with Laravel, Blade, Bootstrap 5, AdminLTE 4, Vite and Laravel Breeze.

This project is intended to be used as a clean, reusable base for future Laravel admin applications.

## Features

* Laravel 13
* PHP 8.4
* MySQL
* Blade templates
* Bootstrap 5
* AdminLTE 4
* Vite
* Laravel Breeze authentication
* Login, registration and password reset
* Email verification support
* Admin dashboard
* AdminLTE navbar, sidebar and footer
* Config-driven sidebar menu
* Light/Dark theme switcher
* DataTables example
* Select2 example
* Chart.js example
* Reusable Blade admin widgets
* Spatie Laravel Permission
* Role and permission seeders
* Permission-aware menu items

## What this starter does not include

This starter intentionally does not include a full business domain, generated CRUD modules, multi-auth, Livewire, Filament or a heavy plugin architecture.

The goal is to provide a clean and maintainable foundation, not a bloated application template.

## Tech Stack

* Laravel 13
* PHP 8.4
* MySQL
* Blade
* Bootstrap 5
* AdminLTE 4
* Vite
* Laravel Breeze
* Spatie Laravel Permission
* DataTables
* Select2
* Chart.js

## Installation

Clone the repository:

```bash
git clone <repository-url> my-admin-project
cd my-admin-project
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Copy the environment file:

```bash
cp .env.examples .env
```

Generate the application key:

```bash
php artisan key:generate
```

Create a MySQL database and update your `.env` file:

```env
DB_DATABASE=laravel_adminlte4_starter
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations and seeders:

```bash
php artisan migrate --seed
```

Start Vite:

```bash
npm run dev
```

Open the project in your browser and register a user.

## Default Roles and Permissions

The starter includes basic permissions:

* `view dashboard`
* `view users`

And basic roles:

* `Super Admin`
* `Admin`

The first user in the database is automatically assigned the `Super Admin` role when the database seeder runs.

## Admin Menu Configuration

The sidebar menu is configured in:

```text
config/adminlte.php
```

Example:

```php
'menu' => [
    [
        'text' => 'Dashboard',
        'route' => 'dashboard',
        'icon' => 'bi bi-speedometer2',
        'can' => 'view dashboard',
    ],

    [
        'header' => 'Management',
    ],

    [
        'text' => 'Users',
        'route' => 'users.index',
        'icon' => 'bi bi-people',
        'can' => 'view users',
    ],
],
```

Menu items can be protected with Laravel permissions using the `can` key.

## Theme System

The admin panel supports light and dark mode using Bootstrap 5 and AdminLTE 4 theme support.

The selected theme is stored in the browser using `localStorage`.

## Admin Layout

Main admin layout:

```text
resources/views/layouts/admin.blade.php
```

Layout partials:

```text
resources/views/layouts/partials/navbar.blade.php
resources/views/layouts/partials/sidebar.blade.php
resources/views/layouts/partials/footer.blade.php
```

Guest/auth layout:

```text
resources/views/layouts/guest.blade.php
```

## Widgets

Reusable admin widgets are located in:

```text
resources/views/components/admin
```

Available widgets:

```text
small-box
info-box
card
```

Example:

```blade
<x-admin.small-box
    title="Users"
    value="150"
    icon="bi bi-people"
    color="primary"
/>
```

## Frontend Plugins

The starter includes examples for:

* DataTables
* Select2
* Chart.js

The example implementation is available on the Users page.

## Useful Commands

Clear Laravel cache:

```bash
composer clear
```

Fresh database with seeders:

```bash
composer fresh
```

Run tests:

```bash
composer test
```

Build frontend assets:

```bash
npm run build
```

Run Vite development server:

```bash
npm run dev
```

## Creating a New Project from This Starter

Recommended approach:

1. Use this repository as a GitHub Template Repository.
2. Create a new repository from the template.
3. Clone the new project.
4. Configure `.env`.
5. Run migrations and seeders.
6. Start building your application-specific modules.

Alternative local approach:

```bash
git clone <starter-repository-url> my-new-project
cd my-new-project
rm -rf .git
git init
```

## Roadmap

Planned future improvements:

* CRUD example module
* Advanced menu items with submenus
* Permission-aware menu headers
* Toast notifications
* Modal examples
* Form component examples
* Optional plugin lazy loading
* More dashboard widgets
* Example tests for admin routes

## License

This project is open-source and may be used as a base for Laravel admin applications.
