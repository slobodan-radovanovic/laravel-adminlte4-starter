# Contributing

Thank you for considering a contribution to Laravel AdminLTE 4 Starter.

This project aims to stay clean, practical and easy to customize.

---

## Project Direction

The goal of this starter is to provide a modern Laravel admin foundation with:

- Laravel 13
- PHP 8.4
- AdminLTE 4
- Bootstrap 5
- Breeze Blade authentication
- Spatie Laravel Permission
- practical CRUD examples
- reusable admin components
- a simple plugin system
- tests for core starter behavior

This project intentionally avoids:

- Filament
- Tailwind CSS for the admin UI
- Laravel AdminLTE wrapper packages
- full CMS complexity
- SaaS boilerplate complexity
- API-first architecture

Please keep contributions aligned with that direction.

---

## Local Setup

Clone the repository:

```bash
git clone https://github.com/slobodan-radovanovic/laravel-adminlte4-starter.git
cd laravel-adminlte4-starter
```

Install dependencies:

```bash
composer install
npm install
```

Create environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Configure the database in `.env`, then run:

```bash
php artisan migrate --seed
```

Create the first Super Admin user:

```bash
php artisan admin:create-user
```

Build assets:

```bash
npm run build
```

---

## Development Checks

Before submitting changes, run:

```bash
composer validate
composer audit
php artisan test
npm run build
```

The test suite should pass before a pull request is submitted.

---

## Coding Guidelines

Please follow these guidelines:

- keep the starter simple and understandable
- prefer standard Laravel conventions
- avoid unnecessary abstraction
- avoid introducing heavy dependencies
- keep AdminLTE integration transparent
- keep Blade views readable
- keep example modules useful for real projects
- protect security-related behavior with tests when possible

---

## Pull Requests

A good pull request should include:

- a clear description of the change
- why the change is useful for a starter kit
- screenshots for visible UI changes, if applicable
- tests for behavior changes, if applicable
- confirmation that tests and build pass

Please avoid unrelated formatting-only changes in the same pull request as functional changes.

---

## Documentation

If a contribution changes setup, configuration, commands, plugins, permissions or project structure, update the documentation as well.

Relevant files may include:

- `README.md`
- `CHANGELOG.md`
- `SECURITY.md`
- `CONTRIBUTING.md`

---

## Security Changes

Security-related changes should be handled carefully.

Do not remove or weaken these safeguards without a strong reason:

- no default admin credentials
- manual first Super Admin creation
- Super Admin role delete protection
- last Super Admin user delete protection
- own-account delete protection in admin user management

---

## Release Notes

When preparing a release, update `CHANGELOG.md` with:

- added features
- changed behavior
- fixed issues
- security notes, if relevant
- upgrade notes, if relevant
