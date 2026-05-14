# Smart Catalog - Platform Manajemen Katalog UMKM

Sistem Smart-Catalog adalah platform web untuk UMKM yang mampu mengelola ribuan produk dengan kategori yang fleksibel. Dibangun menggunakan Laravel 13 dengan arsitektur MVC, fitur authentication, middleware, file management, dan session management.

## 📋 Fitur Utama

### 1. ✅ Routing & Controller
- ✔ URL yang bersih dan SEO-friendly
- ✔ Struktur resource routing menggunakan convention Laravel
- ✔ Controller terpisah untuk setiap domain: Auth, Dashboard, Category, Product
- ✔ RESTful API routes untuk CRUD operations

### 2. ✅ Model
- ✔ Model User dengan relationships ke Category dan Product
- ✔ Model Category dengan merchant_id untuk multi-merchant support
- ✔ Model Product dengan foreign keys ke User dan Category
- ✔ Fillable attributes untuk mass assignment protection
- ✔ Relationships yang proper: hasMany, belongsTo

### 3. ✅ View Layouting (Template Inheritance)
- ✔ Master layout di `resources/views/layouts/app.blade.php`
- ✔ Navbar dengan user profile dropdown
- ✔ Sidebar navigasi responsive
- ✔ Alert notifications (success, warning, danger)
- ✔ Consistent styling dengan Bootstrap 5 dan custom CSS
- ✔ Icon integration dengan Bootstrap Icons

### 4. ✅ CRUD Kategori
- ✔ **Read (List)**: Menampilkan semua kategori dengan pagination
- ✔ **Create**: Form untuk membuat kategori baru
- ✔ **Update**: Form untuk edit kategori
- ✔ **Delete**: Soft delete protection dengan konfirmasi
- ✔ Validasi input dengan error messages
- ✔ Slug generator otomatis dari nama kategori

### 5. ✅ CRUD Produk
- ✔ **Read (List)**: Menampilkan produk dengan preview foto
- ✔ **Create**: Form dengan file upload untuk foto produk
- ✔ **Update**: Edit produk dengan opsi update foto
- ✔ **Delete**: Delete produk dan cleanup file storage
- ✔ Validasi file (type, size)
- ✔ Photo preview sebelum upload

### 6. ✅ Authentication & Session
- ✔ Register form dengan validasi password confirmation
- ✔ Login dengan email dan password
- ✔ Password hashing menggunakan bcrypt (otomatis)
- ✔ Session storage di database
- ✔ Session lifetime configuration
- ✔ Auto-login setelah registrasi
- ✔ Role-based system (merchant, admin)

### 7. ✅ Middleware (Filter)
- ✔ `EnsureUserIsAuthenticated`: Proteksi halaman yang memerlukan login
- ✔ `RedirectIfAuthenticated`: Redirect ke dashboard jika sudah login
- ✔ Applied pada routes yang tepat
- ✔ Custom permission checks di controller (merchant owns resource)

### 8. ✅ File Management
- ✔ Photo upload dengan validasi format (jpeg, png, jpg, gif)
- ✔ File size validation (max 2MB)
- ✔ Storage disk: public untuk akses langsung
- ✔ Automatic filename generation dengan timestamp
- ✔ Delete old file saat update produk
- ✔ Clean file path pada delete operasi
- ✔ Form enctype="multipart/form-data"

### 9. ✅ Integrated Dashboard
- ✔ Pesan selamat datang dinamis dengan nama user
- ✔ Statistics: Total kategori, Total produk
- ✔ Recent products list
- ✔ Quick action buttons
- ✔ Responsive design
- ✔ Tips and guidance

## 🏗️ Arsitektur Sistem

```
Smart-Catalog/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php        # Login, Register, Logout
│   │   │   ├── DashboardController.php   # Dashboard
│   │   │   ├── CategoryController.php    # CRUD Kategori
│   │   │   └── ProductController.php     # CRUD Produk
│   │   └── Middleware/
│   │       ├── EnsureUserIsAuthenticated.php
│   │       └── RedirectIfAuthenticated.php
│   └── Models/
│       ├── User.php
│       ├── Category.php
│       └── Product.php
├── database/
│   └── migrations/
│       ├── 2024_01_01_000001_create_users_table.php
│       ├── 2024_01_02_000001_create_categories_table.php
│       └── 2024_01_03_000001_create_products_table.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php             # Master layout
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── categories/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       ├── products/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       └── dashboard.blade.php
├── routes/
│   └── web.php                           # Route definitions
└── storage/
    └── app/
        └── public/
            └── products/                 # Product photos
```

## 🚀 Instalasi & Setup

### 1. Clone Repository
```bash
git clone <repository-url>
cd uts
```

### 2. Update Dependensi
```bash
composer install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=uts_catalog
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Buat Database
```bash
# Gunakan MySQL CLI atau phpMyAdmin
mysql -u root
CREATE DATABASE uts_catalog;
exit;
```

### 6. Jalankan Migrations
```bash
php artisan migrate
```

### 7. Setup Storage Link (untuk akses file foto)
```bash
php artisan storage:link
```

### 8. Jalankan Application
```bash
php artisan serve
```

Aplikasi akan berjalan di: `http://localhost:8000`

## 📝 Testing Manual

### Test Scenario 1: Register & Login
1. Buka `http://localhost:8000`
2. Klik "Daftar di sini"
3. Isi form dengan:
   - Nama: Merchant Test
   - Email: merchant@test.com
   - Password: password123
   - Konfirmasi: password123
4. Klik "Daftar Sekarang"
5. Akan otomatis login ke dashboard

### Test Scenario 2: Buat Kategori
1. Di dashboard, klik "Tambah Kategori"
2. Isi form:
   - Nama Kategori: Elektronik
   - Deskripsi: Produk elektronik dan gadget
3. Klik "Simpan Kategori"
4. Kategori berhasil ditambahkan dan tampil di list

### Test Scenario 3: Buat Produk dengan Foto
1. Di dashboard, klik "Tambah Produk"
2. Isi form:
   - Nama: Laptop ASUS VivoBook
   - Kategori: Elektronik (pilih)
   - Deskripsi: Laptop gaming dengan spesifikasi tinggi
   - Harga: 10000000
   - Stok: 5
   - Foto: Upload foto produk (max 2MB)
3. Klik "Simpan Produk"
4. Produk berhasil ditambahkan dengan foto

### Test Scenario 4: Edit & Delete
1. Di halaman list kategori/produk, klik tombol Edit
2. Ubah data sesuai kebutuhan
3. Klik "Perbarui"
4. Untuk delete, klik tombol Hapus dan konfirmasi

### Test Scenario 5: Middleware Protection
1. Login dengan akun test
2. Copy URL dashboard: `http://localhost:8000/dashboard`
3. Logout
4. Paste URL di browser
5. Akan redirect ke login page (middleware bekerja)

### Test Scenario 6: File Management
1. Upload foto produk dengan format berbeda (jpg, png, gif)
2. Upload foto dengan ukuran tepat 2MB (validation bekerja)
3. Coba upload file bukan gambar (akan error)
4. Edit produk dan update fotonya
5. Old photo akan terhapus, new photo disimpan

## 🔐 Keamanan Fitur

### Authentication
- ✔ Password hashing dengan bcrypt (otomatis melalui User model)
- ✔ Email uniqueness validation
- ✔ Password confirmation validation
- ✔ Session timeout (120 minutes)

### Authorization
- ✔ Middleware check untuk protected routes
- ✔ Controller check ownership (merchant hanya bisa edit kategori/produk miliknya)
- ✔ 403 Forbidden jika akses unauthorized resource

### File Upload
- ✔ Whitelist format file (jpeg, png, jpg, gif)
- ✔ Maximum file size (2MB)
- ✔ Sanitized filename dengan timestamp
- ✔ Stored di public disk untuk serving

### CSRF Protection
- ✔ @csrf token di semua form
- ✔ @method('DELETE') untuk non-GET requests

## 📊 Database Schema

### Users Table
```sql
- id (primary key)
- name (string)
- email (unique)
- password (hashed)
- role (enum: merchant, admin)
- created_at, updated_at
```

### Categories Table
```sql
- id (primary key)
- merchant_id (foreign key → users.id)
- name (unique)
- description (nullable)
- slug (unique)
- created_at, updated_at
```

### Products Table
```sql
- id (primary key)
- merchant_id (foreign key → users.id)
- category_id (foreign key → categories.id)
- name
- description (nullable)
- price (decimal)
- photo (nullable, path to file)
- stock (integer)
- created_at, updated_at
```

## 📱 UI/UX Features

### Responsive Design
- ✔ Mobile-first approach dengan Bootstrap 5
- ✔ Sidebar responsive (hidden pada mobile)
- ✔ Touch-friendly buttons dan inputs

### Visual Feedback
- ✔ Success alerts
- ✔ Warning/error messages
- ✔ Loading states
- ✔ Hover effects pada buttons dan cards
- ✔ Active menu indicators

### User Experience
- ✔ Clear navigation
- ✔ Intuitive form layouts
- ✔ Confirmation dialogs untuk destructive actions
- ✔ Empty state messages dengan CTA
- ✔ Quick tips dan guidelines

## 🐛 Troubleshooting

### Database Error
```
Solusi: Pastikan MySQL running dan database uts_catalog sudah dibuat
php artisan migrate:refresh (jika perlu reset)
```

### Storage Link Error
```
Solusi: Jalankan php artisan storage:link
Pastikan folder storage/app/public writable
```

### Photo Upload Tidak Muncul
```
Solusi: Pastikan storage:link sudah dijalankan
Check file di storage/app/public/products/
```

### Session Error
```
Solusi: Pastikan sessions table sudah ada (php artisan migrate)
Check DB_DATABASE di .env sesuai
```

## 📚 Teknologi yang Digunakan

- **Framework**: Laravel 13
- **Database**: MySQL
- **Frontend**: Bootstrap 5 + HTML/CSS/JavaScript
- **Icons**: Bootstrap Icons
- **Authentication**: Session-based
- **File Storage**: Local filesystem

## 👨‍💻 Developer Notes

### Model Relationships
- User → hasMany Categories
- User → hasMany Products
- Category → belongsTo User
- Category → hasMany Products
- Product → belongsTo User
- Product → belongsTo Category

### Validation Rules
- Email: required, email, unique
- Password: required, min:8, confirmed
- Name: required, min:3
- Category Name: unique
- Price: numeric, min:0
- Stock: integer, min:0
- Photo: image, mimes:jpeg,png,jpg,gif, max:2048

### Key Features Implementation
1. **Multi-merchant**: Setiap merchant hanya bisa lihat data miliknya
2. **Soft Slug**: Slug di-generate otomatis dari nama
3. **Image Optimization**: Filename + timestamp untuk avoid conflict
4. **Cascading Delete**: Hapus user → hapus semua categories dan products

## 📋 Checklist Fitur

- [x] Routing & Controller
- [x] Model dengan Relationships
- [x] View Layouting (Template Inheritance)
- [x] CRUD Kategori (Create, Read, Update, Delete)
- [x] CRUD Produk dengan file upload
- [x] Authentication (Login, Register)
- [x] Middleware Protection
- [x] Session Management
- [x] File Management dengan Validation
- [x] Integrated Dashboard dengan dynamic greeting
- [x] Multi-merchant support
- [x] Responsive UI dengan Bootstrap 5
- [x] Error handling dan validation

## 📞 Support

Untuk pertanyaan atau issue, silakan buat issue di repository atau hubungi developer.

---

**Version**: 1.0.0  
**Last Updated**: May 2026  
**Status**: Ready for Production
