# Laravel RBAC Admin Panel

Laravel RBAC is a Laravel 13 admin panel for managing users, roles, permissions, and products. It uses `spatie/laravel-permission` for authorization.

## Features

- Dashboard counters for users, roles, permissions, and products
- User CRUD with role and direct permission assignment
- Role CRUD with grouped permission assignment
- Product CRUD protected by permission middleware
- Seeded permissions and a default Super Admin account

## Requirements

- PHP 8.3 or higher
- Composer
- Node.js and npm
- MySQL, MariaDB, or another Laravel-supported database

## Installation

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Update your `.env` database settings, then run:

```bash
php artisan migrate --seed
npm run build
php artisan serve
```

Default seeded admin:

```text
Email: admin@gmail.com
Password: 12345678
```

## Development

```bash
npm run dev
php artisan serve
```

Run tests:

```bash
php artisan test
```

## Authorization

Permissions are generated from `app/Services/PermissionService.php` using module/action names like:

```text
users.viewAny
roles.create
products.edit
dashboard.viewAny
```

Controllers use Laravel's static controller middleware API through `Illuminate\Routing\Controllers\HasMiddleware`, which is required for this Laravel version.

## Breeze

`laravel/breeze` has been removed from Composer dependencies. The application still contains local authentication controllers and views, so login/logout routes continue to work without depending on the Breeze package.
