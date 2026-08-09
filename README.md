# MCA SMTP

Panel SMTP settings for Laravel: apply to `config('mail')` at runtime and send test emails.

## Install

```bash
composer require mca/smtp
php artisan mca:smtp:install
```

Admin: `/mca/smtp` (root only).

## Test mail

```bash
php artisan mca:smtp:test user@example.com
```

Or use the form on the admin page.

## Helpers

```php
mca_smtp()->apply();
mca_smtp()->sendTest('user@example.com');
mca_smtp()->isConfigured();
```
