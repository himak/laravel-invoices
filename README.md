# Invoices Laravel App

This is simple presentation app for creating invoices in PHP framework Laravel.

First create database e.g. with name **invoices**

Rename file **.env.example** to **.env** and fill access to database.

Run this commands:

	composer install
    php artisan migrate --seed
    php artisan key:generate
    php artisan serve

Open browser:

    http://localhost:8000

And fill logins:

    login: admin@mail.test
    pass: Admin@123

First step fill company information in Settings and next create customer, items and invoice.

## API routes

    php artisan route:list

#### Code style fixer

    ./vendor/bin/pint

#### Analyze code with PHPStan

    ./vendor/bin/phpstan analyse

#### Analyze code with PHP CS fixer

    ./vendor/bin/php-cs-fixer fix app 


