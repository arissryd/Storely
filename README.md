# Storely - Aplikasi Manajemen Penjualan (UAS)

## 📝 Penjelasan (Summary)
Storely adalah aplikasi manajemen transaksi penjualan berbasis web yang dirancang untuk mempermudah pencatatan, pemantauan, serta pelaporan data penjualan secara efisien. Aplikasi ini memproses seluruh logika bisnis secara terpusat di sisi backend Laravel serta mendukung fitur ekspor dokumen formal berupa laporan Excel dan PDF murni tanpa mengandalkan fitur bawaan browser.

## 🛠️ Stack / Teknis
* **Bahasa Pemrograman & Framework:** PHP 8.3+ / Laravel 13
* **Database:** MySQL / SQLite (Relational Database Management System)
* **Pustaka Pihak Ketiga (Packages):**
  * `barryvdh/laravel-dompdf` (Komponen cetak dokumen PDF via backend)
  * `maatwebsite/excel` (Komponen ekspor spreadsheet Excel `.xlsx` via backend)
* **AI Recommendation:** *Tidak diterapkan (Tidak ada/Opsional)*

## 🔄 Flow Aplikasi (Garis Besar)
1. **Autentikasi & Dashboard:** Pengguna masuk ke sistem dan disuguhkan halaman dashboard utama yang menampilkan rangkuman performa toko serta ringkasan total transaksi penjualan (*sales*).
2. **Manajemen Transaksi (CRUD Modul):** Pengguna mengelola data transaksi penjualan secara interaktif, yang mencakup input data penjualan baru, menampilkan riwayat transaksi lengkap dengan detail produk dan kuantitas (*qty*), serta melakukan pembaruan atau penghapusan data.
3. **Ekspor & Pelaporan Backend:** Ketika pengguna menekan tombol unduh laporan, request dikirim ke Controller backend. Sistem akan memproses data koleksi dari database, memetakan kolom secara otomatis (termasuk penomoran otomatis nota seperti `TRX-XXXX`), kemudian memicu unduhan langsung dokumen `.pdf` atau `.xlsx` yang sah kepada pengguna.
