# 📌 Laravel Project Setup Guide

## 🔹 Requirements

Sebelum mulai, pastikan perangkat Anda memiliki:

-   **Docker & Docker Compose** (jika menggunakan metode Docker)
-   **PHP 8.2** atau lebih tinggi
-   **Composer**
-   **Node.js & npm**
-   **MySQL / PostgreSQL** (jika menggunakan metode Laravel Original)

---

## 🚀 Install via Docker (Rekomendasi)

### 1️⃣ **Clone Repository**

```sh
git clone https://github.com/mail21/ismail_fdtest.git
cd repository
```

Ubah konfigurasi database sesuai kebutuhan.

### 2️⃣ **Copy `.env` Example**

```sh
cp .env.example .env
```

### 3️⃣ **Jalankan Docker Containers**

```sh
docker-compose up --build -d
```

### 4️⃣ **Generate Application Key**

```sh
docker-compose exec app php artisan key:generate
```

### 5️⃣ **Jalankan Migration & Seeder** (Opsional)

```sh
docker-compose exec app php artisan migrate --seed
```

### 6️⃣ **Akses Aplikasi**

Buka browser dan akses:  
🔗 `http://localhost:8000`

---

## 🛠 Install via Laravel Original (Tanpa Docker)

### 1️⃣ **Clone Repository**

```sh
git clone https://github.com/mail21/ismail_fdtest.git
cd repository
```

### 2️⃣ **Install Dependencies**

```sh
composer install
npm install
npm run build
```

### 3️⃣ **Copy `.env` File**

```sh
cp .env.example .env
```

### 4️⃣ **Generate Application Key**

```sh
php artisan key:generate
```

### 5️⃣ **Jalankan Migration & Seeder**

```sh
php artisan migrate --seed
```

### 6️⃣ **Jalankan Server**

```sh
php artisan serve
```

Akses aplikasi di:  
🔗 `http://127.0.0.1:8000`

---

## 🔄 Perintah Tambahan

🛑 **Stop Docker Containers**

```sh
docker-compose down
```

📦 **Menghapus Cache Laravel**

```sh
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

🔄 **Update Dependencies**

```sh
composer update
npm update
```

---

Semoga membantu! 🚀 Jika ada pertanyaan, silakan buat **issue** di repo ini.
