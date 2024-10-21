# Laravel Vue Authentication Application

This project is a simple authentication system built using Laravel and Vue.js. It includes user registration, login, and a basic dashboard.

## Requirements

- PHP >= 8.0
- Composer
- Node.js and npm
- MySQL (or any database of choice)

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/mobidev86/laravel-vue-login.git
    ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

3. Set up the `.env` file:

    ```plaintext
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=root
    DB_PASSWORD=your_password
    ```

4. Run migrations:

    ```bash
    php artisan migrate
    ```

5. Install JavaScript dependencies:

    ```bash
    npm install
    ```

6. Compile assets:

    ```bash
    npm run dev or npm run build
    ```

7. Run the development server:

    ```bash
    php artisan serve
    ```
## Testing

### Running Laravel Tests

To run the Laravel backend tests, use the following command:

```bash
php artisan test
```

## Code Structure

- `app/Http/Controllers`: Contains backend controllers handling authentication logic.
- `resources/js/Pages/Auth`: Vue.js components for authentication.
- `routes/web.php`: Defines web routes, including protected routes.
- `resources/views`: Contains the Blade templates used with Inertia.js.
