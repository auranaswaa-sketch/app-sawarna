# MVP: Dashboard Cuaca Mikro Pantai Sawarna

**Proyek:** Implementasi Sensor Berbasis IoT dan Edge Computing untuk Mendukung Mitigasi dan Adaptasi Perubahan Iklim di Kawasan Wisata Pantai Sawarna
**Cakupan:** Website dashboard dan pengolahan data
**Versi:** 1.0 (Draf), Oktober 2026

---

## 1. Tujuan MVP

Membuktikan bahwa data sensor dari pantai bisa tampil real-time di dashboard, tersimpan aman saat internet putus, dan memicu peringatan dasar. Cukup untuk dipakai pada tahap implementasi dan penyuluhan di lokasi mitra (rencana Januari 2027).

## 2. Fitur dalam MVP

| No | Fitur | Mengacu ke |
|---|---|---|
| 1 | Ingestion data (MQTT/HTTP) + validasi + anti-duplikasi | F4, FR-04 s.d. FR-08 |
| 2 | Penyimpanan data mentah dan agregasi per jam dan per hari | F5, FR-09 |
| 3 | Beranda: kartu nilai terkini 6 parameter + status online/offline | F1, FR-18 |
| 4 | Grafik time-series dengan pilihan parameter dan rentang | F2, FR-19 |
| 5 | Ambang batas dasar (3 aturan: hujan, angin, suhu) + banner alert di dashboard | F6, F11, FR-13 s.d. FR-15 |
| 6 | Notifikasi Telegram | F7, FR-16 |
| 7 | Login dengan 2 peran (admin, operator) | F8, FR-01 s.d. FR-03 |
| 8 | Status perangkat (last seen, baterai, tegangan surya) | F9, FR-22 |
| 9 | Ekspor CSV | F10, FR-25 |

## 3. Ditunda ke Fase Berikutnya

Wind rose, halaman publik, deteksi anomali lanjutan (stagnan/lonjakan), log perawatan, audit log lengkap, PDF, multi-lokasi, prediksi tren, parameter UV, integrasi BMKG/BPBD.

## 4. Tabel Database untuk MVP

`users`, `sites`, `devices`, `sensors`, `readings`, `aggregates`, `alert_rules`, `alerts`, `device_status_logs`, dan `notification_channels` (versi sederhana). Tabel lain (`notification_logs`, `sync_logs`, `maintenance_logs`, `audit_logs`) ditambahkan setelah MVP.

## 5. Rencana Pengerjaan (Usulan 8 Minggu)

| Minggu | Target |
|---|---|
| 1 | Finalisasi kontrak data dengan tim hardware, setup repo, database, dan environment |
| 2 | Skema database + endpoint ingestion + validasi (uji dengan data simulasi) |
| 3 | Job agregasi + endpoint pembacaan data |
| 4 | Frontend: login, beranda, kartu parameter |
| 5 | Frontend: grafik time-series, status perangkat |
| 6 | Aturan ambang batas, pembuatan alert, banner, notifikasi Telegram |
| 7 | Ekspor CSV, uji integrasi dengan edge node nyata, uji putus-sambung internet |
| 8 | Perbaikan bug, dokumentasi, panduan pengguna, persiapan pelatihan pengelola |

Jika waktu mepet, pangkas dulu fitur 6 (Telegram) dan 9 (ekspor). Jangan pangkas ingestion, penyimpanan, grafik, dan alert dashboard.

## 6. Kriteria Penerimaan

- [ ] Data simulasi dan data sensor nyata tampil di dashboard dengan keterlambatan di bawah 2 menit.
- [ ] Setelah internet diputus 30 menit lalu dipulihkan, seluruh data tertunda masuk tanpa duplikasi.
- [ ] Alert muncul di dashboard dan terkirim ke Telegram saat nilai melewati ambang batas uji.
- [ ] Node yang tidak mengirim data lebih dari 5 menit tampil sebagai offline.
- [ ] Operator non-teknis dapat melakukan UC-01 (lihat cuaca terkini) dan UC-02 (respons alert) tanpa bantuan setelah pelatihan singkat.

## 7. Rekomendasi Teknologi (Saran)

- **Edge/Sink:** Single-board computer dengan Mosquitto (MQTT broker lokal), SQLite atau PostgreSQL lokal, skrip pra-pemrosesan Python.
- **Backend:** FastAPI (Python) atau Node.js (Express/NestJS), PostgreSQL (opsional TimescaleDB untuk time-series).
- **Frontend:** React atau Next.js + Tailwind, Chart.js/ECharts/Recharts untuk grafik.
- **Notifikasi:** Telegram Bot API.
- **Deploy:** Docker Compose di VPS.

Pilih stack yang paling kamu kuasai.

## 8. Pertanyaan Terbuka

1. Berapa node yang akan dipasang di Sawarna dan berapa interval kirim data?
2. Dashboard di-host di cloud (VPS) saja, atau juga ada versi lokal di sink node?
3. Ambang batas (angin, hujan, suhu) mengacu ke standar siapa dan siapa yang memutuskan?
4. Saluran notifikasi apa yang paling dipakai pengelola?
5. Apakah sensor UV akan benar-benar dipasang?
