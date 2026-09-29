# Changelog

All notable changes to this project will be documented in this file.

This project follows a simple versioned release history for the Laravel AdminLTE 4 Starter.

---

## v2.4.0 - Blade Components

### Added

- 44 AdminLTE Blade components, matching the component set of Laravel-AdminLTE: 15 form components, 6 layout and navbar components, datatable and modal, and 21 widgets.
- Example pages under Examples → Components (Forms, Widgets, Layout and Tools). The forms page really submits, validates and uploads files.
- Components start their plugins automatically through `data-admin-*` attributes; `window.adminInitComponents(element)` starts plugins in HTML added later.
- Tom Select and Trix editor as lazy-loaded plugins (`tomselect`, `trix`).
- `form.select` supports `multiple`, grouped options and a custom options slot; `form.input` supports `prepend` and `append` addons.
- `card` supports themes and the AdminLTE collapse, maximize and remove tools; `info-box` supports progress and a filled style.

### Changed

- Users and Roles pages use `content-header` and `datatable`; all admin pages except the Categories example use `content-header`.
- The navbar color mode menu is now the `navbar.color-mode` component.
- Select2 uses AdminLTE's own Select2 theme, which supports dark mode. `select2-bootstrap-5-theme` was removed.
- Password inputs no longer refill their value after a validation error.

### Fixed

- AJAX and JSON requests got a redirect instead of a JSON response on validation errors outside `api/*`.

---

## v2.3.1 - Footer Fixes

### Fixed

- The footer showed version 1.0.0; it now shows the starter release, and a test keeps it in sync with this changelog.
- The copyright link pointed to the dashboard; it now uses `adminlte.footer.url` (the starter's GitHub repository by default, `null` for plain text).
- `adminlte.footer.enabled` had no effect; setting it to `false` now hides the footer.

---

## v2.3.0 - Built-in Color Modes

### Added

- Color mode menu in the navbar with Light, Dark and Auto. Auto follows the operating system.
- `adminlte.theme.available` now controls which modes the menu offers.

### Changed

- The theme switch uses AdminLTE's built-in ColorMode instead of custom JavaScript.
- The saved choice moved from the `admin-theme` to the `lte-theme` browser key. Existing choices are carried over automatically.
- Updated to AdminLTE 4.9. Printing now hides the header, sidebar and footer; add `data-lte-print="app"` to restore the old behavior.
- Inputmask is imported through its package entry point and requires 5.0.10 or newer.
- Node.js 22 or newer is required.
- Dependency updates from Dependabot: DataTables 3, concurrently 10, Vite 8.3, Dropzone 6.3 and GitHub Actions checkout and setup-node v7.

### Removed

- `#admin-theme-toggle` and `#admin-theme-icon` from the navbar. Custom code that used them should use `data-bs-theme-value` buttons instead.

---

## v2.2.0 - Project-Friendly Updates

### Added

- `config/admin-menu.php` for the sidebar menu, owned by each project.
- `ProjectPermissionSeeder` for project-specific permissions and roles.
- Dependabot updates for Composer, npm and GitHub Actions.
- README guide for starting projects from the starter and merging new starter releases by tag.

### Changed

- **Upgrade note:** the sidebar menu moved from the `menu` key in `config/adminlte.php` to the `items` key in `config/admin-menu.php`. An existing `adminlte.menu` still works and takes precedence.

---

## v2.1.0 - Cleanup and Performance

### Added

- `window.adminReady()` helper for page scripts that use plugins.
- GitHub Actions CI running Pint, the frontend build and tests on PHP 8.3 and 8.4.
- Feature tests for the Categories CRUD.

### Changed

- Admin plugins and their CSS are loaded on demand, only when enabled. The base admin bundle went from 881 kB to 183 kB.
- **Upgrade note:** page scripts that use plugins must use `window.adminReady(...)` instead of `DOMContentLoaded`.
- Tests use an in-memory SQLite database instead of a local MySQL test database.
- jQuery is now a direct npm dependency.
- Documented PHP requirement aligned with `composer.json` (PHP 8.3 or newer).

### Removed

- Unused Breeze Tailwind layout, navigation, welcome page and components.
- Tailwind CSS, PostCSS, Autoprefixer and Alpine.js.

---

## v2.0.1 - Security Fixes

### Security

- Super Admin users now pass every permission check through `Gate::before`.
- Only Super Admin users can assign the Super Admin role or edit and delete Super Admin users.
- The Super Admin role can no longer be renamed or edited.
- Admin pages now require a verified email address (`User` implements `MustVerifyEmail`).

### Added

- `ADMINLTE_REGISTRATION_ENABLED` option to turn off public registration.

---

## v2.0.0 - Public Template Release

### Added

- Public template release.
- Custom public landing page instead of the default Laravel welcome page.

### Changed

- Final documentation polish.
- Final dependency and security audit checks.
- Final test and production build verification.

---

## v1.9.0 - Final README and Public Documentation

### Added

- Public README documentation.
- CHANGELOG.md.
- LICENSE.
- SECURITY.md.
- CONTRIBUTING.md.
- Documentation for installation, first admin user creation, roles, permissions, plugins, testing and project structure.
- Documentation for updating existing projects from this starter.

### Changed

- Prepared the starter for public usage and documentation.
- Updated project metadata for public release.

---

## v1.8.0 - Public Polish Checks

### Added

- Final public polish checks before documentation.

### Changed

- Reviewed starter structure before public documentation.
- Verified tests and frontend build.

---

## v1.7.0 - Starter Feature Tests

### Added

- Feature tests for dashboard access.
- Feature tests for protected admin routes.
- Feature tests for user permissions.
- Feature tests for user management.
- Feature tests for role management.
- Feature tests for category access.
- Feature test for the first admin user command.

### Changed

- Improved test database configuration.
- Verified starter behavior with automated tests.

---

## v1.6.0 - Admin Feedback Components

### Added

- Centered flash popup for success, error, warning and info messages.
- Reusable confirm delete component.
- Reusable empty state component.
- Reusable status badge component.
- Feedback configuration in `config/adminlte.php`.

### Changed

- Admin layout now includes the feedback partial.
- Users and Roles modules use reusable feedback-related components where appropriate.

---

## v1.5.0 - Admin Plugin System

### Added

- Admin plugin configuration system.
- Per-page plugin activation using Blade stacks.
- Plugin helper function exposed to JavaScript.
- Plugin examples page.
- DataTables support.
- Select2 support.
- Chart.js support.
- Flatpickr support.
- SweetAlert2 support.
- Inputmask support.
- SortableJS support.
- Dropzone support.

---

## v1.4.0 - Sidebar Submenu Support

### Added

- Minimal sidebar submenu support.
- Active state support for submenu items.
- Permission-aware submenu rendering.

### Changed

- Sidebar menu rendering now supports nested menu items from `config/adminlte.php`.

---

## v1.3.0 - User Management CRUD

### Added

- Full Users CRUD module.
- User creation with role assignment.
- User editing with optional password update.
- Email verification status management.
- Role assignment management.
- User delete safeguards.

### Security

- Users cannot delete their own account.
- The last Super Admin user cannot be deleted.
- The last Super Admin role cannot be removed from the last Super Admin user.

---

## v1.2.0 - Role Management and Form Components

### Added

- Role management CRUD.
- Permission assignment to roles.
- Reusable admin form components.
- `admin:create-user` command for creating the first Super Admin user.

### Security

- The Super Admin role cannot be deleted.
- No default admin credentials are included.

---

## v1.1.0 - Categories CRUD Example

### Added

- Categories CRUD example module.
- Basic category listing, creation, editing and deletion.
- Permission-protected category routes.

### Notes

- Categories intentionally stay closer to plain Blade so developers can compare a manual CRUD approach with the reusable component approach used in other modules.

---

## v1.0.1 - Dashboard Access Patch

### Fixed

- Dashboard access after user registration.
- Authenticated and verified users can access the dashboard.
- Protected admin modules remain permission-based.

---

## v1.0.0 - Initial Stable Starter

### Added

- Laravel 13 starter structure.
- Laravel Breeze Blade authentication.
- AdminLTE 4 manual integration through npm and Vite.
- Bootstrap 5 based admin layout.
- Admin navbar, sidebar and footer.
- Dashboard page.
- Config-driven menu.
- Light/dark theme switcher.
- Admin-styled authentication pages.
- Spatie Laravel Permission integration.
- Initial starter polish and documentation foundation.

---

## v0.10.0 - Roles and Permissions Foundation

### Added

- Spatie Laravel Permission integration.
- Default roles and permissions.
- Permission-aware menu visibility.

---

## v0.9.0 - Admin Examples and Plugins Foundation

### Added

- Initial admin examples.
- Dashboard widgets.
- Frontend plugin foundation.

---

## v0.8.0 - Admin Layout Options

### Added

- Admin layout configuration options.
- Additional layout cleanup.

---

## v0.7.0 - Bootstrap Breeze Views

### Changed

- Breeze authentication views adapted to Bootstrap/AdminLTE styling.

---

## v0.6.0 - Theme System

### Added

- Light/dark theme switcher.
- Theme persistence using local storage.

---

## v0.5.0 - Config Driven Menu

### Added

- Admin menu configuration through `config/adminlte.php`.

---

## v0.4.0 - AdminLTE Layout

### Added

- Main AdminLTE layout.
- Navbar partial.
- Sidebar partial.
- Footer partial.
- Dashboard layout.

---

## v0.3.0 - AdminLTE Vite Integration

### Added

- AdminLTE 4 npm integration.
- Vite-based admin asset loading.

---

## v0.2.0 - Breeze Authentication

### Added

- Laravel Breeze Blade authentication scaffolding.

---

## v0.1.0 - Initial Laravel Install

### Added

- Initial Laravel project installation.
- Basic application bootstrapping.
