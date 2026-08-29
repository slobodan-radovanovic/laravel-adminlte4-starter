# Contributing

Contributions are welcome.

This project aims to stay a clean and practical Laravel AdminLTE 4 starter kit.

---

## Development Setup

Clone the repository:

```bash
git clone https://github.com/slobodan-radovanovic/laravel-adminlte4-starter.git
cd laravel-adminlte4-starter

Install dependencies:

composer install
npm install

Create environment file:

cp .env.example .env

Generate application key:

php artisan key:generate

Run migrations and seeders:

php artisan migrate --seed

Create the first Super Admin user:

php artisan admin:create-user

Start frontend development server:

npm run dev
Running Tests

Run backend tests:

php artisan test

Run frontend build:

npm run build

Before opening a pull request, make sure both commands pass.

Pull Request Guidelines

Before opening a pull request:

keep changes focused
make sure tests pass
make sure the frontend build passes
avoid adding large dependencies without discussion
do not commit .env
do not commit private credentials
do not commit local database dumps
keep the starter simple and reusable
Project Direction

This project is intended to be a starter kit, not a full CMS or SaaS boilerplate.

It intentionally avoids:

Filament
Tailwind CSS for the admin UI
AdminLTE Laravel wrapper packages
unnecessary business-specific modules
large opinionated architecture layers

Preferred contributions:

bug fixes
AdminLTE 4 improvements
Bootstrap 5 UI improvements
starter-friendly components
tests
documentation improvements
small reusable admin patterns
Coding Style

Follow the existing project style.

General conventions:

keep controllers simple
use Form Requests for validation
use Blade components where they improve clarity
avoid over-engineering
keep example modules easy to understand
prefer explicit code over hidden magic
Security

Please do not open public issues for sensitive security vulnerabilities.

See SECURITY.md for details.d
