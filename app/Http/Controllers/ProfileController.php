<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman Detail Profil Administrator Cuaca Pantai Sawarna.
     * Sesuai dengan spesifikasi PRD/SRS dan token desain resmi di DESIGN.md.
     */
    public function index(Request $request)
    {
        $profile = [
            'user' => [
                'name' => 'Ahmad Fauzi, S.Kom.',
                'title' => 'Koordinator Mitigasi & Operasional Posko Cuaca',
                'nip' => 'POK-SWR-2024-001',
                'role' => 'Super Administrator',
                'role_badge' => 'Super Admin',
                'role_description' => 'Akses penuh ke konfigurasi sensor IoT, otorisasi peringatan dini, pengawasan node pesisir, dan manajemen pengguna.',
                'email' => 'admin.sawarna@telkomuniversity.ac.id',
                'phone' => '+62 812-9876-5432',
                'organization' => 'POKDARWIS Sawarna & Tim Riset Abdimas Telkom University',
                'station_name' => 'Pos Pantau Pantai Ciantir (SW-NODE-01)',
                'address' => 'Jl. Pantai Ciantir No. 8, Desa Sawarna, Kec. Bayah, Kab. Lebak, Banten 42393',
                'coordinates' => '-6.98520, 106.31140',
                'avatar_initials' => 'AF',
                'joined_at' => '12 Oktober 2024',
                'last_active' => 'Online · Sedang Aktif',
                'mfa_enabled' => true,
            ],
            'stats' => [
                'days_active' => 388,
                'alerts_handled' => 42,
                'nodes_supervised' => 3,
                'uptime_rate' => '99,4%',
            ],
            'assigned_zones' => [
                [
                    'name' => 'Pantai Ciantir (Zona Utama)',
                    'type' => 'Edge Node Pantai #1',
                    'sensors' => 'Suhu, Kelembapan, Tekanan, Hujan, Angin',
                    'status' => 'Normal / Terhubung',
                    'status_type' => 'ok',
                ],
                [
                    'name' => 'Pantai Tanjung Layar',
                    'type' => 'Edge Node Pesisir Barat #2',
                    'sensors' => 'Anemometer & Arah Angin Samudra',
                    'status' => 'Waspada Angin Kencang',
                    'status_type' => 'warn',
                ],
                [
                    'name' => 'Kantor Pengelola Desa Sawarna',
                    'type' => 'Sink Node Gateway & Cloud Relay',
                    'sensors' => 'Modem 4G, Gateway LoRa, Edge Buffer Storage',
                    'status' => 'Sinkron 100%',
                    'status_type' => 'ok',
                ],
            ],
            'sessions' => [
                [
                    'device' => 'Desktop PC (Windows 11) · Google Chrome',
                    'ip' => '182.253.114.28',
                    'location' => 'Kantor Desa Sawarna, Lebak',
                    'time' => 'Sesi Saat Ini (Aktif)',
                    'is_current' => true,
                ],
                [
                    'device' => 'Smartphone (Apple iPhone 15 Pro) · Mobile Safari',
                    'ip' => '114.122.39.12',
                    'location' => 'Jaringan Seluler 4G Bayah - Sawarna',
                    'time' => '2 jam lalu (08.15 WIB)',
                    'is_current' => false,
                ],
                [
                    'device' => 'Laptop Lapangan (Ubuntu 24.04) · Firefox ESR',
                    'ip' => '182.253.114.30',
                    'location' => 'Pos SAR Pantai Ciantir',
                    'time' => 'Kemarin, 16.45 WIB',
                    'is_current' => false,
                ],
            ],
            'recent_activities' => [
                [
                    'action' => 'Mengubah Ambang Batas Kecepatan Angin',
                    'detail' => 'Nilai batas waspada disesuaikan ke 30 km/jam sesuai instruksi BMKG Maritim.',
                    'time' => 'Hari ini, 09.15 WIB',
                    'icon' => 'fa-wind',
                    'type' => 'warn',
                ],
                [
                    'action' => 'Mengonfirmasi Alert Hujan Lebat (Acknowledge)',
                    'detail' => 'Status waspada curah hujan 18 mm/jam diakui dan disebarkan ke grup relawan.',
                    'time' => '3 Nov 2026, 16.15 WIB',
                    'icon' => 'fa-cloud-rain',
                    'type' => 'ok',
                ],
                [
                    'action' => 'Pemeriksaan Lapangan Sensor Anemometer',
                    'detail' => 'Pembersihan bilah baling-baling dari pasir dan kerak garam laut.',
                    'time' => '1 Nov 2026, 11.20 WIB',
                    'icon' => 'fa-screwdriver-wrench',
                    'type' => 'sea',
                ],
                [
                    'action' => 'Mengunduh Laporan Telemetri Mingguan (CSV)',
                    'detail' => 'Ekspor 168 jam data telemetri untuk riset evaluasi tim Telkom University.',
                    'time' => '30 Okt 2026, 14.00 WIB',
                    'icon' => 'fa-file-csv',
                    'type' => 'tint',
                ],
            ],
            'alert_preferences' => [
                'wa_urgent' => true,
                'telegram_instant' => true,
                'battery_low' => true,
                'daily_digest' => false,
            ],
        ];

        return view('admin.profile', compact('profile'));
    }

    /**
     * Simpan pembaruan profil administrator.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:30',
            'email' => 'required|email|max:100',
            'organization' => 'nullable|string|max:150',
            'address' => 'nullable|string|max:255',
        ]);

        return redirect()->route('profile.index')->with('success', 'Data profil pengelola berhasil diperbarui.');
    }
}

