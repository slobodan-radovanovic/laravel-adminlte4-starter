# Laravel AdminLTE 4 Starter

A modern Laravel admin starter kit built with Laravel 13, AdminLTE 4, Bootstrap 5, Breeze Blade, Vite and Spatie Laravel Permission.

This starter is designed for developers who want a clean AdminLTE 4 admin panel without using a Laravel AdminLTE wrapper package.

It provides authentication, a Bootstrap/AdminLTE layout, role and permission management, example CRUD modules, reusable components, a plugin system and feature tests.

---

## Features

- Laravel 13 application structure
- PHP 8.3+ (tested on PHP 8.3 and 8.4)
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
- Centered flash popup for success, error, warning and info messages
- Admin plugin system
- Plugin examples page
- Feature tests for core starter behavior

---

## Tech Stack

- Laravel 13
- PHP 8.3 or newer
- MySQL or MariaDB
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

- PHP 8.3 or newer
- Composer
- Node.js 22 or newer and npm
- MySQL or MariaDB

---

## Installation

Clone the repository:

```bash
git clone https://github.com/slobodan-radovanovic/laravel-adminlte4-starter.git
cd laravel-adminlte4-starter
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure your database in `.env`, then run migrations and seeders:

```bash
php artisan migrate --seed
```

Build frontend assets:

```bash
npm run build
```

For local development:

```bash
npm run dev
```

---

## Creating the First Super Admin User

This starter does not include default admin credentials.

After running migrations and seeders, create the first Super Admin user manually:

```bash
php artisan admin:create-user
```

The command will ask for:

- name
- email
- password

The created user will be assigned the Super Admin role.

---

## Authentication

Laravel Breeze Blade is used as the authentication foundation.

Included authentication features:

- login
- registration
- forgot password
- reset password
- email verification
- password confirmation
- profile update
- password update
- account deletion

The Breeze views are adapted to match the AdminLTE/Bootstrap UI.

Admin pages require a verified email address, because the `User` model implements `MustVerifyEmail`. Users created with `php artisan admin:create-user` are verified automatically.

Public registration can be turned off in `.env`:

```env
ADMINLTE_REGISTRATION_ENABLED=false
```

When it is disabled, the register routes return 404 and the register links are hidden.

---

## Roles and Permissions

This starter uses Spatie Laravel Permission.

Default roles:

- Super Admin
- Admin

Example permissions include:

- view users
- create users
- edit users
- delete users
- view roles
- create roles
- edit roles
- delete roles
- view categories
- create categories
- edit categories
- delete categories

The Super Admin role receives all permissions.

Add your project's own permissions and roles in `database/seeders/ProjectPermissionSeeder.php`. It runs after the starter's `RolePermissionSeeder`, and starter releases avoid changing it:

```php
protected array $permissions = [
    'view invoices',
    'create invoices',
];

protected array $roles = [
    'Admin' => ['view invoices', 'create invoices'],
    'Accountant' => ['view invoices'],
];
```

Safety rules included:

- the Super Admin role cannot be deleted
- the last Super Admin user cannot be deleted
- the last Super Admin role cannot be removed from the last Super Admin user
- a user cannot delete their own account
- Super Admin users pass every permission check through `Gate::before`, including permissions added later
- only Super Admin users can assign the Super Admin role or edit and delete Super Admin users
- the Super Admin role cannot be renamed or edited

---

## Admin Modules

### Users

The Users module provides a full CRUD interface.

Super Admin users can:

- list users
- create users
- edit users
- update passwords
- mark email as verified or unverified
- assign roles
- delete users

### Roles

The Roles module provides role management with permission assignment.

It also demonstrates the reusable admin form components.

### Categories

The Categories module is a simple CRUD example.

It intentionally stays closer to plain Blade so developers can compare a manual CRUD approach with the reusable component approach used in the Roles module.

---

## AdminLTE Configuration

The main AdminLTE configuration file is:

```text
config/adminlte.php
```

It contains configuration for:

- application name
- layout options
- navbar
- sidebar
- footer
- plugins
- authentication
- feedback behavior

---

## Sidebar Menu

The sidebar menu is configured in the `items` key of:

```text
config/admin-menu.php
```

This file belongs to your project, so starter updates do not overwrite your menu.

Supported menu features:

- headers
- icons
- routes
- external URLs
- badges
- submenu items
- active route patterns
- permission checks with `can`
- permission checks with `can_any`

Example:

```php
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
```

---

## Admin Form Components

Reusable admin form components are located in:

```text
resources/views/components/admin/form
```

Included components:

- input
- textarea
- checkbox
- select
- actions

Example:

```blade
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
```

---

## Feedback Popup

Flash messages are displayed as a centered popup.

Supported message types:

- success
- error
- warning
- info

Example controller usage:

```php
return redirect()
    ->route('roles.index')
    ->with('success', 'Role created successfully.');
```

Feedback configuration is available in:

```text
config/adminlte.php
```

Example:

```php
'feedback' => [
    'type' => 'popup',
    'auto_close' => true,
    'delay' => 3000,
],
```

---

## Plugin System

Plugins can be enabled globally from:

```text
config/adminlte.php
```

Example:

```php
'plugins' => [
    'datatables' => [
        'enabled' => false,
    ],
    'select2' => [
        'enabled' => false,
    ],
],
```

Plugins can also be activated per page using a Blade stack:

```blade
@push('plugins')
datatables
@endpush
```

Each plugin is a separate Vite chunk. Its JavaScript and CSS are downloaded only on pages where it is enabled, so pages without plugins stay small.

Plugins load asynchronously, so wrap page code in `window.adminReady()` instead of `DOMContentLoaded`. The callback runs once the DOM is ready and all enabled plugins are loaded:

```blade
@push('scripts')
<script>
    window.adminReady(function () {
        if (window.adminPluginEnabled('datatables')) {
            new DataTable('#users-table');
        }
    });
</script>
@endpush
```

A plugin examples page is included at:

```text
/examples/plugins
```

---

## Starting a New Project from This Starter

For long-lived projects, start from a clone of this repository instead of GitHub's "Use this template" button. A clone keeps the starter's history, so later starter releases can be merged into your project with `git merge`. A repository created from the template has unrelated history and git refuses to merge it.

Create the project, keeping the starter as a remote named `starter` and its tags under a `starter/` prefix so they never collide with your project's own tags:

```bash
git clone --no-tags --origin starter git@github.com:slobodan-radovanovic/laravel-adminlte4-starter.git my-project
cd my-project
git config --add remote.starter.fetch '+refs/tags/*:refs/tags/starter/*'
git fetch starter
git switch -C main starter/v2.2.0
git branch --unset-upstream
git remote set-url --push starter no-push
```

The project now has two remotes: `origin` (added below) is the project repository you push to every day, and `starter` is only used to fetch new starter releases. The last command disables pushing to `starter`, so project code can never be pushed to the public starter by mistake. Fetching still works.

Create an empty repository for the project (GitHub, GitLab or anywhere else) and push to it:

```bash
git remote add origin git@gitlab.com:your-name/my-project.git
git push -u origin main
```

Then follow the [Installation](#installation) steps from `composer install` onward.

### Files that belong to your project

Starter releases avoid changing these files, so customize them freely:

- `config/admin-menu.php` for the sidebar menu
- `database/seeders/ProjectPermissionSeeder.php` for your permissions and roles
- `.env`

You can also edit any other file. Expect merge conflicts in those files when you update, especially in the example modules (Categories and Plugins), which you may delete.

---

## Updating a Project to a New Starter Version

Read the release notes in `CHANGELOG.md` first, especially any **Upgrade note**. Then merge the release tag on a separate branch:

```bash
git fetch starter
git switch -c update/starter-v2.3.0
git merge starter/v2.3.0
```

Resolve conflicts, then check the application:

```bash
composer install
npm install
php artisan migrate
php artisan test
npm run build
```

Merge the update branch into `main` when everything passes. Merge releases in order where possible (for example `v2.2.0` before `v2.3.0`), so each upgrade note is applied once.

### Upgrading from v2.1 or older to v2.2

The sidebar menu moved from `config/adminlte.php` (`menu` key) to `config/admin-menu.php` (`items` key). If your project still has a `menu` key in `config/adminlte.php`, it keeps working and takes precedence. Move your menu items into `config/admin-menu.php` and remove the old `menu` key when convenient.

If your project was created with "Use this template", add the starter remote as shown above and do the first update with `git merge --allow-unrelated-histories starter/v2.2.0`. Expect many conflicts on that first merge, after which updates work normally.

---

## Testing

Run tests:

```bash
php artisan test
```

Run frontend build:

```bash
npm run build
```

This starter includes feature tests for:

- dashboard access
- protected admin routes
- permissions
- users management
- roles management
- categories access
- first admin user command

Tests run against an in-memory SQLite database configured in `phpunit.xml`, so no test database needs to be created. The `pdo_sqlite` PHP extension is required.

To run the tests against MySQL instead, override the `DB_*` variables in `phpunit.xml` or in a `.env.testing` file.

GitHub Actions runs Pint, the test suite and the frontend build on every push and pull request (`.github/workflows/ci.yml`).

---

## Useful Commands

Clear cache:

```bash
php artisan optimize:clear
```

Fresh database with seeders:

```bash
php artisan migrate:fresh --seed
```

Create first admin user:

```bash
php artisan admin:create-user
```

Run tests:

```bash
php artisan test
```

Build assets:

```bash
npm run build
```

---

## Project Structure

Important files and folders:

```text
app/Console/Commands/CreateAdminUserCommand.php
app/Http/Controllers/Admin
app/Http/Requests/Admin
config/adminlte.php
config/admin-menu.php
database/seeders/ProjectPermissionSeeder.php
resources/css/admin.css
resources/js/admin.js
resources/views/layouts/admin.blade.php
resources/views/layouts/partials
resources/views/components/admin
resources/views/admin
tests/Feature
```

---

## Using as a Starter Template

This project is intended to be used as a starting point for Laravel admin applications.

Recommended workflow:

1. Start the project as described in [Starting a New Project from This Starter](#starting-a-new-project-from-this-starter).
2. Configure `.env`.
3. Run migrations and seeders.
4. Create the first Super Admin user.
5. Replace or extend the example modules.
6. Adjust `config/adminlte.php`, `config/admin-menu.php` and `ProjectPermissionSeeder` for your application.
7. Add your own business modules.
8. Merge new starter releases as described in [Updating a Project to a New Starter Version](#updating-a-project-to-a-new-starter-version).

---

## Roadmap

Possible future improvements:

- optional feedback type selection: popup, toast or inline alert
- more AdminLTE components
- optional screenshots
- additional tests
- reusable CRUD generator patterns
- optional Composer package extraction for shared admin core

---

## License

This project is open-sourced software licensed under the MIT license.
