# Security Policy

## Supported Versions

This project is a starter template. Security fixes are generally applied to the latest released version.

| Version | Supported |
| ------- | --------- |
| Latest  | Yes       |

---

## Reporting a Vulnerability

If you discover a security issue, please do not open a public issue with sensitive details.

Instead, report it privately through GitHub security advisories if available, or contact the maintainer through the repository profile.

Please include:

- a clear description of the issue
- steps to reproduce
- affected files or modules
- possible impact
- suggested fix, if known

---

## Default Credentials

This starter does not include default admin credentials.

The first Super Admin user must be created manually using:

```bash
php artisan admin:create-user
Security Notes

This starter includes basic safeguards:

no default admin user
no default admin password
protected admin routes
permission-based menu visibility
protected Super Admin role
protection against deleting the current authenticated user
protection against deleting the last Super Admin user

These safeguards are not a replacement for a full security review in production applications.


