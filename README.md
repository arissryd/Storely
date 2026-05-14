# 🛒 Smart Catalog - Platform Manajemen Katalog UMKM

Platform web berbasis Laravel 13 untuk memudahkan UMKM dalam mengelola ribuan produk dengan kategori yang fleksibel.

![Laravel](https://img.shields.io/badge/Laravel-13.x-red.svg)
![PHP](https://img.shields.io/badge/PHP-^8.3-blue.svg)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-orange.svg)
![License](https://img.shields.io/badge/License-MIT-green.svg)

## ✨ Fitur Utama

### 🔐 Security & Authentication
- User registration dengan validasi email
- Login dengan enkripsi password bcrypt
- Session management berbasis database
- Middleware protection untuk protected routes
- Role-based access control (Merchant/Admin)

### 📦 Product Management
- CRUD lengkap untuk kategori dan produk
- Multi-merchant support dengan data isolation
- Slug generation otomatis untuk kategori
- Harga, stok, dan deskripsi produk yang flexible

### 📸 File Management
- Upload foto produk dengan validasi
- Supported formats: JPEG, PNG, JPG, GIF
- Maximum file size: 2MB
- Automatic cleanup saat update/delete
- Public access via storage link

### 📊 Dashboard
- Welcome message dinamis berdasarkan user
- Statistics: Total kategori, total produk
- Recent products list
- Quick action buttons

### 🎨 User Interface
- Bootstrap 5 responsive design
- Template inheritance/layouting
- Navbar dengan user dropdown
- Responsive sidebar navigation
- Alert notifications (success, warning, danger)

## 🚀 Quick Start

### Prerequisites
- PHP 8.3+
- MySQL 5.7+
- Composer
- XAMPP atau sejenisnya

### Installation

1. **Clone repository**
   ```bash
   git clone <repository-url>
   cd uts
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database** - Edit `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=uts_catalog
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Create database**
   ```bash
   mysql -u root
   CREATE DATABASE uts_catalog;
   exit;
   ```

6. **Run migrations & seed**
   ```bash
   php artisan migrate:refresh --seed
   ```

7. **Create storage link**
   ```bash
   php artisan storage:link
   ```

8. **Start development server**
   ```bash
   php artisan serve
   ```

   Akses aplikasi di: **http://localhost:8000**

## 🧪 Test Account

| Field | Value |
|-------|-------|
| Email | merchant@test.com |
| Password | password123 |

## 📁 Project Structure

```
smart-catalog/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── CategoryController.php
│   │   │   └── ProductController.php
│   │   └── Middleware/
│   │       ├── EnsureUserIsAuthenticated.php
│   │       └── RedirectIfAuthenticated.php
│   └── Models/
│       ├── User.php
│       ├── Category.php
│       └── Product.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php (Master layout)
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── categories/
│       ├── products/
│       └── dashboard.blade.php
└── routes/
    └── web.php
```

## 🗄️ Database Schema

### Users Table
```sql
id (PK) | name | email (UNIQUE) | password (hashed) | role | timestamps
```

### Categories Table
```sql
id (PK) | merchant_id (FK) | name (UNIQUE) | description | slug (UNIQUE) | timestamps
```

### Products Table
```sql
id (PK) | merchant_id (FK) | category_id (FK) | name | description | price | photo | stock | timestamps
```

## 📖 API Routes

### Authentication
```
POST   /login          - Login user
POST   /register       - Register new user
POST   /logout         - Logout user
```

### Dashboard
```
GET    /dashboard      - View dashboard
```

### Categories
```
GET    /categories           - List categories
GET    /categories/create    - Create form
POST   /categories           - Store category
GET    /categories/{id}/edit - Edit form
PUT    /categories/{id}      - Update category
DELETE /categories/{id}      - Delete category
```

### Products
```
GET    /products           - List products
GET    /products/create    - Create form
POST   /products           - Store product (with file upload)
GET    /products/{id}/edit - Edit form
PUT    /products/{id}      - Update product
DELETE /products/{id}      - Delete product
```

## 🔒 Security Features

✅ Password hashing dengan bcrypt  
✅ CSRF protection di semua forms  
✅ SQL injection prevention dengan parameterized queries  
✅ File upload validation  
✅ Session-based authentication  
✅ Middleware authorization checks  
✅ Ownership verification pada resource updates  

## 📱 Responsive Design

- Mobile-first approach
- Tested on various screen sizes:
  - ✓ Mobile (320px - 480px)
  - ✓ Tablet (768px - 1024px)
  - ✓ Desktop (1024px+)

## 🧪 Testing Guide

Lihat file `TEST_SCENARIOS.md` untuk comprehensive testing guide dengan:
- Login/Register testing
- CRUD operations testing
- File upload validation
- Session management
- Multi-merchant isolation
- UI/UX responsiveness
- Error handling
- Performance testing

## 📝 Documentation

- **IMPLEMENTATION.md** - Detailed implementation guide
- **TEST_SCENARIOS.md** - Comprehensive test scenarios
- **README.md** - This file

## 🐛 Troubleshooting

### Storage Link Error
```bash
php artisan storage:link
```

### Database Migration Error
```bash
php artisan migrate:refresh
```

### Session/Database Error
Pastikan MySQL running dan `.env` configuration benar

## 🤝 Contributing

1. Create feature branch
2. Make changes
3. Commit dengan clear messages
4. Push to repository

## 📄 License

This project is open-sourced under the MIT license.

## 👨‍💻 Author

Smart Catalog Development Team  
**Version:** 1.0.0  
**Last Updated:** May 2026

---

**Status:** ✅ Ready for Production

Untuk informasi lebih lanjut, lihat dokumentasi yang tersedia di folder ini.


- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
