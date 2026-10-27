# Research Portal

A Laravel-based platform that connects **Researchers** running market/UX research studies with **Participants** who take part in them. Researchers create research projects, target participants using detailed demographic and firmographic criteria, screen and hire candidates, message them, and pay for the engagement via integrated credit-card billing.

## Features

### Accounts & Roles

- Dual registration flows for **Researchers** and **Participants** (`/register/researcher`, `/register/participant`)
- Role-based access control (`researcher` / `participant` roles)
- Login, email verification, and password reset/confirmation

### Participant Profiles

- Avatar upload
- Contact details
- Demographics (age, gender, ethnicity, education, household income, location)
- Employment history and industry
- Skills tagging

### Research Projects (Studies)

- Full project management for researchers (create, edit, preview, delete)
- Rich targeting criteria per project: skills, industries, company size, household income, gender, education level, ethnicity, age range, and location
- Custom screener questions per project

### Screening & Recruitment

- Participants browse open projects and submit screener responses
- Participants can withdraw a submitted response
- Researchers review responses and invite, reject, or hire participants
- Zoom meeting links sent to hired participants; participants can accept or decline the invite

### Messaging

- In-app chat between a researcher and a participant, scoped to a project

### Billing

- Credit card profile management via Authorize.Net
- Per-project billing/payment history for researchers

### API

- Lightweight internal API for skills lookup/autocomplete and project detail retrieval

## Tech Stack

- **Framework:** Laravel 13 (PHP 8.3+)
- **Frontend:** Blade, Alpine.js, Tailwind CSS 4, built with Vite
- **Authorization:** Spatie Laravel Permission 8
- **API auth:** Laravel Sanctum 4
- **Payments:** Authorize.Net PHP SDK
- **Images:** Intervention Image 4 (`intervention/image-laravel`)
- **Database:** MySQL
- **Tooling:** Laravel Tinker, Pint, Pail, Sail, PHPUnit 12, Telescope (local only)

## Requirements

- PHP ^8.3 (with the `gd` extension for image processing)
- Composer
- Node.js 20+ & npm
- MySQL

## Installation

```bash
git clone https://github.com/nurulanam/laravel-research-portal.git
cd laravel-research-portal

composer install
npm install

cp .env.example .env
php artisan key:generate
```

Configure your database, mail, and payment provider settings in `.env`, then run migrations:

```bash
php artisan migrate
```

Build frontend assets:

```bash
npm run dev      # Vite dev server (with hot reload)
npm run build    # production build
```

Serve the application:

```bash
php artisan serve
php artisan pail  # tail logs (optional)
```

## Testing

```bash
php artisan test
# or
composer test
```

## Upgrading

This application was upgraded from Laravel 8 to Laravel 13. See
[UPGRADING.md](UPGRADING.md) for the full list of changes and the steps to run
after pulling this release.

## Database Structure

Key tables (see `database/migrations/`):

- `users`, `profiles` — accounts and extended profile data
- `skills`, `user_has_skills`, `user_has_industries` — participant skill/industry taxonomy
- `projects` — research studies
- `project_has_skills`, `project_has_industries`, `project_has_company_sizes`, `project_has_household_incomes`, `project_has_genders`, `project_has_education_levels`, `project_has_ethnicities`, `project_has_age_ranges`, `project_has_locations`, `project_has_project_topics` — project targeting criteria
- `project_has_questions`, `project_has_responses` — screener questions and participant answers
- `project_has_messages` — in-project chat
- `researcher_billings`, `authorize_customers` — billing history and stored payment profiles