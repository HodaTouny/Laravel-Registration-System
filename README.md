# User Registration System

## Description
This project is a user registration system developed using Laravel. It allows users to register by providing personal details and validates the input data both client-side and server-side. Additionally, it sends an automatic email notification upon successful registration. The system also supports multiple languages using Laravel's multi-language feature.

## Features
1. **User Registration Form**: Allows users to register by providing personal details.
2. **Client-side Validation**: Ensures all form fields are mandatory and have correct data types.
3. **Server-side Validation**: Checks if the username is not already registered before allowing submission.
4. **Automatic Email Notification**: Sends an email notification titled "New registered user" upon successful registration.
5. **Multi-language Support**: Supports English and Arabic languages for the registration form and website content.
6. **Header and Footer**: Includes a custom header and footer design in the registration webpage.
7. **IMDb API Integration**: Allows users to check actors born on the same day as their birthdate.

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/your/repository.git
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Copy `.env.example` to `.env` and configure your environment variables:
   ```bash
   cp .env.example .env
   ```

4. Generate application key:
   ```bash
   php artisan key:generate
   ```

5. Set up your database in the `.env` file:
   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravelregisterdb
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Migrate the database:
   ```bash
   php artisan migrate
   ```

7. Run the server:
   ```bash
   php artisan serve
   ```
