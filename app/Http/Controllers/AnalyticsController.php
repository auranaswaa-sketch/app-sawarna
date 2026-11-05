<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AnalyticsController extends Controller
{
    /**
     * Tampilkan halaman utama Grafik Tren & Riwayat Cuaca Mikro Pantai Sawarna.
     * Sesuai dengan spesifikasi SRS (FR-09, FR-10, FR-19, FR-20, FR-25) dan DESIGN.md.
     */
    public function index(Request $request)
    {
        $activeParam = $request->query('param', 'suhu');
        $activeRange = $request->query('range', '24h');

        $data = [
            'meta' => [
                'title' => 'Grafik Tren & Riwayat Cuaca',
                'station' => 'Stasiun Cuaca Mikro Pantai Sawarna (EDGE-01)',
                'subtitle' => 'Analisis time-series multi-parameter, distribusi arah angin (wind rose), dan riwayat agregasi cuaca pesisir.',
                'last_updated' => 'Diperbarui 4 Nov 2026, 10.00 WIB · Data teragregasi otomatis',
            ],
            'filters' => [
                'active_param' => $activeParam,
                'active_range' => $activeRange,
                'params' => [
                    'suhu' => ['label' => 'Suhu Udara', 'unit' => '°C', 'icon' => 'fa-temperature-half'],
                    'kelembapan' => ['label' => 'Kelembapan', 'unit' => '%', 'icon' => 'fa-droplet'],
                    'tekanan' => ['label' => 'Tekanan Barometrik', 'unit' => 'hPa', 'icon' => 'fa-gauge-high'],
                    'hujan' => ['label' => 'Curah Hujan', 'unit' => 'mm/jam', 'icon' => 'fa-cloud-showers-heavy'],
                    'angin' => ['label' => 'Kecepatan Angin', 'unit' => 'km/jam', 'icon' => 'fa-wind'],
                    'uv' => ['label' => 'Indeks UV', 'unit' => 'UVI', 'icon' => 'fa-sun'],
                ],
                'ranges' => [
                    '24h' => '24 Jam Terakhir',
                    '7d' => '7 Hari Terakhir',
                    '30d' => '30 Hari (1 Bulan)',
                ],
            ],
            // Data Tren Lengkap per Parameter & Rentang
            'trends' => [
                'suhu' => [
                    'title' => 'Tren Suhu Udara Pesisir',
                    'unit' => '°C',
                    'threshold' => 35.0,
                    'threshold_label' => 'Batas Panas Ekstrem 35 °C',
                    'max' => '30,8 °C',
                    'max_time' => '13.15 WIB (Puncak Terik)',
                    'avg' => '28,1 °C',
                    'avg_delta' => '+0.8 °C vs kemarin',
                    'min' => '23,9 °C',
                    'min_time' => '04.30 WIB (Dini Hari)',
                    'variability' => 'Stabil (Rentang 6,9 °C)',
                    'y_axis' => ['35,0', '32,0', '29,0', '26,0', '23,0'],
                    'x_axis' => ['10.00', '14.00', '18.00', '22.00', '02.00', '06.00', '10.00'],
                    'path_d' => 'M 40 160 C 90 140, 140 60, 200 45 C 260 30, 320 80, 380 125 C 440 170, 500 190, 560 185 C 620 180, 680 130, 740 95 C 800 60, 840 80, 860 85',
                    'area_d' => 'M 40 160 C 90 140, 140 60, 200 45 C 260 30, 320 80, 380 125 C 440 170, 500 190, 560 185 C 620 180, 680 130, 740 95 C 800 60, 840 80, 860 85 L 860 220 L 40 220 Z',
                    'threshold_y' => 30,
                ],
                'kelembapan' => [
                    'title' => 'Tren Kelembapan Relatif',
                    'unit' => '%',
                    'threshold' => 95.0,
                    'threshold_label' => 'Batas Kejenuhan Uap 95 %',
                    'max' => '94,0 %',
                    'max_time' => '05.00 WIB (Embun Pagi)',
                    'avg' => '84,0 %',
                    'avg_delta' => '+2.0 % vs rata-rata mingguan',
                    'min' => '72,0 %',
                    'min_time' => '13.30 WIB (Siang Panas)',
                    'variability' => 'Lembap Pesisir Tinggi',
                    'y_axis' => ['100', '90', '80', '70', '60'],
                    'x_axis' => ['10.00', '14.00', '18.00', '22.00', '02.00', '06.00', '10.00'],
                    'path_d' => 'M 40 90 C 100 150, 160 170, 220 165 C 280 160, 340 120, 400 95 C 460 70, 520 50, 580 45 C 640 40, 700 70, 760 90 C 820 110, 850 100, 860 95',
                    'area_d' => 'M 40 90 C 100 150, 160 170, 220 165 C 280 160, 340 120, 400 95 C 460 70, 520 50, 580 45 C 640 40, 700 70, 760 90 C 820 110, 850 100, 860 95 L 860 220 L 40 220 Z',
                    'threshold_y' => 40,
                ],
                'tekanan' => [
                    'title' => 'Tren Tekanan Barometrik Udara',
                    'unit' => 'hPa',
                    'threshold' => 1000.0,
                    'threshold_label' => 'Batas Rendah Badai 1000 hPa',
                    'max' => '1010,2 hPa',
                    'max_time' => '09.00 WIB (Puncak Pasang Barometrik)',
                    'avg' => '1008,6 hPa',
                    'avg_delta' => '0.0 hPa (Stabil)',
                    'min' => '1006,8 hPa',
                    'min_time' => '16.00 WIB (Palung Harian)',
                    'variability' => 'Siklus Pasang Surut Barometrik Normal',
                    'y_axis' => ['1012', '1010', '1008', '1006', '1004'],
                    'x_axis' => ['10.00', '14.00', '18.00', '22.00', '02.00', '06.00', '10.00'],
                    'path_d' => 'M 40 100 C 100 125, 160 155, 220 160 C 280 165, 340 135, 400 115 C 460 95, 520 75, 580 80 C 640 85, 700 135, 760 145 C 820 155, 850 110, 860 100',
                    'area_d' => 'M 40 100 C 100 125, 160 155, 220 160 C 280 165, 340 135, 400 115 C 460 95, 520 75, 580 80 C 640 85, 700 135, 760 145 C 820 155, 850 110, 860 100 L 860 220 L 40 220 Z',
                    'threshold_y' => 190,
                ],
                'hujan' => [
                    'title' => 'Tren Curah Hujan & Akumulasi',
                    'unit' => 'mm/jam',
                    'threshold' => 10.0,
                    'threshold_label' => 'Batas Hujan Lebat 10 mm/j',
                    'max' => '18,0 mm/j',
                    'max_time' => 'Kemarin, 16.10 WIB',
                    'avg' => '3,2 mm/j',
                    'avg_delta' => 'Akumulasi 24 Jam: 24,6 mm',
                    'min' => '0,0 mm/j',
                    'min_time' => '01.00 s/d 05.00 WIB',
                    'variability' => 'Hujan Periodik Sore Hari',
                    'y_axis' => ['20', '15', '10', '5', '0'],
                    'x_axis' => ['10.00', '14.00', '18.00', '22.00', '02.00', '06.00', '10.00'],
                    'path_d' => 'M 40 215 C 100 215, 150 205, 210 185 C 240 175, 270 45, 300 40 C 330 35, 360 120, 390 190 C 440 215, 500 215, 560 215 C 620 215, 680 185, 740 165 C 800 145, 840 200, 860 210',
                    'area_d' => 'M 40 215 C 100 215, 150 205, 210 185 C 240 175, 270 45, 300 40 C 330 35, 360 120, 390 190 C 440 215, 500 215, 560 215 C 620 215, 680 185, 740 165 C 800 145, 840 200, 860 210 L 860 220 L 40 220 Z',
                    'threshold_y' => 110,
                ],
                'angin' => [
                    'title' => 'Tren Kecepatan Angin & Hembusan (Gust)',
                    'unit' => 'km/jam',
                    'threshold' => 30.0,
                    'threshold_label' => 'Batas Waspada Pesisir 30 km/j',
                    'max' => '34,0 km/j',
                    'max_time' => '09.40 WIB (Melewati Ambang Batas)',
                    'avg' => '24,2 km/j',
                    'avg_delta' => '+5.4 km/j vs rata-rata bulanan',
                    'min' => '14,0 km/j',
                    'min_time' => '03.00 WIB (Angin Darat Tenang)',
                    'variability' => 'Angin Laut Kencang (Pesisir Selatan)',
                    'y_axis' => ['50', '40', '30', '20', '10'],
                    'x_axis' => ['10.00', '14.00', '18.00', '22.00', '02.00', '06.00', '10.00'],
                    'path_d' => 'M 40 130 C 100 110, 160 140, 220 150 C 280 160, 340 180, 400 185 C 460 190, 520 170, 580 145 C 640 120, 700 80, 760 65 C 800 55, 840 60, 860 65',
                    'area_d' => 'M 40 130 C 100 110, 160 140, 220 150 C 280 160, 340 180, 400 185 C 460 190, 520 170, 580 145 C 640 120, 700 80, 760 65 C 800 55, 840 60, 860 65 L 860 220 L 40 220 Z',
                    'threshold_y' => 95,
                ],
                'uv' => [
                    'title' => 'Tren Radiasi Indeks Ultraviolet',
                    'unit' => 'UVI',
                    'threshold' => 6.0,
                    'threshold_label' => 'Batas UV Tinggi (Kategori Oranye)',
                    'max' => '7,4 UVI',
                    'max_time' => '12.15 WIB (Tengah Hari)',
                    'avg' => '3,6 UVI',
                    'avg_delta' => 'Puncak 7.4 (Perlu Tabir Surya)',
                    'min' => '0,0 UVI',
                    'min_time' => '18.30 s/d 05.30 WIB (Malam)',
                    'variability' => 'Siklus Radiasi Surya Pesisir',
                    'y_axis' => ['10', '8', '6', '4', '2'],
                    'x_axis' => ['10.00', '14.00', '18.00', '22.00', '02.00', '06.00', '10.00'],
                    'path_d' => 'M 40 140 C 100 70, 160 50, 220 60 C 280 70, 340 150, 400 215 C 460 220, 520 220, 580 220 C 640 220, 700 220, 760 190 C 800 160, 840 140, 860 135',
                    'area_d' => 'M 40 140 C 100 70, 160 50, 220 60 C 280 70, 340 150, 400 215 C 460 220, 520 220, 580 220 C 640 220, 700 220, 760 190 C 800 160, 840 140, 860 135 L 860 220 L 40 220 Z',
                    'threshold_y' => 90,
                ],
            ],
            // Data Distribusi Angin (Wind Rose & Compass FR-10 & FR-20)
            'wind_rose' => [
                'dominant_direction' => 'Barat Daya (SW - 225°)',
                'dominant_pct' => 38.5,
                'current_direction' => 225,
                'current_gust' => 41,
                'current_avg' => 28,
                'directions' => [
                    ['code' => 'U', 'name' => 'Utara', 'deg' => 0, 'pct' => 4.2, 'avg_speed' => 12.0],
                    ['code' => 'TL', 'name' => 'Timur Laut', 'deg' => 45, 'pct' => 6.1, 'avg_speed' => 14.5],
                    ['code' => 'T', 'name' => 'Timur', 'deg' => 90, 'pct' => 8.4, 'avg_speed' => 16.2],
                    ['code' => 'TG', 'name' => 'Tenggara', 'deg' => 135, 'pct' => 14.6, 'avg_speed' => 22.8],
                    ['code' => 'S', 'name' => 'Selatan', 'deg' => 180, 'pct' => 21.2, 'avg_speed' => 26.4],
                    ['code' => 'BD', 'name' => 'Barat Daya', 'deg' => 225, 'pct' => 38.5, 'avg_speed' => 31.5],
                    ['code' => 'B', 'name' => 'Barat', 'deg' => 270, 'pct' => 5.2, 'avg_speed' => 18.0],
                    ['code' => 'BL', 'name' => 'Barat Laut', 'deg' => 315, 'pct' => 1.8, 'avg_speed' => 11.2],
                ],
                'speed_bins' => [
                    ['label' => '< 10 km/jam (Tenang)', 'pct' => 15.0, 'color' => 'bg-ok'],
                    ['label' => '10 - 25 km/jam (Sedang)', 'pct' => 46.5, 'color' => 'bg-sea'],
                    ['label' => '25 - 35 km/jam (Kencang)', 'pct' => 30.5, 'color' => 'bg-warn'],
                    ['label' => '> 35 km/jam (Ekstrem)', 'pct' => 8.0, 'color' => 'bg-bad'],
                ],
            ],
            // Tabel Agregasi Historis (ERD Table `aggregates` / FR-09)
            'aggregates_table' => [
                [
                    'time_bucket' => '4 Nov 2026, 09.00 - 10.00',
                    'temp_avg' => '29,4 °C',
                    'temp_range' => '28,8 - 30,1',
                    'humidity_avg' => '84 %',
                    'pressure_avg' => '1008,6 hPa',
                    'rain_sum' => '3,2 mm',
                    'wind_avg' => '24,2 km/j',
                    'wind_max' => '34,0 km/j',
                    'wind_dir' => '225° (BD)',
                    'uv_index' => '6,8',
                    'status' => 'warn',
                    'status_label' => 'Waspada Angin',
                ],
                [
                    'time_bucket' => '4 Nov 2026, 08.00 - 09.00',
                    'temp_avg' => '28,6 °C',
                    'temp_range' => '27,9 - 29,2',
                    'humidity_avg' => '86 %',
                    'pressure_avg' => '1008,9 hPa',
                    'rain_sum' => '1,1 mm',
                    'wind_avg' => '21,5 km/j',
                    'wind_max' => '28,4 km/j',
                    'wind_dir' => '210° (BD)',
                    'uv_index' => '4,5',
                    'status' => 'ok',
                    'status_label' => 'Normal',
                ],
                [
                    'time_bucket' => '4 Nov 2026, 07.00 - 08.00',
                    'temp_avg' => '27,3 °C',
                    'temp_range' => '26,5 - 28,0',
                    'humidity_avg' => '89 %',
                    'pressure_avg' => '1009,2 hPa',
                    'rain_sum' => '0,0 mm',
                    'wind_avg' => '18,2 km/j',
                    'wind_max' => '24,0 km/j',
                    'wind_dir' => '195° (S)',
                    'uv_index' => '2,2',
                    'status' => 'ok',
                    'status_label' => 'Normal',
                ],
                [
                    'time_bucket' => '4 Nov 2026, 06.00 - 07.00',
                    'temp_avg' => '25,5 °C',
                    'temp_range' => '24,8 - 26,4',
                    'humidity_avg' => '92 %',
                    'pressure_avg' => '1008,8 hPa',
                    'rain_sum' => '0,0 mm',
                    'wind_avg' => '15,6 km/j',
                    'wind_max' => '19,2 km/j',
                    'wind_dir' => '180° (S)',
                    'uv_index' => '0,5',
                    'status' => 'ok',
                    'status_label' => 'Normal',
                ],
                [
                    'time_bucket' => '4 Nov 2026, 05.00 - 06.00',
                    'temp_avg' => '24,2 °C',
                    'temp_range' => '23,9 - 24,7',
                    'humidity_avg' => '94 %',
                    'pressure_avg' => '1008,2 hPa',
                    'rain_sum' => '0,0 mm',
                    'wind_avg' => '14,0 km/j',
                    'wind_max' => '16,5 km/j',
                    'wind_dir' => '170° (S)',
                    'uv_index' => '0,0',
                    'status' => 'ok',
                    'status_label' => 'Normal',
                ],
                [
                    'time_bucket' => '4 Nov 2026, 04.00 - 05.00',
                    'temp_avg' => '24,0 °C',
                    'temp_range' => '23,9 - 24,2',
                    'humidity_avg' => '93 %',
                    'pressure_avg' => '1007,9 hPa',
                    'rain_sum' => '0,0 mm',
                    'wind_avg' => '14,2 km/j',
                    'wind_max' => '17,0 km/j',
                    'wind_dir' => '165° (SSE)',
                    'uv_index' => '0,0',
                    'status' => 'ok',
                    'status_label' => 'Normal',
                ],
                [
                    'time_bucket' => '3 Nov 2026, 16.00 - 17.00',
                    'temp_avg' => '26,8 °C',
                    'temp_range' => '25,4 - 28,1',
                    'humidity_avg' => '91 %',
                    'pressure_avg' => '1007,1 hPa',
                    'rain_sum' => '18,0 mm',
                    'wind_avg' => '28,5 km/j',
                    'wind_max' => '38,2 km/j',
                    'wind_dir' => '235° (BD)',
                    'uv_index' => '1,4',
                    'status' => 'warn',
                    'status_label' => 'Waspada Hujan Lebat',
                ],
            ],
        ];

        return view('analytics.index', $data);
    }

    /**
     * Endpoint Ekspor CSV Data Historis Cuaca Mikro Sawarna (FR-25).
     */
    public function exportCsv(Request $request)
    {
        $param = $request->query('param', 'all');
        $range = $request->query('range', '24h');
        $filename = "sawarna-cuaca-mikro-{$param}-{$range}-" . date('Ymd_His') . ".csv";

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($param, $range) {
            $file = fopen('php://output', 'w');
            // Menulis BOM UTF-8 agar Excel membuka dengan karakter benar
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Header Kolom CSV Sesuai ERD (Sensors + Readings / Aggregates)
            fputcsv($file, [
                'Waktu_Bucket',
                'Stasiun',
                'Device_Code',
                'Suhu_Avg_C',
                'Suhu_Min_C',
                'Suhu_Max_C',
                'Kelembapan_Avg_Pct',
                'Tekanan_Avg_hPa',
                'Curah_Hujan_Sum_mm',
                'Angin_Kecepatan_Avg_kmh',
                'Angin_Kecepatan_Max_kmh',
                'Angin_Arah_Dominan_Deg',
                'Indeks_UV',
                'Status_Kualitas',
            ]);

            // Simulasi baris data historis terformat CSV
            $records = [
                ['2026-11-04 10:00:00+07', 'Pantai Sawarna', 'EDGE-01', 29.4, 28.8, 30.1, 84.0, 1008.6, 3.2, 24.2, 34.0, 225, 6.8, 'valid'],
                ['2026-11-04 09:00:00+07', 'Pantai Sawarna', 'EDGE-01', 28.6, 27.9, 29.2, 86.0, 1008.9, 1.1, 21.5, 28.4, 210, 4.5, 'valid'],
                ['2026-11-04 08:00:00+07', 'Pantai Sawarna', 'EDGE-01', 27.3, 26.5, 28.0, 89.0, 1009.2, 0.0, 18.2, 24.0, 195, 2.2, 'valid'],
                ['2026-11-04 07:00:00+07', 'Pantai Sawarna', 'EDGE-01', 25.5, 24.8, 26.4, 92.0, 1008.8, 0.0, 15.6, 19.2, 180, 0.5, 'valid'],
                ['2026-11-04 06:00:00+07', 'Pantai Sawarna', 'EDGE-01', 24.2, 23.9, 24.7, 94.0, 1008.2, 0.0, 14.0, 16.5, 170, 0.0, 'valid'],
                ['2026-11-04 05:00:00+07', 'Pantai Sawarna', 'EDGE-01', 24.0, 23.9, 24.2, 93.0, 1007.9, 0.0, 14.2, 17.0, 165, 0.0, 'valid'],
                ['2026-11-04 04:00:00+07', 'Pantai Sawarna', 'EDGE-01', 23.9, 23.9, 24.0, 93.5, 1007.8, 0.0, 14.0, 16.0, 160, 0.0, 'valid'],
                ['2026-11-03 16:00:00+07', 'Pantai Sawarna', 'EDGE-01', 26.8, 25.4, 28.1, 91.0, 1007.1, 18.0, 28.5, 38.2, 235, 1.4, 'valid'],
            ];

            foreach ($records as $row) {
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}

