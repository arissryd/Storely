# Storely - Smart Catalog & Management System (UAS PWL)

Proyek ini adalah aplikasi **Smart-Catalog (Storely)** yang dibangun menggunakan framework **Laravel** untuk memenuhi tugas besar Final Exam (UAS) mata kuliah Pemrograman Web Lanjut (PWL). Aplikasi ini dirancang untuk membantu manajemen UMKM dalam mengelola produk, transaksi penjualan, barang masuk, serta menyajikan analisis bisnis sederhana.

## 🚀 Fitur Utama
- **Dashboard Insight Bisnis:** Menampilkan metrik utama toko, peringatan otomatis untuk produk dengan stok kritis, serta rekomendasi strategi manajemen gudang dan penjualan.
- **Modul Transaksi Dual-Sistem:**
  - **Penjualan (Sales):** Pencatatan otomatis dengan format ID `TRX-XXXX` beserta kode merchant (`STORELY-01`).
  - **Barang Masuk (Stock In):** Pencatatan otomatis dengan format ID `STK-XXXX` yang langsung terintegrasi untuk menambah stok produk di database.
- **Sistem Pelaporan Ekspor:** Fitur cetak laporan dalam bentuk **Excel** dan **PDF** yang dinamis dan terfilter otomatis khusus untuk data transaksi penjualan.
- **Konfigurasi Sistem:** Menggunakan sinkronisasi zona waktu lokal `Asia/Jakarta` (WIB) untuk pencatatan waktu transaksi yang presisi.

## 🛠️ Tech Stack & Requirement
- **Framework:** Laravel
- **Database:** MySQL (XAMPP)
- **IDE:** Visual Studio Code
- **Waktu Sistem:** Asia/Jakarta (WIB)