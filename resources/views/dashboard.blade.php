@extends('layouts.app')

@section('title', 'Cuaca Mikro Pantai Sawarna')

@section('content')
<div class="bg-bg text-ink min-h-[calc(100vh-2.5rem)] flex flex-col justify-between" id="dashboard-root">

    <!-- Top Wrapper: Grid Layout (Sidebar Capsule + Main Canvas) -->
    <div class="grid grid-cols-1 lg:grid-cols-[auto_minmax(0,1fr)] gap-4 lg:gap-6 items-start">

        <!-- ================= SIDEBAR CAPSULE ================= -->
        <aside class="flex lg:flex-col items-center justify-between lg:justify-start gap-2.5 sm:gap-3 bg-card rounded-[32px] sm:rounded-[36px] p-2 sm:p-2.5 shadow-soft border border-line/60 overflow-x-auto lg:overflow-visible sticky top-3 z-30">
            <!-- 1. Grid / Dashboard (Active) -->
            <a href="{{ route('dashboard') }}" aria-label="Dashboard Beranda" title="Dashboard Beranda" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-dark text-white grid place-items-center shadow-md transition-all hover:scale-105 active:scale-95">
                <i class="fa-solid fa-table-cells-large text-base sm:text-lg"></i>
            </a>

            <!-- 2. Wallet / Hardware Nodes -->
            <a href="{{ route('devices.index') }}" aria-label="Perangkat IoT" title="Perangkat & Sensor Lapangan" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
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
            <a href="{{ route('settings.index') }}" aria-label="Pengaturan" title="Pengaturan Ambang Batas Sensor" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
                <i class="fa-solid fa-gear text-base sm:text-lg"></i>
            </a>

            <!-- 8. Logout -->
            <button aria-label="Keluar" title="Keluar Sesi" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-bad grid place-items-center transition-all">
                <i class="fa-solid fa-arrow-right-from-bracket text-base sm:text-lg"></i>
            </button>

            <!-- 9. Avatar / Location Profile Badge -->
            <div title="Stasiun Sawarna (SW)" class="w-10 h-10 sm:w-11 sm:h-11 rounded-full overflow-hidden bg-gradient-to-br from-sea to-deep border-2 border-white/70 shadow-sm grid place-items-center text-white font-bold text-xs cursor-pointer hover:ring-2 ring-sea transition-all">
                <span>SW</span>
            </div>
        </aside>

        <!-- ================= MAIN DASHBOARD CONTENT ================= -->
        <main class="flex flex-col gap-4 sm:gap-5 min-w-0">

            <!-- ---------- HEADER BAR ---------- -->
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-3.5">
                <!-- Left: Floral Sunburst Logo + Title -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <!-- Sunburst 8-Petal Floral Logo -->
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-tint text-sea grid place-items-center shrink-0 shadow-soft">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                            <line x1="12" y1="2" x2="12" y2="6"></line>
                            <line x1="12" y1="18" x2="12" y2="22"></line>
                            <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
                            <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
                            <line x1="2" y1="12" x2="6" y2="12"></line>
                            <line x1="18" y1="12" x2="22" y2="12"></line>
                            <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
                            <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
                            <circle cx="12" cy="12" r="3" fill="currentColor"></circle>
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-ink">{{ $meta['title'] }}</h1>
                            <span class="hidden sm:inline-flex items-center gap-1 text-[11px] font-semibold px-2 py-0.5 rounded-full bg-okbg text-ok">
                                <i class="fa-solid fa-circle text-[6px]"></i> Live Telemetri
                            </span>
                        </div>
                        <p class="text-mute text-xs sm:text-[13.5px] mt-0.5">{{ $meta['last_updated'] }}</p>
                    </div>
                </div>

                <!-- Right: Warning Banner & Action Buttons -->
                <div class="flex items-center gap-2.5 sm:gap-3.5 flex-wrap md:flex-nowrap">
                    <!-- Warning Banner from Blueprint -->
                    <div class="flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-warnbg/90 border border-warn/30 shadow-soft">
                        <span class="text-xs font-bold px-2 py-0.5 rounded-full bg-warn text-white">
                            {{ $meta['warning']['badge'] }}
                        </span>
                        <span class="text-xs font-medium text-ink">
                            {{ $meta['warning']['text'] }}
                        </span>
                    </div>

                    <!-- Search Pill -->
                    <div class="hidden xl:flex items-center bg-card rounded-full pl-4 pr-1 py-1 shadow-soft border border-line/70 w-[200px]">
                        <input type="text" placeholder="Cari data sensor..." class="bg-transparent text-xs text-ink placeholder-mute focus:outline-none w-full">
                        <button class="w-8 h-8 rounded-full bg-dark text-white grid place-items-center shrink-0">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </button>
                    </div>

                    <!-- Message Icon -->
                    <button aria-label="Pesan & Komunikasi" class="relative w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-card hover:bg-tint text-ink border border-line/70 grid place-items-center shadow-soft shrink-0 transition-colors">
                        <i class="fa-regular fa-comment-dots text-sm sm:text-base"></i>
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 rounded-full bg-red-500 ring-2 ring-card"></span>
                    </button>

                    <!-- Notification Bell Icon -->
                    <button aria-label="Notifikasi Peringatan" class="relative w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-card hover:bg-tint text-ink border border-line/70 grid place-items-center shadow-soft shrink-0 transition-colors">
                        <i class="fa-regular fa-bell text-sm sm:text-base"></i>
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 rounded-full bg-warn ring-2 ring-card animate-pulse"></span>
                    </button>
                </div>
            </header>

            <!-- ---------- ROW 1: 5 METRIC CARDS (SUHU, KELEMBAPAN, TEKANAN, HUJAN, ANGIN) ---------- -->
            <section class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-3.5">

                <!-- Card 1: Suhu (29,4 °C) -->
                <div class="squircle-card p-3.5 sm:p-4 flex flex-col justify-between border border-line/60">
                    <div class="flex items-center justify-between">
                        <span class="text-mute text-xs font-semibold">{{ $metrics['suhu']['label'] }}</span>
                        <div class="flex items-end gap-1 h-5">
                            <span class="w-1 bg-sea rounded-full" style="height: 40%"></span>
                            <span class="w-1 bg-sea rounded-full" style="height: 70%"></span>
                            <span class="w-1 bg-sea rounded-full" style="height: 55%"></span>
                            <span class="w-1 bg-sea rounded-full" style="height: 90%"></span>
                            <span class="w-1 bg-sea rounded-full" style="height: 60%"></span>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-1 my-1">
                        <span class="text-2xl sm:text-[26px] font-bold tracking-tight text-ink">{{ $metrics['suhu']['value'] }}</span>
                        <span class="text-xs text-mute font-medium">{{ $metrics['suhu']['unit'] }}</span>
                    </div>
                    <!-- Blue Sparkline Wave -->
                    <div class="w-full h-7 mt-0.5">
                        <svg viewBox="0 0 100 30" class="w-full h-full overflow-visible">
                            <path d="M 0 25 Q 15 22, 30 24 T 50 14 T 70 8 T 85 16 T 100 12" fill="none" stroke="var(--sea)" stroke-width="2.5" stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>

                <!-- Card 2: Kelembapan (84 %) -->
                <div class="squircle-card p-3.5 sm:p-4 flex flex-col justify-between border border-line/60">
                    <div class="flex items-center justify-between">
                        <span class="text-mute text-xs font-semibold">{{ $metrics['kelembapan']['label'] }}</span>
                        <div class="w-6 h-6 rounded-full bg-tint text-sea grid place-items-center text-xs">
                            <i class="fa-solid fa-droplet text-[10px]"></i>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-1 my-1">
                        <span class="text-2xl sm:text-[26px] font-bold tracking-tight text-ink">{{ $metrics['kelembapan']['value'] }}</span>
                        <span class="text-xs text-mute font-medium">{{ $metrics['kelembapan']['unit'] }}</span>
                    </div>
                    <!-- Blue Sparkline Wave -->
                    <div class="w-full h-7 mt-0.5">
                        <svg viewBox="0 0 100 30" class="w-full h-full overflow-visible">
                            <path d="M 0 10 Q 15 6, 30 8 T 50 18 T 70 24 T 85 16 T 100 14" fill="none" stroke="var(--sea)" stroke-width="2.5" stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>

                <!-- Card 3: Tekanan (1008,6 hPa) -->
                <div class="squircle-card p-3.5 sm:p-4 flex flex-col justify-between border border-line/60">
                    <div class="flex items-center justify-between">
                        <span class="text-mute text-xs font-semibold">{{ $metrics['tekanan']['label'] }}</span>
                        <div class="w-6 h-6 rounded-full bg-tint text-sea grid place-items-center text-xs">
                            <i class="fa-solid fa-gauge-high text-[10px]"></i>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-1 my-1">
                        <span class="text-2xl sm:text-[26px] font-bold tracking-tight text-ink">{{ $metrics['tekanan']['value'] }}</span>
                        <span class="text-xs text-mute font-medium">{{ $metrics['tekanan']['unit'] }}</span>
                    </div>
                    <!-- Blue Sparkline Wave -->
                    <div class="w-full h-7 mt-0.5">
                        <svg viewBox="0 0 100 30" class="w-full h-full overflow-visible">
                            <path d="M 0 20 Q 20 8, 40 10 T 70 22 T 85 18 T 100 16" fill="none" stroke="var(--sea)" stroke-width="2.5" stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>

                <!-- Card 4: Hujan (3,2 mm/jam) -->
                <div class="squircle-card p-3.5 sm:p-4 flex flex-col justify-between border border-line/60">
                    <div class="flex items-center justify-between">
                        <span class="text-mute text-xs font-semibold">{{ $metrics['hujan']['label'] }}</span>
                        <span class="text-[10px] font-bold px-1.5 py-0.2 rounded bg-okbg text-ok">Aman</span>
                    </div>
                    <div class="flex items-baseline gap-1 my-1">
                        <span class="text-2xl sm:text-[26px] font-bold tracking-tight text-ink">{{ $metrics['hujan']['value'] }}</span>
                        <span class="text-xs text-mute font-medium">{{ $metrics['hujan']['unit'] }}</span>
                    </div>
                    <!-- Blue Sparkline Wave -->
                    <div class="w-full h-7 mt-0.5">
                        <svg viewBox="0 0 100 30" class="w-full h-full overflow-visible">
                            <path d="M 0 26 Q 15 15, 30 10 T 50 18 T 65 24 T 85 25 T 100 25" fill="none" stroke="var(--sea)" stroke-width="2.5" stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>

                <!-- Card 5 (Hero Card): Angin (34 km/jam) Waspada -->
                <div class="col-span-2 sm:col-span-1 squircle-card p-3.5 sm:p-4 flex flex-col justify-between bg-gradient-to-br from-sea to-deep text-white border-0 shadow-card">
                    <div class="flex items-center justify-between">
                        <span class="text-white/80 text-xs font-semibold">{{ $metrics['angin']['label'] }}</span>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-warn text-white shadow-sm">Waspada</span>
                    </div>
                    <div class="flex items-baseline gap-1 my-1">
                        <span class="text-2xl sm:text-[26px] font-bold tracking-tight text-white">{{ $metrics['angin']['value'] }}</span>
                        <span class="text-xs text-white/80 font-medium">{{ $metrics['angin']['unit'] }}</span>
                    </div>
                    <!-- Crisp White Wave Line -->
                    <div class="w-full h-7 mt-0.5">
                        <svg viewBox="0 0 100 30" class="w-full h-full overflow-visible">
                            <path d="M 0 15 Q 15 8, 30 10 T 50 20 T 70 24 T 85 10 T 100 8" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>

            </section>

            <!-- ---------- ROW 2: TREN INTERAKTIF, ARAH ANGIN, HARDWARE & PERINGATAN ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-3.5 sm:gap-4 items-stretch">

                <!-- 1. TREN PARAMETER CUACA (Lg: Col-Span 6) -->
                <div class="lg:col-span-6 squircle-card p-4 sm:p-5 flex flex-col justify-between border border-line/60">
                    <!-- Header with Pills Filter matching wireframe -->
                    <div>
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                            <div class="flex items-center gap-2">
                                <h2 class="text-base sm:text-[17px] font-bold text-ink">Tren</h2>
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-2 py-0.5 rounded-full bg-warnbg text-warn">
                                    <i class="fa-solid fa-circle text-[6px]"></i> Ambang Batas 30
                                </span>
                            </div>

                            <!-- Rentang Waktu (24 jam / 7 hari) -->
                            <div class="flex items-center gap-1 bg-bg/80 p-0.5 rounded-full border border-line/70">
                                <button onclick="setRange('24h')" id="btn-range-24" class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-card text-ink shadow-sm transition-all">24 jam</button>
                                <button onclick="setRange('7d')" id="btn-range-7" class="px-2.5 py-0.5 rounded-full text-xs font-semibold text-mute hover:text-ink transition-all">7 hari</button>
                            </div>
                        </div>

                        <!-- Parameter Filter Buttons from blueprint: [Suhu] [Kelembapan] [Tekanan] [Hujan] [Angin] -->
                        <div class="flex flex-wrap items-center gap-1.5 mb-3">
                            <button onclick="setParam('suhu')" id="param-suhu" class="param-btn px-3 py-1 rounded-full text-xs font-semibold bg-dark text-white shadow-sm transition-all">Suhu</button>
                            <button onclick="setParam('kelembapan')" id="param-kelembapan" class="param-btn px-3 py-1 rounded-full text-xs font-semibold bg-bg/80 text-mute hover:text-ink border border-line transition-all">Kelembapan</button>
                            <button onclick="setParam('tekanan')" id="param-tekanan" class="param-btn px-3 py-1 rounded-full text-xs font-semibold bg-bg/80 text-mute hover:text-ink border border-line transition-all">Tekanan</button>
                            <button onclick="setParam('hujan')" id="param-hujan" class="param-btn px-3 py-1 rounded-full text-xs font-semibold bg-bg/80 text-mute hover:text-ink border border-line transition-all">Hujan</button>
                            <button onclick="setParam('angin')" id="param-angin" class="param-btn px-3 py-1 rounded-full text-xs font-semibold bg-bg/80 text-mute hover:text-ink border border-line transition-all">Angin</button>
                        </div>

                        <!-- Summary Pills: Maks, Rata-rata, Min -->
                        <div class="flex flex-wrap gap-2 mb-2">
                            <div class="bg-bg/70 rounded-xl px-3 py-1 border border-line/70 flex items-center gap-2">
                                <span class="text-mute text-[11px] font-medium">Maks</span>
                                <b id="trend-max-val" class="text-xs sm:text-sm font-bold text-ink">30,8 °C</b>
                                <span class="text-[10px] font-bold px-1.5 py-0.2 rounded-full bg-okbg text-ok">+2.45%</span>
                            </div>
                            <div class="bg-bg/70 rounded-xl px-3 py-1 border border-line/70 flex items-center gap-2">
                                <span class="text-mute text-[11px] font-medium">Rata-rata</span>
                                <b id="trend-avg-val" class="text-xs sm:text-sm font-bold text-ink">28,1 °C</b>
                                <span class="text-[10px] font-bold px-1.5 py-0.2 rounded-full bg-badbg text-bad">-1.15%</span>
                            </div>
                            <div class="bg-bg/70 rounded-xl px-3 py-1 border border-line/70 flex items-center gap-2">
                                <span class="text-mute text-[11px] font-medium">Min</span>
                                <b id="trend-min-val" class="text-xs sm:text-sm font-bold text-ink">23,9 °C</b>
                            </div>
                        </div>
                    </div>

                    <!-- SVG Chart with Y-axis and X-axis ticks matching blueprint -->
                    <div class="relative w-full h-[200px] sm:h-[220px] mt-2">
                        <svg id="trend-svg" class="w-full h-full overflow-visible" viewBox="0 0 540 210" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="chartFillGradient" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="var(--sea)" stop-opacity="0.35"></stop>
                                    <stop offset="100%" stop-color="var(--sea)" stop-opacity="0.0"></stop>
                                </linearGradient>
                            </defs>

                            <!-- Y-axis Ticks & Horizontal Lines (32,2 / 30,2 / 28,1 / 26,0 / 23,9) -->
                            <g class="text-[10px] font-medium fill-mute">
                                <line x1="36" y1="20" x2="530" y2="20" stroke="var(--line)"></line>
                                <text x="30" y="24" text-anchor="end">32,2</text>

                                <line x1="36" y1="60" x2="530" y2="60" stroke="var(--line)"></line>
                                <text x="30" y="64" text-anchor="end">30,2</text>

                                <line x1="36" y1="100" x2="530" y2="100" stroke="var(--line)"></line>
                                <text x="30" y="104" text-anchor="end">28,1</text>

                                <line x1="36" y1="140" x2="530" y2="140" stroke="var(--line)"></line>
                                <text x="30" y="144" text-anchor="end">26,0</text>

                                <line x1="36" y1="180" x2="530" y2="180" stroke="var(--line)"></line>
                                <text x="30" y="184" text-anchor="end">23,9</text>
                            </g>

                            <!-- Area Path Fill -->
                            <path id="svg-area" d="M 36 170 L 60 185 L 90 180 L 115 150 L 140 165 L 180 120 L 210 115 L 260 40 L 300 30 L 330 65 L 360 110 L 390 95 L 430 155 L 470 155 L 490 100 L 530 110 L 530 180 L 36 180 Z" fill="url(#chartFillGradient)"></path>

                            <!-- Stroke Line (Smooth Spline Curve) -->
                            <path id="svg-stroke" d="M 36 170 L 60 185 L 90 180 L 115 150 L 140 165 L 180 120 L 210 115 L 260 40 L 300 30 L 330 65 L 360 110 L 390 95 L 430 155 L 470 155 L 490 100 L 530 110" fill="none" stroke="var(--sea)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>

                            <!-- X-axis Ticks (-23 j / -19 j / -15 j / -11 j / -7 j / -3 j) -->
                            <g class="text-[10px] font-medium fill-mute">
                                <text x="50" y="202" text-anchor="middle">-23 j</text>
                                <text x="140" y="202" text-anchor="middle">-19 j</text>
                                <text x="230" y="202" text-anchor="middle">-15 j</text>
                                <text x="320" y="202" text-anchor="middle">-11 j</text>
                                <text x="410" y="202" text-anchor="middle">-7 j</text>
                                <text x="500" y="202" text-anchor="middle">-3 j</text>
                            </g>
                        </svg>
                    </div>
                </div>

                <!-- 2. MIDDLE COLUMN: ARAH ANGIN & PERANGKAT (Lg: Col-Span 3) -->
                <div class="lg:col-span-3 flex flex-col gap-3.5">
                    
                    <!-- Arah Angin Card -->
                    <div class="squircle-card p-4 flex flex-col justify-between border border-line/60">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm sm:text-base font-bold text-ink">{{ $wind['title'] }}</h2>
                            <span class="text-[11px] font-bold text-sea uppercase">Barat Daya</span>
                        </div>

                        <!-- Compass Dial Center from blueprint & image style -->
                        <div class="my-2 flex items-center justify-center gap-4">
                            <!-- Circular Dark Dial with Needle -->
                            <div class="relative w-22 h-22 sm:w-24 sm:h-24 rounded-full bg-[#1b2d24] border-2 border-line/60 shadow-inner grid place-items-center shrink-0">
                                <span class="absolute top-1 text-[9px] font-bold text-white/60">U</span>
                                <span class="absolute right-1.5 text-[9px] font-bold text-white/60">T</span>
                                <span class="absolute bottom-1 text-[9px] font-bold text-white/60">S</span>
                                <span class="absolute left-1.5 text-[9px] font-bold text-white/60">B</span>
                                <!-- Needle pointing 225° -->
                                <div class="w-full h-full grid place-items-center transition-transform duration-700" style="transform: rotate(225deg)">
                                    <svg class="w-4 h-12 text-[#88b19d]" viewBox="0 0 24 56" fill="currentColor">
                                        <polygon points="12,0 18,38 12,32 6,38"></polygon>
                                        <polygon points="12,56 15,38 12,34 9,38" fill="#ffffff" opacity="0.4"></polygon>
                                    </svg>
                                </div>
                            </div>

                            <!-- Bold Heading & Cardinal from Blueprint -->
                            <div>
                                <span class="text-mute text-xs block font-medium">Arah angin</span>
                                <b class="text-2xl sm:text-3xl font-bold text-ink tracking-tight">{{ $wind['degrees'] }}°</b>
                                <span class="text-mute text-xs block font-medium lowercase">{{ $wind['cardinal'] }}</span>
                            </div>
                        </div>

                        <!-- 3 Column Wind Stats -->
                        <div class="grid grid-cols-3 gap-1 pt-2 border-t border-line/60 text-center">
                            <div>
                                <span class="text-mute text-[10px] block font-medium">Derajat</span>
                                <b class="text-sm font-bold text-ink">225°</b>
                            </div>
                            <div>
                                <span class="text-mute text-[10px] block font-medium">Hembusan</span>
                                <b class="text-sm font-bold text-ink">41 <small class="text-[9px] text-mute font-normal">km/j</small></b>
                            </div>
                            <div>
                                <span class="text-mute text-[10px] block font-medium">Rata-rata</span>
                                <b class="text-sm font-bold text-ink">28 <small class="text-[9px] text-mute font-normal">km/j</small></b>
                            </div>
                        </div>
                    </div>

                    <!-- Perangkat Card (Hardware Status) -->
                    <div class="squircle-card p-4 flex flex-col justify-between border border-line/60 flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="text-sm sm:text-base font-bold text-ink">Perangkat</h2>
                            <span class="text-[11px] font-semibold text-ok flex items-center gap-1">
                                <i class="fa-solid fa-circle text-[6px]"></i> 3 Aktif
                            </span>
                        </div>

                        <div class="flex flex-col gap-2.5">
                            <!-- 1. Edge Node Pantai -->
                            <div class="pb-2 border-b border-line/60">
                                <div class="flex items-center justify-between">
                                    <b class="text-xs sm:text-sm font-semibold text-ink">Edge node pantai</b>
                                    <span class="text-[10px] font-bold text-ok px-1.5 py-0.2 rounded bg-okbg">Online</span>
                                </div>
                                <span class="text-mute text-xs mt-0.5 block">Baterai 78% · LoRa −104 dBm</span>
                                <div class="w-full bg-line/80 h-1.5 rounded-full mt-1.5 overflow-hidden">
                                    <div class="bg-sea h-full rounded-full" style="width: 78%"></div>
                                </div>
                            </div>

                            <!-- 2. Sink Node Kantor -->
                            <div class="pb-2 border-b border-line/60">
                                <div class="flex items-center justify-between">
                                    <b class="text-xs sm:text-sm font-semibold text-ink">Sink node kantor</b>
                                    <span class="text-[10px] font-bold text-ok px-1.5 py-0.2 rounded bg-okbg">99,4%</span>
                                </div>
                                <span class="text-mute text-xs mt-0.5 block">Paket diterima 99,4% · 4G stabil</span>
                            </div>

                            <!-- 3. Sinkron ke Cloud -->
                            <div>
                                <div class="flex items-center justify-between">
                                    <b class="text-xs sm:text-sm font-semibold text-ink">Sinkron ke cloud</b>
                                    <span class="text-[10px] font-bold text-warn px-1.5 py-0.2 rounded bg-warnbg">38 antre</span>
                                </div>
                                <span class="text-mute text-xs mt-0.5 block">38 data antre · terakhir 12 menit lalu</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- 3. RIGHT COLUMN: PERINGATAN DINI (Lg: Col-Span 3) -->
                <div class="lg:col-span-3 squircle-card p-4 sm:p-5 flex flex-col justify-between border border-line/60">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-base sm:text-[17px] font-bold text-ink">Peringatan</h2>
                            <span class="text-[11px] font-semibold text-mute">Riwayat Terakhir</span>
                        </div>

                        <!-- 4 Alert Rows from Blueprint -->
                        <div class="flex flex-col gap-3">
                            @foreach($alerts as $alert)
                            <div class="pb-2.5 border-b border-line/60 last:border-0 last:pb-0 flex items-start gap-2.5">
                                <span class="text-[11px] font-bold px-2 py-0.5 rounded-full shrink-0 {{ $alert['type'] === 'warn' ? 'bg-warnbg text-warn border border-warn/30' : 'bg-okbg text-ok' }}">
                                    {{ $alert['status'] }}
                                </span>
                                <div class="min-w-0 flex-1">
                                    <b class="text-xs sm:text-[13px] font-semibold text-ink block leading-snug">{{ $alert['title'] }}</b>
                                    <span class="text-mute text-[11px] block mt-0.5">{{ $alert['desc'] }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Cloud Security & Sync Button -->
                    <div class="mt-4 pt-3 border-t border-line/60">
                        <button class="w-full py-2.5 px-4 rounded-xl bg-sea hover:opacity-90 text-white text-xs font-semibold shadow-sm flex items-center justify-center gap-1.5 transition-all">
                            <i class="fa-solid fa-arrows-rotate text-xs"></i>
                            Sinkronkan Data Sekarang
                        </button>
                    </div>
                </div>

            </section>

        </main>
    </div>

    <!-- Footer Note -->
    <footer class="mt-6 pt-3 border-t border-line/60 text-center text-xs text-mute flex flex-col sm:flex-row items-center justify-between gap-2">
        <span>© {{ date('Y') }} Sistem Pemantauan Cuaca Mikro & Peringatan Dini Pantai Sawarna, Lebak, Banten.</span>
        <span>Gateway Stasiun: <strong class="text-ok">Online</strong> · Transmisi LoRa Aktif</span>
    </footer>

</div>
@endsection

@push('scripts')
<script>
    // Data kurva dan statistik untuk parameter
    const paramData = {
        suhu: {
            max: "30,8 °C", avg: "28,1 °C", min: "23,9 °C",
            d: "M 36 170 L 60 185 L 90 180 L 115 150 L 140 165 L 180 120 L 210 115 L 260 40 L 300 30 L 330 65 L 360 110 L 390 95 L 430 155 L 470 155 L 490 100 L 530 110"
        },
        kelembapan: {
            max: "92 %", avg: "84 %", min: "76 %",
            d: "M 36 60 L 80 50 L 140 80 L 200 110 L 260 140 L 320 90 L 380 70 L 440 60 L 530 80"
        },
        tekanan: {
            max: "1009,4 hPa", avg: "1008,6 hPa", min: "1007,8 hPa",
            d: "M 36 120 L 100 110 L 180 90 L 260 100 L 340 130 L 420 110 L 530 95"
        },
        hujan: {
            max: "18,0 mm/j", avg: "3,2 mm/j", min: "0,0 mm/j",
            d: "M 36 175 L 100 170 L 180 130 L 260 90 L 340 160 L 420 175 L 530 175"
        },
        angin: {
            max: "34,0 km/j", avg: "24,2 km/j", min: "14,0 km/j",
            d: "M 36 140 L 90 120 L 160 150 L 230 110 L 300 60 L 370 70 L 440 90 L 530 50"
        }
    };

    let activeParam = 'suhu';

    function setParam(param) {
        activeParam = param;
        document.querySelectorAll('.param-btn').forEach(btn => {
            btn.className = 'param-btn px-3 py-1 rounded-full text-xs font-semibold bg-bg/80 text-mute hover:text-ink border border-line transition-all';
        });
        const activeBtn = document.getElementById('param-' + param);
        if (activeBtn) {
            activeBtn.className = 'param-btn px-3 py-1 rounded-full text-xs font-semibold bg-dark text-white shadow-sm transition-all';
        }

        const data = paramData[param];
        if (data) {
            document.getElementById('trend-max-val').textContent = data.max;
            document.getElementById('trend-avg-val').textContent = data.avg;
            document.getElementById('trend-min-val').textContent = data.min;

            document.getElementById('svg-stroke').setAttribute('d', data.d);
            document.getElementById('svg-area').setAttribute('d', data.d + ' L 530 180 L 36 180 Z');
        }
    }

    function setRange(range) {
        const btn24 = document.getElementById('btn-range-24');
        const btn7 = document.getElementById('btn-range-7');
        if (range === '24h') {
            btn24.className = 'px-2.5 py-0.5 rounded-full text-xs font-semibold bg-card text-ink shadow-sm transition-all';
            btn7.className = 'px-2.5 py-0.5 rounded-full text-xs font-semibold text-mute hover:text-ink transition-all';
        } else {
            btn7.className = 'px-2.5 py-0.5 rounded-full text-xs font-semibold bg-card text-ink shadow-sm transition-all';
            btn24.className = 'px-2.5 py-0.5 rounded-full text-xs font-semibold text-mute hover:text-ink transition-all';
        }
    }
</script>
@endpush
