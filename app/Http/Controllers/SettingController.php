<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Tampilkan halaman Pengaturan Admin Cuaca Mikro Pantai Sawarna.
     * Sesuai dengan spesifikasi PRD/SRS dan token desain resmi di DESIGN.md.
     */
    public function index(Request $request)
    {
        $settings = [
            'meta' => [
                'title' => 'Pengaturan Sistem & Ambang Batas',
                'subtitle' => 'Kelola aturan peringatan dini, saluran notifikasi darurat, dan kalibrasi sensor IoT Sawarna',
                'station_name' => 'Stasiun Cuaca Pantai Sawarna (Pos Pantau Ciantir)',
                'station_code' => 'SW-NODE-01',
                'last_synced' => '4 Nov 2026, 10.15 WIB',
            ],
            // 1. Ambang Batas Cuaca & Peringatan Dini
            'thresholds' => [
                'wind' => [
                    'label' => 'Kecepatan Angin',
                    'unit' => 'km/jam',
                    'waspada' => 30,
                    'siaga' => 45,
                    'bahaya' => 60,
                    'current' => 34,
                    'is_active' => true,
                    'note' => 'Berdasarkan rekomendasi BMKG untuk kawasan wisata pesisir Samudra Hindia.',
                ],
                'rain' => [
                    'label' => 'Curah Hujan',
                    'unit' => 'mm/jam',
                    'waspada' => 10,
                    'siaga' => 20,
                    'bahaya' => 35,
                    'current' => 3.2,
                    'is_active' => true,
                    'note' => 'Potensi banjir rob dan genangan jalur akses utama desa.',
                ],
                'temp' => [
                    'label' => 'Suhu Udara Ekstrem',
                    'unit' => '°C',
                    'min_cold' => 20,
                    'max_heat' => 35,
                    'current' => 29.4,
                    'is_active' => true,
                    'note' => 'Peringatan suhu tinggi bagi keselamatan wisatawan dan nelayan lokal.',
                ],
                'pressure' => [
                    'label' => 'Tekanan Barometrik',
                    'unit' => 'hPa',
                    'drop_limit' => 1000,
                    'current' => 1008.6,
                    'is_active' => true,
                    'note' => 'Penurunan tajam di bawah batas mengindikasikan pembentukan bibit siklon tropis.',
                ],
            ],
            // 2. Saluran Notifikasi Darurat
            'notifications' => [
                'telegram' => [
                    'enabled' => true,
                    'bot_name' => '@SawarnaWeatherAlertBot',
                    'chat_id' => '-1002938475829',
                    'channel_name' => 'Grup Tanggap Darurat & Pengelola Wisata',
                    'status' => 'Terhubung',
                    'last_tested' => 'Kemarin, 14.30 WIB',
                ],
                'whatsapp' => [
                    'enabled' => true,
                    'gateway' => 'Fonnte / Wablas IoT Service',
                    'recipients' => '+62 812-8899-7711 (Ketua Pokdarwis), +62 878-3344-5522 (Tim Rescue)',
                    'status' => 'Aktif',
                    'cooldown_minutes' => 15,
                ],
                'email' => [
                    'enabled' => false,
                    'recipients' => 'pengelola.sawarna@gmail.com, tim.abdimas@telkomuniversity.ac.id',
                    'status' => 'Nonaktif',
                ],
            ],
            // 3. Konfigurasi Hardware IoT & Edge Telemetry
            'hardware' => [
                'send_interval' => '1', // menit
                'offline_timeout' => '5', // menit
                'battery_low_threshold' => 20, // %
                'min_rssi' => -120, // dBm
                'calibration' => [
                    'temp_offset' => '+0.2',
                    'hum_offset' => '-1.5',
                    'pressure_offset' => '+0.4',
                ],
                'device_key' => 'sw_live_sec_99a8bc43f1e92d847291a003f9',
                'auto_backfill' => true,
                'max_local_queue' => 2000,
            ],
            // 4. Profil Admin & Stasiun
            'admin' => [
                'name' => 'Ahmad Fauzi, S.Kom.',
                'role' => 'Administrator Stasiun Sawarna (POKDARWIS)',
                'email' => 'admin.sawarna@telkomuniversity.ac.id',
                'phone' => '+62 812-9876-5432',
                'station_location' => 'Pantai Ciantir, Desa Sawarna, Kec. Bayah, Lebak, Banten',
                'coordinates' => '-6.98520, 106.31140',
                'mfa_status' => true,
            ],
        ];

        return view('admin.settings', compact('settings'));
    }

    /**
     * Simpan pembaruan pengaturan sistem & ambang batas sensor.
     */
    public function update(Request $request)
    {
        // Validasi input form pengaturan
        $validated = $request->validate([
            'wind_waspada' => 'nullable|numeric|min:1',
            'wind_siaga' => 'nullable|numeric|min:1',
            'wind_bahaya' => 'nullable|numeric|min:1',
            'rain_waspada' => 'nullable|numeric|min:0',
            'rain_siaga' => 'nullable|numeric|min:0',
            'rain_bahaya' => 'nullable|numeric|min:0',
            'send_interval' => 'nullable|string',
            'offline_timeout' => 'nullable|numeric',
        ]);

        return redirect()->route('settings.index')->with('success', 'Konfigurasi ambang batas dan sistem berhasil diperbarui.');
    }
}

