<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman utama dashboard Cuaca Mikro Pantai Sawarna
     * dengan konten persis sesuai blueprint data dan gaya visual tactile squircle modern.
     */
    public function index(Request $request)
    {
        $data = [
            'meta' => [
                'title' => 'Cuaca Mikro Pantai Sawarna',
                'last_updated' => 'Diperbarui 4 Nov 2026, 10.00 WIB · data contoh',
                'warning' => [
                    'badge' => 'Waspada',
                    'text' => 'Angin 34 km/jam, batas 30. Jauhi bibir pantai.',
                    'active' => true,
                ],
            ],
            'metrics' => [
                'suhu' => [
                    'label' => 'Suhu',
                    'value' => '29,4',
                    'unit' => '°C',
                    'sub' => '+0.8°C vs kemarin',
                    'bars' => [40, 70, 55, 85, 60],
                    'sparkline' => [24, 25, 27, 26, 29, 31, 30, 29.4],
                ],
                'kelembapan' => [
                    'label' => 'Kelembapan',
                    'value' => '84',
                    'unit' => '%',
                    'sub' => '+2% vs rata-rata',
                    'sparkline' => [88, 85, 82, 80, 83, 86, 84],
                ],
                'tekanan' => [
                    'label' => 'Tekanan',
                    'value' => '1008,6',
                    'unit' => 'hPa',
                    'sub' => 'Kondisi stabil',
                    'sparkline' => [1007, 1008, 1009, 1008.2, 1008.6],
                ],
                'hujan' => [
                    'label' => 'Hujan',
                    'value' => '3,2',
                    'unit' => 'mm/jam',
                    'sub' => 'Batas waspada 10 mm/j',
                    'sparkline' => [0, 1.2, 4.5, 6.2, 2.1, 3.2],
                ],
                'angin' => [
                    'label' => 'Angin',
                    'value' => '34',
                    'unit' => 'km/jam',
                    'sub' => 'Waspada (Batas 30)',
                    'sparkline' => [18, 22, 27, 30, 32, 28, 34],
                ],
            ],
            'trend' => [
                'title' => 'Tren',
                'params' => ['Suhu', 'Kelembapan', 'Tekanan', 'Hujan', 'Angin'],
                'ranges' => ['24 jam', '7 hari'],
                'y_axis' => ['32,2', '30,2', '28,1', '26,0', '23,9'],
                'x_axis' => ['-23 j', '-19 j', '-15 j', '-11 j', '-7 j', '-3 j'],
                'max' => '30,8 °C',
                'max_change' => '+2.45%',
                'avg' => '28,1 °C',
                'avg_change' => '-1.15%',
                'min' => '23,9 °C',
            ],
            'wind' => [
                'title' => 'Arah angin',
                'degrees' => 225,
                'cardinal' => 'barat daya',
                'code' => 'SW',
                'gust' => 41,
                'average' => 28,
            ],
            'devices' => [
                [
                    'name' => 'Edge node pantai',
                    'sub' => 'Baterai 78% · LoRa −104 dBm',
                    'status' => 'ok',
                    'battery' => 78,
                    'rssi' => '-104 dBm',
                ],
                [
                    'name' => 'Sink node kantor',
                    'sub' => 'Paket diterima 99,4% · 4G stabil',
                    'status' => 'ok',
                    'pdr' => '99,4%',
                    'network' => '4G stabil',
                ],
                [
                    'name' => 'Sinkron ke cloud',
                    'sub' => '38 data antre · terakhir 12 menit lalu',
                    'status' => 'warn',
                    'queue' => 38,
                    'last_sync' => '12 menit lalu',
                ],
            ],
            'alerts' => [
                [
                    'status' => 'Waspada',
                    'title' => 'Angin kencang 34 km/jam',
                    'desc' => 'Aktif sejak 09.40',
                    'type' => 'warn',
                ],
                [
                    'status' => 'Selesai',
                    'title' => 'Hujan lebat 18 mm/jam',
                    'desc' => '3 Nov, 16.10',
                    'type' => 'ok',
                ],
                [
                    'status' => 'Selesai',
                    'title' => 'Anomali sensor tekanan',
                    'desc' => '2 Nov, 22.05 · difilter di edge',
                    'type' => 'ok',
                ],
                [
                    'status' => 'Selesai',
                    'title' => 'Sinyal LoRa lemah',
                    'desc' => '1 Nov, 07.30',
                    'type' => 'ok',
                ],
            ],
        ];

        return view('dashboard', $data);
    }
}
