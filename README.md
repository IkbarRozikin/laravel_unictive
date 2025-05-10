
# **Aplikasi CRUD User dengan Laravel**

Aplikasi ini dibangun menggunakan Laravel untuk mengelola data pengguna (User) dengan relasi satu ke banyak (one-to-many) ke hobi (Hobbies). Aplikasi ini mencakup sistem autentikasi baik untuk UI berbasis web (Blade) maupun API dengan menggunakan JWT (JSON Web Token).

## **Fitur**

- **CRUD User**:
  - Menambah, mengubah, dan menghapus pengguna beserta daftar hobinya.
- **Relasi One-to-Many**:
  - Setiap pengguna dapat memiliki banyak hobi.
- **Autentikasi**:
  - Autentikasi berbasis sesi untuk aplikasi Web.
  - Autentikasi berbasis JWT untuk API.
- **Blade UI**:
  - Form input dan tabel untuk menampilkan daftar pengguna dan hobinya.
- **API Endpoints**:
  - Endpoints API yang dilindungi JWT untuk operasi CRUD.

## **Teknologi yang Digunakan**
- Laravel 8.x
- Blade Templating Engine
- JWT Authentication untuk API
- MySQL atau SQLite untuk database

## **Persyaratan Sistem**
- PHP 8.x
- Composer
- Database MySQL atau SQLite

## **Instalasi**

### **1. Clone Proyek**

Clone repositori ini ke dalam direktori lokal:

```bash
git clone https://github.com/username/laravel-unictive.git
cd laravel-unictive
```

### **2. Instal Dependensi**

Install dependensi dengan Composer:

```bash
composer install
```

### **3. Buat File `.env`**

Salin file `.env.example` dan beri nama `.env`:

```bash
cp .env.example .env
```

### **4. Set Konfigurasi Database**

Ubah konfigurasi database di file `.env` sesuai dengan pengaturan kamu:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### **5. Generate Kunci Aplikasi**

Generate aplikasi key Laravel:

```bash
php artisan key:generate
```

### **6. Jalankan Migration**

Jalankan migration untuk membuat tabel yang diperlukan di database:

```bash
php artisan migrate
```

### **7. Instal JWT Authentication**

Instal package `tymon/jwt-auth`:

```bash
composer require tymon/jwt-auth
```

Kemudian, publish konfigurasi JWT:

```bash
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```

### **8. Set Konfigurasi JWT**

Buka file `.env` dan tambahkan key JWT:

```env
JWT_SECRET=generate
```

Generate JWT secret key:

```bash
php artisan jwt:secret
```

### **9. Seed Data (Opsional)**

Jika kamu ingin menambahkan data pengguna awal untuk uji coba, jalankan seeder:

```bash
php artisan db:seed
```

---

## **Rute Aplikasi**

### **Web Routes (Blade UI)**

- `GET /users` → Menampilkan daftar pengguna.
- `GET /users/create` → Formulir untuk menambahkan pengguna.
- `POST /users` → Menambahkan pengguna baru.
- `GET /users/{id}/edit` → Formulir untuk mengedit pengguna.
- `PUT /users/{id}` → Memperbarui data pengguna.
- `DELETE /users/{id}` → Menghapus pengguna.

### **API Routes**

**Authentication:**
- `POST /api/login` → Login dan mendapatkan JWT token.
- `POST /api/register` → Mendaftar pengguna baru.

**CRUD Users:**
- `GET /api/users` → Mendapatkan daftar pengguna.
- `POST /api/users` → Menambahkan pengguna baru.
- `GET /api/users/{id}` → Mendapatkan data pengguna.
- `PUT /api/users/{id}` → Memperbarui data pengguna.
- `DELETE /api/users/{id}` → Menghapus pengguna.

Semua endpoint API membutuhkan **JWT Authorization** di header `Authorization: Bearer {TOKEN}`.

---