# Post Analytics

A Laravel-based application built using a modular architecture.

## Requirements

Before starting, ensure you have the following installed:

- PHP 8.4+
- Composer
- Docker & Docker Compose
- Git

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/shaho1090/post-analytics
cd post-analytics
```

### 2. Create environment file

```bash
cp .env.example .env
```

### 3. Configure environment variables

Update the `.env` file according to your local environment.

Example:

```env
APP_NAME=post-analytics
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=app
DB_USERNAME=postgres
DB_PASSWORD=secret

REDIS_HOST=redis
REDIS_PORT=6379

QUEUE_CONNECTION=redis
```

## Running with Docker

### Build containers

```bash
docker compose build
```

### Start containers

```bash
docker compose up -d
```
### Start containers using adminer

```bash
docker compose --profile dev up -d
```

### Verify containers

```bash
docker compose ps
```

## Install dependencies

```bash
docker compose exec app composer install
```

## Generate application key

```bash
docker compose exec app php artisan key:generate
```

## Run migrations

```bash
docker compose exec app php artisan migrate
```

## Run database seeders (optional)

```bash
docker compose exec app php artisan db:seed
```

## Storage Link

```bash
docker compose exec app php artisan storage:link
```

## Queue Worker

The application uses queued jobs for asynchronous processing such as email notifications.

Start a worker:

```bash
docker compose exec app php artisan queue:work --queue=listeners
```

Or:

```bash
docker compose exec app php artisan queue:listen --queue=listeners
```

## Running Tests

Run all tests:

```bash
docker compose exec app php artisan test
```

Run PHPUnit directly:

```bash
docker compose exec app vendor/bin/phpunit
```

## Modules

The project follows a modular architecture.

Example:

```text
Modules
├── User
│   ├── Actions
│   ├── Tasks
│   ├── Data
│   │   ├── Models
│   │   └── Migrations
│   └── Events
│
├── Post
│   ├── Actions
│   ├── Tasks
│   ├── Data
│   ├── Requests
│   ├── Resources
│   └── Events
│
└── Notification
    ├── Mails
    ├── Listeners
    └── Resources
```

### Actions

Application use cases.

Examples:

```text
CreateUserAction
CreatePostAction
GetPostAnalyticsAction
```

### Tasks

Single responsibility classes responsible for database interaction or isolated business operations.

Examples:

```text
CreateUserTask
StorePostImageTask
GetDailyPostAnalyticsTask
```

### Resources

API response transformers.

### Events & Listeners

Used for asynchronous processing.

Example:

```text
UserRegistered
    ↓
SendWelcomeEmail
```

## Queue Processing Example

When a user registers:

```text
Register User
    ↓
UserRegistered
    ↓
SendWelcomeEmail (queued)
    ↓
WelcomeMail
```

## Useful Commands

Clear cache:

```bash
docker compose exec app php artisan optimize:clear
```

Rebuild containers:

```bash
docker compose down
docker compose build --no-cache
docker compose up -d
```

Access application container:

```bash
docker compose exec app bash
```

## Default URLs

Application:

```text
http://localhost:8000
```

Adminer (if enabled):

```text
http://localhost:8383
```

## Troubleshooting

### Composer dependencies issue

```bash
docker compose exec app composer install
```

### Permission issues

```bash
docker compose exec app chmod -R 775 storage bootstrap/cache
```

### Clear all caches

```bash
docker compose exec app php artisan optimize:clear
```

### Re-run migrations

```bash
docker compose exec app php artisan migrate:fresh
```
