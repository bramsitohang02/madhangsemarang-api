# Madhang Semarang - Backend API

## 📌 Deskripsi Proyek
Repositori ini berisi *source code backend* berupa RESTful API untuk aplikasi "Madhang Semarang", sebuah platform direktori kuliner, agenda *event*, dan forum diskusi interaktif. API ini dibangun untuk melayani permintaan data dari aplikasi *frontend* secara efisien dan aman.

> 🔗 **Tautan Frontend:** [(https://github.com/bramsitohang02/madhangsemarang-app.git)]

## 🛠️ Teknologi & Arsitektur
* **Framework:** Laravel (PHP)
* **Database:** MySQL
* **Autentikasi:** Laravel Sanctum / JWT (Token-based Auth)
* **Arsitektur:** MVC (Model-View-Controller) dengan pemisahan *Endpoints* API.

## ⚙️ Fitur Utama API
* **Autentikasi & Otorisasi:** Registrasi, Login, dan manajemen sesi pengguna.
* **Manajemen Restoran:** CRUD data direktori kuliner dan galeri foto restoran.
* **Manajemen Event:** Endpoint agenda *event* lokal Semarang.
* **Sistem Interaksi:** API untuk ulasan (*Review*), komentar (*Comment*), dan forum diskusi (*Topic*).

## 🚀 Cara Menjalankan di Lokal (How to Run)

1. **Clone repositori ini:**
   ```bash
   git clone [https://github.com/username-anda/madhangsemarang-api.git](https://github.com/username-anda/madhangsemarang-api.git)
   cd madhangsemarang-api

2. Instal dependensi:
   ```bash
   composer install

4. Konfigurasi Environment:
(Salin file .env.example menjadi .env, lalu sesuaikan kredensial koneksi database Anda)
   ```bash
   cp .env.example .env
   php artisan key:generate

5. Migrasi Database & Seeder:
   ```bash
   php artisan migrate --seed

6. Jalankan Server Lokal:
   ```bash
   php artisan serve
