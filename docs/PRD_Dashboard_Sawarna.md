# PRD: Dashboard Cuaca Mikro Pantai Sawarna

**Proyek:** Implementasi Sensor Berbasis IoT dan Edge Computing untuk Mendukung Mitigasi dan Adaptasi Perubahan Iklim di Kawasan Wisata Pantai Sawarna
**Cakupan:** Website dashboard dan pengolahan data
**Versi:** 1.0 (Draf), Oktober 2026

---

## 0. Konteks Sistem

Alur menurut proposal: **Edge Node** di pantai (mikrokontroler + sensor cuaca, catu daya panel surya) mengirim data via **LoRa** ke **Sink Node/Gateway** di kantor pengelola (single-board computer dengan penyimpanan lokal, filtering, agregasi, deteksi anomali), lalu diteruskan ke **cloud** dan **dashboard web**.

**Parameter cuaca:** suhu, kelembapan, tekanan udara, curah hujan, kecepatan angin, arah angin. Indeks UV bersifat opsional (fase 2).

**Asumsi (perlu dikonfirmasi):** 1 edge node + 1 sink node untuk tahap awal (skema siap multi-node), interval kirim data 1 menit, payload berformat JSON.

---

## 1. Latar Belakang dan Masalah

Kawasan Pantai Sawarna berhadapan langsung dengan Samudra Hindia dan rentan terhadap cuaca ekstrem. Pengelola belum punya informasi cuaca mikro yang kontinu dan cepat diakses. Konektivitas internet terbatas, sehingga ada risiko kehilangan data, latensi tinggi, dan ketergantungan pada cloud yang tidak stabil.

## 2. Tujuan Produk

1. Menampilkan data cuaca mikro real-time dan historis dalam satu dashboard yang mudah dibaca pengelola non-teknis.
2. Memberi peringatan dini ketika parameter melewati ambang batas (hujan lebat, angin kencang, dll).
3. Tetap berguna saat internet putus: data tersimpan di edge dan disinkronkan otomatis saat koneksi kembali.
4. Memantau kesehatan perangkat (baterai, panel surya, sinyal) agar perawatan bisa dilakukan tepat waktu.

## 3. Target Pengguna

| Persona | Kebutuhan utama | Tingkat akses |
|---|---|---|
| Pengelola wisata PSB | Lihat kondisi cuaca sekarang, terima peringatan, ambil keputusan keselamatan wisatawan | Viewer + penerima alert |
| Masyarakat pesisir (nelayan, petani tambak, pelaku usaha) | Cek cuaca cepat dari HP, atur jadwal kerja | Publik (read-only) |
| Admin lokal / teknisi | Atur ambang batas, kelola perangkat, lihat log perawatan | Admin |
| Tim abdimas Tel-U | Unduh data, evaluasi performa sistem, bahan publikasi | Super admin |

## 4. Fitur dan Prioritas

| ID | Fitur | Prioritas |
|---|---|---|
| F1 | Halaman beranda: kartu nilai terkini tiap parameter + status perangkat | Must |
| F2 | Grafik time-series (jam, hari, minggu, bulan) per parameter | Must |
| F3 | Wind rose / arah angin | Should |
| F4 | Ingestion data dari gateway (MQTT/HTTP) + validasi | Must |
| F5 | Agregasi data (rata-rata, min, maks per 5 menit, jam, hari) | Must |
| F6 | Deteksi anomali dan aturan ambang batas | Must |
| F7 | Peringatan dini di dashboard + notifikasi (Telegram/WhatsApp/email) | Must (dashboard), Should (notifikasi) |
| F8 | Login dan manajemen pengguna berbasis peran | Must |
| F9 | Monitoring perangkat (baterai, tegangan panel surya, RSSI LoRa, last seen) | Must |
| F10 | Ekspor data CSV/PDF | Should |
| F11 | Pengaturan ambang batas oleh admin | Must |
| F12 | Log perawatan perangkat | Could |
| F13 | Halaman publik ringkas untuk masyarakat | Should |
| F14 | Prediksi/analisis tren sederhana | Could |
| F15 | Dukungan multi-lokasi dan multi-node | Could |

## 5. Metrik Keberhasilan

- Dashboard menampilkan data terbaru dengan keterlambatan maksimal 2 menit saat koneksi normal.
- Tidak ada data hilang setelah internet putus lalu pulih (data completeness 99% atau lebih pada pengujian).
- Alert terkirim maksimal 1 menit setelah ambang batas terlewati.
- Minimal 80% peserta pelatihan pengelola mampu membaca dashboard dan merespons alert (kuesioner pasca-pelatihan).
- Uptime dashboard 95% atau lebih selama masa evaluasi.

## 6. Di Luar Lingkup

Firmware sensor, desain jaringan LoRa, desain catu daya, aplikasi mobile native, prediksi cuaca berbasis machine learning (hanya tren sederhana), integrasi resmi BMKG/BPBD (potensi pengembangan lanjutan).

## 7. Risiko dan Mitigasi

| Risiko | Mitigasi |
|---|---|
| Internet pesisir tidak stabil | Edge menyimpan lokal, sinkronisasi dengan antrean dan idempotency key |
| Sensor rusak karena korosi/kelembapan | Flag kualitas data, status perangkat, notifikasi "node offline" |
| Pengguna lokal kurang paham teknologi | UI sederhana, bahasa Indonesia, kode warna status, pelatihan |
| Format payload dari hardware berubah | Kontrak data terdokumentasi dan versi skema |
| Waktu implementasi (Jan 2027) mepet | Kerjakan MVP dulu |

## 8. Pertanyaan Terbuka

1. Berapa node yang akan dipasang di Sawarna dan berapa interval kirim data?
2. Dashboard di-host di cloud (VPS) saja, atau juga ada versi lokal di sink node?
3. Ambang batas (angin, hujan, suhu) mengacu ke standar siapa (misalnya BMKG) dan siapa yang memutuskan?
4. Saluran notifikasi apa yang paling dipakai pengelola (Telegram, WhatsApp, email)?
5. Apakah sensor UV akan benar-benar dipasang?
