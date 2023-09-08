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

| Method | Route              |
|--------|--------------------|
| POST   | /api/auth/register |
| POST   | /api/auth/login    |
| POST   | /api/auth/logout   |
| PUT    | /api/auth/password |
| GET    | /api/company       |
| PUT    | /api/company       |
| GET    | /api/items         |
| GET    | /api/items/{id}    |
| POST   | /api/items         |
| PUT    | /api/items/{id}    |
| DEL    | /api/items/{id}    |
