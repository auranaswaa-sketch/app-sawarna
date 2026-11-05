# DESIGN SYSTEM & UI/UX SPECIFICATION
## Dashboard Cuaca Mikro & Sistem Peringatan Dini Pantai Sawarna

Dokumen ini merupakan panduan dan spesifikasi resmi desain antarmuka (*Design System Specification*) yang ditranslasikan dari implementasi prototipe di `docs/design/` (`index.html`, `style.css`, dan `app.js`). Panduan ini dirancang untuk memastikan konsistensi visual, aksesibilitas, dan kemudahan pengembangan lebih lanjut bagi pengembang maupun *agentic AI* (seperti Stitch, Tailwind, dan Laravel Blade).

---

## 1. Filosofi & Karakteristik Desain

### 1.1 Konsep Utama (*Design Personality*)
- **Coastal Maritime Cyber-Physical**: Menggabungkan ketenangan spektrum laut (*oceanic maritime tones*) dengan keterbacaan data perangkat keras IoT (*edge telemetry*).
- **High Glanceability**: Petugas dan pengelola lapangan dapat membaca status cuaca dan peringatan darurat dalam hitungan detik (*3-second rule*), baik di layar komputer kantor pengelola maupun ponsel pintar di bawah terik matahari pesisir.
- **Zero-Waste Dashboard Layout**: Mengoptimalkan bidang pandang layar monitor standar (1080p) agar seluruh metrik penting terlihat tanpa memerlukan *scrolling* berlebih (`lg:h-screen lg:overflow-hidden`).
- **Tactile Squircle Geometry**: Memanfaatkan sudut lengkung modern yang bersahabat (*rounded squircle* 20px–36px) untuk menghilangkan kesan kaku/intimidatif dari data sensor teknis.

---

## 2. Tipografi (Typography)

Sistem menggunakan jenis huruf primer **DM Sans** yang diimpor dari Google Fonts, dengan *font stack fallback* modern:

```css
font-family: "DM Sans", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
```

### Skala Hierarki Tipografi

| Level / Token | Kelas Tailwind | Ukuran / Bobot | Kegunaan |
|---|---|---|---|
| **Display / Page Title** | `text-2xl font-medium` | 24px / Medium (500) | Judul salam utama pada header (*"Halo, Pengelola Sawarna!"*) |
| **Section / Card Title** | `text-[17px] font-bold` | 17px / Bold (700) | Judul modul/kartu utama (*Tren, Curah hujan, Perangkat terpasang*) |
| **Hero Metric Number** | `text-[26px] font-bold tracking-tight` | 26px / Bold (700) | Angka pembacaan sensor utama (*29,4*, *84*, *1008,6*) |
| **Secondary Metric Number** | `text-[19px] font-bold` / `text-xl` | 19px–20px / Bold (700) | Angka ringkasan Maks/Min/Rata-rata & kompas |
| **Unit Suffix** | `text-[13px] font-medium text-mute` | 13px / Medium (500) | Satuan besaran di samping nilai (*°C, %, hPa, km/jam*) |
| **Body / Subtitle** | `text-[13.5px] text-mute` | 13.5px / Regular (400) | Deskripsi header, label parameter kartu cuaca |
| **Secondary Description** | `text-[13px] text-mute` | 13px / Regular (400) | Keterangan perangkat, teks batas waspada, status cloud |
| **Small Label / Caption** | `text-xs text-mute` | 12px / Regular (400) | Label "Maks", "Min", "Arah", waktu notifikasi |
| **Micro Status Badge** | `text-[11.5px] font-bold` | 11.5px / Bold (700) | Teks chip status (*Waspada, Aktif, Selesai*) |
| **Chart Axis Ticks** | `font-size: 10px; fill: var(--mute)` | 10px / Regular (400) | Label grid sumbu X dan Y pada grafik SVG |

---

## 3. Palet Warna & Token (Color Tokens)

Warna didefinisikan menggunakan CSS Custom Variables (`:root`) yang secara otomatis mendukung mode Terang (*Light Mode*) dan Gelap (*Dark Mode*) melalui media query `@media (prefers-color-scheme: dark)`.

### 3.1 Token Warna Utama

| Token CSS | Tailwind Class | Light Mode (Hex) | Dark Mode (Hex) | Deskripsi & Peran |
|---|---|---|---|---|
| `--bg` | `bg-bg` / `text-bg` | `#E3EEF2` | `#081C27` | Latar belakang dasar kanvas aplikasi (maritime soft cyan) |
| `--card` | `bg-card` / `text-card` | `#FFFFFF` | `#0F2F41` | Latar permukaan kartu (*card surface*) |
| `--ink` | `text-ink` | `#0D2F44` | `#E3F3FA` | Warna teks utama (*high-contrast text*) |
| `--mute` | `text-mute` | `#7A97A6` | `#85A9BB` | Warna teks sekunder, ikon inaktif, garis kisi non-invasif |
| `--line` | `border-line` / `bg-line` | `#E1EDF2` | `#1B4258` | Garis pemisah, *progress bar track*, batas kontur |
| `--sea` | `bg-sea` / `text-sea` | `#0E86B8` | `#4CC0EA` | Warna aksen primer identitas laut, kurva grafik aktif, pointer arah |
| `--deep` | `from-sea to-deep` | `#0A5C8A` | `#0B4D73` | Warna gradien penutup (samudra dalam) untuk tombol CTA dan *hero card* |
| `--sky` | `var(--sky)` | `#8FD3EE` | `#3AA6D4` | Aksen biru cerah untuk gradien arsiran area grafik |
| `--tint` | `bg-tint` / `text-tint` | `#E6F4FA` | `#12384D` | Latar belakang wadah ikon bulat (*icon container background*) |
| `--dark` | `bg-dark` / `text-dark` | `#0D2F44` | `#04121A` | Status menu navigasi terpilih, tombol *search trigger* |

### 3.2 Token Status & Peringatan Dini (Semantic Alert Tokens)

| Status | Teks Token | Background Token | Light Mode (Text / Bg) | Dark Mode (Text / Bg) | Arti Operasional |
|---|---|---|---|---|---|
| **Aman (Ok)** | `--ok` | `--okbg` | `#1B9A72` / `#DCF5EC` | `#4FD0A0` / `#10382E` | Normal, baterai penuh, koneksi stabil |
| **Waspada (Warn)** | `--warn` | `--warnbg` | `#C9831A` / `#FFF1D6` | `#EFB04E` / `#3B2F14` | Melewati ambang batas awal, angin kencang |
| **Bahaya (Bad)** | `--bad` | `--badbg` | `#C23B3B` / `#FBE3E3` | `#F08080` / `#3D1F1F` | Cuaca ekstrem, sensor malfungsi, offline kritis |

### 3.3 Konfigurasi Ekstensi Tailwind CSS

```javascript
tailwind.config = {
  theme: {
    extend: {
      fontFamily: {
        sans: ['"DM Sans"', 'system-ui', 'sans-serif'],
      },
      colors: {
        bg: 'var(--bg)',
        card: 'var(--card)',
        ink: 'var(--ink)',
        mute: 'var(--mute)',
        line: 'var(--line)',
        sea: 'var(--sea)',
        deep: 'var(--deep)',
        sky: 'var(--sky)',
        tint: 'var(--tint)',
        dark: 'var(--dark)',
        ok: 'var(--ok)',
        okbg: 'var(--okbg)',
        warn: 'var(--warn)',
        warnbg: 'var(--warnbg)',
        bad: 'var(--bad)',
        badbg: 'var(--badbg)',
      }
    }
  }
}
```

---

## 4. Sistem Spacing, Elevation & Corner Radius

Sistem menggunakan kurva kelengkungan (*border radius*) proporsional untuk membedakan tingkatan elemen antarmuka:

- **Sidebar Capsule (`rounded-[36px]`)**: Kapsul melengkung penuh untuk bilah navigasi vertikal/horizontal.
- **Master Cards (`rounded-[20px]`)**: Sudut kontainer kartu statistik, grafik, dan panel operasional (`p-4 px-[18px]`).
- **Inner Sub-Cards (`rounded-2xl` / 16px)**: Kartu anak di dalam panel perangkat keras (`p-3`).
- **Pill / Metric Stat Boxes (`rounded-xl` / 12px)**: Kotak nilai ringkasan Maks/Rata-rata/Min (`px-3 py-1.5`).
- **Interactive Action Buttons (`rounded-[10px]`)**: Tombol aksi utama (`px-4 py-2.5`).
- **Circular Controls (`rounded-full`)**: Tombol ikon navigasi (44px × 44px), avatar profil (44px), wadah ikon (46px), dan pill pencarian.

---

## 5. Struktur Grid & Tata Letak (Layout Architecture)

Layout dirancang dengan prinsip **Mobile-First & Desktop Dashboard-Lock**:

```
+-----------------------------------------------------------------------------------------+
| [Side Nav] | HEADER: Title + Subtitle                  [Search Bar]  [Msg]  [Bell Alert]|
| (36px pill)|----------------------------------------------------------------------------|
|            | ROW 1: STATS CARDS (4 Kolom)                                               |
|            | [Suhu (Bars)]   [Kelembapan (Line)]  [Tekanan (Gauge)] [Angin (Hero Gradient)]|
|            |----------------------------------------------------------------------------|
|            | ROW 2: VISUALISASI UTAMA (4 Kolom)                                         |
|            | [Grafik Tren Interaktif (2 Kolom)]    [Curah Hujan (Arc)]  [Arah Angin (Compass)]|
|            |----------------------------------------------------------------------------|
|            | ROW 3: HARDWARE & STATUS (4 Kolom)                                         |
|            | [Status Perangkat (2 Kolom)]          [Peringatan List]    [Data Cloud Sync]   |
+-----------------------------------------------------------------------------------------+
```

### Spesifikasi Layout:
1. **Desktop (`lg:grid-cols-[auto_minmax(0,1fr)] lg:h-screen lg:overflow-hidden`)**:
   - Kolom kiri: Sidebar navigasi tetap (`auto`).
   - Kolom kanan: Konten utama dengan 4 baris fleksibel (`grid-rows-[auto_auto_minmax(0,1.2fr)_minmax(0,1fr)]`).
2. **Mobile / Tablet (`min-h-screen`)**:
   - Sidebar mengambang horizontal di bagian atas/bawah (`flex-row overflow-x-auto`).
   - Grid 4-kolom berganti otomatis menjadi 2-kolom (`grid-cols-2`) atau 1-kolom bertumpuk untuk keterbacaan optimal.

---

## 6. Spesifikasi Komponen (Component Specifications)

### 6.1 Sidebar Navigasi (`#side`)
- **Struktur**: Kontainer vertikal berperekat lembut dengan bantalan `p-2.5`, memuat tombol sirkular `w-11 h-11`.
- **Item Menu**:
  1. `grid`: Beranda / Dashboard Ringkasan (aktif default: `bg-dark text-white`).
  2. `chart`: Grafik Analisis Cuaca & Riwayat.
  3. `cpu`: Manajemen Edge Node & Perangkat Sensor.
  4. `bell`: Log Peringatan Dini & Notifikasi.
  5. `db`: Basis Data / Sinkronisasi Cloud.
  6. *(Spacer fleksibel)*.
  7. `set`: Pengaturan Ambang Batas & Sistem.
  8. `out`: Keluar Sesi.
  9. `Avatar`: Inisial identitas lokasi `"SW"` (Sawarna) dengan gradien `bg-gradient-to-br from-sea to-deep`.

### 6.2 Header & Kontrol Global
- **Salam Pengguna**: Teks nama pengelola dan sub-teks waktu/status data contoh.
- **Search Pill**: Input pencarian berbentuk kapsul `rounded-full bg-card py-1 pl-4 pr-1 text-mute` dengan tombol sirkular gelap (`w-9 h-9 bg-dark text-white`).
- **Notifikasi Bell**: Tombol sirkular `w-[46px] h-[46px] bg-card` dengan titik indikator merah menyala (`b.w-2.h-2.bg-red-500`) saat terdapat peringatan aktif.

### 6.3 Kartu Statistik Metrik Cuaca (`#stats`)
- **Ukuran Dasar**: `bg-card rounded-[20px] px-[18px] py-4 min-h-0 flex items-center justify-between gap-3`.
- **Variasi Standar**:
  - Judul parameter berukuran `text-[13.5px] text-mute`.
  - Nilai utama `text-[26px] font-bold tracking-tight` dengan satuan `text-[13px] font-medium text-mute`.
  - Dilengkapi ornamen visual:
    - *Suhu*: 5 batang sparkline mini (`w-1.5 rounded-[3px] bg-sea`) dengan variasi ketinggian.
    - *Kelembapan*: Ikon tetesan air dalam lingkaran `bg-tint text-sea` + sparkline SVG mini 24 jam.
    - *Tekanan Udara*: Ikon barometer/gauge dalam lingkaran `bg-tint text-sea`.
- **Variasi Kartu Hero (Kecepatan Angin)**:
  - Latar belakang gradien samudra: `bg-gradient-to-br from-sea to-deep text-white`.
  - Teks sekunder memakai opasitas: `text-white/80`.
  - Kurva sparkline garis putih murni (`#ffffff`) dengan ketebalan 2.5px.

### 6.4 Modul Grafik Tren Interaktif (`#chart`)
- **Header**: Judul modul, badge status peringatan (*Waspada*), pemilih parameter dropdown (`#ps`), dan pemilih rentang waktu (`#rs`: 24 jam atau 7 hari).
- **Ringkasan Nilai Kunci**: 3 pil ringkas berturut-turut untuk **Maks**, **Rata-rata**, dan **Min** (`bg-bg rounded-xl px-3 py-1.5`).
- **Karakteristik Visual SVG**:
  - Kurva halus Bezier Spline (`Q` quad curve) dengan ketebalan garis `2.5px` berwarna `var(--sea)`.
  - Arsiran gradien vertikal di bawah kurva: `linearGradient` dari `var(--sky)` (opasitas 0.45) menuju transparan (opasitas 0).
  - Garis batas waspada (*Threshold Warning Line*): Garis putus-putus horizontal (`stroke-dasharray="5 4"`) berwarna `var(--warn)` dengan anotasi label nilai ambang batas.
  - Garis kisi horizontal halus (`var(--line)`) dengan label nilai terformat Indonesia (koma untuk desimal).

### 6.5 Indikator Curah Hujan (Radial Arc Gauge)
- **Visualisasi**: Setengah lingkaran SVG (diameter 160px, busur 180 derajat).
- **Trek Latar Belakang**: Tebal garis `22px`, warna `var(--tint)`, ujung bulat (`stroke-linecap="round"`).
- **Indikator Aktif**: Lapisan busur warna `var(--sea)` dengan `pathLength="100"` dan `stroke-dasharray` proporsional.
- **Teks Fokus**: Nilai curah hujan di tengah busur (font size 30px, tebal 700) diikuti label satuan dan badge status (*Aman / Waspada*).

### 6.6 Kompas Arah Angin (Wind Compass Dial)
- **Diameter Lingkaran**: `104px` dengan border halus `stroke: var(--line); stroke-width: 3`.
- **Titik Kardinal**: Penanda mata angin Indonesia: **U** (Utara), **T** (Timur), **S** (Selatan), **B** (Barat).
- **Jarum Penunjuk**: Poligon panah aerodinamis warna `var(--sea)` yang dirotasi dinamis menggunakan CSS/SVG transform `rotate(derajat)`.
- **Statistik 3 Kolom**: Arah derajat (°), Kecepatan hembusan (*gust*), dan Rata-rata kecepatan angin.

### 6.7 Pemantauan Node Perangkat Keras (*Hardware Health*)
- Memantau infrastruktur IoT pesisir secara langsung:
  1. **Edge Node Pantai**: Indikator titik hijau (`bg-ok`), *progress bar* persentase baterai dari panel surya, dan kekuatan sinyal LoRa RSSI (misal: `-104 dBm`).
  2. **Sink Node Kantor**: Tingkat penerimaan paket data LoRa (`99.4%`) dan status modem internet 4G.
  3. **Edge Computing Local Hub**: Kapasitas memori/penyimpanan lokal (`63%`) dan jumlah data telemetri yang sedang mengantre sinkronisasi ke cloud (*backfill queue*).

### 6.8 Daftar Peringatan Dini (*Early Warning Alerts*)
- Elemen daftar vertikal dengan batas aksen kiri tebal: `border-l-[3px] border-sea pl-2.5`.
- Memuat judul kejadian (*Angin kencang 34 km/jam*, *Hujan lebat 18 mm/jam*), stempel waktu kejadian, serta chip status:
  - **Aktif**: `bg-warnbg text-warn`
  - **Selesai**: `bg-okbg text-ok`

### 6.9 Status Data Cloud & Sinkronisasi
- Panel integrasi sinkronisasi data tertunda akibat fluktuasi koneksi pesisir.
- Menampilkan ikon database sirkular `bg-tint text-sea`, hitungan data antre, serta tombol aksi primer (*Call-to-Action*):
  - Kelas: `bg-gradient-to-br from-sea to-deep text-white font-bold text-[13px] rounded-[10px] px-4 py-2.5 shadow-sm hover:opacity-95 transition-opacity`.

---

## 7. Pustaka Ikon Vektor (SVG Icon System)

Seluruh ikon antarmuka menggunakan gaya *minimal stroke line*:
- **Atribut**: `viewBox="0 0 24 24"`, `fill="none"`, `stroke="currentColor"`, `stroke-width="1.8"`, `stroke-linecap="round"`, `stroke-linejoin="round"`.
- **Ukuran Standar**: `20px × 20px` (kelas `.ic`).

```html
<!-- Kamus Ikon Primer -->
<!-- Grid / Dashboard -->
<rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/>
<rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/>

<!-- Chart / Tren -->
<path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>

<!-- CPU / Node Hardware -->
<rect x="6" y="6" width="12" height="12" rx="2"/><path d="M9 2v4M15 2v4M9 18v4M15 18v4M2 9h4M2 15h4M18 9h4M18 15h4"/>

<!-- Bell / Notifikasi -->
<path d="M6 9a6 6 0 0112 0c0 6 2 7 2 7H4s2-1 2-7M10 20a2 2 0 004 0"/>

<!-- Database / Cloud Sinkron -->
<ellipse cx="12" cy="6" rx="8" ry="3"/>
<path d="M4 6v12c0 1.7 3.6 3 8 3s8-1.3 8-3V6M4 12c0 1.7 3.6 3 8 3s8-1.3 8-3"/>

<!-- Settings / Pengaturan -->
<circle cx="12" cy="12" r="3"/>
<path d="M12 2v3M12 19v3M2 12h3M19 12h3M5 5l2 2M17 17l2 2M19 5l-2 2M7 17l-2 2"/>

<!-- Logout / Keluar -->
<path d="M9 4H5a1 1 0 00-1 1v14a1 1 0 001 1h4M16 8l4 4-4 4M20 12H9"/>

<!-- Search / Cari -->
<circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/>

<!-- Drop / Tetes Hujan & Kelembapan -->
<path d="M12 3s6 6.5 6 11a6 6 0 11-12 0c0-4.5 6-11 6-11z"/>

<!-- Gauge / Tekanan Udara & Anemometer -->
<path d="M4 17a8 8 0 1116 0M12 17l4-5"/>
```

---

## 8. Format Angka & Lokalisasi Data (Locale Formatting)

- Bahasa Antarmuka: **Bahasa Indonesia (`id`)**.
- Pemisah Desimal: Menggunakan tanda koma (`,`), contoh: `29,4 °C`, `1008,6 hPa`, `3,2 mm/jam`.
- Pemisah Ribuan: Menggunakan tanda titik (`.`), contoh: `1.024 data`.
- Format Waktu: 24 Jam dengan pemisah titik (misal: `09.40`, `16.10`).
- Tanggal Singkat: `3 Nov`, `Hari ini`.

---

## 9. Petunjuk Implementasi untuk AI & Pengembang (Stitch / Frontend Prompts)

Bagi agen pembuat antarmuka (seperti Stitch AI) atau *engineer* yang mengembangkan halaman turunan (misalnya: *Halaman Analisis Riwayat*, *Halaman Manajemen Node IoT*, atau *Halaman Pengaturan Ambang Batas*), wajib mematuhi aturan berikut:

1. **Gunakan Selalu Token Warna Konsisten**:
   Jangan memakai warna sembarang (seperti Tailwind `bg-blue-500` atau `text-gray-600`). Selalu gunakan padanan `bg-sea`, `from-sea to-deep`, `text-ink`, `text-mute`, `bg-card`, dan `bg-bg`.
2. **Pertahankan Estetika Kelengkungan (Corner Radius Hierarchy)**:
   Gunakan `rounded-[20px]` untuk setiap kontainer kartu baru, `rounded-xl` untuk badge ringkasan, dan `rounded-[10px]` untuk tombol aksi.
3. **Penyajian Data Berbasis Status**:
   Sertakan selalu indikator visual (titik status bulat atau badge berlatar warna muda) yang merujuk pada standar mitigasi bencana cuaca:
   - Hijau (`var(--ok)` & `var(--okbg)`) untuk kondisi aman.
   - Kuning/Oranye (`var(--warn)` & `var(--warnbg)`) untuk waspada.
   - Merah (`var(--bad)` & `var(--badbg)`) untuk bahaya/kritis.
4. **Respon Cepat Saat Koneksi Lambat**:
   Gunakan visualisasi berbasis vektor SVG murni (ringan tanpa dependensi pustaka grafik berat pihak ketiga) agar performa tetap prima di koneksi seluler 4G pesisir.

