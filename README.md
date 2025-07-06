# 📚 Aplikasi Toko Buku Online

Aplikasi berbasis web yang memungkinkan pelanggan untuk **melihat, memilih, membeli, dan membayar buku secara online**. Admin dapat melakukan manajemen data buku, mengelola pesanan, dan memantau statistik penjualan melalui dashboard.

---

## ✨ Fitur Utama

### 🔹 Untuk Pelanggan
- **Katalog Buku**  
  Menampilkan daftar lengkap buku beserta kategori, penulis, harga, dan deskripsi.

- **Pencarian & Filter**  
  Memudahkan pencarian buku berdasarkan judul, penulis, atau kategori.

- **Keranjang Belanja & Checkout**  
  Tambahkan buku ke keranjang dan lanjutkan ke proses pembayaran.

---

### 🔹 Untuk Admin
- **Manajemen Buku (CRUD)**  
  Tambah, ubah, hapus, dan kelola data buku dan kategori.

- **Statistik Penjualan**  
  Dashboard yang menampilkan data penjualan, pendapatan, dan buku terlaris.

---

## 🛠️ Teknologi yang Digunakan

**Frontend:**  
- HTML5, Tailwind CSS, JavaScript  
- Blade Template (Laravel)  
- Tailwind CSS / Bootstrap  

**Backend:**  
- PHP 8.x  
- Laravel Framework  
- Eloquent ORM  

**Database:**  
- MySQL / MariaDB  

**Dashboard & Statistik:**  
- Chart.js 

---

## 🚀 Alur Penggunaan

### Pelanggan:
1. Mengakses halaman utama toko buku.
2. Melihat dan mencari buku yang tersedia.
3. Menambahkan buku ke keranjang belanja.
4. Melakukan checkout dan pembayaran.
5. Mendapatkan notifikasi dan melihat riwayat pesanan.

### Admin:
1. Login ke dashboard admin.
2. Mengelola data buku dan kategori.
3. Memonitor data penjualan melalui grafik dan statistik.

---

## 📦 Instalasi Aplikasi Toko Buku Laravel

Pastikan sudah terpasang: PHP ≥ 8.0, Composer,MySQL/MariaDB, Git.

### Langkah Instalasi Cepat:

```bash
# 1. Clone repositori
git clone https://github.com/namakamu/bookstore-app.git
cd bookstore-app

# 2. Install dependency backend Laravel
composer install

# 3. Install dependency frontend (CSS & JS)
npm install && npm run dev

# 4. Salin file konfigurasi environment
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Buat database di MySQL (manual atau gunakan CLI)
# Contoh:
# CREATE DATABASE toko_buku;

# 7. Edit file .env dan sesuaikan konfigurasi database:
# DB_DATABASE=toko_buku
# DB_USERNAME=root
# DB_PASSWORD=

# 8. Jalankan migrasi & seed data (opsional)
php artisan migrate --seed

# 9. Jalankan server lokal Laravel
php artisan serve

