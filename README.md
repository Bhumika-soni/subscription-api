# Subscription API

A Laravel-based REST API for managing subscription plans. This API allows users to view available plans, create subscriptions, cancel subscriptions, and view their subscription history.

## Features

- Plan management
- Subscription creation
- Subscription cancellation
- User subscription history

## Tech Stack

- PHP 8.x
- Laravel 12.x
- MySQL

## Project Setup

### Prerequisites

- PHP 8.0 or higher
- Composer
- MySQL
- Web server (Apache, Nginx, etc.)

### Installation Steps

1. Clone the repository:
   ```bash
   git clone https://github.com/Bhumika-soni/subscription-api.git
   cd subscription-api
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Create and configure the environment file:
   ```bash
   cp .env.example .env
   ```
   
4. Configure your database settings in the `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=subscription_api
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Run database migrations:
   ```bash
   php artisan migrate
   ```

7. Seed the database with sample data (optional):
   ```bash
   php artisan db:seed
   ```

8. Start the development server:
   ```bash
   php artisan serve
   ```

## API Documentation

### Endpoints

#### Plans

- `GET /api/plans` - List all available plans

#### Subscriptions

- `POST /api/subscriptions` - Create a new subscription
  - Required header: `x-user-id`
  - Required body: `plan_id`

- `PUT /api/subscriptions/{id}/cancel` - Cancel a subscription
  - Required header: `x-user-id`

- `GET /api/users/{id}/subscriptions` - Get user's subscriptions history

### Authentication

This API uses a simple `x-user-id` header for identifying users. In a production environment, you should implement proper authentication using Laravel Sanctum, Passport, or JWT.

## Error Handling

The API returns standardized error responses:

- 200: Success
- 204: No content
- 400: Bad request
- 422: Validation error
- 500: Server error

## Transactions

Database operations are wrapped in transactions to ensure data integrity.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
