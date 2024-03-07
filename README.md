<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP >= 7.4
- Composer (Dependency Manager for PHP)
- MySQL or any other compatible database system
  
## Installation

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/arieeefrahman/memento-mori.git
   ```

2. Navigate to the project directory:

   ```bash
   cd memento-mori
   ```

3. Install PHP dependencies using Composer:

   ```bash
   composer install
   ```

4. Copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

5. Update the `.env` file with your database credentials and other configurations.

6. Run database migrations:

   ```bash
   php artisan migrate
   ```

## Usage

To run the application locally, use the following command:

```bash
php artisan serve
```

The application will be accessible at `http://localhost:8000` by default.

## Additional Notes

- Make sure your web server is properly configured to serve a Laravel application.
- For production deployment, consider optimizing the application by running `php artisan optimize`.