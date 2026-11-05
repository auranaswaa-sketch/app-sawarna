# SRS: Dashboard Cuaca Mikro Pantai Sawarna

**Proyek:** Implementasi Sensor Berbasis IoT dan Edge Computing untuk Mendukung Mitigasi dan Adaptasi Perubahan Iklim di Kawasan Wisata Pantai Sawarna
**Cakupan:** Website dashboard dan pengolahan data
**Versi:** 1.0 (Draf), Oktober 2026

---

## 1. Pendahuluan

### 1.1 Tujuan

Mendefinisikan kebutuhan fungsional dan non-fungsional perangkat lunak dashboard dan pengolahan data cuaca mikro Pantai Sawarna.

### 1.2 Lingkup

Layanan ingestion, penyimpanan, pengolahan, peringatan, dan visualisasi data cuaca, termasuk antarmuka web. Firmware sensor dan konfigurasi LoRa berada di luar lingkup (tanggung jawab tim hardware).

### 1.3 Definisi

| Istilah | Arti |
|---|---|
| Edge Node | Perangkat di pantai yang membaca sensor |
| Sink Node | Gateway penerima LoRa di kantor pengelola |
| Reading | Satu pengukuran sensor |
| Alert | Peringatan akibat pelanggaran ambang batas atau anomali |
| Backfill | Pengiriman data tertunda dari edge setelah koneksi pulih |

## 2. Deskripsi Umum

- **Perspektif produk:** Bagian dari sistem IoT end-to-end (Edge Node → LoRa → Sink Node → Cloud → Dashboard). Sistem menerima data dari gateway dan tidak berkomunikasi langsung dengan sensor.
- **Pengguna:** Super Admin, Admin, Operator/Pengelola, Publik (tanpa login).
- **Batasan:** Konektivitas internet terbatas, daya perangkat edge terbatas, dashboard harus ringan dan responsif di HP, bahasa antarmuka Indonesia.
- **Asumsi:** Gateway mampu mengirim data via MQTT atau HTTP POST; waktu perangkat disinkronkan (NTP/RTC); payload berformat JSON.

## 3. Kebutuhan Fungsional

### 3.1 Autentikasi dan Pengguna

- **FR-01:** Sistem menyediakan login dengan email/username dan password.
- **FR-02:** Sistem menerapkan peran Super Admin, Admin, Operator, dan Publik.
- **FR-03:** Admin dapat menambah, mengubah, dan menonaktifkan pengguna.

### 3.2 Ingestion dan Penyimpanan

- **FR-04:** Sistem menerima data sensor dari gateway melalui MQTT atau endpoint HTTP terautentikasi (API key per perangkat).
- **FR-05:** Sistem memvalidasi payload (format, tipe, rentang nilai wajar, timestamp) dan menolak atau menandai data tidak valid.
- **FR-06:** Sistem menyimpan data mentah beserta flag kualitas (valid, suspect, invalid).
- **FR-07:** Sistem mencegah duplikasi data (kombinasi perangkat + timestamp + parameter bersifat unik) agar sinkronisasi ulang dari edge aman.
- **FR-08:** Sistem menerima batch data tertunda dari edge setelah koneksi pulih (backfill).

### 3.3 Pengolahan Data

- **FR-09:** Sistem menghitung agregasi rata-rata, minimum, maksimum, dan jumlah (curah hujan) per 5 menit, per jam, dan per hari.
- **FR-10:** Sistem menghitung arah angin dominan dan distribusi kecepatan untuk wind rose.
- **FR-11:** Sistem mendeteksi anomali: nilai di luar rentang fisik, lonjakan tiba-tiba, dan nilai stagnan (indikasi sensor macet).
- **FR-12:** Sistem menandai perangkat offline bila tidak ada data melebihi batas waktu yang dikonfigurasi (default 5 menit).

### 3.4 Peringatan Dini

- **FR-13:** Admin dapat membuat dan mengubah aturan ambang batas per parameter (misalnya angin lebih dari X m/s, curah hujan lebih dari Y mm/jam) dengan level Waspada, Siaga, Bahaya.
- **FR-14:** Sistem membuat alert saat aturan terpenuhi, mencatat waktu mulai dan selesai.
- **FR-15:** Sistem menampilkan banner alert aktif di dashboard dengan kode warna.
- **FR-16:** Sistem mengirim notifikasi ke saluran terdaftar (Telegram/email) dan mencatat status pengiriman.
- **FR-17:** Operator dapat mengakui (acknowledge) alert dan menambah catatan.

### 3.5 Dashboard dan Visualisasi

- **FR-18:** Beranda menampilkan nilai terkini, waktu pembaruan terakhir, dan tren singkat setiap parameter.
- **FR-19:** Halaman grafik memungkinkan pemilihan parameter, rentang waktu, dan resolusi agregasi.
- **FR-20:** Halaman wind rose menampilkan arah dan kecepatan angin.
- **FR-21:** Halaman riwayat alert dengan filter level, tanggal, dan status.
- **FR-22:** Halaman status perangkat menampilkan baterai, tegangan panel surya, RSSI/SNR LoRa, last seen, dan riwayat sinkronisasi edge ke cloud.
- **FR-23:** Dashboard memperbarui data otomatis (polling atau WebSocket/SSE) tanpa reload halaman.
- **FR-24:** Halaman publik menampilkan ringkasan cuaca dan status alert tanpa login.

### 3.6 Ekspor dan Administrasi

- **FR-25:** Pengguna berhak dapat mengekspor data (CSV; PDF opsional) sesuai rentang waktu dan parameter.
- **FR-26:** Admin dapat mengelola lokasi, perangkat, sensor, dan kalibrasi (offset/faktor).
- **FR-27:** Admin dapat mencatat perawatan perangkat (tanggal, tindakan, petugas).
- **FR-28:** Sistem mencatat audit log untuk perubahan konfigurasi penting.

## 4. Kebutuhan Non-Fungsional

| ID | Kategori | Kebutuhan |
|---|---|---|
| NFR-01 | Kinerja | Halaman utama termuat di bawah 3 detik pada jaringan 4G |
| NFR-02 | Kinerja | Data baru tampil di dashboard maksimal 2 menit setelah diterima |
| NFR-03 | Keandalan | Tidak ada kehilangan data saat internet putus; data disimpan lokal di edge dan disinkronkan otomatis |
| NFR-04 | Ketersediaan | Target uptime 95% atau lebih |
| NFR-05 | Keamanan | Password di-hash (bcrypt/argon2), HTTPS, API key per perangkat, pembatasan akses berdasarkan peran |
| NFR-06 | Keamanan | Perlindungan terhadap SQL injection, XSS, dan CSRF; rate limiting pada endpoint ingestion |
| NFR-07 | Kegunaan | UI responsif (mobile first), bahasa Indonesia, kode warna konsisten untuk level alert |
| NFR-08 | Skalabilitas | Skema mendukung penambahan node dan lokasi tanpa perubahan struktur |
| NFR-09 | Retensi | Data mentah disimpan minimal 12 bulan, agregasi disimpan tanpa batas |
| NFR-10 | Keterpeliharaan | Kode terdokumentasi, konfigurasi via environment variable, backup database terjadwal |
| NFR-11 | Kompatibilitas | Chrome, Firefox, Edge, Safari versi dua tahun terakhir |

## 5. Use Case Utama

| ID | Use case | Aktor | Alur singkat |
|---|---|---|---|
| UC-01 | Melihat cuaca terkini | Operator, Publik | Buka beranda, lihat kartu parameter dan status |
| UC-02 | Menerima dan merespons alert | Operator | Sistem membuat alert, notifikasi terkirim, operator membuka dashboard, mengakui alert, menambah catatan |
| UC-03 | Menganalisis tren | Operator, Tim abdimas | Pilih parameter dan rentang, lihat grafik, ekspor CSV |
| UC-04 | Mengatur ambang batas | Admin | Buka pengaturan, ubah nilai, simpan, tercatat di audit log |
| UC-05 | Memantau perangkat | Admin | Buka status perangkat, cek baterai dan last seen, catat perawatan |
| UC-06 | Sinkronisasi data tertunda | Sistem | Edge mengirim batch setelah online, sistem menyimpan tanpa duplikasi |

## 6. Antarmuka Eksternal dan Kontrak Data

### 6.1 Topik MQTT (Usulan)

- `sawarna/{site_id}/{device_id}/telemetry`
- `sawarna/{site_id}/{device_id}/status`

### 6.2 Payload Telemetri

```json
{
  "device_id": "EDGE-01",
  "ts": "2026-12-01T08:15:00+07:00",
  "seq": 10452,
  "data": {
    "temperature_c": 28.4,
    "humidity_pct": 81.2,
    "pressure_hpa": 1009.6,
    "rainfall_mm": 0.4,
    "wind_speed_ms": 5.8,
    "wind_dir_deg": 215
  },
  "flags": ["ok"]
}
```

### 6.3 Payload Status Perangkat

```json
{
  "device_id": "EDGE-01",
  "ts": "2026-12-01T08:15:00+07:00",
  "battery_v": 12.4,
  "solar_v": 17.9,
  "rssi_dbm": -92,
  "snr_db": 6.5,
  "pending_sync": 0
}
```

### 6.4 REST API

| Method | Endpoint | Fungsi |
|---|---|---|
| POST | /api/ingest | Terima data (batch) dari gateway |
| GET | /api/readings/latest | Nilai terkini semua parameter |
| GET | /api/readings?param=&from=&to=&agg= | Data time-series teragregasi |
| GET | /api/alerts | Daftar alert (filter status/level) |
| POST | /api/alerts/{id}/ack | Mengakui alert |
| GET/PUT | /api/rules | Baca/ubah aturan ambang batas |
| GET | /api/devices | Status perangkat |
| GET | /api/export?... | Ekspor CSV |

## 7. Matriks Keterlacakan (Fitur PRD → Kebutuhan SRS)

| Fitur PRD | Kebutuhan SRS |
|---|---|
| F1 Beranda | FR-18 |
| F2 Grafik | FR-19 |
| F3 Wind rose | FR-10, FR-20 |
| F4 Ingestion | FR-04 s.d. FR-08 |
| F5 Agregasi | FR-09 |
| F6 Anomali dan ambang batas | FR-11, FR-13, FR-14 |
| F7 Peringatan dini | FR-15, FR-16, FR-17, FR-21 |
| F8 Login dan peran | FR-01 s.d. FR-03 |
| F9 Monitoring perangkat | FR-12, FR-22 |
| F10 Ekspor | FR-25 |
| F11 Pengaturan ambang batas | FR-13 |
| F12 Log perawatan | FR-27 |
| F13 Halaman publik | FR-24 |
| F15 Multi-lokasi/node | FR-26, NFR-08 |

## 8. Asumsi dan Pertanyaan Terbuka

1. Jumlah node dan interval kirim data (diasumsikan 1 edge node, 1 menit).
2. Format final payload dari tim hardware (contoh di atas bersifat usulan).
3. Standar ambang batas yang dipakai (misalnya BMKG) dan pihak yang memutuskan.
4. Saluran notifikasi yang paling dipakai pengelola.
5. Hosting: cloud (VPS) saja, atau juga versi lokal di sink node.
