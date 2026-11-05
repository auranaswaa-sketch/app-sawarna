@extends('layouts.app')

@section('title', 'Grafik Tren & Riwayat Cuaca - Pantai Sawarna')

@section('content')
<div class="bg-bg text-ink min-h-[calc(100vh-2.5rem)] flex flex-col justify-between" id="analytics-root">

    <!-- Top Wrapper: Grid Layout (Sidebar Capsule + Main Canvas) -->
    <div class="grid grid-cols-1 lg:grid-cols-[auto_minmax(0,1fr)] gap-4 lg:gap-6 items-start">

        @include('partials.sidebar')

        <!-- ================= MAIN CONTENT ================= -->
        <main class="flex flex-col gap-4 sm:gap-5 min-w-0">

            <!-- ---------- HEADER BAR ---------- -->
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-3.5">
                <!-- Left: Floral/Chart Logo + Title & Live Badge -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-tint text-sea grid place-items-center shrink-0 shadow-soft">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                            <path d="M4 20V10M10 20V4M16 20v-7M22 20H2"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-ink">{{ $meta['title'] }}</h1>
                            <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold px-2.5 py-0.5 rounded-full bg-okbg text-ok">
                                <i class="fa-solid fa-circle text-[6px] animate-pulse"></i> Resolusi 1 Jam
                            </span>
                        </div>
                        <p class="text-mute text-xs sm:text-[13.5px] mt-0.5">{{ $meta['subtitle'] }}</p>
                    </div>
                </div>

                <!-- Right: Range Switcher & CSV Export Button -->
                <div class="flex items-center gap-2.5 sm:gap-3 flex-wrap md:flex-nowrap">
                    <!-- Range Pills -->
                    <div class="inline-flex p-1 rounded-full bg-card border border-line/70 shadow-soft">
                        <button onclick="switchRange('24h')" id="btn-range-24h" class="range-btn px-3 py-1 rounded-full text-xs font-semibold bg-dark text-white shadow-sm transition-all">
                            24 Jam
                        </button>
                        <button onclick="switchRange('7d')" id="btn-range-7d" class="range-btn px-3 py-1 rounded-full text-xs font-semibold text-mute hover:text-ink transition-all">
                            7 Hari
                        </button>
                        <button onclick="switchRange('30d')" id="btn-range-30d" class="range-btn px-3 py-1 rounded-full text-xs font-semibold text-mute hover:text-ink transition-all">
                            30 Hari
                        </button>
                    </div>

                    <!-- Direct CSV Export Button (FR-25) -->
                    <a href="{{ route('analytics.export', ['param' => 'all', 'range' => '24h']) }}" id="exportCsvBtn" class="flex items-center gap-2 bg-gradient-to-br from-sea to-deep text-white font-bold text-xs rounded-[10px] px-4 py-2 shadow-sm hover:opacity-95 transition-opacity" title="Unduh data riwayat format CSV">
                        <i class="fa-solid fa-file-arrow-down text-xs"></i>
                        <span>Ekspor CSV</span>
                    </a>

                    <!-- Advanced Filter Modal Trigger -->
                    <button onclick="openFilterModal()" class="w-9 h-9 rounded-full bg-card hover:bg-tint text-ink border border-line/70 grid place-items-center shadow-soft transition-all" title="Filter Parameter & Rentang Lanjutan">
                        <i class="fa-solid fa-sliders text-xs text-sea"></i>
                    </button>
                </div>
            </header>

            <!-- ---------- ROW 1: PARAMETER SELECTOR BAR (6 Parameter Cuaca) ---------- -->
            <section class="bg-card rounded-[20px] p-2 sm:p-2.5 border border-line/60 shadow-soft">
                <div class="flex items-center gap-2 overflow-x-auto pb-1 sm:pb-0 scrollbar-none">
                    @foreach($filters['params'] as $pKey => $p)
                    <button onclick="switchParam('{{ $pKey }}')" id="param-pill-{{ $pKey }}" class="param-pill flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold transition-all shrink-0 {{ $pKey === 'suhu' ? 'bg-dark text-white shadow-sm' : 'text-mute hover:bg-tint hover:text-sea' }}">
                        <i class="fa-solid {{ $p['icon'] }} text-xs"></i>
                        <span>{{ $p['label'] }}</span>
                        <span class="text-[10px] font-normal opacity-80">({{ $p['unit'] }})</span>
                    </button>
                    @endforeach
                </div>
            </section>

            <!-- ---------- ROW 2: KEY SUMMARY STATS CARDS (4 Kolom Sesuai DESIGN.md) ---------- -->
            <section class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                <!-- 1. Maksimum -->
                <div class="bg-card rounded-[20px] p-4 sm:p-5 border border-line/60 shadow-soft flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-[13px] text-mute font-medium">Nilai Maksimum</span>
                        <div class="w-9 h-9 rounded-full bg-warnbg text-warn grid place-items-center">
                            <i class="fa-solid fa-arrow-trend-up text-sm"></i>
                        </div>
                    </div>
                    <div class="my-2.5">
                        <span class="text-[26px] font-bold tracking-tight text-ink" id="stat-max-val">{{ $trends['suhu']['max'] }}</span>
                        <span class="text-[12px] text-mute block mt-0.5" id="stat-max-time">{{ $trends['suhu']['max_time'] }}</span>
                    </div>
                    <div class="pt-2 border-t border-line/60 flex items-center justify-between text-[11px] text-mute">
                        <span>Puncak Terukur</span>
                        <span class="font-semibold text-warn">Ekstrem Harian</span>
                    </div>
                </div>

                <!-- 2. Rata-rata -->
                <div class="bg-card rounded-[20px] p-4 sm:p-5 border border-line/60 shadow-soft flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-[13px] text-mute font-medium">Rata-rata Teragregasi</span>
                        <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                            <i class="fa-solid fa-calculator text-sm"></i>
                        </div>
                    </div>
                    <div class="my-2.5">
                        <span class="text-[26px] font-bold tracking-tight text-ink" id="stat-avg-val">{{ $trends['suhu']['avg'] }}</span>
                        <span class="text-[12px] text-ok font-semibold block mt-0.5" id="stat-avg-delta">{{ $trends['suhu']['avg_delta'] }}</span>
                    </div>
                    <div class="pt-2 border-t border-line/60 flex items-center justify-between text-[11px] text-mute">
                        <span>Sampel 24 Jam</span>
                        <span class="font-semibold text-ok">24 Titik Data</span>
                    </div>
                </div>

                <!-- 3. Minimum -->
                <div class="bg-card rounded-[20px] p-4 sm:p-5 border border-line/60 shadow-soft flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-[13px] text-mute font-medium">Nilai Minimum</span>
                        <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                            <i class="fa-solid fa-arrow-trend-down text-sm"></i>
                        </div>
                    </div>
                    <div class="my-2.5">
                        <span class="text-[26px] font-bold tracking-tight text-ink" id="stat-min-val">{{ $trends['suhu']['min'] }}</span>
                        <span class="text-[12px] text-mute block mt-0.5" id="stat-min-time">{{ $trends['suhu']['min_time'] }}</span>
                    </div>
                    <div class="pt-2 border-t border-line/60 flex items-center justify-between text-[11px] text-mute">
                        <span>Titik Terendah</span>
                        <span class="font-semibold text-ink">Kondisi Sejuk</span>
                    </div>
                </div>

                <!-- 4. Variabilitas / Ambang Batas (Hero Gradient) -->
                <div class="bg-gradient-to-br from-sea to-deep rounded-[20px] p-4 sm:p-5 text-white shadow-soft flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-[13px] text-white/80 font-medium">Batas Waspada & Status</span>
                        <div class="w-9 h-9 rounded-full bg-white/15 text-white grid place-items-center">
                            <i class="fa-solid fa-shield-halved text-sm"></i>
                        </div>
                    </div>
                    <div class="my-2.5">
                        <span class="text-lg font-bold tracking-tight block leading-tight" id="stat-threshold-title">{{ $trends['suhu']['threshold_label'] }}</span>
                        <span class="text-[12px] text-white/90 inline-flex items-center gap-1.5 mt-1" id="stat-variability">
                            <i class="fa-solid fa-circle-check text-xs text-okbg"></i> {{ $trends['suhu']['variability'] }}
                        </span>
                    </div>
                    <div class="pt-2 border-t border-white/20 flex items-center justify-between text-[11px] text-white/80">
                        <span>Aturan Alert: FR-13</span>
                        <span class="font-bold underline cursor-pointer hover:text-white" onclick="highlightThreshold()">Sorot Batas</span>
                    </div>
                </div>
            </section>

            <!-- ---------- ROW 3: VISUALISASI UTAMA (GRAFIK TREN INTERAKTIF + WIND ROSE) ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-stretch">

                <!-- Kolom Kiri: Kurva Time-Series SVG Bezier Spline (8 Kolom) -->
                <div class="lg:col-span-8 bg-card rounded-[20px] p-4 sm:p-6 border border-line/60 shadow-soft flex flex-col justify-between">
                    <div>
                        <!-- Header Grafik -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4 pb-3 border-b border-line/60">
                            <div>
                                <div class="flex items-center gap-2">
                                    <h2 class="text-base sm:text-[17px] font-bold text-ink" id="chart-main-title">{{ $trends['suhu']['title'] }}</h2>
                                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-tint text-sea" id="chart-param-badge">Suhu Udara (°C)</span>
                                </div>
                                <p class="text-mute text-xs mt-0.5">Kurva kontinu data teragregasi per jam dengan batas ambang waspada sistem.</p>
                            </div>

                            <!-- Indikator Legend -->
                            <div class="flex items-center gap-4 text-xs">
                                <span class="flex items-center gap-1.5 text-ink font-medium">
                                    <span class="w-3 h-0.5 bg-sea rounded-full"></span> Nilai Pengukuran
                                </span>
                                <span class="flex items-center gap-1.5 text-warn font-medium">
                                    <span class="w-3 h-0.5 border-b-2 border-dashed border-warn"></span> Ambang Waspada
                                </span>
                            </div>
                        </div>

                        <!-- Canvas Grafik SVG -->
                        <div class="relative w-full h-[260px] sm:h-[300px]" id="chartCanvasWrapper">
                            <svg class="w-full h-full overflow-visible" viewBox="0 0 900 240" preserveAspectRatio="none">
                                <defs>
                                    <linearGradient id="chartGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" stop-color="var(--sky)" stop-opacity="0.45"></stop>
                                        <stop offset="100%" stop-color="var(--sky)" stop-opacity="0.0"></stop>
                                    </linearGradient>
                                </defs>

                                <!-- Horizontal Grid Lines -->
                                <line x1="40" y1="30" x2="860" y2="30" stroke="var(--line)" stroke-width="1"></line>
                                <line x1="40" y1="75" x2="860" y2="75" stroke="var(--line)" stroke-width="1"></line>
                                <line x1="40" y1="120" x2="860" y2="120" stroke="var(--line)" stroke-width="1"></line>
                                <line x1="40" y1="165" x2="860" y2="165" stroke="var(--line)" stroke-width="1"></line>
                                <line x1="40" y1="210" x2="860" y2="210" stroke="var(--line)" stroke-width="1"></line>

                                <!-- Y Axis Labels -->
                                <text x="10" y="34" class="text-[10px] fill-mute" id="y-axis-0">{{ $trends['suhu']['y_axis'][0] }}</text>
                                <text x="10" y="79" class="text-[10px] fill-mute" id="y-axis-1">{{ $trends['suhu']['y_axis'][1] }}</text>
                                <text x="10" y="124" class="text-[10px] fill-mute" id="y-axis-2">{{ $trends['suhu']['y_axis'][2] }}</text>
                                <text x="10" y="169" class="text-[10px] fill-mute" id="y-axis-3">{{ $trends['suhu']['y_axis'][3] }}</text>
                                <text x="10" y="214" class="text-[10px] fill-mute" id="y-axis-4">{{ $trends['suhu']['y_axis'][4] }}</text>

                                <!-- Dashed Threshold Warning Line (FR-13 & DESIGN.md 6.4) -->
                                <line id="svg-threshold-line" x1="40" y1="30" x2="860" y2="30" stroke="var(--warn)" stroke-width="1.8" stroke-dasharray="5 4"></line>

                                <!-- Area Gradient Fill -->
                                <path id="svg-trend-area" d="{{ $trends['suhu']['area_d'] }}" fill="url(#chartGradient)"></path>

                                <!-- Main Spline Line -->
                                <path id="svg-trend-stroke" d="{{ $trends['suhu']['path_d'] }}" fill="none" stroke="var(--sea)" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"></path>

                                <!-- Interactive Data Point Circles -->
                                <g id="svg-data-points">
                                    <circle cx="40" cy="160" r="4" fill="var(--card)" stroke="var(--sea)" stroke-width="2.5" class="cursor-pointer hover:r-6 transition-all" onmouseover="showTooltip(event, '10.00 WIB', '28,1 °C')"></circle>
                                    <circle cx="200" cy="45" r="4" fill="var(--card)" stroke="var(--sea)" stroke-width="2.5" class="cursor-pointer hover:r-6 transition-all" onmouseover="showTooltip(event, '14.00 WIB', '30,8 °C (Maks)')"></circle>
                                    <circle cx="380" cy="125" r="4" fill="var(--card)" stroke="var(--sea)" stroke-width="2.5" class="cursor-pointer hover:r-6 transition-all" onmouseover="showTooltip(event, '18.00 WIB', '27,5 °C')"></circle>
                                    <circle cx="560" cy="185" r="4" fill="var(--card)" stroke="var(--sea)" stroke-width="2.5" class="cursor-pointer hover:r-6 transition-all" onmouseover="showTooltip(event, '22.00 WIB', '25,2 °C')"></circle>
                                    <circle cx="680" cy="130" r="4" fill="var(--card)" stroke="var(--sea)" stroke-width="2.5" class="cursor-pointer hover:r-6 transition-all" onmouseover="showTooltip(event, '02.00 WIB', '24,4 °C')"></circle>
                                    <circle cx="740" cy="95" r="4" fill="var(--card)" stroke="var(--sea)" stroke-width="2.5" class="cursor-pointer hover:r-6 transition-all" onmouseover="showTooltip(event, '06.00 WIB', '25,8 °C')"></circle>
                                    <circle cx="860" cy="85" r="5" fill="var(--sea)" stroke="var(--card)" stroke-width="2" class="cursor-pointer hover:r-7 transition-all" onmouseover="showTooltip(event, '10.00 WIB', '29,4 °C (Terkini)')"></circle>
                                </g>
                            </svg>

                            <!-- Tooltip Box Element -->
                            <div id="chartTooltip" class="absolute hidden pointer-events-none bg-dark text-white text-[11px] font-semibold px-2.5 py-1.5 rounded-xl shadow-floating transform -translate-x-1/2 -translate-y-full z-10 transition-opacity">
                                <span id="tooltipTime" class="text-white/80 block text-[10px]"></span>
                                <span id="tooltipVal" class="font-bold text-sm text-sky"></span>
                            </div>
                        </div>

                        <!-- X Axis Time Ticks -->
                        <div class="flex items-center justify-between px-8 mt-2 text-[11px] text-mute font-medium" id="xAxisLabelsContainer">
                            <span>10.00</span>
                            <span>14.00</span>
                            <span>18.00</span>
                            <span>22.00</span>
                            <span>02.00</span>
                            <span>06.00</span>
                            <span>10.00</span>
                        </div>
                    </div>

                    <!-- Footer Action Bar -->
                    <div class="flex items-center justify-between pt-3 mt-3 border-t border-line/60 text-xs text-mute">
                        <span>Model Perhitungan: Moving Average Gaussian Spline</span>
                        <div class="flex items-center gap-2">
                            <span class="text-ink font-semibold">Toleransi Validasi: Rentang Fisik Sensor Wajar (FR-05)</span>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Wind Rose & Kompas Pesisir Sawarna (4 Kolom / FR-10 & FR-20) -->
                <div class="lg:col-span-4 bg-card rounded-[20px] p-4 sm:p-5 border border-line/60 shadow-soft flex flex-col justify-between">
                    <div>
                        <!-- Header Wind Rose -->
                        <div class="flex items-center justify-between mb-3 pb-2 border-b border-line/60">
                            <div>
                                <h2 class="text-base sm:text-[17px] font-bold text-ink">Wind Rose & Arah Angin</h2>
                                <p class="text-mute text-xs mt-0.5">Distribusi kecepatan dan arah mata angin Pantai Sawarna.</p>
                            </div>
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-warnbg text-warn">34 km/j</span>
                        </div>

                        <!-- Wind Compass Dial Visual (DESIGN.md 6.6) -->
                        <div class="flex flex-col items-center justify-center my-3">
                            <div class="relative w-[150px] h-[150px] rounded-full border-[3px] border-line flex items-center justify-center shadow-inner">
                                <!-- Cardinal Labels -->
                                <span class="absolute top-1 text-[11px] font-bold text-ink">U</span>
                                <span class="absolute right-2 text-[11px] font-bold text-ink">T</span>
                                <span class="absolute bottom-1 text-[11px] font-bold text-ink">S</span>
                                <span class="absolute left-2 text-[11px] font-bold text-ink">B</span>

                                <span class="absolute top-5 right-5 text-[9px] font-semibold text-mute">TL</span>
                                <span class="absolute bottom-5 right-5 text-[9px] font-semibold text-mute">TG</span>
                                <span class="absolute bottom-5 left-5 text-[9px] font-bold text-sea">BD</span>
                                <span class="absolute top-5 left-5 text-[9px] font-semibold text-mute">BL</span>

                                <!-- Compass Dial Pointer -->
                                <div class="w-full h-full absolute inset-0 flex items-center justify-center transform rotate-[225deg] transition-transform duration-700" id="compassPointer">
                                    <div class="w-1.5 h-[65px] bg-gradient-to-t from-transparent via-sea to-sea rounded-full flex flex-col items-center">
                                        <div class="w-3.5 h-3.5 bg-sea rotate-45 transform -translate-y-1 rounded-sm shadow-sm"></div>
                                    </div>
                                </div>

                                <!-- Center Hub -->
                                <div class="w-10 h-10 rounded-full bg-card border border-line shadow-soft flex flex-col items-center justify-center z-10">
                                    <span class="text-xs font-bold text-ink">SW</span>
                                    <span class="text-[9px] text-mute font-mono">225°</span>
                                </div>
                            </div>

                            <p class="text-xs font-semibold text-ink mt-2">Arah Dominan: <b class="text-sea">{{ $wind_rose['dominant_direction'] }}</b> ({{ $wind_rose['dominant_pct'] }}%)</p>
                        </div>

                        <!-- Wind Speed Bins Frequency -->
                        <div class="space-y-2 mt-2 pt-2 border-t border-line/60 text-xs">
                            <div class="flex items-center justify-between text-mute mb-1">
                                <span>Distribusi Kecepatan Angin:</span>
                                <span class="font-semibold text-ink">Hembusan: {{ $wind_rose['current_gust'] }} km/j</span>
                            </div>

                            @foreach($wind_rose['speed_bins'] as $bin)
                            <div>
                                <div class="flex items-center justify-between text-[11px] text-mute">
                                    <span>{{ $bin['label'] }}</span>
                                    <span class="font-bold text-ink">{{ $bin['pct'] }}%</span>
                                </div>
                                <div class="w-full bg-line/80 h-1.5 rounded-full mt-1 overflow-hidden">
                                    <div class="{{ $bin['color'] }} h-full rounded-full" style="width: {{ $bin['pct'] }}%"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Footer Action -->
                    <div class="pt-3 mt-3 border-t border-line/60 flex items-center justify-between text-xs">
                        <span class="text-mute">Frekuensi 8 Penjuru Mata Angin</span>
                        <a href="{{ route('analytics.export', ['param' => 'angin', 'range' => '24h']) }}" class="text-sea font-bold hover:underline inline-flex items-center gap-1">
                            <span>Unduh Vektor Angin</span> &rarr;
                        </a>
                    </div>
                </div>

            </section>

            <!-- ---------- ROW 4: TABEL AGREGASI HISTORIS DATA CUACA (FR-09 & ERD `aggregates`) ---------- -->
            <section class="bg-card rounded-[20px] p-4 sm:p-5 border border-line/60 shadow-soft">
                <!-- Header Tabel & Filter Pencarian -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4 pb-3 border-b border-line/60">
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="text-base sm:text-[17px] font-bold text-ink">Rekapitulasi Agregasi Data Historis</h2>
                            <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-okbg text-ok">Format ERD: aggregates (1h)</span>
                        </div>
                        <p class="text-mute text-xs mt-0.5">Tabel rekap agregasi rata-rata, minimum, maksimum, dan akumulasi curah hujan per jam sesuai kebutuhan SRS FR-09.</p>
                    </div>

                    <!-- Search Filter Box -->
                    <div class="flex items-center gap-2">
                        <div class="flex items-center bg-bg rounded-full pl-3 pr-1 py-1 border border-line/70 w-[200px]">
                            <input type="text" id="tableSearchInput" oninput="searchAggregateTable()" placeholder="Cari jam / tanggal..." class="bg-transparent text-xs text-ink placeholder-mute focus:outline-none w-full">
                            <span class="w-7 h-7 rounded-full bg-dark text-white grid place-items-center shrink-0">
                                <i class="fa-solid fa-magnifying-glass text-[10px]"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Responsive Table Wrapper -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="border-b border-line/80 text-mute font-semibold text-[11.5px]">
                                <th class="pb-2.5 pl-2">Periode Waktu (1 Jam)</th>
                                <th class="pb-2.5">Suhu (°C)</th>
                                <th class="pb-2.5">Kelembapan</th>
                                <th class="pb-2.5">Tekanan</th>
                                <th class="pb-2.5">Curah Hujan</th>
                                <th class="pb-2.5">Kecepatan Angin</th>
                                <th class="pb-2.5">Arah Angin</th>
                                <th class="pb-2.5">Indeks UV</th>
                                <th class="pb-2.5 pr-2 text-right">Status Kualitas</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-line/60" id="aggregateTableBody">
                            @foreach($aggregates_table as $row)
                            <tr class="hover:bg-bg/60 transition-colors aggregate-row">
                                <td class="py-3 pl-2 font-semibold text-ink whitespace-nowrap">
                                    {{ $row['time_bucket'] }}
                                </td>
                                <td class="py-3 font-medium text-ink">
                                    <b>{{ $row['temp_avg'] }}</b>
                                    <span class="text-[10px] text-mute block">({{ $row['temp_range'] }})</span>
                                </td>
                                <td class="py-3 font-medium text-ink">
                                    {{ $row['humidity_avg'] }}
                                </td>
                                <td class="py-3 font-medium text-ink">
                                    {{ $row['pressure_avg'] }}
                                </td>
                                <td class="py-3 font-medium text-ink">
                                    <b class="{{ floatval($row['rain_sum']) > 5 ? 'text-sea' : '' }}">{{ $row['rain_sum'] }}</b>
                                </td>
                                <td class="py-3 font-medium text-ink">
                                    <b>{{ $row['wind_avg'] }}</b>
                                    <span class="text-[10px] text-mute block">Maks {{ $row['wind_max'] }}</span>
                                </td>
                                <td class="py-3 font-medium text-ink">
                                    {{ $row['wind_dir'] }}
                                </td>
                                <td class="py-3 font-medium text-ink">
                                    {{ $row['uv_index'] }} UVI
                                </td>
                                <td class="py-3 pr-2 text-right">
                                    <span class="inline-flex items-center gap-1 text-[10.5px] font-bold px-2 py-0.5 rounded-full {{ $row['status'] === 'warn' ? 'bg-warnbg text-warn' : 'bg-okbg text-ok' }}">
                                        <i class="fa-solid fa-circle text-[5px]"></i> {{ $row['status_label'] }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer -->
                <div class="pt-3 mt-3 border-t border-line/60 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs text-mute">
                    <span>Menampilkan 7 rentang agregasi per jam terbaru (Total sampel: 420 pembacaan sensor)</span>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('analytics.export', ['param' => 'all', 'range' => '7d']) }}" class="text-sea font-bold hover:underline inline-flex items-center gap-1">
                            <i class="fa-solid fa-download text-xs"></i> Unduh Seluruh Data Agregasi (CSV)
                        </a>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <!-- ================= FOOTER BRANDING ================= -->
    <footer class="mt-6 pt-4 border-t border-line/60 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-mute">
        <p>© 2026 Pengabdian Masyarakat Telkom University & Kelompok Sadar Wisata (Pokdarwis) Pantai Sawarna, Lebak Banten.</p>
        <p class="flex items-center gap-2">
            <span>Sistem IoT & Edge Computing</span>
            <span>·</span>
            <span class="text-sea font-medium">Design System v1.0</span>
        </p>
    </footer>

</div>

<!-- ================= MODAL: FILTER PARAMETER & EKSPOR CSV (FR-25) ================= -->
<div id="modalFilter" class="fixed inset-0 bg-dark/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-card rounded-[24px] max-w-md w-full p-5 sm:p-6 shadow-floating border border-line/60 transition-all scale-95 opacity-0 duration-200" id="modalFilterBox">
        <div class="flex items-center justify-between pb-3 border-b border-line/60">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-full bg-tint text-sea grid place-items-center">
                    <i class="fa-solid fa-filter text-xs"></i>
                </div>
                <h3 class="text-base font-bold text-ink">Kustomisasi Filter & Ekspor CSV</h3>
            </div>
            <button onclick="closeFilterModal()" class="w-7 h-7 rounded-full bg-bg hover:bg-line text-mute hover:text-ink grid place-items-center transition-all">
                <i class="fa-solid fa-xmark text-xs"></i>
            </button>
        </div>

        <form action="{{ route('analytics.export') }}" method="GET" class="space-y-4 mt-4">
            <div>
                <label class="block text-xs font-semibold text-mute mb-1">Pilih Parameter Cuaca</label>
                <select name="param" id="filterExportParam" class="w-full bg-bg rounded-xl px-3 py-2 text-xs text-ink border border-line focus:outline-none font-medium">
                    <option value="all">Semua Parameter (6 Parameter Lengkap)</option>
                    <option value="suhu">Suhu Udara (°C)</option>
                    <option value="kelembapan">Kelembapan Relatif (%)</option>
                    <option value="tekanan">Tekanan Barometrik (hPa)</option>
                    <option value="hujan">Curah Hujan (mm/jam)</option>
                    <option value="angin">Kecepatan & Arah Angin (km/jam)</option>
                    <option value="uv">Indeks Radiasi UV (UVI)</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-mute mb-1">Rentang Waktu</label>
                <select name="range" id="filterExportRange" class="w-full bg-bg rounded-xl px-3 py-2 text-xs text-ink border border-line focus:outline-none font-medium">
                    <option value="24h">24 Jam Terakhir</option>
                    <option value="7d">7 Hari Terakhir</option>
                    <option value="30d">30 Hari (1 Bulan Penuh)</option>
                </select>
            </div>

            <div class="bg-tint/70 rounded-xl p-3 text-xs text-ink border border-sea/20">
                <span class="font-bold text-sea block mb-1">Standar Format Ekspor CSV (FR-25):</span>
                <p class="text-[11px] text-mute">Berkas CSV kompatibel dengan Microsoft Excel, Google Sheets, dan format tabel data ilmiah dengan enkripsi UTF-8 BOM.</p>
            </div>

            <div class="flex items-center justify-end gap-2 pt-2">
                <button type="button" onclick="closeFilterModal()" class="px-4 py-2 rounded-[10px] bg-bg hover:bg-line text-ink text-xs font-semibold transition-all">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 rounded-[10px] bg-gradient-to-br from-sea to-deep text-white text-xs font-bold shadow-sm hover:opacity-95 transition-opacity">
                    Unduh Berkas CSV
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= TOAST NOTIFICATION CONTAINER ================= -->
<div id="toastContainer" class="fixed bottom-5 right-5 z-50 flex flex-col gap-2 pointer-events-none"></div>

@endsection

@push('scripts')
<script>
    // Data Tren Multi-Parameter
    const trendDataset = @json($trends);

    let currentParam = 'suhu';
    let currentRange = '24h';

    // Switch Parameter
    function switchParam(paramKey) {
        currentParam = paramKey;

        // Update Pill Styling
        document.querySelectorAll('.param-pill').forEach(pill => {
            pill.className = 'param-pill flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold transition-all shrink-0 text-mute hover:bg-tint hover:text-sea';
        });
        const activePill = document.getElementById('param-pill-' + paramKey);
        if (activePill) {
            activePill.className = 'param-pill flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold transition-all shrink-0 bg-dark text-white shadow-sm';
        }

        const data = trendDataset[paramKey];
        if (!data) return;

        // Update Stat Cards
        document.getElementById('stat-max-val').textContent = data.max;
        document.getElementById('stat-max-time').textContent = data.max_time;
        document.getElementById('stat-avg-val').textContent = data.avg;
        document.getElementById('stat-avg-delta').textContent = data.avg_delta;
        document.getElementById('stat-min-val').textContent = data.min;
        document.getElementById('stat-min-time').textContent = data.min_time;
        document.getElementById('stat-threshold-title').textContent = data.threshold_label;
        document.getElementById('stat-variability').innerHTML = `<i class="fa-solid fa-circle-check text-xs text-okbg"></i> ${data.variability}`;

        // Update Chart Labels & Title
        document.getElementById('chart-main-title').textContent = data.title;
        document.getElementById('chart-param-badge').textContent = `${data.title.replace('Tren ', '')} (${data.unit})`;

        // Update Y Axis
        if (data.y_axis) {
            for (let i = 0; i < 5; i++) {
                const yEl = document.getElementById('y-axis-' + i);
                if (yEl && data.y_axis[i]) yEl.textContent = data.y_axis[i];
            }
        }

        // Update SVG Paths with Smooth Transition
        const strokeEl = document.getElementById('svg-trend-stroke');
        const areaEl = document.getElementById('svg-trend-area');
        const threshLine = document.getElementById('svg-threshold-line');

        if (strokeEl && areaEl) {
            strokeEl.setAttribute('d', data.path_d);
            areaEl.setAttribute('d', data.area_d);
        }

        if (threshLine && data.threshold_y !== undefined) {
            threshLine.setAttribute('y1', data.threshold_y);
            threshLine.setAttribute('y2', data.threshold_y);
        }

        // Update Export Link
        updateExportLink();
    }

    // Switch Range
    function switchRange(rangeKey) {
        currentRange = rangeKey;
        document.querySelectorAll('.range-btn').forEach(btn => {
            btn.className = 'range-btn px-3 py-1 rounded-full text-xs font-semibold text-mute hover:text-ink transition-all';
        });
        const activeBtn = document.getElementById('btn-range-' + rangeKey);
        if (activeBtn) {
            activeBtn.className = 'range-btn px-3 py-1 rounded-full text-xs font-semibold bg-dark text-white shadow-sm transition-all';
        }

        // Update X-Axis labels based on range
        const container = document.getElementById('xAxisLabelsContainer');
        if (rangeKey === '24h') {
            container.innerHTML = '<span>10.00</span><span>14.00</span><span>18.00</span><span>22.00</span><span>02.00</span><span>06.00</span><span>10.00</span>';
        } else if (rangeKey === '7d') {
            container.innerHTML = '<span>29 Okt</span><span>30 Okt</span><span>31 Okt</span><span>1 Nov</span><span>2 Nov</span><span>3 Nov</span><span>Hari Ini</span>';
        } else {
            container.innerHTML = '<span>5 Okt</span><span>10 Okt</span><span>15 Okt</span><span>20 Okt</span><span>25 Okt</span><span>30 Okt</span><span>4 Nov</span>';
        }

        updateExportLink();
        showToast(`Rentang waktu beralih ke: ${rangeKey === '24h' ? '24 Jam Terakhir' : (rangeKey === '7d' ? '7 Hari Terakhir' : '30 Hari')}`);
    }

    function updateExportLink() {
        const btn = document.getElementById('exportCsvBtn');
        if (btn) {
            btn.href = `{{ route('analytics.export') }}?param=${currentParam}&range=${currentRange}`;
        }
    }

    // Tooltip Hover
    function showTooltip(e, time, val) {
        const tooltip = document.getElementById('chartTooltip');
        const timeEl = document.getElementById('tooltipTime');
        const valEl = document.getElementById('tooltipVal');

        timeEl.textContent = time;
        valEl.textContent = val;

        const rect = e.target.getBoundingClientRect();
        const wrapperRect = document.getElementById('chartCanvasWrapper').getBoundingClientRect();

        tooltip.style.left = `${rect.left - wrapperRect.left + 5}px`;
        tooltip.style.top = `${rect.top - wrapperRect.top - 10}px`;
        tooltip.classList.remove('hidden');

        e.target.onmouseleave = function() {
            tooltip.classList.add('hidden');
        };
    }

    // Highlight Threshold Line
    function highlightThreshold() {
        const line = document.getElementById('svg-threshold-line');
        line.setAttribute('stroke-width', '4');
        setTimeout(() => line.setAttribute('stroke-width', '1.8'), 1200);
        showToast('Garis batas waspada parameter disorot!');
    }

    // Search Table
    function searchAggregateTable() {
        const query = document.getElementById('tableSearchInput').value.toLowerCase().trim();
        const rows = document.querySelectorAll('.aggregate-row');
        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(query) ? '' : 'none';
        });
    }

    // Modal Filter
    function openFilterModal() {
        const modal = document.getElementById('modalFilter');
        const box = document.getElementById('modalFilterBox');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => box.classList.remove('scale-95', 'opacity-0'), 10);
    }

    function closeFilterModal() {
        const modal = document.getElementById('modalFilter');
        const box = document.getElementById('modalFilterBox');
        box.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 200);
    }

    // Toast
    function showToast(message) {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        toast.className = 'pointer-events-auto flex items-center gap-2 px-4 py-3 rounded-2xl shadow-floating text-xs font-semibold bg-ink text-white transition-all duration-300 transform translate-y-3 opacity-0';
        toast.innerHTML = `
            <i class="fa-solid fa-circle-check text-ok"></i>
            <span>${message}</span>
        `;
        container.appendChild(toast);
        requestAnimationFrame(() => {
            toast.classList.remove('translate-y-3', 'opacity-0');
        });
        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-y-3');
            setTimeout(() => toast.remove(), 300);
        }, 3500);
    }
</script>
@endpush

