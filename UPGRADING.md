# Upgrading to Laravel 13

This document records the Laravel 8 → Laravel 13 upgrade of this application and
the manual steps required after pulling it.

## Summary

| Component | Before | After |
| --- | --- | --- |
| PHP | `^7.3 \| ^8.0` | `^8.3` |
| laravel/framework | `^8.75` | `^13.39` |
| laravel/sanctum | `^2.11` | `^4.3` |
| laravel/tinker | `^2.5` | `^3.0` |
| spatie/laravel-permission | `^5.10` | `^8.3` |
| intervention/image | `^2.7` (`intervention/image`) | `^4.1` (`intervention/image-laravel`) |
| laravel/telescope | `^4.10` | `^5.26` |
| laravel/breeze (dev) | `^1.10` | `^2.4` |
| nunomaduro/collision (dev) | `^5.10` | `^8.9` |
| phpunit/phpunit (dev) | `^9.5` | `^12.5` |
| fakerphp/faker (dev) | `^1.9.1` | `^1.24` |
| Front-end build | Laravel Mix | Vite 8 + Tailwind CSS 4 |
| `fruitcake/laravel-cors` | `^2.0` | removed — CORS is built into the framework |
| `facade/ignition` | `^2.5` | removed — replaced by Collision |

## What changed in the codebase

### Application bootstrapping (Laravel 11+ skeleton)

- `bootstrap/app.php` now builds the application with `Application::configure()`,
  registering web/api/console routes, broadcast channels and the `/up` health
  check.
- `app/Http/Kernel.php`, `app/Console/Kernel.php`, `app/Exceptions/Handler.php`
  and the `app/Http/Middleware` customisations were removed. Behaviour is now
  configured in `bootstrap/app.php`:
  - guests are redirected to `/` (`redirectGuestsTo`);
  - authenticated users hitting `guest` routes go to `/dashboard` (`redirectUsersTo`);
  - Spatie middleware aliases (`role`, `permission`, `role_or_permission`) are
    registered with the new `Spatie\Permission\Middleware\*` namespace;
  - `throttle:api` remains on the `api` group (`throttleApi()`), with the `api`
    rate limiter defined in `AppServiceProvider`.
- `app/Providers/RouteServiceProvider.php` was removed (the framework handles
  routing). `RouteServiceProvider::HOME` references were replaced with the
  `/dashboard` path.
- `app/Providers/EventServiceProvider.php` and `AuthServiceProvider.php` were
  removed. Listeners are now auto-discovered in `app/Listeners`, and
  `App\Models\Listeners\NotifyParticipantHired` was moved to `app\Listeners` so
  it is discovered too. The e-mail verification listener is registered
  automatically by the framework.
- Service providers are listed in `bootstrap/providers.php`.
- Scheduling is defined in `routes/console.php` (no console kernel).
- `server.php` was removed (`public/index.php` handles requests).
- `tests/CreatesApplication.php` was removed; `Tests\TestCase` extends the
  framework test case directly and disables Vite.

### Configuration

- Config files were regenerated from the Laravel 13 defaults: `auth`, `cache`,
  `database`, `filesystems`, `logging`, `mail`, `queue`, `session`,
  `broadcasting`, `cors`, `sanctum`, `permission`, `telescope` and
  `intervention-image` (replacing the old `config/image.php`).
- `config/hashing.php` and `config/view.php` were removed (framework defaults).
- `config/app.php` is the modern minimal file plus this project's `us_states`
  and `industries` reference data. The `providers`/`aliases` arrays are gone —
  class aliases now come from the framework and package manifests.
- Environment variable names follow the current conventions:
  `CACHE_STORE`, `FILESYSTEM_DISK`, `BROADCAST_CONNECTION`, `LOG_STACK`,
  `APP_LOCALE`, `MAIL_SCHEME`, …
- Authorize.Net credentials are read through `config('services.authorizenet.*')`
  instead of calling `env()` at runtime (required for `config:cache`).

### Database

- Password reset tokens now use the `password_reset_tokens` table (Laravel 9+
  default). A new migration renames the old `password_resets` table in place, so
  existing tokens are kept.
- The `schema` for every other table is unchanged.

### Application code

- `app/Http/Controllers/Controller.php` is now an empty abstract controller, as
  in the Laravel 13 skeleton.
- `ProfileController` uses the Intervention Image 4 API
  (`Image::decode($file)->scaleDown(width: 400, height: 400)->save(...)`) and
  imports the `File` facade explicitly.
- `ProjectController` no longer imports the non-existent `http\Env\Response`
  class and reads Authorize.Net credentials from config.
- Pagination uses Bootstrap 5 markup (`Paginator::useBootstrapFive()`) to match
  the admin theme.
- Front-end is built with Vite; `webpack.mix.js`, `tailwind.config.js`,
  `postcss.config.js` and the Mix npm dependencies were removed.
  `resources/css/app.css` uses the Tailwind CSS 4 `@import 'tailwindcss'` entry.
- English translation files under `resources/lang` were removed — Laravel ships
  the same defaults in the framework.

## Steps to run after pulling

```bash
# 1. PHP dependencies (composer.lock was regenerated for Laravel 13)
rm -rf vendor
composer install

# 2. Front-end dependencies and build
rm -rf node_modules
npm install
npm run build

# 3. Environment
#    Copy any new keys from .env.example into your .env, in particular:
#    APP_LOCALE / APP_FALLBACK_LOCALE, CACHE_STORE, FILESYSTEM_DISK,
#    BROADCAST_CONNECTION, LOG_STACK, MAIL_SCHEME,
#    MERCHANT_LOGIN_ID / MERCHANT_TRANSACTION_KEY / MERCHANT_CLIENT_KEY
php artisan key:generate   # only for fresh installations

# 4. Database
php artisan migrate

# 5. Clear caches
php artisan optimize:clear

# 6. Verify
php artisan test
```

> The framework, Sanctum, Spatie Permission, Telescope and Intervention Image all
> require PHP 8.3+ now. Make sure the `gd` extension is installed for avatar
> uploads.

## Behaviour changes worth knowing

- Laravel 13 renamed the CSRF middleware to `PreventRequestForgery` and adds
  request-origin verification using the `Sec-Fetch-Site` header. Cross-site form
  posts must be same-origin (or use `Sec-Fetch-Site` aware clients).
- Cache keys and the session cookie name changed format in Laravel 13
  (`app-name-session` instead of `app_name_session`). Existing users will be
  logged out once; set `SESSION_COOKIE`, `CACHE_PREFIX` and `REDIS_PREFIX`
  explicitly if you need to keep the old values.
- Queue/cache/session drivers are now configured with `QUEUE_CONNECTION`,
  `CACHE_STORE` and `SESSION_DRIVER`. This app keeps `sync`/`file`/`file` as in
  the previous configuration.
- Telescope is only registered when `APP_ENV=local`.
