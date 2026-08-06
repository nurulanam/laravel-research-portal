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

- **Framework:** Laravel 8 (PHP)
- **Frontend:** Blade, Alpine.js, Tailwind CSS, built with Laravel Mix
- **Authorization:** Spatie Laravel Permission
- **API auth:** Laravel Sanctum
- **Payments:** Authorize.Net PHP SDK
- **Images:** Intervention Image
- **Database:** MySQL

## Requirements

- PHP ^7.3 or ^8.0
- Composer
- Node.js & npm
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
npm run dev    # development
npm run prod   # production build
```

Serve the application:

```bash
php artisan serve
```

## Testing

```bash
php artisan test
```

## Database Structure

Key tables (see `database/migrations/`):

- `users`, `profiles` — accounts and extended profile data
- `skills`, `user_has_skills`, `user_has_industries` — participant skill/industry taxonomy
- `projects` — research studies
- `project_has_skills`, `project_has_industries`, `project_has_company_sizes`, `project_has_household_incomes`, `project_has_genders`, `project_has_education_levels`, `project_has_ethnicities`, `project_has_age_ranges`, `project_has_locations`, `project_has_project_topics` — project targeting criteria
- `project_has_questions`, `project_has_responses` — screener questions and participant answers
- `project_has_messages` — in-project chat
- `researcher_billings`, `authorize_customers` — billing history and stored payment profiles