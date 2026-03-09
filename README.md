<p align="center">
  <img src="public/img/logo.png" width="150" alt="Logo Kemenkumham">
</p>

<h1 align="center">Sistem Informasi Penggajian (E-Payroll)</h1>

<p align="center">
  <strong>Kementerian Hukum dan HAM – Kantor Wilayah Bali</strong><br>
  Sistem pengelolaan dan distribusi slip gaji digital yang aman dan efisien.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=flat&logo=tailwind-css" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=flat&logo=alpine.js" alt="Alpine JS">
</p>

---

## Deskripsi Proyek

**E-Payroll** adalah sistem informasi berbasis web yang digunakan untuk mengelola dan mendistribusikan slip gaji pegawai secara digital di lingkungan **Kementerian Hukum dan HAM Kantor Wilayah Bali**.

Aplikasi ini dirancang untuk menggantikan proses distribusi slip gaji manual dengan sistem yang lebih terstruktur, efisien, dan mudah diakses oleh pegawai melalui perangkat komputer maupun perangkat mobile.

Melalui sistem ini, administrator dapat mengimpor data gaji dari file Excel, memproses slip gaji secara otomatis, serta menyediakan akses unduhan slip gaji dalam format PDF untuk masing-masing pegawai.

---

## Fitur Utama

### Panel Administrator
- Manajemen data pegawai (tambah, ubah, hapus, dan pencarian).
- Import data pegawai dan data gaji dari file Excel (`.xlsx` / `.xls`).
- Pembuatan slip gaji dalam format **PDF**.
- Unduh arsip slip gaji seluruh pegawai dalam bentuk **ZIP**.
- Pengelolaan riwayat penggajian berdasarkan bulan dan tahun.

### Panel Pegawai
- Login menggunakan **NIP** dan kata sandi.
- Melihat riwayat penerimaan gaji setiap periode.
- Mengunduh slip gaji resmi dalam format **PDF**.
- Antarmuka responsif yang dapat digunakan pada perangkat desktop maupun mobile.

---

## Teknologi yang Digunakan

- **Backend Framework** : Laravel
- **Bahasa Pemrograman** : PHP
- **Frontend** : Tailwind CSS, Alpine.js
- **Database** : MySQL / MariaDB
- **Excel Processing** : `maatwebsite/excel`
- **PDF Generator** : `barryvdh/laravel-dompdf`
- **Role & Permission** : `spatie/laravel-permission`
- **UI Alert** : SweetAlert2

---

## Instalasi (Local Development)

### Persyaratan Sistem

Pastikan sistem Anda telah terpasang:

- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Node.js & NPM (opsional)

---

### 1. Clone Repository

```bash
git clone https://github.com/username-kamu/e-payroll-kemenkumham.git
cd e-payroll-kemenkumham
```

---

### 2. Install Dependensi PHP

```bash
composer install
```

---

### 3. Konfigurasi Environment

Salin file konfigurasi `.env`.

```bash
cp .env.example .env
```

Sesuaikan konfigurasi database pada file `.env`.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_payroll_kemenkumham
DB_USERNAME=root
DB_PASSWORD=
```

---

### 4. Generate Application Key

```bash
php artisan key:generate
```

---

### 5. Migrasi Database

```bash
php artisan migrate --seed
```

Perintah ini akan membuat struktur tabel dan menambahkan data awal yang diperlukan.

---

### 6. Membuat Storage Link

```bash
php artisan storage:link
```

Langkah ini diperlukan agar file yang dihasilkan sistem dapat diakses oleh aplikasi.

---

### 7. Menjalankan Server

```bash
php artisan serve
```

Aplikasi dapat diakses melalui:

```
http://localhost:8000
```

---

## Alur Penggunaan

### Administrator

1. Login sebagai **Admin**.
2. Import data pegawai menggunakan template Excel yang tersedia.
3. Upload data gaji setiap periode melalui menu penggajian.
4. Sistem akan memproses dan menghasilkan slip gaji otomatis.
5. Admin dapat mengunduh arsip slip gaji dalam bentuk ZIP.

### Pegawai

1. Login menggunakan **NIP** dan kata sandi.
2. Sistem menampilkan riwayat slip gaji yang tersedia.
3. Pegawai dapat mengunduh slip gaji dalam format PDF.

---

## Pengembang

Dikembangkan oleh:

**Komang Mahendra**

Sebagai bagian dari inisiatif digitalisasi administrasi penggajian di lingkungan  
**Kementerian Hukum dan HAM Kantor Wilayah Bali**.

---