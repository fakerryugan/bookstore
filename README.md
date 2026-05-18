## Aplikasi E-Commerce Bookstore (Toko Buku Online)

---

### Identitas Pengembang
* **Nama**: FATKUR ROHMAN IRHAM    
* **Kampus**: POITEKNIK NEGERI BANYUWANGI
* **Program Studi / Jurusan**: TRPL


---

## Tentang Aplikasi
Aplikasi **Bookstore** adalah sebuah platform e-commerce (toko buku online) modern berbasis web yang dirancang khusus untuk memenuhi standar skema sertifikasi BNSP / Ujian Kompetensi Keahlian (UKK). 

Aplikasi ini memfasilitasi transaksi jual-beli buku secara online mulai dari pencarian buku, pengelolaan keranjang, pemilihan alamat pengiriman multi-address, integrasi payment gateway otomatis menggunakan Xendit maupun metode manual, hingga layanan bantuan pelanggan secara langsung menggunakan sistem chatting real-time.

---

##  Fitur Utama Aplikasi

### Fitur Sisi Pelanggan (Customer)
1. **Pendaftaran & Autentikasi Akun**: Pendaftaran mandiri dengan fitur **Verifikasi Email** demi keamanan akun.
2. **Katalog Buku & Filter Lanjutan**: Pencarian judul buku, penulis, penerbit, serta filter berdasarkan Kategori Buku dan rentang harga.
3. **Sistem Alamat Pengiriman (Multi-address)**: Fitur menambahkan banyak alamat pengiriman, menghapus alamat, dan menentukan salah satu sebagai Alamat Utama (Default).
4. **Keranjang Belanja (Cart System)**: Menambah, mengubah kuantitas, dan menghapus buku dari keranjang belanja sebelum checkout.
5. **Checkout & Metode Pembayaran**:
   * **Pembayaran Otomatis**: Integrasi payment gateway **Xendit** (Invoice API) menggunakan mata uang IDR dengan status pembayaran yang tersinkronisasi otomatis via Callback.
   * **Pembayaran Manual**: Pilihan transfer bank manual sebelum proses pengiriman buku.
6. **Riwayat Transaksi & Pelacakan**: Halaman dasbor pelanggan untuk memantau invoice pembayaran, status pengiriman barang (`menunggu` / `dikirim`), dan fitur pembatalan transaksi yang belum dibayar.
7. **Chat Bantuan Pelanggan Real-time**: Mengirimkan pesan bantuan langsung ke admin menggunakan teknologi WebSocket tanpa perlu melakukan refresh halaman.

### Fitur Sisi Admin (Admin Panel)
1. **Dashboard Metrik & Ringkasan**: Statistik pendapatan total, stok buku rendah, jumlah pelanggan terdaftar, dan log aktivitas transaksi terbaru.
2. **Kelola Buku (CRUD)**: Manajemen data buku meliputi judul, penulis, penerbit, stok, harga, deskripsi, pemilihan kategori, serta unggah sampul buku.
3. **Kelola Kategori (CRUD)**: Manajemen kategori pengelompokan buku.
4. **Kelola Pelanggan (CRUD)**: Mengelola akun-akun pelanggan terdaftar di sistem.
5. **Kelola Transaksi & Pengiriman**: Konfirmasi manual pembayaran pelanggan, pembatalan pesanan, dan pembaruan status pengiriman barang dari status `menunggu` menjadi `dikirim`.
6. **Chat Pelanggan (Admin Chat Hub)**: Membalas chat bantuan dari semua pelanggan secara real-time melalui halaman antarmuka pesan tunggal yang dinamis.

---

## Arsitektur & Teknologi

* **Framework Utama**: Laravel 11 (PHP 8.2+)
* **Database**: MySQL / SQLite (mendukung migrasi schema & seeder)
* **Real-time Engine**: Laravel Reverb (WebSocket server bawaan) & Laravel Echo
* **Frontend styling**: Vanilla CSS & TailwindCSS (untuk estetika premium modern & responsive layout)
* **Build Tools**: Vite (kompilasi aset JS/CSS ultra-cepat)
* **Payment Gateway**: SDK Resmi Xendit untuk Invoice Generation & Webhook callback handler

---

## Petunjuk Instalasi & Menjalankan Project

### 1. Prasyarat Sistem
* PHP >= 8.2 (dilengkapi ekstensi `intl`, `sqlite3`, `pdo_mysql`)
* Composer (Dependency Manager untuk PHP)
* Node.js & NPM (untuk aset kompilasi JS/Tailwind)
* Web Server (Apache/Nginx/Artisan Serve)

### 2. Langkah-Langkah Instalasi

1. **Salin Folder Project** ke direktori server lokal Anda (misal `C:/laragon/www/bookstore` atau `C:/xampp/htdocs/bookstore`).
2. **Pasang PHP Dependencies**:
   ```bash
   composer install
   ```
3. **Pasang Node.js Dependencies**:
   ```bash
   npm install
   ```
4. **Salin Konfigurasi Environment**:
   Duplikat file `.env.example` dan ubah namanya menjadi `.env`:
   ```powershell
   copy .env.example .env
   ```
5. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```
6. **Konfigurasi Database & Layanan** (Buka berkas `.env`):
   * Atur koneksi database sesuai server Anda (SQLite/MySQL).
   * Masukkan API Keys Xendit pada variabel di berkas `.env` jika ingin menguji pembayaran online:
     ```env
     XENDIT_SECRET_KEY=xnd_development_...
     ```
7. **Jalankan Migrasi & Database Seeding**:
   Buat tabel database beserta data bawaan (kategori buku, buku sampel, dan akun administrator):
   ```bash
   php artisan migrate --seed
   ```
8. **Kompilasi Aset Frontend (Vite)**:
   ```bash
   npm run dev
   ```
9. **Jalankan Server WebSocket (Laravel Reverb)**:
   Agar fitur chat real-time berfungsi, jalankan server WebSocket di terminal terpisah:
   ```bash
   php artisan reverb:start
   ```
10. **Jalankan Server Aplikasi**:
    ```bash
    php artisan serve
    ```
    Buka peramban (browser) Anda dan akses alamat `http://127.0.0.1:8000`.

---

## Akun Uji Coba Bawaan

Gunakan akun berikut (yang dibuat melalui `UserSeeder`) untuk menguji aplikasi:

* **Akun Administrator**:
  * **Email**: `admin@gmail.com`
  * **Password**: `password`
* **Akun Pelanggan**:
  * **Email**: `user@gmail.com`
  * **Password**: `password`

---

*Laporan proyek ini disusun untuk memenuhi salah satu syarat penilaian kelulusan program keahlian.*
