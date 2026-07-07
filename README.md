# HR Management System

HR Management System is a Laravel-based web application for managing employee records, staff access, job positions, departments, rankings, and employee documents.

This project was created by:

- Christian Earl Juico - Backend
- Jayson Pascual - Frontend

This project is not 100% perfect because it is our first web application project. It was built as a learning project and may still need improvements, bug fixes, and additional polishing.

## Features

- Login system for staff and employees
- Staff dashboard
- Employee dashboard
- Employee record management
- Job and department management
- Ranking management
- Employee document upload and management
- Search functionality for employee records
- Custom dashboard layouts and styling

## Tech Stack

- Laravel 10
- PHP 8.1+
- MySQL or another Laravel-supported database
- Bootstrap 5
- Sass
- Vite
- JavaScript

## Project Structure

- `app/Http/Controllers` - application controllers
- `app/Models` - database models
- `database/migrations` - database table definitions
- `resources/views` - Blade templates for login, staff dashboard, and employee dashboard
- `public` - public CSS, JavaScript, fonts, and image assets
- `routes/web.php` - web routes

## Installation

1. Clone or download the project.

2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. Install Node dependencies:

   ```bash
   npm install
   ```

4. Create the environment file:

   ```bash
   cp .env.example .env
   ```

5. Generate the Laravel application key:

   ```bash
   php artisan key:generate
   ```

6. Configure the database settings in `.env`.

7. Run the database migrations:

   ```bash
   php artisan migrate
   ```

8. Add the starter data:

   ```bash
   php artisan store:data
   ```

9. Build or run the frontend assets:

   ```bash
   npm run dev
   ```

10. Start the Laravel development server:

    ```bash
    php artisan serve
    ```

11. Open the project in the browser:

    ```text
    http://127.0.0.1:8000
    ```

## Default Staff Accounts

After running `php artisan store:data`, the project creates these staff accounts:

| Username | Password | Role |
| --- | --- | --- |
| `jayson` | `pascual` | Manager |
| `christian` | `juico` | Manager |

## Notes

- Make sure your database is created before running migrations.
- The project uses custom guards for staff and employee login.
- Some parts of the project may still need validation, security improvements, UI polishing, and additional tests.

## Authors

- Christian Earl Juico - Backend Developer
- Jayson Pascual - Frontend Developer
