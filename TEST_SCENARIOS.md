# 🧪 Smart Catalog - Test Scenarios & Manual Testing Guide

## Informasi Login Test

**Email:** merchant@test.com  
**Password:** password123  
**Role:** Merchant

---

## 📋 Test Scenario 1: Authentication Flow

### 1.1 Test Login
**Objective:** Verify login functionality works correctly

1. Open browser ke `http://localhost:8000`
2. Klik link "Login di sini" atau langsung ke `/login`
3. **Expected:** Halaman login ditampilkan dengan form yang valid
4. Isi form:
   - Email: `merchant@test.com`
   - Password: `password123`
5. Klik tombol "Login"
6. **Expected:** Redirect ke dashboard dengan pesan "Login berhasil!"
7. **Check:** Session user_name ditampilkan di navbar

### 1.2 Test Register
**Objective:** Verify user registration works correctly

1. Di halaman login, klik "Daftar di sini"
2. **Expected:** Halaman register ditampilkan
3. Isi form:
   - Nama Lengkap: `Merchant Baru`
   - Email: `merchant_baru@test.com`
   - Password: `newpassword123`
   - Konfirmasi Password: `newpassword123`
4. Klik "Daftar Sekarang"
5. **Expected:** 
   - Redirect ke dashboard
   - Pesan "Registrasi berhasil!"
   - User baru sudah login otomatis

### 1.3 Test Middleware Protection
**Objective:** Verify protected routes require authentication

1. Logout dari aplikasi
2. Buka URL langsung: `http://localhost:8000/dashboard`
3. **Expected:** Redirect ke halaman login dengan pesan "Silakan login terlebih dahulu"
4. Coba akses: `http://localhost:8000/categories`
5. **Expected:** Redirect ke login juga

### 1.4 Test Invalid Credentials
**Objective:** Verify error handling for invalid login

1. Di halaman login, isi dengan email yang tidak ada: `notexist@test.com`
2. Isi password: `password123`
3. Klik "Login"
4. **Expected:** Halaman login ditampilkan kembali dengan error message "Email atau password tidak sesuai"

---

## 📋 Test Scenario 2: Dashboard

### 2.1 Test Dashboard Display
**Objective:** Verify dashboard shows correct information

1. Login dengan akun test
2. **Expected:** Halaman dashboard ditampilkan
3. **Verify:**
   - ✓ Greeting message: "Selamat datang, Merchant Test! 👋"
   - ✓ Total kategori: 3
   - ✓ Total produk: 0
   - ✓ Recent products section (should be empty)

### 2.2 Test Dashboard Quick Actions
**Objective:** Verify quick action buttons work

1. Di dashboard, klik tombol "Tambah Kategori"
2. **Expected:** Redirect ke halaman create kategori
3. Kembali ke dashboard
4. Klik tombol "Tambah Produk"
5. **Expected:** Redirect ke halaman create produk

---

## 📋 Test Scenario 3: Category Management (CRUD)

### 3.1 Test Read (List) Categories
**Objective:** Verify list kategori ditampilkan dengan benar

1. Login dan buka menu "Kategori"
2. **Expected:**
   - ✓ List dengan 3 kategori yang sudah ada (dari seeder)
   - ✓ Kolom: No, Nama, Deskripsi, Slug, Tanggal, Aksi
   - ✓ Tombol Edit dan Hapus di setiap baris

### 3.2 Test Create Category
**Objective:** Verify membuat kategori baru

1. Di halaman kategori, klik "Tambah Kategori"
2. Isi form:
   - Nama Kategori: `Furniture`
   - Deskripsi: `Perabotan rumah dan kantor berkualitas`
3. Klik "Simpan Kategori"
4. **Expected:**
   - ✓ Redirect ke halaman list kategori
   - ✓ Success message: "Kategori berhasil ditambahkan"
   - ✓ Kategori baru muncul di list (total menjadi 4)

### 3.3 Test Create Category Validation
**Objective:** Verify validasi kategori

**Test 3.3a - Duplicate Name**
1. Klik "Tambah Kategori"
2. Isi Nama: `Elektronik` (sama dengan yang sudah ada)
3. Klik "Simpan"
4. **Expected:** Error message "Nama kategori sudah ada"

**Test 3.3b - Empty Name**
1. Klik "Tambah Kategori"
2. Kosongkan field Nama
3. Klik "Simpan"
4. **Expected:** Error message "Nama kategori harus diisi"

**Test 3.3c - Name Too Short**
1. Klik "Tambah Kategori"
2. Isi Nama: `AB` (2 karakter)
3. Klik "Simpan"
4. **Expected:** Error message "Nama kategori minimal 3 karakter"

### 3.4 Test Update Category
**Objective:** Verify edit kategori

1. Di list kategori, klik tombol Edit pada kategori `Furniture`
2. **Expected:** Halaman edit ditampilkan dengan data yang sudah terisi
3. Ubah:
   - Nama: `Furniture & Dekorasi`
   - Deskripsi: `Perabotan dan dekorasi rumah premium`
4. Klik "Perbarui Kategori"
5. **Expected:**
   - ✓ Redirect ke list
   - ✓ Success message: "Kategori berhasil diperbarui"
   - ✓ Data kategori berubah di list

### 3.5 Test Delete Category
**Objective:** Verify hapus kategori

1. Di list kategori, klik tombol Hapus pada kategori `Furniture & Dekorasi`
2. **Expected:** Dialog konfirmasi muncul
3. Klik "OK" untuk confirm
4. **Expected:**
   - ✓ Redirect ke list
   - ✓ Success message: "Kategori 'Furniture & Dekorasi' berhasil dihapus"
   - ✓ Kategori tidak ada di list lagi

---

## 📋 Test Scenario 4: Product Management (CRUD)

### 4.1 Test Create Product with Photo
**Objective:** Verify membuat produk dengan foto

1. Login dan buka menu "Produk"
2. Klik "Tambah Produk"
3. Isi form:
   - Nama Produk: `Laptop ASUS VivoBook 15`
   - Kategori: `Elektronik`
   - Deskripsi: `Laptop gaming dengan prosesor Intel i7 dan RAM 16GB`
   - Harga: `9500000`
   - Stok: `5`
   - Foto: Upload foto produk (format PNG/JPG, max 2MB)
4. **Verify:** Preview foto muncul sebelum submit
5. Klik "Simpan Produk"
6. **Expected:**
   - ✓ Redirect ke list produk
   - ✓ Success message: "Produk berhasil ditambahkan"
   - ✓ Produk baru muncul di list dengan foto

### 4.2 Test Product Photo Validation
**Objective:** Verify validasi file foto

**Test 4.2a - No Photo**
1. Klik "Tambah Produk"
2. Isi semua field kecuali foto
3. Klik "Simpan"
4. **Expected:** Error message "Foto produk harus diunggah"

**Test 4.2b - Invalid File Type**
1. Klik "Tambah Produk"
2. Upload file text (.txt) atau PDF
3. Klik "Simpan"
4. **Expected:** Error message "File harus berupa gambar"

**Test 4.2c - File Too Large**
1. Klik "Tambah Produk"
2. Upload gambar > 2MB
3. Klik "Simpan"
4. **Expected:** Error message "Ukuran gambar maksimal 2MB"

### 4.3 Test Read (List) Products
**Objective:** Verify list produk

1. Di halaman produk
2. **Expected:**
   - ✓ Kolom: No, Foto, Nama, Kategori, Harga, Stok, Tanggal, Aksi
   - ✓ Foto produk ditampilkan dengan ukuran kecil (thumbnail)
   - ✓ Harga ditampilkan dengan format Rupiah (e.g., "Rp 9.500.000")
   - ✓ Status stok ditampilkan dengan badge

### 4.4 Test Update Product
**Objective:** Verify edit produk

1. Di list produk, klik Edit pada produk yang baru dibuat
2. **Expected:** Halaman edit ditampilkan dengan data terisi
3. Ubah:
   - Harga: `8500000`
   - Stok: `10`
4. **Jangan ubah foto**
5. Klik "Perbarui Produk"
6. **Expected:**
   - ✓ Data produk berubah
   - ✓ Foto lama tetap digunakan
   - ✓ Pesan success: "Produk berhasil diperbarui"

### 4.5 Test Update Product Photo
**Objective:** Verify update foto produk

1. Di list produk, klik Edit
2. Upload foto baru
3. **Expected:** Preview foto baru muncul
4. Klik "Perbarui Produk"
5. **Expected:**
   - ✓ Foto lama dihapus dari storage
   - ✓ Foto baru ditampilkan di list
   - ✓ Akses ke URL foto lama akan error/404

### 4.6 Test Delete Product
**Objective:** Verify hapus produk dan cleanup file

1. Di list produk, klik Hapus
2. Confirm dialog
3. **Expected:**
   - ✓ Produk dihapus dari list
   - ✓ Foto produk dihapus dari storage
   - ✓ Success message

---

## 📋 Test Scenario 5: File Management

### 5.1 Test Storage Link
**Objective:** Verify foto dapat diakses via URL

1. Upload produk dengan foto
2. Copy path foto: `storage/products/xxxxx.jpg`
3. Akses di URL: `http://localhost:8000/storage/products/xxxxx.jpg`
4. **Expected:** Foto dapat ditampilkan di browser

### 5.2 Test Multiple File Formats
**Objective:** Verify semua format file didukung

Upload produk dengan format:
- ✓ JPEG (.jpg)
- ✓ PNG (.png)
- ✓ GIF (.gif)

**Expected:** Semua berhasil diupload dan ditampilkan

### 5.3 Test Concurrent File Upload
**Objective:** Verify tidak ada konflik nama file

1. Upload 2 produk dengan foto yang sama (filename sama)
2. **Expected:** Filename di-generate dengan timestamp, tidak ada overwrite

---

## 📋 Test Scenario 6: Session Management

### 6.1 Test Session Persistence
**Objective:** Verify session data tersimpan

1. Login dengan merchant@test.com
2. Refresh halaman dashboard
3. **Expected:** Session tetap aktif, user masih login

### 6.2 Test Logout
**Objective:** Verify logout menghapus session

1. Login
2. Di navbar, dropdown menu user
3. Klik "Logout"
4. **Expected:**
   - ✓ Redirect ke halaman login
   - ✓ Success message: "Logout berhasil"
   - ✓ Session dihapus

### 6.3 Test Session Timeout
**Objective:** Verify session timeout (opsional)

1. Login
2. Tunggu atau ubah SESSION_LIFETIME di .env menjadi 1 menit
3. Tunggu session timeout
4. Coba akses halaman protected
5. **Expected:** Redirect ke login

---

## 📋 Test Scenario 7: Multi-Merchant Isolation

### 7.1 Test User Data Isolation
**Objective:** Verify setiap merchant hanya bisa lihat data miliknya

1. Login dengan merchant@test.com (merchant 1)
2. Buat kategori & produk
3. Logout
4. Register akun baru (merchant 2)
5. **Expected:**
   - ✓ Merchant 2 tidak melihat kategori/produk milik merchant 1
   - ✓ Total kategori merchant 2 = 0
   - ✓ List kategori kosong

### 7.2 Test Authorization Check
**Objective:** Verify tidak bisa edit resource orang lain

1. Dari akun merchant 1, buka developer console
2. Ambil ID kategori milik merchant 1
3. Logout dan login sebagai merchant 2
4. Buka URL: `/categories/{merchant1_category_id}/edit`
5. **Expected:** Error 403 Forbidden "Anda tidak memiliki akses ke kategori ini"

---

## 📋 Test Scenario 8: UI/UX & Responsiveness

### 8.1 Test Layout Consistency
**Objective:** Verify layout konsisten di semua halaman

1. Buka berbagai halaman (dashboard, categories, products, etc)
2. **Expected:**
   - ✓ Navbar selalu di atas
   - ✓ Sidebar selalu di kiri
   - ✓ Content area konsisten

### 8.2 Test Mobile Responsiveness
**Objective:** Verify aplikasi responsive di mobile

1. Buka di mobile browser atau gunakan developer tools responsive mode
2. Ukuran: 375px (iPhone SE)
3. **Expected:**
   - ✓ Sidebar hidden atau collapsed
   - ✓ Menu dapat diakses via hamburger
   - ✓ Tabel menjadi scrollable
   - ✓ Buttons tetap clickable

### 8.3 Test Dark Mode (Opsional)
**Objective:** Verify contrast dan readability

1. Periksa contrast ratio dengan tools accessibility
2. **Expected:** WCAG AA compliant

---

## 📋 Test Scenario 9: Error Handling

### 9.1 Test Database Error Handling
**Objective:** Verify error handling graceful

1. Disconnect database
2. Coba akses halaman
3. **Expected:** Error message yang user-friendly (bukan raw SQL error)

### 9.2 Test File Upload Error
**Objective:** Verify error handling saat file error

1. Upload file dengan permission issue (jika bisa simulate)
2. **Expected:** Error message yang jelas

### 9.3 Test Form Validation Error Display
**Objective:** Verify error messages ditampilkan dengan baik

1. Submit form dengan data invalid
2. **Expected:**
   - ✓ Alert box menampilkan daftar error
   - ✓ Form fields dengan class "is-invalid"
   - ✓ Error messages jelas dan helpful

---

## 📋 Test Scenario 10: Performance

### 10.1 Test Page Load Time
**Objective:** Verify performa

1. Open DevTools > Network tab
2. Load dashboard
3. **Expected:** Load time < 2 detik (untuk server lokal)

### 10.2 Test Pagination
**Objective:** Verify pagination bekerja

1. Create 15+ kategori
2. Di halaman list kategori, verify pagination muncul (default 10 per page)
3. Klik page 2
4. **Expected:** Kategori page 2 ditampilkan

---

## 🐛 Troubleshooting Test

Jika mengalami masalah saat testing:

| Issue | Solusi |
|-------|--------|
| Foto tidak muncul | Jalankan `php artisan storage:link` |
| Session error | Ensure DB sudah migrate, sessions table ada |
| 404 Routes | Cek routes/web.php sudah benar |
| File upload error | Cek storage/app/public permissions |
| Database error | Ensure MySQL running, `.env` benar |

---

## ✅ Final Checklist

Sebelum submit, pastikan semua test passed:

- [ ] Auth: Login, Register, Logout bekerja
- [ ] Middleware: Protected routes memerlukan login
- [ ] Dashboard: Menampilkan greeting & statistics
- [ ] CRUD Kategori: Create, Read, Update, Delete semuanya bekerja
- [ ] CRUD Produk: Create, Read, Update, Delete semuanya bekerja
- [ ] File Upload: Foto terupload, validasi bekerja
- [ ] File Access: Foto dapat diakses via URL
- [ ] File Cleanup: Old files dihapus saat update/delete
- [ ] Validation: Error messages menampilkan dengan benar
- [ ] Multi-merchant: Data isolation bekerja
- [ ] Authorization: Cannot access other user's resources
- [ ] UI: Responsive dan konsisten
- [ ] Performance: Load time acceptable

---

## 📸 Screenshot Evidence

Untuk submission, include screenshots of:
1. Login page
2. Dashboard dengan greeting
3. Categories list
4. Create category success
5. Products list dengan foto
6. Create product with photo upload
7. Edit product
8. Delete confirmation
9. Error validation
10. Mobile responsive view

---

**Last Updated:** May 2026  
**Status:** Ready for Testing
