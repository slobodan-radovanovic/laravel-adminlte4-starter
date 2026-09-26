# Security Policy

## Supported Versions

This project is a starter kit. Security fixes are expected to target the latest stable release.

| Version | Supported |
| --- | --- |
| Latest release | Yes |
| Older releases | Best effort |

---

## Reporting a Vulnerability

If you discover a security vulnerability, please open a private report through GitHub Security Advisories when available, or contact the maintainer directly through the repository owner profile.

Please include:

- a clear description of the issue
- affected files or features
- steps to reproduce
- possible impact
- suggested fix, if available

Do not publicly disclose a vulnerability before it has been reviewed.

---

## Security Notes

This starter intentionally avoids default admin credentials.

The first Super Admin user must be created manually with:

```bash
php artisan admin:create-user
```

Included safety rules:

- the Super Admin role cannot be deleted
- the last Super Admin user cannot be deleted
- the last Super Admin role cannot be removed from the last Super Admin user
- a user cannot delete their own account

---

## Before Using in Production

Before using this starter in a production project, review and configure:

- `.env` values
- application key
- database credentials
- mail configuration
- queue configuration
- cache/session drivers
- HTTPS configuration
- file permissions
- web server configuration
- backup strategy
- user registration policy
- role and permission assignments

Also run:

```bash
composer audit
php artisan test
npm run build
```

---

## Dependency Security

Keep PHP and JavaScript dependencies updated.

Recommended checks:

```bash
composer audit
npm audit
```

Apply dependency updates carefully and test the application after every update.
