@extends('layouts.app')

@section('title', 'Perangkat & Sensor Lapangan - Cuaca Mikro Sawarna')

@section('content')
<div class="bg-bg text-ink min-h-[calc(100vh-2.5rem)] flex flex-col justify-between" id="devices-root">

    <!-- Top Wrapper: Grid Layout (Sidebar Capsule + Main Canvas) -->
    <div class="grid grid-cols-1 lg:grid-cols-[auto_minmax(0,1fr)] gap-4 lg:gap-6 items-start">

        <!-- ================= SIDEBAR CAPSULE ================= -->
        <aside class="flex lg:flex-col items-center justify-between lg:justify-start gap-2.5 sm:gap-3 bg-card rounded-[32px] sm:rounded-[36px] p-2 sm:p-2.5 shadow-soft border border-line/60 overflow-x-auto lg:overflow-visible sticky top-3 z-30">
            <!-- 1. Grid / Dashboard -->
            <a href="{{ route('dashboard') }}" aria-label="Dashboard Beranda" title="Dashboard Beranda" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
                <i class="fa-solid fa-table-cells-large text-base sm:text-lg"></i>
            </a>

            <!-- 2. Perangkat IoT / Hardware Nodes (Active) -->
            <a href="{{ route('devices.index') }}" aria-label="Perangkat IoT" title="Perangkat & Sensor Lapangan" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-dark text-white grid place-items-center shadow-md transition-all hover:scale-105 active:scale-95">
                <i class="fa-solid fa-microchip text-base sm:text-lg"></i>
            </a>

            <!-- 3. Analytics / Charts -->
            <button aria-label="Analisis Tren" title="Grafik Tren & Riwayat Cuaca" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
                <i class="fa-solid fa-chart-line text-base sm:text-lg"></i>
            </button>

            <!-- 4. Weather Stations / Locations -->
            <button aria-label="Stasiun Pesisir" title="Peta Titik Sensor Sawarna" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
                <i class="fa-solid fa-tower-broadcast text-base sm:text-lg"></i>
            </button>

            <!-- 5. Users / Tim Pengelola -->
            <button aria-label="Tim Pengelola" title="Petugas Lapangan & Pengelola" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
                <i class="fa-solid fa-user-shield text-sm sm:text-base"></i>
            </button>

            <!-- 6. Calendar / Log Riwayat -->
            <button aria-label="Log & Peringatan" title="Log Peringatan Dini" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
                <i class="fa-regular fa-calendar-check text-base sm:text-lg"></i>
            </button>

            <!-- Flexible Spacer on Desktop -->
            <div class="hidden lg:block flex-1 min-h-[40px]"></div>

            <!-- 7. Settings -->
            <button aria-label="Pengaturan" title="Pengaturan Ambang Batas Sensor" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
                <i class="fa-solid fa-gear text-base sm:text-lg"></i>
            </button>

            <!-- 8. Logout -->
            <button aria-label="Keluar" title="Keluar Sesi" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-bad grid place-items-center transition-all">
                <i class="fa-solid fa-arrow-right-from-bracket text-base sm:text-lg"></i>
            </button>

            <!-- 9. Avatar / Location Profile Badge -->
            <div title="Stasiun Sawarna (SW)" class="w-10 h-10 sm:w-11 sm:h-11 rounded-full overflow-hidden bg-gradient-to-br from-sea to-deep border-2 border-white/70 shadow-sm grid place-items-center text-white font-bold text-xs cursor-pointer hover:ring-2 ring-sea transition-all">
                <span>SW</span>
            </div>
        </aside>

        <!-- ================= MAIN CONTENT ================= -->
        <main class="flex flex-col gap-4 sm:gap-5 min-w-0">

            <!-- ---------- HEADER BAR ---------- -->
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-3.5">
                <!-- Left: Floral Logo + Title & Live Badge -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-tint text-sea grid place-items-center shrink-0 shadow-soft">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                            <rect x="6" y="6" width="12" height="12" rx="2"></rect>
                            <path d="M9 2v4M15 2v4M9 18v4M15 18v4M2 9h4M2 15h4M18 9h4M18 15h4"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-ink">{{ $meta['title'] }}</h1>
                            <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold px-2.5 py-0.5 rounded-full bg-okbg text-ok">
                                <i class="fa-solid fa-circle text-[6px] animate-pulse"></i> 2 Node Online
                            </span>
                        </div>
                        <p class="text-mute text-xs sm:text-[13.5px] mt-0.5">{{ $meta['last_updated'] }}</p>
                    </div>
                </div>

                <!-- Right: Action Buttons & Quick Search -->
                <div class="flex items-center gap-2.5 sm:gap-3 flex-wrap md:flex-nowrap">
                    <!-- Ping LoRa Button -->
                    <button onclick="pingLoraNetwork()" class="flex items-center gap-2 px-3.5 py-2 rounded-full bg-card hover:bg-tint text-ink border border-line/70 text-xs font-semibold shadow-soft transition-all">
                        <i class="fa-solid fa-tower-cell text-sea text-xs"></i>
                        <span>Pindai Sinyal LoRa</span>
                    </button>

                    <!-- Trigger Backfill Sync -->
                    <button onclick="openSyncModal()" class="flex items-center gap-2 bg-gradient-to-br from-sea to-deep text-white font-bold text-xs rounded-[10px] px-4 py-2 shadow-sm hover:opacity-95 transition-opacity">
                        <i class="fa-solid fa-cloud-arrow-up text-xs"></i>
                        <span>Sinkronkan Sekarang</span>
                    </button>

                    <!-- Search Filter Box -->
                    <div class="hidden xl:flex items-center bg-card rounded-full pl-4 pr-1 py-1 shadow-soft border border-line/70 w-[210px]">
                        <input type="text" id="sensorSearchInput" oninput="filterSensors()" placeholder="Cari sensor / node..." class="bg-transparent text-xs text-ink placeholder-mute focus:outline-none w-full">
                        <button class="w-8 h-8 rounded-full bg-dark text-white grid place-items-center shrink-0">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </button>
                    </div>
                </div>
            </header>

            <!-- ---------- ROW 1: TOP STATS OVERVIEW CARDS (4 Kolom Sesuai Design System) ---------- -->
            <section class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">

                <!-- 1. Status Infrastruktur Node -->
                <div class="bg-card rounded-[20px] p-4 sm:p-5 border border-line/60 shadow-soft flex flex-col justify-between transition-all hover:shadow-card">
                    <div class="flex items-center justify-between">
                        <span class="text-[13px] text-mute font-medium">Infrastruktur Node</span>
                        <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                            <i class="fa-solid fa-network-wired text-sm"></i>
                        </div>
                    </div>
                    <div class="my-2.5">
                        <div class="flex items-baseline gap-1.5">
                            <span class="text-[26px] font-bold tracking-tight text-ink">{{ $overview['active_devices'] }}</span>
                            <span class="text-xs text-mute font-medium">/ {{ $overview['total_devices'] }} Unit Aktif</span>
                        </div>
                        <span class="text-[12px] text-ok font-semibold inline-flex items-center gap-1 mt-0.5">
                            <i class="fa-solid fa-circle-check text-[11px]"></i> 100% Online (Latensi 182 ms)
                        </span>
                    </div>
                    <div class="pt-2 border-t border-line/60 flex items-center justify-between text-[11px] text-mute">
                        <span>EDGE-01 Pantai</span>
                        <span class="font-bold text-ink">SINK-01 Kantor</span>
                    </div>
                </div>

                <!-- 2. Manajemen Catu Daya Solar & Baterai -->
                <div class="bg-card rounded-[20px] p-4 sm:p-5 border border-line/60 shadow-soft flex flex-col justify-between transition-all hover:shadow-card">
                    <div class="flex items-center justify-between">
                        <span class="text-[13px] text-mute font-medium">Catu Daya Edge</span>
                        <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                            <i class="fa-solid fa-solar-panel text-sm"></i>
                        </div>
                    </div>
                    <div class="my-2.5">
                        <div class="flex items-baseline gap-1.5">
                            <span class="text-[26px] font-bold tracking-tight text-ink">{{ $overview['edge_battery']['pct'] }}</span>
                            <span class="text-[13px] font-medium text-mute">%</span>
                            <span class="text-xs text-mute font-normal ml-1">({{ $overview['edge_battery']['voltage'] }})</span>
                        </div>
                        <div class="w-full bg-line/80 h-1.5 rounded-full mt-2 overflow-hidden">
                            <div class="bg-sea h-full rounded-full transition-all duration-500" style="width: {{ $overview['edge_battery']['pct'] }}%"></div>
                        </div>
                    </div>
                    <div class="pt-2 border-t border-line/60 flex items-center justify-between text-[11px] text-mute">
                        <span>Solar: {{ $overview['edge_battery']['solar_voltage'] }}</span>
                        <span class="font-semibold text-ok">Charging Normal</span>
                    </div>
                </div>

                <!-- 3. Tautan Radio LoRa Pesisir -->
                <div class="bg-card rounded-[20px] p-4 sm:p-5 border border-line/60 shadow-soft flex flex-col justify-between transition-all hover:shadow-card">
                    <div class="flex items-center justify-between">
                        <span class="text-[13px] text-mute font-medium">Kualitas Sinyal LoRa</span>
                        <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                            <i class="fa-solid fa-radio text-sm"></i>
                        </div>
                    </div>
                    <div class="my-2.5">
                        <div class="flex items-baseline gap-1.5">
                            <span class="text-[26px] font-bold tracking-tight text-ink">{{ $overview['lora_link']['rssi'] }}</span>
                        </div>
                        <div class="flex items-center gap-2 mt-0.5">
                            <span class="text-xs text-mute">SNR {{ $overview['lora_link']['snr'] }}</span>
                            <span class="text-mute text-xs">·</span>
                            <span class="text-xs font-semibold text-ok">PDR {{ $overview['lora_link']['pdr'] }}</span>
                        </div>
                    </div>
                    <div class="pt-2 border-t border-line/60 flex items-center justify-between text-[11px] text-mute">
                        <span>Jarak: {{ $overview['lora_link']['distance'] }}</span>
                        <span class="font-bold text-ink">AS923 (Ch 3)</span>
                    </div>
                </div>

                <!-- 4. Buffer & Antrean Sinkronisasi Cloud (Hero Accent) -->
                <div class="bg-gradient-to-br from-sea to-deep rounded-[20px] p-4 sm:p-5 text-white shadow-soft flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-[13px] text-white/80 font-medium">Antrean Backfill Cloud</span>
                        <div class="w-9 h-9 rounded-full bg-white/15 text-white grid place-items-center">
                            <i class="fa-solid fa-database text-sm"></i>
                        </div>
                    </div>
                    <div class="my-2.5">
                        <div class="flex items-baseline gap-1.5">
                            <span class="text-[26px] font-bold tracking-tight">{{ $overview['cloud_sync']['pending_queue'] }}</span>
                            <span class="text-xs text-white/80 font-medium">paket data antre</span>
                        </div>
                        <span class="text-[12px] text-white/90 inline-flex items-center gap-1.5 mt-0.5">
                            <i class="fa-solid fa-shield-halved text-xs"></i> Tersimpan aman di MicroSD
                        </span>
                    </div>
                    <div class="pt-2 border-t border-white/20 flex items-center justify-between text-[11px] text-white/80">
                        <span>Sinkron: {{ $overview['cloud_sync']['last_sync'] }}</span>
                        <span class="font-bold underline cursor-pointer hover:text-white" onclick="triggerImmediateSync()">Kirim Batch</span>
                    </div>
                </div>

            </section>

            <!-- ---------- ROW 2: DETAIL SPESIFIKASI DUA NODE IOT UTAMA (2 Kolom) ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                @foreach($devices as $idx => $dev)
                <div class="bg-card rounded-[20px] p-4 sm:p-5 border border-line/60 shadow-soft flex flex-col justify-between">
                    <div>
                        <!-- Header Node -->
                        <div class="flex items-start justify-between gap-3 pb-3 border-b border-line/60">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold px-2 py-0.5 rounded-full {{ $dev['type'] === 'edge_node' ? 'bg-sea/10 text-sea' : 'bg-dark/10 text-dark' }}">
                                        {{ $dev['code'] }}
                                    </span>
                                    <h2 class="text-base sm:text-[17px] font-bold text-ink">{{ $dev['name'] }}</h2>
                                </div>
                                <p class="text-xs text-mute mt-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-location-dot text-sea"></i>
                                    <span>{{ $dev['location'] }} ({{ $dev['elevation'] }})</span>
                                </p>
                            </div>

                            <div class="flex flex-col items-end shrink-0">
                                <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-okbg text-ok flex items-center gap-1">
                                    <i class="fa-solid fa-circle text-[5px]"></i> {{ $dev['status_label'] }}
                                </span>
                                <span class="text-[11px] text-mute mt-1">Last seen: {{ $dev['last_seen'] }}</span>
                            </div>
                        </div>

                        <!-- Hardware & Telemetry Specs Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 my-3.5">
                            <!-- Box Hardware -->
                            <div class="bg-bg/60 rounded-xl p-3 border border-line/50 text-xs">
                                <div class="flex items-center gap-1.5 text-mute font-semibold mb-1">
                                    <i class="fa-solid fa-microchip text-sea"></i>
                                    <span>Pemroses & Radio</span>
                                </div>
                                <p class="text-ink font-medium leading-snug">{{ $dev['hardware']['mcu'] }}</p>
                                <p class="text-mute mt-1 text-[11px]">{{ $dev['hardware']['transceiver'] }}</p>
                            </div>

                            <!-- Box Daya -->
                            <div class="bg-bg/60 rounded-xl p-3 border border-line/50 text-xs">
                                <div class="flex items-center gap-1.5 text-mute font-semibold mb-1">
                                    <i class="fa-solid fa-bolt text-warn"></i>
                                    <span>Catu Daya & Tegangan</span>
                                </div>
                                <p class="text-ink font-medium leading-snug">{{ $dev['power']['source'] }}</p>
                                <div class="flex items-center justify-between text-[11px] text-mute mt-1">
                                    <span>Tegangan: <b class="text-ink">{{ $dev['power']['battery_voltage'] }}</b></span>
                                    <span>Status: <b class="text-ok">{{ $dev['power']['power_status'] ?? 'Aktif' }}</b></span>
                                </div>
                            </div>

                            <!-- Box Jaringan LoRa/4G -->
                            <div class="bg-bg/60 rounded-xl p-3 border border-line/50 text-xs">
                                <div class="flex items-center gap-1.5 text-mute font-semibold mb-1">
                                    <i class="fa-solid fa-tower-broadcast text-sea"></i>
                                    <span>Konektivitas Transmisi</span>
                                </div>
                                <p class="text-ink font-medium leading-snug">{{ $dev['radio']['frequency'] }}</p>
                                <p class="text-mute mt-1 text-[11px]">
                                    RSSI: <b class="text-ink">{{ $dev['radio']['rssi'] }} dBm</b> · SNR: <b class="text-ink">{{ $dev['radio']['snr'] }} dB</b>
                                </p>
                            </div>

                            <!-- Box Penyimpanan & Backfill -->
                            <div class="bg-bg/60 rounded-xl p-3 border border-line/50 text-xs">
                                <div class="flex items-center gap-1.5 text-mute font-semibold mb-1">
                                    <i class="fa-solid fa-hard-drive text-sea"></i>
                                    <span>Penyimpanan & Buffer</span>
                                </div>
                                <p class="text-ink font-medium leading-snug">{{ $dev['hardware']['storage'] }}</p>
                                <p class="text-mute mt-1 text-[11px]">
                                    Terpakai: <b class="text-ink">{{ $dev['hardware']['storage_used'] }}</b> · <span class="text-warn font-semibold">{{ $dev['sync']['pending_count'] }} antrean</span>
                                </p>
                            </div>
                        </div>

                        <!-- Progress / Diagnostic Bars -->
                        <div class="space-y-2 pt-1 text-xs">
                            <div class="flex items-center justify-between text-mute">
                                <span>Persentase Cadangan Daya:</span>
                                <span class="font-bold text-ink">{{ $dev['power']['battery_pct'] }}%</span>
                            </div>
                            <div class="w-full bg-line/80 h-2 rounded-full overflow-hidden">
                                <div class="bg-sea h-full rounded-full transition-all duration-500" style="width: {{ $dev['power']['battery_pct'] }}%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Action Buttons -->
                    <div class="flex items-center justify-between gap-2 pt-4 mt-3 border-t border-line/60">
                        <span class="text-[11px] text-mute">Dipasang: {{ $dev['installed_at'] }}</span>
                        <div class="flex items-center gap-2">
                            <button onclick="pingSingleDevice('{{ $dev['code'] }}')" class="px-3 py-1.5 rounded-[10px] bg-bg hover:bg-tint text-ink border border-line text-xs font-semibold transition-all">
                                <i class="fa-solid fa-satellite-dish text-sea mr-1"></i> Uji Transmisi
                            </button>
                            <button onclick="openDeviceDetailModal('{{ $dev['code'] }}')" class="px-3 py-1.5 rounded-[10px] bg-dark text-white text-xs font-semibold hover:opacity-90 transition-all">
                                Rincian Node
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach

            </section>

            <!-- ---------- ROW 3: MATRIKS & INVENTARIS SENSOR LAPANGAN (FR-26, SRS, ERD) ---------- -->
            <section class="bg-card rounded-[20px] p-4 sm:p-5 border border-line/60 shadow-soft">
                <!-- Header Section -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-4 pb-3 border-b border-line/60">
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="text-base sm:text-[17px] font-bold text-ink">Matriks & Kalibrasi Sensor Cuaca Lapangan</h2>
                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-okbg text-ok">7 Terpasang di EDGE-01</span>
                        </div>
                        <p class="text-mute text-xs mt-0.5">Spesifikasi parameter fisik, model pabrikan, formula kalibrasi (offset/faktor), dan pembacaan telemetri aktif.</p>
                    </div>

                    <!-- Filter Tabs & Add Maintenance -->
                    <div class="flex items-center gap-2 flex-wrap">
                        <div class="inline-flex p-1 rounded-full bg-bg border border-line">
                            <button onclick="filterSensorCategory('all')" id="tab-sensor-all" class="sensor-tab-btn px-3 py-1 rounded-full text-xs font-semibold bg-dark text-white shadow-sm transition-all">
                                Semua (7)
                            </button>
                            <button onclick="filterSensorCategory('ok')" id="tab-sensor-ok" class="sensor-tab-btn px-3 py-1 rounded-full text-xs font-semibold text-mute hover:text-ink transition-all">
                                Normal (5)
                            </button>
                            <button onclick="filterSensorCategory('warn')" id="tab-sensor-warn" class="sensor-tab-btn px-3 py-1 rounded-full text-xs font-semibold text-mute hover:text-ink transition-all">
                                Waspada (2)
                            </button>
                        </div>

                        <button onclick="openCalibrationModal()" class="flex items-center gap-1.5 px-3 py-1.5 rounded-[10px] bg-gradient-to-br from-sea to-deep text-white font-bold text-xs shadow-sm hover:opacity-95 transition-opacity">
                            <i class="fa-solid fa-sliders text-xs"></i>
                            <span>Kalibrasi Sensor</span>
                        </button>
                    </div>
                </div>

                <!-- Sensor Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3.5" id="sensorGridContainer">
                    @foreach($sensors as $sensor)
                    <div class="sensor-card bg-bg/50 hover:bg-bg rounded-2xl p-4 border border-line/70 transition-all flex flex-col justify-between"
                         data-param="{{ $sensor['parameter'] }}"
                         data-status="{{ $sensor['status'] }}"
                         data-name="{{ strtolower($sensor['name']) }}"
                         data-model="{{ strtolower($sensor['model']) }}">
                        
                        <div>
                            <!-- Card Top: Param Name + Status Badge -->
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-9 h-9 rounded-xl bg-tint text-sea grid place-items-center shrink-0">
                                        @if($sensor['parameter'] === 'temperature')
                                            <i class="fa-solid fa-temperature-half text-sm"></i>
                                        @elseif($sensor['parameter'] === 'humidity')
                                            <i class="fa-solid fa-droplet text-sm"></i>
                                        @elseif($sensor['parameter'] === 'pressure')
                                            <i class="fa-solid fa-gauge-high text-sm"></i>
                                        @elseif($sensor['parameter'] === 'rainfall')
                                            <i class="fa-solid fa-cloud-showers-heavy text-sm"></i>
                                        @elseif($sensor['parameter'] === 'wind_speed')
                                            <i class="fa-solid fa-wind text-sm"></i>
                                        @elseif($sensor['parameter'] === 'wind_dir')
                                            <i class="fa-regular fa-compass text-sm"></i>
                                        @elseif($sensor['parameter'] === 'uv')
                                            <i class="fa-solid fa-sun text-sm"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-ink leading-tight">{{ $sensor['name'] }}</h3>
                                        <span class="text-[11px] text-mute block mt-0.5">{{ $sensor['id'] }} · {{ $sensor['device_code'] }}</span>
                                    </div>
                                </div>

                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $sensor['status'] === 'warn' ? 'bg-warnbg text-warn' : 'bg-okbg text-ok' }}">
                                    {{ $sensor['status_label'] }}
                                </span>
                            </div>

                            <!-- Live Value Box -->
                            <div class="bg-card rounded-xl p-3 border border-line/60 my-2.5 flex items-baseline justify-between">
                                <span class="text-xs text-mute font-medium">Pembacaan Terkini:</span>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-xl font-bold tracking-tight text-ink">{{ $sensor['value'] }}</span>
                                    <span class="text-xs font-semibold text-mute">{{ $sensor['unit'] }}</span>
                                </div>
                            </div>

                            <!-- Technical Specs List -->
                            <div class="space-y-1.5 text-xs text-mute">
                                <div class="flex items-center justify-between">
                                    <span>Model Sensor:</span>
                                    <span class="font-semibold text-ink truncate max-w-[170px]" title="{{ $sensor['model'] }}">{{ $sensor['model'] }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span>Interface Bus / Pin:</span>
                                    <span class="font-mono text-[11px] text-ink">{{ $sensor['bus'] }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span>Rentang Valid:</span>
                                    <span class="font-medium text-ink">{{ $sensor['min_valid'] }} ~ {{ $sensor['max_valid'] }} {{ $sensor['unit'] }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span>Formula Kalibrasi:</span>
                                    <span class="font-mono text-[11px] text-sea">y = {{ $sensor['calib_factor'] }}x {{ $sensor['calib_offset'] >= 0 ? '+ ' . $sensor['calib_offset'] : '- ' . abs($sensor['calib_offset']) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer Action -->
                        <div class="pt-3 mt-3 border-t border-line/60 flex items-center justify-between">
                            <span class="text-[11px] text-mute">{{ $sensor['accuracy'] }}</span>
                            <button onclick="editCalibration('{{ $sensor['id'] }}', '{{ $sensor['name'] }}', '{{ $sensor['calib_offset'] }}', '{{ $sensor['calib_factor'] }}', '{{ $sensor['unit'] }}')" class="text-xs font-semibold text-sea hover:text-deep hover:underline inline-flex items-center gap-1">
                                <i class="fa-solid fa-pen-to-square text-[11px]"></i> Kalibrasi
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- ---------- ROW 4: LOG RIWAYAT PERAWATAN & TELEMETRI INSPECTOR (2 Kolom) ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-4">

                <!-- Kolom Kiri: Riwayat Log Perawatan Perangkat (7 Kolom) -->
                <div class="lg:col-span-7 bg-card rounded-[20px] p-4 sm:p-5 border border-line/60 shadow-soft flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3 pb-2 border-b border-line/60">
                            <div>
                                <h2 class="text-base sm:text-[17px] font-bold text-ink">Riwayat Perawatan & Pemeliharaan</h2>
                                <p class="text-mute text-xs mt-0.5">Catatan teknisi penanganan berkala sensor cuaca di pesisir Pantai Sawarna.</p>
                            </div>
                            <button onclick="openMaintenanceModal()" class="flex items-center gap-1.5 px-3 py-1.5 rounded-[10px] bg-dark text-white text-xs font-semibold hover:opacity-90 transition-all">
                                <i class="fa-solid fa-plus text-xs"></i>
                                <span>Catat Perawatan</span>
                            </button>
                        </div>

                        <!-- Maintenance Table / Activity List -->
                        <div class="divide-y divide-line/60">
                            @foreach($maintenance_logs as $log)
                            <div class="py-3 flex flex-col sm:flex-row sm:items-start justify-between gap-2.5">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full bg-tint text-sea grid place-items-center shrink-0 mt-0.5">
                                        <i class="fa-solid fa-wrench text-xs"></i>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <b class="text-xs sm:text-sm font-semibold text-ink">{{ $log['action'] }}</b>
                                            <span class="text-[10px] font-bold px-1.5 py-0.2 rounded bg-okbg text-ok">Selesai</span>
                                        </div>
                                        <p class="text-xs text-mute mt-1 leading-relaxed">{{ $log['notes'] }}</p>
                                        <div class="flex items-center gap-3 text-[11px] text-mute mt-1.5">
                                            <span><i class="fa-solid fa-hard-drive text-sea mr-1"></i>{{ $log['device'] }}</span>
                                            <span><i class="fa-solid fa-user-gear mr-1"></i>{{ $log['technician'] }} ({{ $log['role'] }})</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right shrink-0 text-xs text-mute sm:self-start">
                                    <span class="font-semibold text-ink block">{{ $log['date'] }}</span>
                                    <span class="text-[11px]">{{ $log['time'] }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-3 border-t border-line/60 flex items-center justify-between text-xs text-mute">
                        <span>Menampilkan 4 log pemeliharaan terbaru</span>
                        <a href="#" class="text-sea font-semibold hover:underline">Lihat Semua Arsip &rarr;</a>
                    </div>
                </div>

                <!-- Kolom Kanan: Payload Telemetri Live & Kontrak Data JSON (5 Kolom) -->
                <div class="lg:col-span-5 bg-card rounded-[20px] p-4 sm:p-5 border border-line/60 shadow-soft flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3 pb-2 border-b border-line/60">
                            <div>
                                <h2 class="text-base sm:text-[17px] font-bold text-ink">Kontrak Data & Telemetri Live</h2>
                                <p class="text-mute text-xs mt-0.5">Payload JSON ingestion LoRa dari EDGE-01 ke Gateway (SRS 6.2 & 6.3).</p>
                            </div>
                            <span class="text-[11px] font-mono font-bold px-2 py-0.5 rounded-full bg-tint text-sea">JSON / MQTT</span>
                        </div>

                        <!-- Live Payload Inspector Code Block -->
                        <div class="relative bg-dark rounded-xl p-3 text-white/90 font-mono text-[11.5px] leading-relaxed overflow-x-auto shadow-inner max-h-[290px] border border-dark">
                            <button onclick="copyPayload()" title="Salin Payload JSON" class="absolute top-2.5 right-2.5 px-2 py-1 rounded bg-white/10 hover:bg-white/20 text-[10px] text-white transition-all flex items-center gap-1">
                                <i class="fa-regular fa-copy"></i>
                                <span id="copyBtnText">Salin</span>
                            </button>
                            <pre id="payloadCodeSnippet"><code>{
  "device_id": "{{ $payload_sample['device_id'] }}",
  "ts": "{{ $payload_sample['ts'] }}",
  "seq": {{ $payload_sample['seq'] }},
  "telemetry": {
    "temperature_c": {{ $payload_sample['telemetry']['temperature_c'] }},
    "humidity_pct": {{ $payload_sample['telemetry']['humidity_pct'] }},
    "pressure_hpa": {{ $payload_sample['telemetry']['pressure_hpa'] }},
    "rainfall_mm": {{ $payload_sample['telemetry']['rainfall_mm'] }},
    "wind_speed_kmh": {{ $payload_sample['telemetry']['wind_speed_kmh'] }},
    "wind_dir_deg": {{ $payload_sample['telemetry']['wind_dir_deg'] }},
    "uv_index": {{ $payload_sample['telemetry']['uv_index'] }}
  },
  "diagnostics": {
    "battery_v": {{ $payload_sample['diagnostics']['battery_v'] }},
    "battery_pct": {{ $payload_sample['diagnostics']['battery_pct'] }},
    "solar_v": {{ $payload_sample['diagnostics']['solar_v'] }},
    "rssi_dbm": {{ $payload_sample['diagnostics']['rssi_dbm'] }},
    "snr_db": {{ $payload_sample['diagnostics']['snr_db'] }},
    "pending_sync": {{ $payload_sample['diagnostics']['pending_sync'] }}
  },
  "flags": ["ok", "wind_warning"]
}</code></pre>
                        </div>

                        <!-- Info Bar Ingestion Validation -->
                        <div class="mt-3 bg-bg/80 rounded-xl p-3 border border-line/70 text-xs flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-check text-ok"></i>
                                <span class="text-ink font-semibold">Validasi Payload: Sesuai Kontrak Ingestion</span>
                            </div>
                            <span class="text-[11px] text-mute">Hash: SHA-256 Valid</span>
                        </div>
                    </div>

                    <!-- Footer Action -->
                    <div class="pt-3 mt-3 border-t border-line/60 flex items-center justify-between text-xs">
                        <span class="text-mute">Format Ingestion: POST /api/ingest</span>
                        <button onclick="simulateTelemetryPacket()" class="text-sea font-bold hover:underline inline-flex items-center gap-1">
                            <i class="fa-solid fa-paper-plane text-xs"></i> Uji Simulasi Ingest
                        </button>
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

<!-- ================= MODAL: KALIBRASI SENSOR (FR-26) ================= -->
<div id="modalCalibration" class="fixed inset-0 bg-dark/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-card rounded-[24px] max-w-md w-full p-5 sm:p-6 shadow-floating border border-line/60 transition-all scale-95 opacity-0 duration-200" id="modalCalibBox">
        <div class="flex items-center justify-between pb-3 border-b border-line/60">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-full bg-tint text-sea grid place-items-center">
                    <i class="fa-solid fa-sliders text-xs"></i>
                </div>
                <h3 class="text-base font-bold text-ink">Kalibrasi Sensor Lapangan</h3>
            </div>
            <button onclick="closeCalibrationModal()" class="w-7 h-7 rounded-full bg-bg hover:bg-line text-mute hover:text-ink grid place-items-center transition-all">
                <i class="fa-solid fa-xmark text-xs"></i>
            </button>
        </div>

        <form id="formCalibration" onsubmit="saveCalibration(event)" class="space-y-4 mt-4">
            <input type="hidden" id="calibSensorId" value="">
            
            <div>
                <label class="block text-xs font-semibold text-mute mb-1">Nama Sensor</label>
                <input type="text" id="calibSensorName" readonly class="w-full bg-bg rounded-xl px-3 py-2 text-xs font-bold text-ink border border-line focus:outline-none cursor-not-allowed">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-mute mb-1">Offset Kalibrasi (<span id="calibUnitText">°C</span>)</label>
                    <input type="number" step="0.01" id="calibOffsetInput" class="w-full bg-card rounded-xl px-3 py-2 text-xs text-ink border border-line focus:border-sea focus:outline-none font-mono">
                    <span class="text-[10px] text-mute block mt-0.5">Penambah nilai riil</span>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-mute mb-1">Faktor Kalibrasi (Slope)</label>
                    <input type="number" step="0.01" id="calibFactorInput" class="w-full bg-card rounded-xl px-3 py-2 text-xs text-ink border border-line focus:border-sea focus:outline-none font-mono">
                    <span class="text-[10px] text-mute block mt-0.5">Pengali skala (Default 1.0)</span>
                </div>
            </div>

            <div class="bg-tint/70 rounded-xl p-3 text-xs text-ink border border-sea/20">
                <span class="font-bold text-sea block mb-1">Formula Standar Kalibrasi:</span>
                <p class="font-mono text-[11px] text-mute">Nilai Akhir = (Nilai Mentah × Faktor) + Offset</p>
                <p class="text-[10px] text-mute mt-1">Perubahan akan langsung dicatat pada tabel audit log dan diterapkan pada proses ingestion gateway.</p>
            </div>

            <div class="flex items-center justify-end gap-2 pt-2">
                <button type="button" onclick="closeCalibrationModal()" class="px-4 py-2 rounded-[10px] bg-bg hover:bg-line text-ink text-xs font-semibold transition-all">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 rounded-[10px] bg-gradient-to-br from-sea to-deep text-white text-xs font-bold shadow-sm hover:opacity-95 transition-opacity">
                    Simpan Kalibrasi
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL: CATAT PERAWATAN (FR-27) ================= -->
<div id="modalMaintenance" class="fixed inset-0 bg-dark/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-card rounded-[24px] max-w-lg w-full p-5 sm:p-6 shadow-floating border border-line/60 transition-all scale-95 opacity-0 duration-200" id="modalMaintBox">
        <div class="flex items-center justify-between pb-3 border-b border-line/60">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-full bg-tint text-sea grid place-items-center">
                    <i class="fa-solid fa-screwdriver-wrench text-xs"></i>
                </div>
                <h3 class="text-base font-bold text-ink">Catat Pemeliharaan Perangkat</h3>
            </div>
            <button onclick="closeMaintenanceModal()" class="w-7 h-7 rounded-full bg-bg hover:bg-line text-mute hover:text-ink grid place-items-center transition-all">
                <i class="fa-solid fa-xmark text-xs"></i>
            </button>
        </div>

        <form id="formMaintenance" onsubmit="saveMaintenance(event)" class="space-y-3.5 mt-4">
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-mute mb-1">Pilih Perangkat</label>
                    <select id="maintDeviceSelect" class="w-full bg-bg rounded-xl px-3 py-2 text-xs text-ink border border-line focus:outline-none font-medium">
                        <option value="EDGE-01">EDGE-01 (Pantai Pasir Putih)</option>
                        <option value="SINK-01">SINK-01 (Kantor Pengelola)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-mute mb-1">Tanggal Pelaksanaan</label>
                    <input type="text" id="maintDateInput" value="4 Nov 2026" class="w-full bg-bg rounded-xl px-3 py-2 text-xs text-ink border border-line focus:outline-none font-medium">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-mute mb-1">Petugas / Teknisi</label>
                <input type="text" id="maintTechInput" placeholder="Contoh: Rian Hidayat (Teknisi)" class="w-full bg-card rounded-xl px-3 py-2 text-xs text-ink border border-line focus:border-sea focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-semibold text-mute mb-1">Tindakan Perawatan</label>
                <input type="text" id="maintActionInput" placeholder="Contoh: Pembersihan garam panel surya & pengecekan baut tiang" class="w-full bg-card rounded-xl px-3 py-2 text-xs text-ink border border-line focus:border-sea focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-semibold text-mute mb-1">Catatan & Hasil Pemeriksaan</label>
                <textarea id="maintNotesInput" rows="3" placeholder="Tuliskan catatan teknis kondisi perangkat..." class="w-full bg-card rounded-xl p-3 text-xs text-ink border border-line focus:border-sea focus:outline-none resize-none"></textarea>
            </div>

            <div class="flex items-center justify-end gap-2 pt-2">
                <button type="button" onclick="closeMaintenanceModal()" class="px-4 py-2 rounded-[10px] bg-bg hover:bg-line text-ink text-xs font-semibold transition-all">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 rounded-[10px] bg-gradient-to-br from-sea to-deep text-white text-xs font-bold shadow-sm hover:opacity-95 transition-opacity">
                    Simpan Log
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
    // Toast Feedback
    function showToast(message, type = 'success') {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        const isOk = type === 'success';
        toast.className = `pointer-events-auto flex items-center gap-2 px-4 py-3 rounded-2xl shadow-floating text-xs font-semibold transition-all duration-300 transform translate-y-3 opacity-0 ${isOk ? 'bg-ink text-white' : 'bg-bad text-white'}`;
        toast.innerHTML = `
            <i class="fa-solid ${isOk ? 'fa-circle-check text-ok' : 'fa-triangle-exclamation text-warn'}"></i>
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

    // Ping Network LoRa
    function pingLoraNetwork() {
        showToast('Memindai jaringan LoRa AS923... Sinyal terdeteksi stabil (-104 dBm, SNR +6.5 dB)');
    }

    function pingSingleDevice(code) {
        showToast(`Uji transmisi ke ${code} berhasil! Waktu respons radio: 182 ms`);
    }

    function openSyncModal() {
        showToast('Sinkronisasi backfill cloud dimulai: Mengirim 38 paket data terpending...');
    }

    function triggerImmediateSync() {
        showToast('Batch sync terkirim! 38 data telemetri berhasil diunggah ke cloud.');
    }

    function openDeviceDetailModal(code) {
        showToast(`Membuka profil diagnostik perangkat ${code}...`);
    }

    // Filter Sensors by Tab
    function filterSensorCategory(category) {
        document.querySelectorAll('.sensor-tab-btn').forEach(btn => {
            btn.className = 'sensor-tab-btn px-3 py-1 rounded-full text-xs font-semibold text-mute hover:text-ink transition-all';
        });
        const activeTab = document.getElementById('tab-sensor-' + category);
        if (activeTab) {
            activeTab.className = 'sensor-tab-btn px-3 py-1 rounded-full text-xs font-semibold bg-dark text-white shadow-sm transition-all';
        }

        const cards = document.querySelectorAll('.sensor-card');
        cards.forEach(card => {
            const status = card.getAttribute('data-status');
            if (category === 'all' || status === category) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Quick Search Sensor
    function filterSensors() {
        const query = document.getElementById('sensorSearchInput').value.toLowerCase().trim();
        const cards = document.querySelectorAll('.sensor-card');
        cards.forEach(card => {
            const name = card.getAttribute('data-name') || '';
            const model = card.getAttribute('data-model') || '';
            const param = card.getAttribute('data-param') || '';
            if (name.includes(query) || model.includes(query) || param.includes(query)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Modal Kalibrasi
    function openCalibrationModal() {
        editCalibration('SNS-TMP-01', 'Suhu Udara', '0.00', '1.00', '°C');
    }

    function editCalibration(id, name, offset, factor, unit) {
        document.getElementById('calibSensorId').value = id;
        document.getElementById('calibSensorName').value = `${name} (${id})`;
        document.getElementById('calibOffsetInput').value = offset;
        document.getElementById('calibFactorInput').value = factor;
        document.getElementById('calibUnitText').textContent = unit;

        const modal = document.getElementById('modalCalibration');
        const box = document.getElementById('modalCalibBox');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            box.classList.remove('scale-95', 'opacity-0');
        }, 10);
    }

    function closeCalibrationModal() {
        const modal = document.getElementById('modalCalibration');
        const box = document.getElementById('modalCalibBox');
        box.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 200);
    }

    function saveCalibration(e) {
        e.preventDefault();
        const name = document.getElementById('calibSensorName').value;
        const offset = document.getElementById('calibOffsetInput').value;
        const factor = document.getElementById('calibFactorInput').value;
        closeCalibrationModal();
        showToast(`Kalibrasi ${name} disimpan: Faktor ${factor}, Offset ${offset}`);
    }

    // Modal Perawatan
    function openMaintenanceModal() {
        const modal = document.getElementById('modalMaintenance');
        const box = document.getElementById('modalMaintBox');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            box.classList.remove('scale-95', 'opacity-0');
        }, 10);
    }

    function closeMaintenanceModal() {
        const modal = document.getElementById('modalMaintenance');
        const box = document.getElementById('modalMaintBox');
        box.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 200);
    }

    function saveMaintenance(e) {
        e.preventDefault();
        const action = document.getElementById('maintActionInput').value || 'Pemeriksaan rutin';
        closeMaintenanceModal();
        showToast(`Log perawatan baru berhasil dicatat: "${action}"`);
    }

    // Copy Payload JSON
    function copyPayload() {
        const code = document.getElementById('payloadCodeSnippet').innerText;
        navigator.clipboard.writeText(code).then(() => {
            const btn = document.getElementById('copyBtnText');
            btn.textContent = 'Tersalin!';
            setTimeout(() => btn.textContent = 'Salin', 2000);
            showToast('Payload JSON disalin ke clipboard');
        });
    }

    // Simulate Ingestion Packet
    function simulateTelemetryPacket() {
        showToast('Mengirim paket simulasi telemetri ke endpoint POST /api/ingest... Respon 200 OK');
    }
</script>
@endpush

