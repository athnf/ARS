# ✈️ Airline Reservation System (ARS)

<p align="center">
  <strong>A Full-Stack Laravel Web Application for Flight Management & Ticket Reservation</strong><br>
  Developed by <strong>Nazhidf</strong> · Completed in 4 Hours Non-stop
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.x-blue" alt="PHP Version">
  <img src="https://img.shields.io/badge/Laravel-10-red" alt="Laravel Version">
  <img src="https://img.shields.io/badge/Status-Production Ready-brightgreen" alt="Status">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

---

## 📌 Overview

**Airline Reservation System (ARS)** adalah aplikasi Laravel dengan fitur lengkap untuk:

* Manajemen data penerbangan (CRUD)
* Pemesanan tiket oleh user
* Dashboard admin
* Role-based access (RBAC)
* Audit log aktivitas
* Soft delete dan restore
* Enkripsi data sensitif
* Pencegahan SQL injection
* Backup dan recovery database

ARS memenuhi seluruh **8 poin tugas dosen** terkait keamanan dan pengelolaan data.

---

## 🚀 Features

### 🔐 Keamanan & Autentikasi

* Laravel Breeze Authentication
* Password hashing (bcrypt)
* Role-Based Access Control (Admin dan User)
* Middleware proteksi route admin
* SQL injection prevention via Query Builder
* Enkripsi AES-256 untuk field sensitif

---

## 🛫 Manajemen Data (CRUD)

### Flights (Admin)

* Create
* Read
* Update
* Delete

### Tickets (User)

* Booking tiket
* Lihat tiket sendiri
* Cancel (soft delete)

### Tickets (Admin)

* Lihat semua tiket
* Restore tiket terhapus

### Dua Foreign Key (Sesuai Kriteria Dosen)

* `user_id` → users.id
* `flight_id` → flights.id

---

## 📝 Audit Log System

Setiap aksi penting terekam otomatis:

* Create
* Update
* Delete / Soft delete
* Restore
* Login

Tersimpan pada tabel `audit_logs`.

---

## 🔄 Backup & Recovery

### Backup

Export database `.sql` melalui phpMyAdmin/MySQL.

### Recovery

Import `.sql` ke database tujuan.

---

## 🗄️ Database ERD (Ringkas)

```
Users → Tickets → Flights

1 user bisa punya banyak tickets
1 flight bisa punya banyak tickets
```

---

## 🧑‍💻 Installation

### 1. Clone Repository

```bash
git clone https://github.com/nzhf/airline-reservation-system.git
cd airline-reservation-system
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

Isi `.env`:

```env
DB_DATABASE=ars_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrate dan Seed

```bash
php artisan migrate
php artisan db:seed
```

### 5. Run Server

```bash
php artisan serve
```

Akses:

```
http://127.0.0.1:8000
```

---

## 🔑 Default Credentials

### Admin

Email: `admin@ars.com`
Password: `password`

### User

Daftar langsung melalui halaman register.

---

## 🧪 Unit Tests (phpunit)

* Authentication Test
* RBAC Access Test
* Flights CRUD Test
* Ticket Booking Test
* Soft Delete dan Restore Test
* Encryption Test
* SQL Injection Test
* Audit Log Test

---

## 🧭 Demo Guide (Presentasi)

* Login admin → akses `/admin`
* Login user → ditarik ke dashboard user
* User coba akses `/admin` → forbidden
* Admin CRUD flights
* User booking tiket → cek relasi FK
* User soft delete tiket
* Admin restore tiket
* Tampilkan audit log
* Perlihatkan kolom terenkripsi di database
* Jelaskan backup dan recovery

---

## ✒️ Credit

* Full Stack Developer: **Nazhidf**
* Project: **Airline Reservation System (ARS)**
* Time spent: 4 hours non-stop

---

# Laravel Section (Official README)

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>
<p align="center">
  <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Downloads">
  <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Version">
  <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
</p>

Laravel adalah framework web yang ekspresif dan elegan...

Dokumentasi lengkap tersedia di website Laravel.

Lisensi: MIT.
