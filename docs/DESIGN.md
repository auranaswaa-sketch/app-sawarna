# PANDUAN DESIGN SYSTEM & UI/UX OPERATOR
## Dashboard Cuaca Mikro & Sistem Peringatan Dini Pantai Sawarna
*Edisi: Operator-First & High-Usability (Sederhana, Sigap, Ramah Pengguna)*

Dokumen ini merupakan panduan resmi desain antarmuka (*Design System Specification*) yang diperbarui khusus untuk memenuhi kebutuhan **Operator Lapangan, Petugas Pos Pantau, Penjaga Pantai (Life Guard/Balawista), dan Pengurus POKDARWIS Sawarna**.

---

## 1. Filosofi & Prinsip Desain Operator-First

Petugas posko dan operator lapangan sering kali harus mengambil keputusan keselamatan pengunjung di bawah kondisi stres, cuaca buruk, atau terik matahari pesisir. Oleh karena itu, antarmuka dirancang dengan 5 pilar utama:

### 1. Aturan 3 Detik (*The 3-Second Rule*)
Dalam 3 detik menatap layar, operator harus langsung mengetahui jawaban atas pertanyaan terpenting:
- **"Apakah pantai saat ini aman untuk wisatawan?"** (Status warna jelas: Hijau = Aman, Kuning = Waspada, Merah = Bahaya).
- **"Apakah alat sensor di pantai masih menyala?"** (Status perangkat: Normal / Perlu Cek).

### 2. Kebijakan Bebas Jargon (*Zero-Jargon Policy*)
Hilangkan istilah telemetri teknis yang membingungkan bagi operator non-teknisi:
- ❌ Jangan gunakan: *RSSI -104 dBm, SNR +6.5 dB, PDR 99.4%, Ingestion Payload, Tipping Bucket BME280*.
- ✅ Gunakan bahasa manusia: *Sinyal Sangat Baik, Baterai 78% (Mengisi dari Panel Surya), Alat Pengukur Hujan Normal, Internet Kantor 4G Aktif*.

### 3. Navigasi Berlabel Jelas (*Clear Labeled Navigation*)
Hindari navigasi yang hanya mengandalkan ikon tanpa teks. Operator lapangan tidak boleh menebak arti simbol:
- Setiap menu memiliki **ikon kontras + label teks bahasa Indonesia yang tegas** (*Beranda Cuaca, Alat Sensor, Pengaturan, Profil Petugas*).

### 4. Elemen Sentuh Besar (*Touch & Sunlight Friendly*)
- Tombol dan kartu berukuran besar (*minimum touch target 48px*).
- Kontras tinggi (*High Contrast*) agar tetap terbaca jelas di layar tablet/ponsel posko di bawah terik sinar matahari pantai.
- Sudut *squircle* melengkung modern (16px–24px) yang nyaman dipandang.

### 5. Panduan Tindakan Nyata (*Actionable Safety Warnings*)
Setiap kali muncul status *Waspada* atau *Bahaya*, sistem tidak hanya menampilkan angka, tetapi juga **rekomendasi tindakan langsung**:
- Contoh: *"Angin 34 km/jam melewati batas 30 km/jam &rarr; Imbau pengunjung menjauhi tebing karang Tanjung Layar."*

---

## 2. Palet Warna Operator (High-Contrast Coastal Maritime)

Warna dirancang berdaya kontras tinggi dan memenuhi standar aksesibilitas WCAG AAA untuk keterbacaan luar ruangan:

| Token CSS | Tailwind Class | Warna (Hex) | Peran & Arti untuk Operator |
|---|---|---|---|
| `--ok` / `--okbg` | `text-ok bg-okbg` | `#1B8A5A` / `#DCF5EC` | **PANTAI AMAN**: Cuaca kondusif, sensor menyala normal, wisata dibuka |
| `--warn` / `--warnbg` | `text-warn bg-warnbg` | `#C97812` / `#FFF1D6` | **WASPADA**: Angin kencang / hujan sedang, pasang bendera kuning, siaga posko |
| `--bad` / `--badbg` | `text-bad bg-badbg` | `#C53030` / `#FDE8E8` | **BAHAYA / DARURAT**: Cuaca ekstrem / badai, pasang bendera merah, evakuasi bibir pantai |
| `--sea` | `bg-sea text-sea` | `#0E86B8` | Warna primer laut Sawarna untuk kartu sorotan & tombol utama |
| `--deep` | `from-sea to-deep` | `#0A5C8A` | Warna gradien samudra untuk tombol aksi cepat |
| `--bg` | `bg-bg` | `#E8EEF2` | Latar belakang kanvas sejuk dan tidak menyilaukan mata |
| `--card` | `bg-card` | `#FFFFFF` | Permukaan kartu putih bersih dengan batas halus |
| `--ink` | `text-ink` | `#0D2738` | Teks hitam-kebiruan kontras sangat tinggi untuk angka & judul |
| `--mute` | `text-mute` | `#5A7585` | Teks keterangan pendukung yang tetap mudah dibaca |
| `--line` | `border-line` | `#D5E2EA` | Garis pemisah tegas dan rapi |

---

## 3. Tipografi Ramah Operator (Plus Jakarta Sans)

Sistem menggunakan **Plus Jakarta Sans** dengan penekanan pada ukuran besar dan ketebalan huruf (*font-weight*) yang mantap:

```css
font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
```

### Skala Ukuran untuk Operator:
- **Status Keselamatan Utama**: `text-2xl` s/d `text-3xl font-extrabold` (Mudah dibaca dari jarak 1 meter).
- **Angka Pembacaan Sensor**: `text-3xl` s/d `text-4xl font-extrabold` (Contoh: **34** km/jam, **29,4** °C).
- **Label Parameter**: `text-sm font-bold uppercase tracking-wider` (Contoh: KECEPATAN ANGIN).
- **Teks Instruksi / Aksi**: `text-sm sm:text-base font-semibold` (Contoh: "Imbau nelayan perahu kecil berhati-hati").
- **Tombol Aksi**: `text-sm font-bold` (Contoh: "Kirim Peringatan WhatsApp").

---

## 4. Tata Letak Dashboard Sederhana (3 Blok Inti)

Antarmuka dirancang dalam 3 blok horizontal berurutan sesuai prioritas operator:

```
+-----------------------------------------------------------------------------------------+
| [NAVBAR ATAS / SAMPING]  Logo Sawarna  |  Beranda  |  Alat Sensor  |  Setelan  |  Profil |
+-----------------------------------------------------------------------------------------+
| BLOK 1: BANNER KESELAMATAN PANTAI UTAMA (Status Hidup & Instruksi Petugas)              |
| [!] STATUS KAWASAN: WASPADA ANGIN KENCANG (34 km/jam)                                   |
|     Instruksi: Pasang bendera kuning di Pantai Ciantir. Nelayan perahu jukung waspada.  |
|     [Tombol: Kirim WhatsApp Pengelola]    [Tombol: Laporkan Kondisi]                    |
+-----------------------------------------------------------------------------------------+
| BLOK 2: 4 KARTU METRIK CUACA UTAMA (Besar, Jelas, Disertai Penjelasan Bahasa Manusia)   |
| [ ANGIN: 34 km/j ]   [ HUJAN: 3,2 mm/j ]   [ SUHU: 29,4 °C ]   [ GELOMBANG / OMBAK ]    |
| Status: Waspada      Status: Aman Gerimis  Status: Nyaman       Status: Laut Tenang     |
+-----------------------------------------------------------------------------------------+
| BLOK 3: KONDISI ALAT SENSOR & BANTUAN LAPANGAN                                          |
| [ Sensor di Pantai: MENYALA (Baterai 78% - Panel Surya Mengisi) - Sinyal Bagus ]        |
| [ Gateway Kantor: NORMAL (Internet 4G Aktif) - Pengiriman Data Berjalan Baik ]          |
+-----------------------------------------------------------------------------------------+
```

---

## 5. Pedoman Pembaruan Halaman

### 1. Dashboard Beranda (`dashboard.blade.php`)
- Menampilkan Banner Status Keselamatan di posisi teratas layar.
- 4 Kartu metrik berukuran besar dengan bahasa Indonesia sehari-hari.
- Status sensor pantai diterjemahkan menjadi indikator baterai dan lampu hijau "Menyala Normal".
- Menyediakan tombol bantuan langsung untuk menghubungi tim evakuasi / koordinator Pokdarwis.

### 2. Manajemen Alat & Sensor (`devices/index.blade.php`)
- Tampilan kartu sederhana: Tiap alat memiliki foto/ikon, nama lokasi posko, indikator daya baterai, dan teks "Berfungsi Baik" atau "Perlu Diperiksa".
- Panduan perawatan singkat untuk operator (misal: cara menyeka kaca panel surya atau membersihkan corong pengukur hujan).

### 3. Pengaturan Ambang Batas (`settings.blade.php`)
- Mengganti istilah teknis rumit dengan slider mudah dipahami.
- Menampilkan nilai rekomendasi resmi (BMKG) agar operator tidak bingung menentukan angka.
- Pengaturan nomor WhatsApp darurat yang ringkas dan jelas.

### 4. Profil Petugas Operator (`profile.blade.php`)
- Identitas petugas jaga piket hari ini, nomor kontak darurat posko, serta riwayat konfirmasi peringatan dini.
