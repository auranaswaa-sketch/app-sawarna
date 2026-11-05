@extends('layouts.app')

@section('title', 'Pengaturan Sistem & Ambang Batas - Cuaca Pantai Sawarna')

@section('content')
<div class="bg-bg text-ink min-h-[calc(100vh-2.5rem)] flex flex-col justify-between" id="settings-root">

    <!-- Top Wrapper: Grid Layout (Sidebar Capsule + Main Settings Canvas) -->
    <div class="grid grid-cols-1 lg:grid-cols-[auto_minmax(0,1fr)] gap-4 lg:gap-6 items-start">

        <!-- ================= SIDEBAR CAPSULE ================= -->
        <aside class="flex lg:flex-col items-center justify-between lg:justify-start gap-2.5 sm:gap-3 bg-card rounded-[32px] sm:rounded-[36px] p-2 sm:p-2.5 shadow-soft border border-line/60 overflow-x-auto lg:overflow-visible sticky top-3 z-30">
            <!-- 1. Grid / Dashboard -->
            <a href="{{ route('dashboard') }}" aria-label="Dashboard Beranda" title="Kembali ke Dashboard Beranda" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
                <i class="fa-solid fa-table-cells-large text-base sm:text-lg"></i>
            </a>

            <!-- 2. Wallet / Hardware Nodes -->
            <button aria-label="Perangkat IoT" title="Perangkat & Sensor Lapangan" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all" onclick="switchTab('hardware')">
                <i class="fa-solid fa-microchip text-base sm:text-lg"></i>
            </button>

            <!-- 3. Analytics / Charts -->
            <a href="{{ route('dashboard') }}#analytics" aria-label="Analisis Tren" title="Grafik Tren & Riwayat Cuaca" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
                <i class="fa-solid fa-chart-line text-base sm:text-lg"></i>
            </a>

            <!-- 4. Weather Stations / Locations -->
            <button aria-label="Stasiun Pesisir" title="Peta Titik Sensor Sawarna" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all" onclick="switchTab('profile')">
                <i class="fa-solid fa-tower-broadcast text-base sm:text-lg"></i>
            </button>

            <!-- 5. Users / Tim Pengelola -->
            <button aria-label="Tim Pengelola" title="Petugas Lapangan & Pengelola" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all" onclick="switchTab('profile')">
                <i class="fa-solid fa-user-shield text-sm sm:text-base"></i>
            </button>

            <!-- 6. Calendar / Log Riwayat -->
            <button aria-label="Log & Peringatan" title="Log Peringatan Dini" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all" onclick="switchTab('thresholds')">
                <i class="fa-regular fa-calendar-check text-base sm:text-lg"></i>
            </button>

            <!-- Flexible Spacer on Desktop -->
            <div class="hidden lg:block flex-1 min-h-[40px]"></div>

            <!-- 7. Settings (ACTIVE) -->
            <button aria-label="Pengaturan" title="Pengaturan Ambang Batas Sensor" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-dark text-white grid place-items-center shadow-md transition-all hover:scale-105 active:scale-95">
                <i class="fa-solid fa-gear text-base sm:text-lg"></i>
            </button>

            <!-- 8. Logout -->
            <a href="{{ route('dashboard') }}" aria-label="Keluar" title="Keluar Sesi" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-bad grid place-items-center transition-all">
                <i class="fa-solid fa-arrow-right-from-bracket text-base sm:text-lg"></i>
            </a>

            <!-- 9. Avatar / Location Profile Badge -->
            <div title="Stasiun Sawarna (SW)" class="w-10 h-10 sm:w-11 sm:h-11 rounded-full overflow-hidden bg-gradient-to-br from-sea to-deep border-2 border-white/70 shadow-sm grid place-items-center text-white font-bold text-xs cursor-pointer hover:ring-2 ring-sea transition-all">
                <span>SW</span>
            </div>
        </aside>

        <!-- ================= MAIN SETTINGS CONTENT ================= -->
        <main class="flex flex-col gap-4 sm:gap-5 min-w-0">

            <!-- ---------- HEADER BAR ---------- -->
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-3.5">
                <!-- Left: Gear Logo + Title & Breadcrumb -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-tint text-sea grid place-items-center shrink-0 shadow-soft">
                        <i class="fa-solid fa-sliders text-lg sm:text-xl"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-ink">{{ $settings['meta']['title'] }}</h1>
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2.5 py-0.5 rounded-full bg-tint text-sea">
                                <i class="fa-solid fa-shield-halved text-[10px]"></i> Mode Administrator
                            </span>
                        </div>
                        <p class="text-mute text-xs sm:text-[13.5px] mt-0.5">{{ $settings['meta']['subtitle'] }}</p>
                    </div>
                </div>

                <!-- Right: Quick Actions -->
                <div class="flex items-center gap-2.5 sm:gap-3 flex-wrap">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-[10px] bg-card border border-line text-xs font-semibold text-mute hover:text-ink hover:bg-tint transition-all">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        <span>Dashboard</span>
                    </a>
                    <button type="button" onclick="saveAllSettings()" class="inline-flex items-center gap-2 px-4 py-2 rounded-[10px] bg-gradient-to-br from-sea to-deep text-white text-xs font-bold shadow-soft hover:opacity-95 active:scale-95 transition-all">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </header>

            <!-- ---------- TAB NAVIGATION PILLS ---------- -->
            <section class="bg-card rounded-[20px] p-2 shadow-soft border border-line/60">
                <nav class="flex items-center gap-1.5 sm:gap-2 overflow-x-auto no-scrollbar" aria-label="Tabs Pengaturan">
                    <button onclick="switchTab('thresholds')" id="tab-btn-thresholds" class="tab-pill active flex items-center gap-2 px-3.5 sm:px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all shrink-0 bg-dark text-white shadow-sm">
                        <i class="fa-solid fa-triangle-exclamation text-xs"></i>
                        <span>Ambang Batas Cuaca</span>
                    </button>
                    <button onclick="switchTab('notifications')" id="tab-btn-notifications" class="tab-pill flex items-center gap-2 px-3.5 sm:px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-mute hover:bg-tint hover:text-ink transition-all shrink-0">
                        <i class="fa-solid fa-paper-plane text-xs"></i>
                        <span>Saluran Notifikasi</span>
                    </button>
                    <button onclick="switchTab('hardware')" id="tab-btn-hardware" class="tab-pill flex items-center gap-2 px-3.5 sm:px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-mute hover:bg-tint hover:text-ink transition-all shrink-0">
                        <i class="fa-solid fa-microchip text-xs"></i>
                        <span>Node IoT & Kalibrasi</span>
                    </button>
                    <button onclick="switchTab('profile')" id="tab-btn-profile" class="tab-pill flex items-center gap-2 px-3.5 sm:px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-mute hover:bg-tint hover:text-ink transition-all shrink-0">
                        <i class="fa-solid fa-user-shield text-xs"></i>
                        <span>Profil Stasiun & Akses</span>
                    </button>
                </nav>
            </section>

            <!-- Alert Notification Banner (Hidden by default, triggered on save) -->
            <div id="save-toast" class="hidden items-center justify-between gap-3 px-4 py-3 rounded-2xl bg-okbg border border-ok/30 text-ok transition-all shadow-soft animate-fade-in">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-check text-base"></i>
                    <span class="text-xs sm:text-sm font-semibold">Konfigurasi pengaturan ambang batas dan telemetri berhasil disimpan ke sistem cloud!</span>
                </div>
                <button onclick="document.getElementById('save-toast').classList.add('hidden')" class="text-ok hover:opacity-75">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="settings-form" action="{{ route('settings.update') }}" method="POST" onsubmit="event.preventDefault(); saveAllSettings();">
                @csrf

                <!-- ================= TAB 1: AMBANG BATAS CUACA ================= -->
                <div id="tab-content-thresholds" class="tab-panel flex flex-col gap-4">
                    
                    <!-- Info Banner -->
                    <div class="bg-card rounded-[20px] p-4 shadow-soft border border-line/60 flex items-start sm:items-center justify-between gap-4 flex-col sm:flex-row">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-warnbg text-warn grid place-items-center shrink-0">
                                <i class="fa-solid fa-bell-concierge"></i>
                            </div>
                            <div>
                                <h2 class="text-sm font-bold text-ink">Aturan Otomatis Deteksi Peringatan Dini</h2>
                                <p class="text-mute text-xs mt-0.5">Sistem akan secara instan memicu banner merah/kuning dan mengirimkan sinyal bahaya ke Telegram & WhatsApp saat data sensor melampaui batas di bawah.</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1 rounded-full bg-okbg text-ok shrink-0">
                            <i class="fa-solid fa-circle text-[6px]"></i> Engine Peringatan Aktif
                        </span>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        
                        <!-- CARD 1: Kecepatan Angin (Hero Warning) -->
                        <div class="squircle-card p-5 flex flex-col justify-between gap-4 border border-line/60">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                                            <i class="fa-solid fa-wind text-sm"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-base font-bold text-ink">Kecepatan Angin</h3>
                                            <span class="text-mute text-xs">Satuan: km/jam · Sensor Anemometer</span>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center gap-1 text-xs font-bold px-2.5 py-1 rounded-full bg-warnbg text-warn">
                                        Live: 34 km/jam (Waspada)
                                    </span>
                                </div>
                                <p class="text-mute text-xs mb-4">{{ $settings['thresholds']['wind']['note'] }}</p>

                                <div class="space-y-4">
                                    <!-- Batas Waspada -->
                                    <div class="bg-bg/60 rounded-xl p-3 border border-line/60">
                                        <div class="flex items-center justify-between text-xs mb-1.5">
                                            <span class="font-semibold text-warn flex items-center gap-1.5">
                                                <i class="fa-solid fa-triangle-exclamation"></i> Batas Waspada (Kuning)
                                            </span>
                                            <span class="font-bold text-ink" id="wind_waspada_val">30 km/jam</span>
                                        </div>
                                        <input type="range" name="wind_waspada" min="10" max="60" value="{{ $settings['thresholds']['wind']['waspada'] }}" class="w-full accent-warn cursor-pointer" oninput="updateRangeText('wind_waspada_val', this.value, 'km/jam')">
                                        <div class="flex justify-between text-[10px] text-mute mt-1">
                                            <span>10 km/jam</span>
                                            <span>Default: 30 km/jam</span>
                                            <span>60 km/jam</span>
                                        </div>
                                    </div>

                                    <!-- Batas Siaga -->
                                    <div class="bg-bg/60 rounded-xl p-3 border border-line/60">
                                        <div class="flex items-center justify-between text-xs mb-1.5">
                                            <span class="font-semibold text-orange-600 flex items-center gap-1.5">
                                                <i class="fa-solid fa-circle-exclamation"></i> Batas Siaga (Oranye)
                                            </span>
                                            <span class="font-bold text-ink" id="wind_siaga_val">45 km/jam</span>
                                        </div>
                                        <input type="range" name="wind_siaga" min="30" max="80" value="{{ $settings['thresholds']['wind']['siaga'] }}" class="w-full accent-orange-500 cursor-pointer" oninput="updateRangeText('wind_siaga_val', this.value, 'km/jam')">
                                    </div>

                                    <!-- Batas Bahaya -->
                                    <div class="bg-bg/60 rounded-xl p-3 border border-line/60">
                                        <div class="flex items-center justify-between text-xs mb-1.5">
                                            <span class="font-semibold text-bad flex items-center gap-1.5">
                                                <i class="fa-solid fa-radiation"></i> Batas Bahaya Ekstrem (Merah)
                                            </span>
                                            <span class="font-bold text-ink" id="wind_bahaya_val">60 km/jam</span>
                                        </div>
                                        <input type="range" name="wind_bahaya" min="50" max="120" value="{{ $settings['thresholds']['wind']['bahaya'] }}" class="w-full accent-bad cursor-pointer" oninput="updateRangeText('wind_bahaya_val', this.value, 'km/jam')">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CARD 2: Curah Hujan -->
                        <div class="squircle-card p-5 flex flex-col justify-between gap-4 border border-line/60">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                                            <i class="fa-solid fa-droplet text-sm"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-base font-bold text-ink">Curah Hujan</h3>
                                            <span class="text-mute text-xs">Satuan: mm/jam · Tipping Bucket Gauge</span>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center gap-1 text-xs font-bold px-2.5 py-1 rounded-full bg-okbg text-ok">
                                        Live: 3.2 mm/jam (Aman)
                                    </span>
                                </div>
                                <p class="text-mute text-xs mb-4">{{ $settings['thresholds']['rain']['note'] }}</p>

                                <div class="space-y-4">
                                    <!-- Batas Waspada Hujan -->
                                    <div class="bg-bg/60 rounded-xl p-3 border border-line/60">
                                        <div class="flex items-center justify-between text-xs mb-1.5">
                                            <span class="font-semibold text-warn flex items-center gap-1.5">
                                                <i class="fa-solid fa-cloud-rain"></i> Hujan Sedang / Waspada
                                            </span>
                                            <span class="font-bold text-ink" id="rain_waspada_val">10 mm/jam</span>
                                        </div>
                                        <input type="range" name="rain_waspada" min="5" max="30" value="{{ $settings['thresholds']['rain']['waspada'] }}" class="w-full accent-warn cursor-pointer" oninput="updateRangeText('rain_waspada_val', this.value, 'mm/jam')">
                                    </div>

                                    <!-- Batas Siaga Hujan Lebat -->
                                    <div class="bg-bg/60 rounded-xl p-3 border border-line/60">
                                        <div class="flex items-center justify-between text-xs mb-1.5">
                                            <span class="font-semibold text-orange-600 flex items-center gap-1.5">
                                                <i class="fa-solid fa-cloud-showers-heavy"></i> Hujan Lebat / Siaga
                                            </span>
                                            <span class="font-bold text-ink" id="rain_siaga_val">20 mm/jam</span>
                                        </div>
                                        <input type="range" name="rain_siaga" min="15" max="50" value="{{ $settings['thresholds']['rain']['siaga'] }}" class="w-full accent-orange-500 cursor-pointer" oninput="updateRangeText('rain_siaga_val', this.value, 'mm/jam')">
                                    </div>

                                    <!-- Batas Bahaya Badai Air -->
                                    <div class="bg-bg/60 rounded-xl p-3 border border-line/60">
                                        <div class="flex items-center justify-between text-xs mb-1.5">
                                            <span class="font-semibold text-bad flex items-center gap-1.5">
                                                <i class="fa-solid fa-cloud-bolt"></i> Hujan Sangat Lebat / Bahaya
                                            </span>
                                            <span class="font-bold text-ink" id="rain_bahaya_val">35 mm/jam</span>
                                        </div>
                                        <input type="range" name="rain_bahaya" min="30" max="80" value="{{ $settings['thresholds']['rain']['bahaya'] }}" class="w-full accent-bad cursor-pointer" oninput="updateRangeText('rain_bahaya_val', this.value, 'mm/jam')">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CARD 3: Suhu Udara Ekstrem -->
                        <div class="squircle-card p-5 flex flex-col justify-between gap-4 border border-line/60">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                                            <i class="fa-solid fa-temperature-half text-sm"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-base font-bold text-ink">Rentang Suhu Normal</h3>
                                            <span class="text-mute text-xs">Satuan: °C · Sensor SHT31 / BME280</span>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center gap-1 text-xs font-bold px-2.5 py-1 rounded-full bg-okbg text-ok">
                                        Live: 29.4 °C (Normal)
                                    </span>
                                </div>
                                <p class="text-mute text-xs mb-4">{{ $settings['thresholds']['temp']['note'] }}</p>

                                <div class="grid grid-cols-2 gap-3">
                                    <div class="bg-bg/60 rounded-xl p-3 border border-line/60">
                                        <label class="block text-xs font-semibold text-mute mb-1">Ambang Batas Dingin</label>
                                        <div class="flex items-center gap-2">
                                            <input type="number" step="0.5" value="{{ $settings['thresholds']['temp']['min_cold'] }}" class="w-full bg-card rounded-lg px-3 py-1.5 text-sm font-bold text-ink border border-line focus:outline-none focus:ring-2 ring-sea">
                                            <span class="text-xs text-mute font-semibold">°C</span>
                                        </div>
                                    </div>
                                    <div class="bg-bg/60 rounded-xl p-3 border border-line/60">
                                        <label class="block text-xs font-semibold text-mute mb-1">Ambang Panas Ekstrem</label>
                                        <div class="flex items-center gap-2">
                                            <input type="number" step="0.5" value="{{ $settings['thresholds']['temp']['max_heat'] }}" class="w-full bg-card rounded-lg px-3 py-1.5 text-sm font-bold text-ink border border-line focus:outline-none focus:ring-2 ring-sea">
                                            <span class="text-xs text-mute font-semibold">°C</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CARD 4: Tekanan Barometrik (Depresi Badai) -->
                        <div class="squircle-card p-5 flex flex-col justify-between gap-4 border border-line/60">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                                            <i class="fa-solid fa-gauge-high text-sm"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-base font-bold text-ink">Tekanan Barometrik</h3>
                                            <span class="text-mute text-xs">Satuan: hPa · Barometer Presisi Tinggi</span>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center gap-1 text-xs font-bold px-2.5 py-1 rounded-full bg-okbg text-ok">
                                        Live: 1008.6 hPa (Stabil)
                                    </span>
                                </div>
                                <p class="text-mute text-xs mb-4">{{ $settings['thresholds']['pressure']['note'] }}</p>

                                <div class="bg-bg/60 rounded-xl p-3 border border-line/60">
                                    <label class="block text-xs font-semibold text-bad mb-1">Batas Anomali Penurunan Cepat (Indikasi Badai)</label>
                                    <div class="flex items-center gap-3">
                                        <input type="number" step="1" value="{{ $settings['thresholds']['pressure']['drop_limit'] }}" class="w-full bg-card rounded-lg px-3 py-1.5 text-sm font-bold text-ink border border-line focus:outline-none focus:ring-2 ring-sea">
                                        <span class="text-xs text-mute font-semibold">hPa</span>
                                    </div>
                                    <p class="text-[11px] text-mute mt-2">Bila tekanan anjlok &lt; 1000 hPa dalam tempo 3 jam, sistem akan mengirim status Siaga Badai Laut.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ================= TAB 2: SALURAN NOTIFIKASI ================= -->
                <div id="tab-content-notifications" class="tab-panel hidden flex-col gap-4">
                    
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                        
                        <!-- 1. Telegram Bot (Utama) -->
                        <div class="squircle-card p-5 flex flex-col justify-between gap-4 border border-line/60">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-10 h-10 rounded-full bg-sky-100 text-sky-600 grid place-items-center">
                                            <i class="fa-brands fa-telegram text-xl"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-base font-bold text-ink">Telegram Bot</h3>
                                            <span class="text-ok text-xs font-semibold flex items-center gap-1">
                                                <i class="fa-solid fa-circle text-[6px]"></i> Terhubung
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Toggle Switch -->
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" checked class="sr-only peer">
                                        <div class="w-11 h-6 bg-line peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-sea"></div>
                                    </label>
                                </div>
                                <p class="text-mute text-xs mb-3">Saluran tercepat untuk notifikasi instan kepada tim SAR, pengelola wisata, dan aparat desa.</p>
                                
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-xs font-semibold text-mute mb-1">Bot Username</label>
                                        <input type="text" value="{{ $settings['notifications']['telegram']['bot_name'] }}" readonly class="w-full bg-bg rounded-lg px-3 py-1.5 text-xs font-semibold text-ink border border-line">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-mute mb-1">Target Group Chat ID</label>
                                        <input type="text" value="{{ $settings['notifications']['telegram']['chat_id'] }}" class="w-full bg-card rounded-lg px-3 py-1.5 text-xs font-semibold text-ink border border-line focus:outline-none focus:ring-2 ring-sea">
                                    </div>
                                </div>
                            </div>

                            <button type="button" onclick="testNotification('Telegram')" class="w-full py-2 px-3 rounded-lg bg-tint text-sea text-xs font-bold hover:bg-sea hover:text-white transition-all flex items-center justify-center gap-2">
                                <i class="fa-solid fa-paper-plane"></i>
                                <span>Kirim Pesan Uji Coba</span>
                            </button>
                        </div>

                        <!-- 2. WhatsApp Gateway -->
                        <div class="squircle-card p-5 flex flex-col justify-between gap-4 border border-line/60">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 grid place-items-center">
                                            <i class="fa-brands fa-whatsapp text-xl"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-base font-bold text-ink">WhatsApp Broadcast</h3>
                                            <span class="text-ok text-xs font-semibold flex items-center gap-1">
                                                <i class="fa-solid fa-circle text-[6px]"></i> Aktif
                                            </span>
                                        </div>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" checked class="sr-only peer">
                                        <div class="w-11 h-6 bg-line peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-sea"></div>
                                    </label>
                                </div>
                                <p class="text-mute text-xs mb-3">Pesan otomatis ke grup WA Pokdarwis dan koordinator posko penyelamat pantai.</p>

                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-xs font-semibold text-mute mb-1">Penerima Pesan Kritis</label>
                                        <textarea rows="2" class="w-full bg-card rounded-lg p-2 text-xs font-semibold text-ink border border-line focus:outline-none focus:ring-2 ring-sea">{{ $settings['notifications']['whatsapp']['recipients'] }}</textarea>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-mute mb-1">Cooldown Pesan Ulang</label>
                                        <select class="w-full bg-card rounded-lg px-3 py-1.5 text-xs font-semibold text-ink border border-line focus:outline-none focus:ring-2 ring-sea">
                                            <option value="15" selected>15 Menit (Standar)</option>
                                            <option value="30">30 Menit</option>
                                            <option value="60">60 Menit</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="button" onclick="testNotification('WhatsApp')" class="w-full py-2 px-3 rounded-lg bg-tint text-sea text-xs font-bold hover:bg-sea hover:text-white transition-all flex items-center justify-center gap-2">
                                <i class="fa-solid fa-paper-plane"></i>
                                <span>Kirim Pesan Uji Coba</span>
                            </button>
                        </div>

                        <!-- 3. Email Alerts -->
                        <div class="squircle-card p-5 flex flex-col justify-between gap-4 border border-line/60">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-10 h-10 rounded-full bg-tint text-mute grid place-items-center">
                                            <i class="fa-solid fa-envelope text-lg"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-base font-bold text-ink">Email Laporan Harian</h3>
                                            <span class="text-mute text-xs font-semibold flex items-center gap-1">
                                                <i class="fa-solid fa-circle text-[6px]"></i> Nonaktif
                                            </span>
                                        </div>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer">
                                        <div class="w-11 h-6 bg-line peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-sea"></div>
                                    </label>
                                </div>
                                <p class="text-mute text-xs mb-3">Laporan rekapitulasi cuaca 24 jam untuk tim riset Telkom University dan arsip BMKG.</p>

                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-xs font-semibold text-mute mb-1">Daftar Email Penerima</label>
                                        <input type="text" value="{{ $settings['notifications']['email']['recipients'] }}" class="w-full bg-card rounded-lg px-3 py-1.5 text-xs font-semibold text-ink border border-line focus:outline-none focus:ring-2 ring-sea">
                                    </div>
                                </div>
                            </div>

                            <button type="button" onclick="testNotification('Email')" class="w-full py-2 px-3 rounded-lg bg-bg text-mute text-xs font-bold hover:bg-tint hover:text-ink transition-all flex items-center justify-center gap-2">
                                <i class="fa-solid fa-envelope"></i>
                                <span>Kirim Email Percobaan</span>
                            </button>
                        </div>

                    </div>
                </div>

                <!-- ================= TAB 3: NODE IOT & KALIBRASI ================= -->
                <div id="tab-content-hardware" class="tab-panel hidden flex-col gap-4">
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        
                        <!-- Konfigurasi Transmisi LoRa & Jaringan -->
                        <div class="squircle-card p-5 flex flex-col justify-between gap-4 border border-line/60">
                            <div>
                                <div class="flex items-center gap-2.5 mb-3">
                                    <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                                        <i class="fa-solid fa-tower-broadcast text-sm"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-base font-bold text-ink">Transmisi LoRa & Gateway Kantor</h3>
                                        <span class="text-mute text-xs">Edge Node Pantai &rarr; LoRa &rarr; Sink Node Kantor</span>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-ink mb-1">Interval Kirim Data Sensor (LoRa Uplink)</label>
                                        <select name="send_interval" class="w-full bg-card rounded-xl px-3 py-2 text-xs font-semibold text-ink border border-line focus:outline-none focus:ring-2 ring-sea">
                                            <option value="1" selected>Setiap 1 Menit (Rekomendasi Operasional)</option>
                                            <option value="2">Setiap 2 Menit</option>
                                            <option value="5">Setiap 5 Menit (Hemat Daya Mendung)</option>
                                            <option value="10">Setiap 10 Menit</option>
                                        </select>
                                        <p class="text-[11px] text-mute mt-1">Pengaturan 1 menit mengoptimalkan pengamatan angin dan hujan cepat.</p>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-semibold text-ink mb-1">Timeout Deteksi Node Mati (Offline Watchdog)</label>
                                        <div class="flex items-center gap-2">
                                            <input type="number" name="offline_timeout" value="{{ $settings['hardware']['offline_timeout'] }}" class="w-full bg-card rounded-xl px-3 py-2 text-xs font-bold text-ink border border-line focus:outline-none focus:ring-2 ring-sea">
                                            <span class="text-xs text-mute font-semibold">Menit</span>
                                        </div>
                                        <p class="text-[11px] text-mute mt-1">Bila gateway tidak menerima paket LoRa melebihi batas ini, alert "Node Offline" dibunyikan.</p>
                                    </div>

                                    <div class="bg-bg/60 rounded-xl p-3 border border-line/60">
                                        <div class="flex items-center justify-between mb-1.5">
                                            <span class="text-xs font-semibold text-ink">Ambang Kritis Baterai Panel Surya</span>
                                            <span class="text-xs font-bold text-bad">&lt; 20%</span>
                                        </div>
                                        <p class="text-[11px] text-mute">Pemberitahuan perawatan bila daya baterai li-ion turun di bawah 20% akibat hujan terus menerus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kalibrasi Offset Sensor & Ingestion Key -->
                        <div class="squircle-card p-5 flex flex-col justify-between gap-4 border border-line/60">
                            <div>
                                <div class="flex items-center gap-2.5 mb-3">
                                    <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                                        <i class="fa-solid fa-microchip text-sm"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-base font-bold text-ink">Kalibrasi Presisi & API Key Gateway</h3>
                                        <span class="text-mute text-xs">Penyesuaian offset lingkungan lapangan pesisir</span>
                                    </div>
                                </div>

                                <div class="space-y-3.5">
                                    <div class="grid grid-cols-3 gap-2">
                                        <div>
                                            <label class="block text-[11px] font-semibold text-mute mb-1">Offset Suhu</label>
                                            <input type="text" value="{{ $settings['hardware']['calibration']['temp_offset'] }}" class="w-full bg-card rounded-lg px-2.5 py-1.5 text-xs font-bold text-ink border border-line text-center">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-semibold text-mute mb-1">Offset Kelembapan</label>
                                            <input type="text" value="{{ $settings['hardware']['calibration']['hum_offset'] }}" class="w-full bg-card rounded-lg px-2.5 py-1.5 text-xs font-bold text-ink border border-line text-center">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-semibold text-mute mb-1">Offset Tekanan</label>
                                            <input type="text" value="{{ $settings['hardware']['calibration']['pressure_offset'] }}" class="w-full bg-card rounded-lg px-2.5 py-1.5 text-xs font-bold text-ink border border-line text-center">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-semibold text-ink mb-1">Sink Node Secret Key (HTTP Header X-Device-Key)</label>
                                        <div class="flex items-center gap-2">
                                            <input type="password" id="device_key_input" value="{{ $settings['hardware']['device_key'] }}" readonly class="w-full bg-bg rounded-lg px-3 py-1.5 text-xs font-mono text-mute border border-line">
                                            <button type="button" onclick="toggleSecretKey()" class="px-2.5 py-1.5 rounded-lg bg-card border border-line text-mute hover:text-ink text-xs">
                                                <i class="fa-solid fa-eye" id="eye_icon"></i>
                                            </button>
                                            <button type="button" onclick="copySecretKey()" class="px-2.5 py-1.5 rounded-lg bg-card border border-line text-mute hover:text-sea text-xs">
                                                <i class="fa-solid fa-copy"></i>
                                            </button>
                                        </div>
                                        <p class="text-[11px] text-mute mt-1">Digunakan untuk autentikasi data batch dan backfill dari Raspberry Pi di kantor pengelola.</p>
                                    </div>

                                    <div class="flex items-center justify-between p-3 rounded-xl bg-bg/70 border border-line/60">
                                        <div>
                                            <span class="block text-xs font-semibold text-ink">Auto-Backfill Saat Internet Pulih</span>
                                            <span class="block text-[11px] text-mute">Sinkronisasi batch dengan idempotency key</span>
                                        </div>
                                        <span class="text-ok text-xs font-bold px-2 py-0.5 rounded-full bg-okbg">Aktif</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ================= TAB 4: PROFIL STASIUN & KEAMANAN ================= -->
                <div id="tab-content-profile" class="tab-panel hidden flex-col gap-4">
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        
                        <!-- Info Stasiun & Lokasi Geografis -->
                        <div class="squircle-card p-5 flex flex-col justify-between gap-4 border border-line/60">
                            <div>
                                <div class="flex items-center gap-2.5 mb-3">
                                    <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                                        <i class="fa-solid fa-location-dot text-sm"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-base font-bold text-ink">Lokasi Stasiun & Identitas Perangkat</h3>
                                        <span class="text-mute text-xs">{{ $settings['meta']['station_code'] }}</span>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-xs font-semibold text-mute mb-1">Nama Stasiun Lapangan</label>
                                        <input type="text" value="{{ $settings['meta']['station_name'] }}" class="w-full bg-card rounded-lg px-3 py-1.5 text-xs font-semibold text-ink border border-line">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-mute mb-1">Alamat Penempatan Node</label>
                                        <input type="text" value="{{ $settings['admin']['station_location'] }}" class="w-full bg-card rounded-lg px-3 py-1.5 text-xs font-semibold text-ink border border-line">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-mute mb-1">Koordinat GPS (Latitude, Longitude)</label>
                                        <div class="flex items-center gap-2">
                                            <input type="text" value="{{ $settings['admin']['coordinates'] }}" readonly class="w-full bg-bg rounded-lg px-3 py-1.5 text-xs font-mono text-ink border border-line">
                                            <a href="https://maps.google.com/?q={{ $settings['admin']['coordinates'] }}" target="_blank" class="px-3 py-1.5 rounded-lg bg-tint text-sea text-xs font-semibold hover:bg-sea hover:text-white transition-all flex items-center gap-1.5">
                                                <i class="fa-solid fa-map"></i>
                                                <span>Peta</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Akun Administrator Pengelola -->
                        <div class="squircle-card p-5 flex flex-col justify-between gap-4 border border-line/60">
                            <div>
                                <div class="flex items-center gap-2.5 mb-3">
                                    <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                                        <i class="fa-solid fa-user-gear text-sm"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-base font-bold text-ink">Data Pengguna & Hak Akses</h3>
                                        <span class="text-mute text-xs">Penanggung jawab operasional harian</span>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-xs font-semibold text-mute mb-1">Nama Pengelola</label>
                                        <input type="text" value="{{ $settings['admin']['name'] }}" class="w-full bg-card rounded-lg px-3 py-1.5 text-xs font-semibold text-ink border border-line">
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <div>
                                            <label class="block text-xs font-semibold text-mute mb-1">Email Resmi</label>
                                            <input type="email" value="{{ $settings['admin']['email'] }}" class="w-full bg-card rounded-lg px-3 py-1.5 text-xs font-semibold text-ink border border-line">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-mute mb-1">Nomor WhatsApp</label>
                                            <input type="text" value="{{ $settings['admin']['phone'] }}" class="w-full bg-card rounded-lg px-3 py-1.5 text-xs font-semibold text-ink border border-line">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-mute mb-1">Peran Pengguna</label>
                                        <input type="text" value="{{ $settings['admin']['role'] }}" readonly class="w-full bg-bg rounded-lg px-3 py-1.5 text-xs font-semibold text-ink border border-line">
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-2 border-t border-line">
                                <span class="text-xs text-mute">Status Keamanan: <strong>MFA Aktif</strong></span>
                                <button type="button" onclick="alert('Fitur ganti kata sandi akan mengirimkan tautan konfirmasi ke email administrator.')" class="text-xs font-bold text-sea hover:underline">
                                    Ganti Kata Sandi
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </form>

        </main>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Tab Switching Functionality
    function switchTab(tabId) {
        // Sembunyikan seluruh tab panel
        document.querySelectorAll('.tab-panel').forEach(panel => {
            panel.classList.add('hidden');
            panel.classList.remove('flex');
        });

        // Hapus kelas aktif di tab button
        document.querySelectorAll('.tab-pill').forEach(btn => {
            btn.classList.remove('active', 'bg-dark', 'text-white', 'shadow-sm');
            btn.classList.add('text-mute');
        });

        // Tampilkan panel terpilih
        const targetPanel = document.getElementById('tab-content-' + tabId);
        const targetBtn = document.getElementById('tab-btn-' + tabId);

        if (targetPanel) {
            targetPanel.classList.remove('hidden');
            targetPanel.classList.add('flex');
        }

        if (targetBtn) {
            targetBtn.classList.add('active', 'bg-dark', 'text-white', 'shadow-sm');
            targetBtn.classList.remove('text-mute');
        }
    }

    // Dynamic slider text update
    function updateRangeText(elementId, value, unit) {
        const el = document.getElementById(elementId);
        if (el) {
            el.textContent = value + ' ' + unit;
        }
    }

    // Toggle Secret Key Visibility
    function toggleSecretKey() {
        const input = document.getElementById('device_key_input');
        const icon = document.getElementById('eye_icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Copy Secret Key
    function copySecretKey() {
        const input = document.getElementById('device_key_input');
        navigator.clipboard.writeText(input.value).then(() => {
            alert('Kunci rahasia API (Device Key) berhasil disalin ke clipboard.');
        });
    }

    // Test Notification
    function testNotification(channel) {
        alert('Mengirimkan sinyal uji coba peringatan dini ke saluran ' + channel + '...\nStatus: Sukses terkirim.');
    }

    // Save All Settings with Toast Animation
    function saveAllSettings() {
        const toast = document.getElementById('save-toast');
        toast.classList.remove('hidden');
        toast.classList.add('flex');
        
        // Scroll smoothly to top
        window.scrollTo({ top: 0, behavior: 'smooth' });

        // Auto hide after 4 seconds
        setTimeout(() => {
            toast.classList.add('hidden');
            toast.classList.remove('flex');
        }, 4000);
    }
</script>
@endpush

