## About Project

This is a simple CRUD Apis on products table with JWT Authentication

## Tech/framework used

<b>Built with</b>

-   [Laravel](https://laravel.com)

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/7.x/installation#installation)

Clone the repository

```
git clone https://github.com/NourhanAymanElstohy/product-backend.git
```

Switch to the repo folder

```
cd product-backend
```

Install all the dependencies using composer

```
composer install
```

Copy the example env file and make the required configuration changes in the .env file

```
cp .env.example .env
```

Generate a new application key

```
php artisan key:generate
```

Run the database migrations (**Set the database credentials in .env before migrating**)

```
php artisan migrate:fresh
```

Generate JWT KEY

```
php artisan jwt:secret
```

Start the local development server

```
php artisan serve
```

You can now access the server at http://127.0.0.1:8000

**Command List**

```
git clone https://github.com/NourhanAymanElstohy/product-backend.git
cd product-backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh
php artisan jwt:secret
php artisan serve
```
