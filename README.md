<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="320" alt="Laravel Logo">
</p>

<h1 align="center">🌊 Dashboard Cuaca Mikro & Sistem Peringatan Dini Pantai Sawarna</h1>

<p align="center">
  <strong>Platform Pemantauan Cuaca Pesisir Real-Time & Telemetri IoT Berbasis Edge Computing</strong><br>
  Proyek Pengabdian Masyarakat: <em>Implementasi Sensor Berbasis IoT dan Edge Computing untuk Mendukung Mitigasi dan Adaptasi Perubahan Iklim di Kawasan Wisata Pantai Sawarna, Lebak, Banten</em>.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.3+">
  <img src="https://img.shields.io/badge/Blade-Engine-F05340?style=for-the-badge&logo=laravel&logoColor=white" alt="Blade">
  <img src="https://img.shields.io/badge/Tailwind_CSS-v4.0-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Font-Plus_Jakarta_Sans-1E293B?style=for-the-badge" alt="Plus Jakarta Sans">
  <img src="https://img.shields.io/badge/Animation-Framer_Motion-1E1E1E?style=for-the-badge&logo=framer&logoColor=white" alt="Framer Motion">
  <img src="https://img.shields.io/badge/Icons-Font_Awesome_6-528DD7?style=for-the-badge&logo=fontawesome&logoColor=white" alt="Font Awesome">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="MIT License">
</p>

---

## 📋 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Arsitektur Sistem (Cyber-Physical)](#-arsitektur-sistem-cyber-physical)
- [Teknologi & Dependensi](#-teknologi--dependensi)
- [Fitur Utama](#-fitur-utama)
- [Konfigurasi UI/UX & Desain](#-konfigurasi-uiux--desain)
  - [Tipografi: Plus Jakarta Sans](#1-tipografi-plus-jakarta-sans)
  - [Ikonografi: Font Awesome 6](#2-ikonografi-font-awesome-6)
  - [Animasi: Framer Motion / Motion](#3-animasi-framer-motion--motion)
  - [Palet Warna Pesisir (Coastal Maritime Palette)](#4-palet-warna-pesisir-coastal-maritime-palette)
- [Struktur Direktori Proyek](#-struktur-direktori-proyek)
- [Panduan Instalasi & Menjalankan](#-panduan-instalasi--menjalankan)
- [Kontrak Ingestion Data Sensor (API)](#-kontrak-ingestion-data-sensor-api)
- [Dokumentasi Terkait](#-dokumentasi-terkait)
- [Tim & Lisensi](#-tim--lisensi)

---

## 📖 Tentang Proyek

Kawasan Pantai Sawarna berhadapan langsung dengan Samudra Hindia dan memiliki tingkat kerentanan tinggi terhadap cuaca ekstrem pesisir (angin kencang, gelombang pasang, curah hujan tinggi, dan perubahan tekanan udara mendadak). 

Aplikasi ini merupakan **Web Dashboard Cuaca Mikro dan Sistem Peringatan Dini** yang dibangun dengan framework **Laravel** dan templating **Blade**. Sistem ini dirancang untuk menyajikan data telemetri sensor dari lapangan secara kontinu, menghitung ambang batas bahaya (*early warning*), memantau kesehatan node IoT pesisir, serta menjamin keutuhan data (*data integrity*) melalui mekanisme *backfill* otomatis saat konektivitas internet pesisir mengalami gangguan.

---

## 🛰️ Arsitektur Sistem (Cyber-Physical)

```
[ Sensor Cuaca Lapangan ]
 (Suhu, Hum, Baro, Hujan, Angin)
          │
          ▼
[ Edge Node Pantai ] ──(Panel Surya + Baterai)
          │
          │  Transmisi LoRa (Jarak Jauh / Nirkabel)
          ▼
[ Sink Node / Gateway Kantor ] ──(Single Board Computer + Edge Storage)
          │
          │  HTTP POST / MQTT (Koneksi Seluler 4G)
          ▼
[ Laravel Cloud Backend ] ──(Validasi Ingestion, Agregasi, Deteksi Anomali)
          │
          ▼
[ Web Dashboard Sawarna ] ──(Laravel Blade + Plus Jakarta Sans + Font Awesome + Framer Motion)
```

---

## 💻 Teknologi & Dependensi

Proyek ini dibangun menggunakan standar teknologi modern:

| Komponen | Teknologi | Keterangan |
|---|---|---|
| **Backend Framework** | **Laravel 12.x / 13.x** | Routing, Eloquent ORM, Ingestion REST API, Queues, Scheduler |
| **Language Runtime** | **PHP 8.3+** | Fitur modern PHP (Type Safety, Readonly Properties) |
| **Templating Engine** | **Blade Components** | Server-Side Rendering (SSR) yang terstruktur dan modular |
| **CSS Framework** | **Tailwind CSS v4** | `@tailwindcss/vite` untuk build super cepat |
| **Typeface / Font** | **Plus Jakarta Sans** | Geometris, modern, dan sangat mudah dibaca (*high-glanceability*) |
| **Animasi UI** | **Framer Motion / Motion** | Transisi halaman halus, animasi grafik, *number counter*, dan kartu metrik |
| **Pustaka Ikon** | **Font Awesome 6 (Solid & Regular)** | Ikonografi standar industri yang konsisten |
| **Build Tool** | **Vite 8** | Hot Module Replacement (HMR) dan bundling aset teroptimasi |
| **Database** | **PostgreSQL / MySQL / SQLite** | Relational DB untuk *raw readings*, agregat, dan log peringatan |

---

## ✨ Fitur Utama & Prinsip Operator-First

Aplikasi ini didesain khusus agar ramah digunakan oleh **Operator Lapangan, Penjaga Pantai (Balawista/Life Guard), dan Pengurus POKDARWIS**:

1. **Aturan 3 Detik (*The 3-Second Rule*)**:
   - Dalam 3 detik, operator langsung tahu apakah pantai saat ini **Aman**, **Waspada**, atau **Bahaya**.
   - Banner status keselamatan pantai berukuran besar diletakkan di posisi paling atas layar.
2. **Bebas Jargon Teknis (*Zero-Jargon Policy*)**:
   - Seluruh istilah rumit diterjemahkan ke bahasa sehari-hari: *"Baterai 78% (Mengisi dari Surya)"*, *"Sinyal Sangat Kuat"*, *"Internet 4G Aktif"*.
3. **Navigasi Berlabel Jelas (*Clear Labeled Navigation*)**:
   - Sidebar navigasi dilengkapi teks label bahasa Indonesia (*Beranda Cuaca, Kondisi Sensor, Atur Batas Peringatan, Profil Petugas*) agar tidak membingungkan operator.
4. **4 Metrik Utama Cuaca Berskala Besar**:
   - Angka super besar dan terbaca jelas di bawah terik sinar matahari pantai:
     - 💨 **Kecepatan Angin** (km/jam) & Arah Mata Angin
     - 🌧️ **Curah Hujan** (mm/jam) & Status Banjir Rob
     - 🌡️ **Suhu Udara** (°C) & Kelembapan
     - 🌊 **Tekanan Barometrik** (hPa) & Kondisi Ombak Laut
5. **Aksi Tanggap Cepat Peringatan Dini**:
   - Tombol satu klik: *"Kirim Peringatan WA ke Pengelola"* dan *"Konfirmasi Paham"*.
6. **Pemantauan Kesehatan Alat Sensor di Pantai**:
   - Status baterai panel surya di bibir pantai dan koneksi internet posko kantor desa.
7. **Ketahanan Jaringan Pesisir (Offline-First Resilience)**:
   - Data otomatis disimpan di posko saat internet pesisir terputus dan disinkronkan kembali saat koneksi pulih (*auto-backfill*).

---

## 🎨 Konfigurasi UI/UX & Desain

### 1. Tipografi: Plus Jakarta Sans

Aplikasi ini menggunakan font resmi **Plus Jakarta Sans** menggantikan font standar.

#### Pemasangan Font (via Google Fonts / CDN di Layout Blade):
Tambahkan pada file layout `<head>` (`resources/views/layouts/app.blade.php`):
```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
```

#### Integrasi Tailwind CSS v4 (`resources/css/app.css`):
```css
@import 'tailwindcss';

@theme {
  --font-sans: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
}
```

---

### 2. Ikonografi: Font Awesome 6

Seluruh ikon antarmuka menggunakan **Font Awesome 6 (Solid / Regular)** untuk menggantikan SVG manual.

#### Pemasangan Font Awesome:
```bash
npm install @fortawesome/fontawesome-free
```
Atau tambahkan CDN resmi di file Blade layout:
```html
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
```

#### Pemetaan Ikon Prototipe ke Font Awesome:

| Modul / Komponen | Prototipe Lama | Kelas Font Awesome 6 | Preview / Peran |
|---|---|---|---|
| **Beranda / Ringkasan** | SVG Grid | `<i class="fa-solid fa-table-cells-large"></i>` | Menu Dashboard |
| **Grafik / Tren** | SVG Chart | `<i class="fa-solid fa-chart-line"></i>` | Analisis tren data |
| **Node / Perangkat** | SVG CPU | `<i class="fa-solid fa-microchip"></i>` | Status hardware edge |
| **Notifikasi / Alert** | SVG Bell | `<i class="fa-solid fa-bell"></i>` | Peringatan dini |
| **Basis Data / Cloud** | SVG Database | `<i class="fa-solid fa-database"></i>` | Sinkronisasi data cloud |
| **Pengaturan Sistem** | SVG Settings | `<i class="fa-solid fa-gear"></i>` | Ambang batas & konfig |
| **Keluar Sesi** | SVG Logout | `<i class="fa-solid fa-right-from-bracket"></i>` | Keluar aplikasi |
| **Pencarian Data** | SVG Search | `<i class="fa-solid fa-magnifying-glass"></i>` | Search bar |
| **Kelembapan / Air** | SVG Droplet | `<i class="fa-solid fa-droplet"></i>` | Kartu kelembapan udara |
| **Tekanan Udara** | SVG Gauge | `<i class="fa-solid fa-gauge-high"></i>` | Barometer atmosfer |
| **Kecepatan Angin** | SVG Wind | `<i class="fa-solid fa-wind"></i>` | Kecepatan angin |
| **Kompas Arah Angin** | SVG Compass | `<i class="fa-solid fa-compass"></i>` | Arah mata angin (U-T-S-B) |
| **Baterai / Daya** | SVG Battery | `<i class="fa-solid fa-battery-three-quarters"></i>`| Status daya panel surya |
| **Sinyal Radio** | SVG RSSI | `<i class="fa-solid fa-tower-broadcast"></i>` | Sinyal LoRa / 4G |

---

### 3. Animasi: Framer Motion / Motion

Aplikasi memanfaatkan pustaka **Framer Motion** (melalui library modern `motion`) untuk memberikan transisi halus, angka dinamis yang berputar (*counting numbers*), dan animasi indikator jarum kompas.

#### Pemasangan Motion:
```bash
npm install motion
```

#### Contoh Implementasi Animasi di `resources/js/app.js`:
```javascript
import { animate, inView } from "motion";

// Animasi Fade-in & Slide-up saat kartu dimuat
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".metric-card").forEach((card, index) => {
        animate(
            card,
            { opacity: [0, 1], y: [16, 0] },
            { duration: 0.45, delay: index * 0.08, easing: "ease-out" }
        );
    });

    // Animasi jarum kompas angin berputar halus sesuai data derajat
    const compassArrow = document.getElementById("compass-arrow");
    if (compassArrow) {
        const targetDegree = compassArrow.dataset.degree || 225;
        animate(
            compassArrow,
            { rotate: targetDegree },
            { duration: 1.2, easing: [0.34, 1.56, 0.64, 1] }
        );
    }
});
```

---

### 4. Palet Warna Pesisir (Coastal Maritime Palette)

Warna didefinisikan secara semantik untuk mendukung tema bahari dan mode gelap otomatis (*Dark Mode*):

```css
:root {
  --bg: #e3eef2;      /* Latar kanvas aplikasi (maritime cyan) */
  --card: #ffffff;    /* Permukaan kartu data */
  --ink: #0d2f44;     /* Teks utama berdaya kontras tinggi */
  --mute: #7a97a6;    /* Teks sekunder dan label halus */
  --sea: #0e86b8;     /* Biru laut primer untuk kurva dan aksen */
  --deep: #0a5c8a;    /* Biru samudra gelap (gradien CTA) */
  --sky: #8fd3ee;     /* Biru langit arsiran grafik */
  --ok: #1b9a72;      /* Status hijau (Aman / Normal) */
  --warn: #c9831a;    /* Status oranye/amber (Waspada) */
  --bad: #c23b3b;     /* Status merah koral (Bahaya) */
}
```

---

## 📂 Struktur Direktori Proyek

```
app-sawarna/
├── app/
│   ├── Http/
│   │   ├── Controllers/          # Controller halaman dashboard & endpoint API
│   │   │   ├── DashboardController.php
│   │   │   └── Api/
│   │   │       └── IngestionController.php
│   │   └── Middleware/
│   └── Models/                   # Model Eloquent (Reading, Device, Alert, Rule)
│       ├── Device.php
│       ├── SensorReading.php
│       └── Alert.php
├── database/
│   ├── migrations/               # Skema tabel database IoT & Peringatan
│   └── seeders/                  # Seeder dummy data cuaca Sawarna
├── docs/                         # Spesifikasi teknis proyek
│   ├── PRD_Dashboard_Sawarna.md  # Dokumen Product Requirements
│   ├── SRS_Dashboard_Sawarna.md  # Dokumen Spesifikasi Software
│   ├── ERD_Dashboard_Sawarna.md  # Desain Basis Data
│   └── design/
│       ├── DESIGN.md             # Panduan resmi Design System & Token
│       ├── index.html            # Prototipe visual
│       ├── style.css
│       └── app.js
├── resources/
│   ├── css/
│   │   └── app.css               # Import Tailwind CSS & konfigurasi Plus Jakarta Sans
│   ├── js/
│   │   └── app.js               # Inisialisasi Framer Motion / Motion & grafik dinamis
│   └── views/                    # Tampilan Laravel Blade
│       ├── layouts/
│       │   └── app.blade.php     # Layout utama (Header, Sidebar, Script, Font)
│       ├── components/           # Komponen Blade reusable
│       │   ├── metric-card.blade.php
│       │   ├── trend-chart.blade.php
│       │   ├── wind-compass.blade.php
│       │   └── alert-banner.blade.php
│       └── dashboard.blade.php   # Tampilan beranda dashboard Sawarna
├── routes/
│   ├── api.php                   # Endpoint ingestion telemetri sensor
│   └── web.php                   # Rute antarmuka dashboard Blade
├── vite.config.js                # Konfigurasi Vite & bundling aset
├── composer.json                 # Dependensi PHP & Laravel
└── package.json                  # Dependensi Node.js, Motion, Font Awesome, Tailwind
```

---

## 🚀 Panduan Instalasi & Menjalankan

Ikuti langkah-langkah berikut untuk menjalankan website di komputer lokal:

### 1. Prasyarat Sistem
- **PHP** >= 8.3 dengan ekstensi `pdo`, `mbstring`, `openssl`, `sqlite3` atau `pdo_mysql`/`pdo_pgsql`
- **Composer** (Dependency manager PHP)
- **Node.js** >= 20.x & **npm**
- **Git**

### 2. Kloning Repositori & Instalasi Dependensi
```bash
# 1. Kloning repositori
git clone https://github.com/username/app-sawarna.git
cd app-sawarna

# 2. Instalasi dependensi backend PHP
composer install

# 3. Instalasi dependensi frontend (Tailwind v4, Font Awesome, Framer Motion)
npm install
npm install @fortawesome/fontawesome-free motion
```

### 3. Konfigurasi Environment (`.env`)
```bash
# Salin file konfigurasi
cp .env.example .env

# Generate application key
php artisan key:generate
```

Sesuaikan konfigurasi basis data pada file `.env`:
```env
DB_CONNECTION=sqlite
# Atau jika menggunakan MySQL/PostgreSQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=sawarna_weather
# DB_USERNAME=root
# DB_PASSWORD=
```

### 4. Eksekusi Migrasi Database & Seeding
```bash
php artisan migrate --seed
```

### 5. Menjalankan Server Pengembangan
Jalankan server Laravel dan Vite asset bundler secara bersamaan:

```bash
# Opsi 1: Menggunakan Artisan Dev Runner terpadu (Laravel 11+)
php artisan dev

# Opsi 2: Menjalankan di dua terminal terpisah
# Terminal 1:
php artisan serve

# Terminal 2:
npm run dev
```

Buka peramban (*browser*) Anda di: **`http://127.0.0.1:8000`**

---

## 📡 Kontrak Ingestion Data Sensor (API)

Sink Node / Gateway di kantor pengelola mengirimkan data pembacaan sensor ke Laravel Backend melalui endpoint:

- **Method**: `POST`
- **Endpoint**: `/api/v1/telemetry`
- **Headers**:
  ```http
  Content-Type: application/json
  X-Device-Key: <DEVICE_SECRET_API_KEY>
  ```
- **Payload JSON (Contoh)**:
  ```json
  {
    "device_code": "EDGE-SAWARNA-01",
    "timestamp": "2026-11-05T09:40:00+07:00",
    "telemetry": {
      "battery_percent": 78,
      "solar_voltage": 13.8,
      "lora_rssi": -104,
      "storage_queue": 38
    },
    "readings": {
      "temperature": 29.4,
      "humidity": 84,
      "pressure": 1008.6,
      "rainfall_rate": 3.2,
      "wind_speed": 34,
      "wind_direction": 225,
      "wind_gust": 41
    }
  }
  ```

---

## 📚 Dokumentasi Terkait

Untuk pemahaman mendalam mengenai kebutuhan teknis dan perancangan sistem, silakan merujuk pada berkas dokumentasi di direktori [`docs/`](file:///D:/INTERN/SAWARNA/app-sawarna/docs):
- 📘 [**PRD_Dashboard_Sawarna.md**](file:///D:/INTERN/SAWARNA/app-sawarna/docs/PRD_Dashboard_Sawarna.md): Kebutuhan Produk & Prioritas Fitur.
- 📙 [**SRS_Dashboard_Sawarna.md**](file:///D:/INTERN/SAWARNA/app-sawarna/docs/SRS_Dashboard_Sawarna.md): Spesifikasi Kebutuhan Perangkat Lunak (Fungsional & Non-Fungsional).
- 🗄️ [**ERD_Dashboard_Sawarna.md**](file:///D:/INTERN/SAWARNA/app-sawarna/docs/ERD_Dashboard_Sawarna.md): Rancangan Entitas Relasi Basis Data IoT.
- 🎨 [**DESIGN.md**](file:///D:/INTERN/SAWARNA/app-sawarna/docs/design/DESIGN.md): Spesifikasi Lengkap Design System, Token Warna, & Panduan Komponen.

---

## 👥 Tim & Lisensi

- **Inisiator & Pengembang**: Tim Pengabdian Masyarakat Program Studi S1 Teknik Komputer / Informatika, Universitas Telkom bekerja sama dengan Kelompok Sadar Wisata (POKDARWIS) Kawasan Pantai Sawarna.
- **Lisensi**: Proyek ini dirilis di bawah lisensi terbuka [MIT License](LICENSE).
