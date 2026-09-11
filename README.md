# 📚 Library Management System

![Symfony](https://img.shields.io/badge/Symfony-7-000000?logo=symfony)
![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?logo=bootstrap)

A Symfony 7 web application to manage a small library — book catalogue, loans
with business rules, and a role-based dashboard for members and administrators.

## ✨ Features

**For members**
- Search books by title, author or ISBN
- View book availability in real time
- Request loans (maximum 3 active at a time)
- View active loans and loan history
- Return books
- Personal profile with usage statistics

**For administrators**
- Full book management (create, edit, delete)
- View all loans with filters
- Dashboard with library-wide statistics
- Track overdue loans

## 🛠️ Tech Stack

PHP 8.3 · Symfony 7 · Doctrine ORM · MySQL · Twig · Bootstrap 5

## 🚀 Getting Started

```bash
git clone https://github.com/SoniaDL90/BIBLIOTECA.git
cd BIBLIOTECA
composer install
```

Configure your database in `.env.local` (see `.env.example` for the format):
```
DATABASE_URL="mysql://user:password@127.0.0.1:3306/biblioteca?serverVersion=8.0&charset=utf8mb4"
```

```bash
php bin/console doctrine:database:create
php bin/console doctrine:schema:create
php bin/console doctrine:fixtures:load
symfony serve -d
```

Then open http://127.0.0.1:8000 in your browser.

## 👤 Test Users

| Role | Email | Password |
|------|-------|----------|
| Administrator | admin@biblioteca.com | admin1234 |
| Member | user1@biblioteca.com | user1234 |
| Member | user2@biblioteca.com | user1234 |
| Member | user3@biblioteca.com | user1234 |
| Member | user4@biblioteca.com | user1234 |
