<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman utama dashboard yang sesuai dengan spesifikasi
     * Pantai Sawarna IoT & Weather Early Warning System dan referensi desain visual.
     */
    public function index(Request $request)
    {
        $data = [
            'meta' => [
                'title' => 'Dashboard Cuaca Mikro & Sistem Peringatan Dini Pantai Sawarna',
                'location' => 'Pantai Sawarna, Lebak, Banten',
                'last_updated' => now()->format('H:i') . ' WIB',
            ],
            'user' => [
                'name' => 'Carlic Bolomboy',
                'email' => 'carlic@gmail.com',
                'role' => 'Pengawas Stasiun Cuaca Sawarna',
                'avatar_initials' => 'SW',
                'projects' => 26,
                'followers' => 356,
                'following' => 68,
            ],
            'metrics' => [
                'temperature' => [
                    'label' => 'Suhu Udara',
                    'ref_label' => 'Spent this month',
                    'value' => '29,4',
                    'ref_value' => '$682.5',
                    'unit' => '°C',
                    'trend' => '+0.8°C vs kemarin',
                    'bars' => [40, 70, 55, 85, 60],
                ],
                'humidity' => [
                    'label' => 'Kelembapan',
                    'ref_label' => 'New clients',
                    'value' => '84',
                    'ref_value' => '321',
                    'unit' => '%',
                    'trend' => '+2% vs rata-rata',
                ],
                'pressure' => [
                    'label' => 'Tekanan Udara',
                    'ref_label' => 'Earnings',
                    'value' => '1008,6',
                    'ref_value' => '$350.40',
                    'unit' => 'hPa',
                    'trend' => 'Stabil',
                ],
                'wind' => [
                    'label' => 'Kecepatan Angin',
                    'ref_label' => 'Activity',
                    'value' => '34',
                    'ref_value' => '$540.50',
                    'unit' => 'km/jam',
                    'trend' => 'Waspada (Batas 30)',
                ],
            ],
            'trend' => [
                'parameter' => 'Kecepatan Angin & Suhu',
                'status' => 'Waspada',
                'on_track_text' => 'Kondisi Terpantau',
                'max' => '34,0 km/j',
                'max_change' => '+2.45%',
                'avg' => '24,2 km/j',
                'avg_change' => '-4.75%',
                'min' => '14,0 km/j',
                'ref_saves' => '43.50%',
                'ref_balance' => '$52,422',
            ],
            'rainfall' => [
                'current' => '3,2',
                'unit' => 'mm/jam',
                'total_expense' => '$6078.76',
                'total_daily' => '18,4 mm',
                'subtext' => 'Intensitas hujan terpantau aman',
                'percentage' => 80,
                'status' => 'Aman',
            ],
            'wind_compass' => [
                'direction_deg' => 225,
                'cardinal' => 'Barat Daya (SW)',
                'gust' => 41,
                'average' => 28,
            ],
            'hardware_cards' => [
                [
                    'id' => 'node-1',
                    'name' => 'Edge Node Pantai',
                    'type' => 'LoRa Solar Sensor Unit',
                    'battery' => 78,
                    'rssi' => '-104 dBm',
                    'sub' => 'Baterai 78% · Panel surya mengisi',
                    'code' => '**** 1234 1234 1234',
                    'holder' => 'SAWARNA SENSOR 01',
                    'status' => 'ok',
                ],
                [
                    'id' => 'node-2',
                    'name' => 'Sink Node Kantor',
                    'type' => 'Gateway & 4G Uplink',
                    'pdr' => '99.4%',
                    'sub' => 'Paket diterima 99,4% · Internet 4G stabil',
                    'code' => '**** 5678 5678 5678',
                    'holder' => 'GATEWAY HUB 02',
                    'status' => 'ok',
                ],
                [
                    'id' => 'node-3',
                    'name' => 'Edge Computing Hub',
                    'type' => 'Local Hub & Buffer Storage',
                    'storage' => '63%',
                    'queue' => '38 data antre',
                    'sub' => 'Penyimpanan 63% · 38 antre sinkron',
                    'code' => '**** 9012 9012 9012',
                    'holder' => 'LOCAL BUFFER 03',
                    'status' => 'warn',
                ],
            ],
            'transfers_alerts' => [
                [
                    'title' => 'Angin kencang 34 km/jam',
                    'ref_title' => 'From Anna Jones',
                    'time' => 'Hari ini, 09.40',
                    'ref_time' => 'Today, 14:34',
                    'status' => 'Aktif',
                    'badge' => '+2.45%',
                    'badge_type' => 'warn',
                ],
                [
                    'title' => 'Hujan lebat 18 mm/jam',
                    'ref_title' => 'To Carlos Brown III',
                    'time' => '3 Nov, 16.10',
                    'ref_time' => 'Today, 15:23',
                    'status' => 'Selesai',
                    'badge' => '-4.75%',
                    'badge_type' => 'ok',
                ],
                [
                    'title' => 'Anomali sensor tekanan',
                    'ref_title' => 'From Joel Cannan',
                    'time' => '2 Nov, 22.05',
                    'ref_time' => 'Today, 17:54',
                    'status' => 'Selesai',
                    'badge' => '+2.45%',
                    'badge_type' => 'ok',
                ],
            ],
            'security' => [
                'title' => 'Keep you safe!',
                'subtext' => 'Update your security password & sensor auth keys',
                'queue' => 38,
                'last_sync' => '12 menit lalu',
                'button_text' => 'Update Your Security',
            ],
        ];

        return view('dashboard', $data);
    }
}

