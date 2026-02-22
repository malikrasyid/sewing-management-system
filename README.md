# Sewing Schedule Management System

Sistem manajemen jadwal produksi garmen yang dirancang khusus untuk mengelola efisiensi jalur penjahitan (*sewing lines*). Aplikasi ini mengotomatisasi perhitungan target produksi harian dengan logika penyeimbangan beban kerja yang akurat.

## 🌟 Fitur Utama

- **Automatic Production Balancing**: Menghitung target harian berdasarkan total kuantitas dan rentang waktu kerja secara otomatis.
- **Remainder Management**: Logika cerdas yang menempatkan sisa pembagian produksi (*modulo*) pada hari terakhir jadwal untuk memastikan akurasi data.
- **Master Data Management**: CRUD (Create, Read, Update, Delete) lengkap untuk manajemen Jalur Produksi (*Lines*) dan Pesanan (*Orders/PO*).
- **Interactive Dashboard**: Ringkasan performa produksi global termasuk persentase pencapaian target harian.
- **Modern Web Interface**: Responsif dan cepat dengan interaksi berbasis AJAX (Axios) dan notifikasi SweetAlert2.

## 🛠️ Tech Stack

- **Backend**: Laravel 10 (PHP 8.x)
- **Frontend**: Tailwind CSS, Vite, Blade Components
- **Database**: MySQL / MariaDB
- **Libraries**: Axios (API Calls), SweetAlert2 (Pop-ups), Carbon (Date Manipulation)

## 📦 Instalasi

### Persyaratan Sistem
- PHP >= 8.1
- Composer
- Node.js >= 16
- MySQL / MariaDB

### Langkah Instalasi
1. **Clone Repository**:
   ```bash
   git clone <url-repository>
   cd sewing-project
   ```

2. **Install Dependencies PHP**:
   ```bash
   composer install
   ```

3. **Install Dependencies JavaScript**:
   ```bash
   npm install
   ```

4. **Setup Environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Setup Database**:
   Konfigurasi database di file `.env`, kemudian jalankan:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Build Assets**:
   ```bash
   npm run build
   ```

7. **Jalankan Aplikasi**:
   ```bash
   php artisan serve
   ```
   Aplikasi akan berjalan di `http://localhost:8000`