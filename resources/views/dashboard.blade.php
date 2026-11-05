@extends('layouts.app')

@section('title', 'Dashboard - ' . ($meta['title'] ?? 'Pantai Sawarna'))

@section('content')
<div class="bg-bg text-ink min-h-[calc(100vh-2.5rem)] flex flex-col justify-between" id="dashboard-root">

    <!-- Top Wrapper: Grid Layout (Sidebar Capsule + Main Canvas) -->
    <div class="grid grid-cols-1 lg:grid-cols-[auto_minmax(0,1fr)] gap-4 lg:gap-6 items-start">

        <!-- ================= SIDEBAR CAPSULE ================= -->
        <aside class="flex lg:flex-col items-center justify-between lg:justify-start gap-2 sm:gap-3 bg-card rounded-[32px] sm:rounded-[36px] p-2 sm:p-2.5 shadow-soft border border-line/60 overflow-x-auto lg:overflow-visible sticky top-3 z-30">
            <!-- 1. Grid / Dashboard (Active) -->
            <button aria-label="Dashboard Beranda" title="Dashboard Beranda" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-dark text-white grid place-items-center shadow-md transition-all hover:scale-105 active:scale-95">
                <i class="fa-solid fa-table-cells-large text-base sm:text-lg"></i>
            </button>

            <!-- 2. Wallet / Hardware Nodes -->
            <button aria-label="Hardware & Node IoT" title="Perangkat & Sensor Lapangan" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
                <i class="fa-regular fa-id-badge text-base sm:text-lg"></i>
            </button>

            <!-- 3. Analytics / Charts -->
            <button aria-label="Analisis Tren" title="Grafik Tren & Riwayat Cuaca" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
                <i class="fa-solid fa-chart-simple text-base sm:text-lg"></i>
            </button>

            <!-- 4. Weather Stations / Locations -->
            <button aria-label="Stasiun Pesisir" title="Peta Titik Sensor Sawarna" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
                <i class="fa-solid fa-building text-base sm:text-lg"></i>
            </button>

            <!-- 5. Users / Tim Pengelola -->
            <button aria-label="Tim Pengelola" title="Petugas Lapangan & Pengelola" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
                <i class="fa-solid fa-user-group text-sm sm:text-base"></i>
            </button>

            <!-- 6. Calendar / Log Riwayat -->
            <button aria-label="Kalender & Log" title="Jadwal & Log Mitigasi Bencana" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
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
            <div title="{{ $user['name'] }} ({{ $user['role'] }})" class="w-10 h-10 sm:w-11 sm:h-11 rounded-full overflow-hidden bg-gradient-to-br from-sea to-deep border-2 border-white/70 shadow-sm grid place-items-center text-white font-bold text-xs cursor-pointer hover:ring-2 ring-sea transition-all">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="{{ $user['name'] }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                <span style="display:none;">{{ $user['avatar_initials'] ?? 'SW' }}</span>
            </div>
        </aside>

        <!-- ================= MAIN DASHBOARD CONTENT ================= -->
        <main class="flex flex-col gap-4 sm:gap-5 min-w-0">

            <!-- ---------- HEADER BAR ---------- -->
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-3.5">
                <!-- Left: Floral Sunburst Logo + Greeting -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <!-- Sunburst 8-Petal Floral Logo from Image -->
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
                            <h1 id="header-title" class="text-xl sm:text-2xl font-bold tracking-tight text-ink">Hello, Carlic!</h1>
                            <span class="hidden sm:inline-flex items-center gap-1 text-[11px] font-semibold px-2 py-0.5 rounded-full bg-okbg text-ok">
                                <i class="fa-solid fa-circle text-[6px]"></i> Live Telemetri
                            </span>
                        </div>
                        <p id="header-subtitle" class="text-mute text-xs sm:text-[13.5px] mt-0.5">Explore information and activity about your property</p>
                    </div>
                </div>

                <!-- Right: Controls, Search Pill & Notification Icons -->
                <div class="flex items-center gap-2 sm:gap-3 flex-wrap sm:flex-nowrap">
                    <!-- Toggle Context Button (Sawarna vs Image Demo Mode) -->
                    <button id="toggle-context-btn" onclick="toggleContextMode()" class="px-3 py-1.5 rounded-full bg-card hover:bg-tint text-mute hover:text-ink text-xs font-semibold border border-line shadow-soft flex items-center gap-1.5 transition-all">
                        <i class="fa-solid fa-repeat text-sea"></i>
                        <span id="context-mode-text">Ganti Mode: Sawarna IoT</span>
                    </button>

                    <!-- Theme Switcher Pill -->
                    <button onclick="toggleTheme()" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-card hover:bg-tint text-mute hover:text-ink grid place-items-center border border-line shadow-soft transition-all" title="Ganti Palet (Sage Green / Maritime Ocean)">
                        <i class="fa-solid fa-palette text-sm"></i>
                    </button>

                    <!-- Search Pill -->
                    <div class="flex items-center bg-card rounded-full pl-4 pr-1 py-1 shadow-soft border border-line/70 w-full sm:w-[260px] md:w-[280px]">
                        <input type="text" placeholder="Search..." class="bg-transparent text-xs sm:text-sm text-ink placeholder-mute focus:outline-none w-full">
                        <button class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-dark text-white grid place-items-center shrink-0 hover:opacity-90 transition-opacity">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </button>
                    </div>

                    <!-- Message Icon with Red Notification Dot -->
                    <button aria-label="Pesan & Komunikasi" class="relative w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-card hover:bg-tint text-ink border border-line/70 grid place-items-center shadow-soft shrink-0 transition-colors">
                        <i class="fa-regular fa-comment-dots text-sm sm:text-base"></i>
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 rounded-full bg-red-500 ring-2 ring-card"></span>
                    </button>

                    <!-- Notification Bell Icon -->
                    <button aria-label="Notifikasi Peringatan" class="relative w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-card hover:bg-tint text-ink border border-line/70 grid place-items-center shadow-soft shrink-0 transition-colors">
                        <i class="fa-regular fa-bell text-sm sm:text-base"></i>
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 rounded-full bg-sea ring-2 ring-card"></span>
                    </button>
                </div>
            </header>

            <!-- ---------- ROW 1: 4 STATS METRIC CARDS ---------- -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4">

                <!-- Card 1: Spent this month / Suhu Udara -->
                <div class="squircle-card p-4 sm:p-5 flex items-center justify-between border border-line/60">
                    <div>
                        <span class="metric-label text-mute text-xs sm:text-[13.5px] font-medium block">Spent this month</span>
                        <div class="flex items-baseline gap-1 mt-1">
                            <span class="metric-val text-2xl sm:text-[28px] font-bold tracking-tight text-ink">$682.5</span>
                            <span class="metric-unit text-xs text-mute font-medium"></span>
                        </div>
                        <span class="text-[11px] text-ok font-semibold inline-flex items-center gap-1 mt-0.5">
                            <i class="fa-solid fa-arrow-trend-up text-[10px]"></i> +0.8% stabil
                        </span>
                    </div>
                    <!-- 5 Animated Vertical Soundwave Bars from Image -->
                    <div class="flex items-end gap-1.5 h-10 sm:h-11 px-1">
                        <span class="w-1.5 sm:w-2 bg-sea rounded-full transition-all duration-500" style="height: 40%"></span>
                        <span class="w-1.5 sm:w-2 bg-sea rounded-full transition-all duration-500" style="height: 70%"></span>
                        <span class="w-1.5 sm:w-2 bg-sea rounded-full transition-all duration-500" style="height: 55%"></span>
                        <span class="w-1.5 sm:w-2 bg-sea rounded-full transition-all duration-500" style="height: 90%"></span>
                        <span class="w-1.5 sm:w-2 bg-sea rounded-full transition-all duration-500" style="height: 60%"></span>
                    </div>
                </div>

                <!-- Card 2: New clients / Kelembapan Udara -->
                <div class="squircle-card p-4 sm:p-5 flex items-center justify-between border border-line/60">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-tint text-sea grid place-items-center shrink-0">
                            <i class="fa-regular fa-user text-base"></i>
                        </div>
                        <div>
                            <span class="metric-label text-mute text-xs sm:text-[13.5px] font-medium block">New clients</span>
                            <div class="flex items-baseline gap-1 mt-0.5">
                                <span class="metric-val text-2xl sm:text-[28px] font-bold tracking-tight text-ink">321</span>
                                <span class="metric-unit text-xs text-mute font-medium"></span>
                            </div>
                        </div>
                    </div>
                    <!-- Mini Sparkline Wave Curve -->
                    <div class="w-16 h-8 shrink-0">
                        <svg viewBox="0 0 70 30" class="w-full h-full overflow-visible">
                            <path d="M 0 20 Q 15 5, 30 18 T 60 10 T 70 12" fill="none" stroke="var(--sea)" stroke-width="2.5" stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>

                <!-- Card 3: Earnings / Tekanan Barometrik -->
                <div class="squircle-card p-4 sm:p-5 flex items-center justify-between border border-line/60">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-tint text-sea grid place-items-center shrink-0">
                            <i class="fa-solid fa-sack-dollar text-base"></i>
                        </div>
                        <div>
                            <span class="metric-label text-mute text-xs sm:text-[13.5px] font-medium block">Earnings</span>
                            <div class="flex items-baseline gap-1 mt-0.5">
                                <span class="metric-val text-2xl sm:text-[28px] font-bold tracking-tight text-ink">$350.40</span>
                                <span class="metric-unit text-xs text-mute font-medium"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-tint text-sea border border-line/60">
                        +12%
                    </span>
                </div>

                <!-- Card 4 (Hero Card): Activity / Kecepatan Angin Gradient Card -->
                <div class="squircle-card p-4 sm:p-5 flex items-center justify-between bg-gradient-to-br from-sea to-deep text-white border-0 shadow-card">
                    <div>
                        <span class="metric-label text-white/80 text-xs sm:text-[13.5px] font-medium block">Activity</span>
                        <div class="flex items-baseline gap-1 mt-0.5">
                            <span class="metric-val text-2xl sm:text-[28px] font-bold tracking-tight text-white">$540.50</span>
                            <span class="metric-unit text-xs text-white/80 font-medium"></span>
                        </div>
                    </div>
                    <!-- White Elegant Sinusoidal Wave Line from Image -->
                    <div class="w-20 h-9 shrink-0">
                        <svg viewBox="0 0 90 35" class="w-full h-full overflow-visible">
                            <path d="M 0 24 Q 22 5, 45 20 T 90 10" fill="none" stroke="#ffffff" stroke-width="2.8" stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>

            </section>

            <!-- ---------- ROW 2: MAIN VISUALIZATION (BALANCE / TREN, EARNINGS / HUJAN, PROFILE / KOMPAS) ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-4 gap-3.5 sm:gap-4 items-stretch">

                <!-- 1. Balance / Tren Interaktif (Span 2 Columns) -->
                <div class="lg:col-span-2 squircle-card p-4 sm:p-5 flex flex-col justify-between border border-line/60">
                    <!-- Top Sub-Header & Controls -->
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                        <div class="flex items-center gap-2">
                            <h2 id="chart-card-title" class="text-base sm:text-[17px] font-bold text-ink">Balance</h2>
                            <!-- Green "On track" pill with checkmark from image -->
                            <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-0.5 rounded-full bg-okbg text-ok">
                                <i class="fa-solid fa-circle-check text-[11px]"></i>
                                <span id="chart-status-badge">On track</span>
                            </span>
                        </div>
                        <div class="flex items-center gap-2">
                            <select id="trend-param" onchange="renderChart()" class="text-xs bg-bg/80 text-ink border border-line rounded-lg px-2 py-1 font-medium focus:outline-none">
                                <option value="wind">Kecepatan Angin (km/j)</option>
                                <option value="temp">Suhu Udara (°C)</option>
                                <option value="humidity">Kelembapan (%)</option>
                                <option value="pressure">Tekanan (hPa)</option>
                            </select>
                            <select id="trend-range" onchange="renderChart()" class="text-xs bg-bg/80 text-ink border border-line rounded-lg px-2 py-1 font-medium focus:outline-none">
                                <option value="monthly">Monthly</option>
                                <option value="24h">24 Jam</option>
                                <option value="7d">7 Hari</option>
                            </select>
                        </div>
                    </div>

                    <!-- Floating White Metric Pills (Saves & Balance pills from image) -->
                    <div class="flex flex-wrap gap-2.5 sm:gap-3 mb-3">
                        <!-- Pill A: Saves 43.50% +2.45% -->
                        <div class="bg-bg/70 rounded-xl px-3.5 py-2 border border-line/70 flex items-center gap-2.5 shadow-sm">
                            <div>
                                <span class="text-mute text-[11px] block font-medium">Saves</span>
                                <b id="pill-saves-val" class="text-sm sm:text-base font-bold text-ink">43.50%</b>
                            </div>
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-okbg text-ok">
                                +2.45%
                            </span>
                        </div>

                        <!-- Pill B: Balance $52,422 -4.75% -->
                        <div class="bg-bg/70 rounded-xl px-3.5 py-2 border border-line/70 flex items-center gap-2.5 shadow-sm">
                            <div>
                                <span class="text-mute text-[11px] block font-medium">Balance</span>
                                <b id="pill-balance-val" class="text-sm sm:text-base font-bold text-ink">$52,422</b>
                            </div>
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-badbg text-bad">
                                -4.75%
                            </span>
                        </div>

                        <!-- Pill C: Min / Range -->
                        <div class="bg-bg/70 rounded-xl px-3.5 py-2 border border-line/70 flex items-center gap-2 shadow-sm">
                            <div>
                                <span class="text-mute text-[11px] block font-medium">Min</span>
                                <b id="pill-min-val" class="text-sm sm:text-base font-bold text-ink">14,0</b>
                            </div>
                        </div>
                    </div>

                    <!-- Big Interactive SVG Spline Wave Chart -->
                    <div class="relative w-full h-[180px] sm:h-[200px] mt-1" id="chart-container">
                        <svg id="main-spline-chart" class="w-full h-full overflow-visible" viewBox="0 0 600 180" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="chartGradient" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="var(--sea)" stop-opacity="0.3"></stop>
                                    <stop offset="100%" stop-color="var(--sea)" stop-opacity="0.0"></stop>
                                </linearGradient>
                            </defs>
                            <!-- Grid Lines -->
                            <line x1="30" y1="40" x2="590" y2="40" stroke="var(--line)" stroke-dasharray="3 3"></line>
                            <line x1="30" y1="90" x2="590" y2="90" stroke="var(--line)" stroke-dasharray="3 3"></line>
                            <line x1="30" y1="140" x2="590" y2="140" stroke="var(--line)" stroke-dasharray="3 3"></line>

                            <!-- Warning Threshold Line -->
                            <line x1="30" y1="65" x2="590" y2="65" stroke="var(--warn)" stroke-dasharray="5 4" stroke-width="1.5"></line>
                            <text x="585" y="60" text-anchor="end" font-size="10" fill="var(--warn)" font-weight="600">batas waspada 30 km/j</text>

                            <!-- Gradient Area Fill -->
                            <path id="chart-area-path" d="M 30 130 Q 80 150, 130 90 T 230 110 T 330 60 T 430 85 T 530 115 T 590 120 L 590 170 L 30 170 Z" fill="url(#chartGradient)"></path>

                            <!-- Smooth Wavy Stroke Line (identical undulating curve from image) -->
                            <path id="chart-stroke-path" d="M 30 130 Q 80 150, 130 90 T 230 110 T 330 60 T 430 85 T 530 115 T 590 120" fill="none" stroke="var(--sea)" stroke-width="3" stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>

                <!-- 2. Earnings / Curah Hujan Arc Gauge Card -->
                <div class="squircle-card p-4 sm:p-5 flex flex-col justify-between border border-line/60 text-center">
                    <div class="text-left w-full">
                        <h2 id="gauge-card-title" class="text-base sm:text-[17px] font-bold text-ink">Earnings</h2>
                        <span class="text-mute text-xs block mt-1">Total Expense</span>
                        <div id="gauge-big-num" class="text-xl sm:text-2xl font-bold text-ink tracking-tight mt-0.5">$6078.76</div>
                        <p id="gauge-subtext" class="text-mute text-xs mt-1">Profit is 34% More than last Month</p>
                    </div>

                    <!-- Semi-Circle Arc Gauge (Identical to 80% gauge in image) -->
                    <div class="my-2 flex flex-col items-center justify-center">
                        <div class="relative w-44 h-24 sm:w-48 sm:h-28 flex items-end justify-center">
                            <svg class="w-full h-full overflow-visible" viewBox="0 0 200 110">
                                <!-- Background Track Arc -->
                                <path d="M 25 100 A 75 75 0 0 1 175 100" fill="none" stroke="var(--tint)" stroke-width="22" stroke-linecap="round"></path>
                                <!-- Active Arc Indicator (80% fill) -->
                                <path id="radial-arc-path" d="M 25 100 A 75 75 0 0 1 175 100" fill="none" stroke="var(--sea)" stroke-width="22" stroke-linecap="round" pathLength="100" stroke-dasharray="80 100"></path>
                                <!-- Center Bold Percentage Text -->
                                <text id="gauge-center-text" x="100" y="96" text-anchor="middle" font-size="28" font-weight="700" fill="var(--ink)">80%</text>
                            </svg>
                        </div>
                    </div>

                    <!-- Footer Status Pill -->
                    <div class="flex items-center justify-center gap-1.5 text-xs text-mute font-medium">
                        <span id="gauge-footer-note">mm/jam · <b class="text-ok">Status Normal & Terkendali</b></span>
                    </div>
                </div>

                <!-- 3. Profile / Arah Angin (Compass Dial Card) -->
                <div class="squircle-card p-4 sm:p-5 flex flex-col justify-between border border-line/60 text-center">
                    <!-- Top: Avatar & Name from Image -->
                    <div class="flex flex-col items-center">
                        <div class="relative w-14 h-14 sm:w-16 sm:h-16 rounded-full overflow-hidden bg-tint border-2 border-white shadow-soft flex items-center justify-center mb-2">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=120&auto=format&fit=crop&q=80" alt="Carlic Bolomboy" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-sm sm:text-base font-bold text-ink">Carlic Bolomboy</h3>
                        <span class="text-mute text-xs">carlic@gmail.com</span>
                    </div>

                    <!-- Center: Wind Direction Compass Dial with Rotating Pointer -->
                    <div class="my-2 flex flex-col items-center">
                        <div class="relative w-24 h-24 sm:w-28 sm:h-28 rounded-full border-2 border-line bg-bg/50 grid place-items-center shadow-inner">
                            <span class="absolute top-1 text-[11px] font-bold text-mute">U</span>
                            <span class="absolute right-1.5 text-[11px] font-bold text-mute">T</span>
                            <span class="absolute bottom-1 text-[11px] font-bold text-mute">S</span>
                            <span class="absolute left-1.5 text-[11px] font-bold text-mute">B</span>
                            <!-- Rotating Needle Pointer (225° Barat Daya) -->
                            <div id="compass-needle" class="w-full h-full grid place-items-center transition-transform duration-700" style="transform: rotate(225deg)">
                                <svg class="w-6 h-14 text-sea" viewBox="0 0 24 56" fill="currentColor">
                                    <polygon points="12,0 20,40 12,32 4,40"></polygon>
                                    <polygon points="12,56 16,40 12,36 8,40" fill="var(--mute)" opacity="0.6"></polygon>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom: 3 Columns Stats (Projects, Followers, Following / Arah, Hembusan, Rata-rata) -->
                    <div class="grid grid-cols-3 gap-1 pt-2 border-t border-line/70 w-full text-center">
                        <div>
                            <span id="stat-col-1-label" class="text-mute text-[11px] block font-medium">Projects</span>
                            <b id="stat-col-1-val" class="text-base sm:text-lg font-bold text-ink">26</b>
                        </div>
                        <div>
                            <span id="stat-col-2-label" class="text-mute text-[11px] block font-medium">Followers</span>
                            <b id="stat-col-2-val" class="text-base sm:text-lg font-bold text-ink">356</b>
                        </div>
                        <div>
                            <span id="stat-col-3-label" class="text-mute text-[11px] block font-medium">Following</span>
                            <b id="stat-col-3-val" class="text-base sm:text-lg font-bold text-ink">68</b>
                        </div>
                    </div>
                </div>

            </section>

            <!-- ---------- ROW 3: BOTTOM OPERATIONAL ROW (CREDIT CARDS / NODES, TRANSFERS / ALERTS, KEEP SAFE / CLOUD) ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-4 gap-3.5 sm:gap-4 items-stretch">

                <!-- 1. Available Credit Card in Wallet / Perangkat Sensor Terpasang (Span 2 Columns) -->
                <div class="lg:col-span-2 squircle-card p-4 sm:p-6 flex flex-col md:flex-row items-center justify-between gap-6 border border-line/60 relative overflow-hidden">
                    <!-- Left: Description & Add New Card Button -->
                    <div class="flex-1 z-10 w-full md:w-auto">
                        <h2 id="wallet-card-title" class="text-base sm:text-[17px] font-bold text-ink leading-snug">Available Credit<br>Card in Wallet</h2>
                        <p id="wallet-card-desc" class="text-mute text-xs sm:text-[13px] mt-2 max-w-[280px] leading-relaxed">
                            Kelola data sensor IoT dan kartu telemetri kawasan Pantai Sawarna secara real-time dan terintegrasi aman.
                        </p>
                        <button class="mt-4 px-4 py-2 sm:px-5 sm:py-2.5 rounded-xl bg-sea hover:opacity-90 text-white font-semibold text-xs tracking-wide shadow-sm flex items-center gap-1.5 transition-all">
                            <i class="fa-solid fa-plus text-[10px]"></i>
                            <span id="wallet-btn-text">Add New Card +</span>
                        </button>
                    </div>

                    <!-- Right: 3 Stacked Isometric Cards (matching the 3 floating tilted cards in image) -->
                    <div class="relative w-full md:w-[280px] h-[160px] sm:h-[180px] flex items-center justify-center shrink-0">
                        <!-- Card 3 (Bottom/Back Layer - Charcoal Black) -->
                        <div class="absolute w-[190px] sm:w-[210px] h-[115px] sm:h-[125px] rounded-2xl bg-gradient-to-br from-neutral-800 to-neutral-950 text-white p-3 shadow-card transform -rotate-12 translate-x-5 translate-y-6 opacity-90 border border-white/10">
                            <div class="flex justify-between items-center text-[9px] text-white/60">
                                <span>Master Card</span>
                                <i class="fa-solid fa-wifi text-[10px]"></i>
                            </div>
                            <div class="mt-4 font-mono text-[10px] tracking-widest text-white/80">**** 9012</div>
                            <div class="mt-3 flex justify-between items-end">
                                <span class="text-[8px] text-white/60 uppercase">Edge Hub 03</span>
                                <span class="w-5 h-3.5 rounded bg-amber-400/80 inline-block"></span>
                            </div>
                        </div>

                        <!-- Card 2 (Middle Layer - Forest Spruce Green) -->
                        <div class="absolute w-[190px] sm:w-[210px] h-[115px] sm:h-[125px] rounded-2xl bg-gradient-to-br from-[#3b5949] to-[#25392e] text-white p-3 shadow-card transform -rotate-6 translate-x-2 translate-y-2 opacity-95 border border-white/15">
                            <div class="flex justify-between items-center text-[9px] text-white/70">
                                <span>Sink Gateway</span>
                                <i class="fa-solid fa-signal text-[10px]"></i>
                            </div>
                            <div class="mt-4 font-mono text-[10px] tracking-widest text-white/90">**** 5678</div>
                            <div class="mt-3 flex justify-between items-end">
                                <span class="text-[8px] text-white/70 uppercase">Paket 99.4%</span>
                                <div class="flex -space-x-1">
                                    <span class="w-3.5 h-3.5 rounded-full bg-red-400/90 inline-block"></span>
                                    <span class="w-3.5 h-3.5 rounded-full bg-amber-400/90 inline-block"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Card 1 (Top/Front Layer - Frosted Glassmorphism Semi-Transparent) -->
                        <div class="absolute w-[190px] sm:w-[210px] h-[115px] sm:h-[125px] rounded-2xl bg-white/40 backdrop-blur-md border border-white/80 text-ink p-3 shadow-floating transform rotate-0 hover:scale-105 transition-transform duration-300">
                            <div class="flex justify-between items-center text-[9px] font-semibold text-ink/70">
                                <span>LARA STEINER / SW-01</span>
                                <i class="fa-solid fa-rss text-sea text-[10px]"></i>
                            </div>
                            <div class="mt-3 font-mono text-[11px] font-bold tracking-widest text-ink">1234 1234 1234 1234</div>
                            <div class="mt-3 flex justify-between items-end">
                                <div>
                                    <span class="text-[8px] text-mute uppercase block">Status Node</span>
                                    <span class="text-[9px] font-bold text-ok flex items-center gap-1">
                                        <i class="fa-solid fa-circle text-[6px]"></i> Solar 78%
                                    </span>
                                </div>
                                <div class="flex -space-x-1">
                                    <span class="w-4 h-4 rounded-full bg-rose-500/80 inline-block"></span>
                                    <span class="w-4 h-4 rounded-full bg-amber-500/80 inline-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Your Transfers / Log Peringatan Dini -->
                <div class="squircle-card p-4 sm:p-5 flex flex-col justify-between border border-line/60">
                    <h2 id="transfers-title" class="text-base sm:text-[17px] font-bold text-ink mb-2">Your Transfers</h2>

                    <div class="flex flex-col gap-3 my-1">
                        <!-- Transfer Row 1 -->
                        <div class="flex items-center justify-between gap-2 pb-2.5 border-b border-line/60">
                            <div>
                                <b id="tx-1-title" class="text-xs sm:text-sm font-semibold text-ink block leading-tight">From Anna Jones</b>
                                <span id="tx-1-time" class="text-[11px] text-mute">Today, 14:34</span>
                            </div>
                            <span id="tx-1-badge" class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-okbg text-ok">
                                +2.45%
                            </span>
                        </div>

                        <!-- Transfer Row 2 -->
                        <div class="flex items-center justify-between gap-2 pb-2.5 border-b border-line/60">
                            <div>
                                <b id="tx-2-title" class="text-xs sm:text-sm font-semibold text-ink block leading-tight">To Carlos Brown III</b>
                                <span id="tx-2-time" class="text-[11px] text-mute">Today, 15:23</span>
                            </div>
                            <span id="tx-2-badge" class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-badbg text-bad">
                                -4.75%
                            </span>
                        </div>

                        <!-- Transfer Row 3 -->
                        <div class="flex items-center justify-between gap-2">
                            <div>
                                <b id="tx-3-title" class="text-xs sm:text-sm font-semibold text-ink block leading-tight">From Joel Cannan</b>
                                <span id="tx-3-time" class="text-[11px] text-mute">Today, 17:54</span>
                            </div>
                            <span id="tx-3-badge" class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-okbg text-ok">
                                +2.45%
                            </span>
                        </div>
                    </div>
                </div>

                <!-- 3. Keep you safe! / Keamanan Password & Sinkronisasi -->
                <div class="squircle-card p-4 sm:p-5 flex flex-col items-center justify-between text-center border border-line/60">
                    <!-- Fingerprint Icon in Rounded Squircle Container -->
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-tint text-sea grid place-items-center shadow-soft mb-1">
                        <svg class="w-8 h-8 sm:w-9 sm:h-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12C2 6.5 6.5 2 12 2a10 10 0 0 1 8 4"></path>
                            <path d="M5 19.5C5.5 18 6 15 6 12a6 6 0 0 1 .34-2"></path>
                            <path d="M8.65 22c.21-.66.45-1.32.75-2"></path>
                            <path d="M9 6.8a6 6 0 0 1 9 5.2v2"></path>
                            <path d="M14 13a2 2 0 0 0-2-2 2 2 0 0 0-2 2v4"></path>
                            <path d="M12 21a8 8 0 0 0 7-4"></path>
                            <path d="M17 18a4 4 0 0 0-4-4"></path>
                        </svg>
                    </div>

                    <div>
                        <h3 id="security-card-title" class="text-base sm:text-[17px] font-bold text-ink">Keep you safe!</h3>
                        <p id="security-card-desc" class="text-mute text-xs sm:text-[13px] mt-1">
                            Update your security password
                        </p>
                    </div>

                    <!-- Full Width Action Button from Image -->
                    <button id="security-action-btn" class="w-full mt-3 py-2.5 px-4 rounded-xl bg-sea hover:opacity-90 text-white text-xs font-semibold shadow-sm transition-all">
                        Update Your Security
                    </button>
                </div>

            </section>

        </main>
    </div>

    <!-- Footer Note -->
    <footer class="mt-6 pt-3 border-t border-line/60 text-center text-xs text-mute flex flex-col sm:flex-row items-center justify-between gap-2">
        <span>© {{ date('Y') }} Sistem Telemetri & Peringatan Dini Pantai Sawarna, Lebak, Banten.</span>
        <span>Status Edge Gateway: <strong class="text-ok">Online</strong> · Sinkronisasi LoRaWAN Terhubung</span>
    </footer>

</div>
@endsection

@push('scripts')
<script>
    // State mode: 'image' (tampilan Carlic Bolomboy dari gambar) vs 'sawarna' (tampilan cuaca & IoT Sawarna dari docs/design)
    let currentMode = 'image';
    let currentTheme = 'sage';

    // Data kamus untuk kedua mode
    const modes = {
        image: {
            headerTitle: "Hello, Carlic!",
            headerSubtitle: "Explore information and activity about your property",
            toggleBtnText: "Ganti Mode: Sawarna IoT",
            chartTitle: "Balance",
            chartStatus: "On track",
            savesVal: "43.50%",
            balanceVal: "$52,422",
            minVal: "14,0",
            gaugeTitle: "Earnings",
            gaugeExpense: "$6078.76",
            gaugeSub: "Profit is 34% More than last Month",
            gaugeText: "80%",
            gaugeFooter: "mm/jam · <b class='text-ok'>Status Normal & Terkendali</b>",
            col1Label: "Projects", col1Val: "26",
            col2Label: "Followers", col2Val: "356",
            col3Label: "Following", col3Val: "68",
            walletTitle: "Available Credit<br>Card in Wallet",
            walletDesc: "Lorem ipsum dolor sit amet consectetur. Facilisis tincidunt purus id hendrerit cras massa sollicitudin adipiscing.",
            walletBtn: "Add New Card +",
            transfersTitle: "Your Transfers",
            tx1: { title: "From Anna Jones", time: "Today, 14:34", badge: "+2.45%", isOk: true },
            tx2: { title: "To Carlos Brown III", time: "Today, 15:23", badge: "-4.75%", isOk: false },
            tx3: { title: "From Joel Cannan", time: "Today, 17:54", badge: "+2.45%", isOk: true },
            securityTitle: "Keep you safe!",
            securityDesc: "Update your security password",
            securityBtn: "Update Your Security",
            m1: { label: "Spent this month", val: "$682.5", unit: "" },
            m2: { label: "New clients", val: "321", unit: "" },
            m3: { label: "Earnings", val: "$350.40", unit: "" },
            m4: { label: "Activity", val: "$540.50", unit: "" },
        },
        sawarna: {
            headerTitle: "Halo, Pengelola Sawarna!",
            headerSubtitle: "Pantau telemetri cuaca mikro dan sistem peringatan dini kawasan Pantai Sawarna",
            toggleBtnText: "Ganti Mode: Referensi Gambar",
            chartTitle: "Tren Parameter Cuaca",
            chartStatus: "Waspada",
            savesVal: "34,0 km/j",
            balanceVal: "24,2 km/j",
            minVal: "14,0 km/j",
            gaugeTitle: "Curah Hujan",
            gaugeExpense: "18,4 mm",
            gaugeSub: "Batas waspada 10 mm/jam · Intensitas terkontrol",
            gaugeText: "3,2",
            gaugeFooter: "mm/jam · <b class='text-ok'>Aman Terkendali</b>",
            col1Label: "Arah", col1Val: "225°",
            col2Label: "Hembusan", col2Val: "41",
            col3Label: "Rata-rata", col3Val: "28",
            walletTitle: "Perangkat Terpasang<br>(Hardware Health)",
            walletDesc: "3 Node Sensor terhubung via LoRaWAN & Gateway 4G. Panel surya dan baterai pengisi daya aktif.",
            walletBtn: "Konfigurasi Node +",
            transfersTitle: "Log Peringatan Dini",
            tx1: { title: "Angin kencang 34 km/jam", time: "Hari ini, 09.40", badge: "Aktif", isOk: false },
            tx2: { title: "Hujan lebat 18 mm/jam", time: "3 Nov, 16.10", badge: "Selesai", isOk: true },
            tx3: { title: "Anomali sensor tekanan", time: "2 Nov, 22.05", badge: "Selesai", isOk: true },
            securityTitle: "Data Cloud & Integritas",
            securityDesc: "38 data menunggu sinkron · Enkripsi telemetri aktif",
            securityBtn: "Sinkronkan Sekarang",
            m1: { label: "Suhu Udara", val: "29,4", unit: "°C" },
            m2: { label: "Kelembapan", val: "84", unit: "%" },
            m3: { label: "Tekanan Udara", val: "1008,6", unit: "hPa" },
            m4: { label: "Kecepatan Angin", val: "34", unit: "km/jam" },
        }
    };

    function updateDOM() {
        const d = modes[currentMode];
        document.getElementById('header-title').textContent = d.headerTitle;
        document.getElementById('header-subtitle').textContent = d.headerSubtitle;
        document.getElementById('context-mode-text').textContent = d.toggleBtnText;
        document.getElementById('chart-card-title').textContent = d.chartTitle;
        document.getElementById('chart-status-badge').textContent = d.chartStatus;
        document.getElementById('pill-saves-val').textContent = d.savesVal;
        document.getElementById('pill-balance-val').textContent = d.balanceVal;
        document.getElementById('pill-min-val').textContent = d.minVal;
        document.getElementById('gauge-card-title').textContent = d.gaugeTitle;
        document.getElementById('gauge-big-num').textContent = d.gaugeExpense;
        document.getElementById('gauge-subtext').textContent = d.gaugeSub;
        document.getElementById('gauge-center-text').textContent = d.gaugeText;
        document.getElementById('gauge-footer-note').innerHTML = d.gaugeFooter;

        document.getElementById('stat-col-1-label').textContent = d.col1Label;
        document.getElementById('stat-col-1-val').textContent = d.col1Val;
        document.getElementById('stat-col-2-label').textContent = d.col2Label;
        document.getElementById('stat-col-2-val').textContent = d.col2Val;
        document.getElementById('stat-col-3-label').textContent = d.col3Label;
        document.getElementById('stat-col-3-val').textContent = d.col3Val;

        document.getElementById('wallet-card-title').innerHTML = d.walletTitle;
        document.getElementById('wallet-card-desc').innerHTML = d.walletDesc;
        document.getElementById('wallet-btn-text').textContent = d.walletBtn;

        document.getElementById('transfers-title').textContent = d.transfersTitle;
        document.getElementById('tx-1-title').textContent = d.tx1.title;
        document.getElementById('tx-1-time').textContent = d.tx1.time;
        document.getElementById('tx-1-badge').textContent = d.tx1.badge;

        document.getElementById('tx-2-title').textContent = d.tx2.title;
        document.getElementById('tx-2-time').textContent = d.tx2.time;
        document.getElementById('tx-2-badge').textContent = d.tx2.badge;

        document.getElementById('tx-3-title').textContent = d.tx3.title;
        document.getElementById('tx-3-time').textContent = d.tx3.time;
        document.getElementById('tx-3-badge').textContent = d.tx3.badge;

        document.getElementById('security-card-title').textContent = d.securityTitle;
        document.getElementById('security-card-desc').textContent = d.securityDesc;
        document.getElementById('security-action-btn').textContent = d.securityBtn;

        const labels = document.querySelectorAll('.metric-label');
        const vals = document.querySelectorAll('.metric-val');
        const units = document.querySelectorAll('.metric-unit');

        if (labels.length >= 4) {
            labels[0].textContent = d.m1.label; vals[0].textContent = d.m1.val; units[0].textContent = d.m1.unit;
            labels[1].textContent = d.m2.label; vals[1].textContent = d.m2.val; units[1].textContent = d.m2.unit;
            labels[2].textContent = d.m3.label; vals[2].textContent = d.m3.val; units[2].textContent = d.m3.unit;
            labels[3].textContent = d.m4.label; vals[3].textContent = d.m4.val; units[3].textContent = d.m4.unit;
        }

        renderChart();
    }

    function toggleContextMode() {
        currentMode = (currentMode === 'image') ? 'sawarna' : 'image';
        updateDOM();
    }

    function toggleTheme() {
        const root = document.documentElement;
        if (currentTheme === 'sage') {
            root.setAttribute('data-theme', 'maritime');
            currentTheme = 'maritime';
        } else {
            root.removeAttribute('data-theme');
            currentTheme = 'sage';
        }
    }

    // Generator kurva Bezier halus yang realistis
    function renderChart() {
        const param = document.getElementById('trend-param').value;
        const range = document.getElementById('trend-range').value;
        const strokePath = document.getElementById('chart-stroke-path');
        const areaPath = document.getElementById('chart-area-path');

        // Variasi kurva berdasarkan parameter
        let points = [];
        if (param === 'wind') {
            points = [
                {x: 30, y: 130}, {x: 80, y: 150}, {x: 130, y: 90},
                {x: 230, y: 110}, {x: 330, y: 55}, {x: 430, y: 85},
                {x: 530, y: 115}, {x: 590, y: 120}
            ];
        } else if (param === 'temp') {
            points = [
                {x: 30, y: 110}, {x: 90, y: 100}, {x: 170, y: 60},
                {x: 260, y: 50}, {x: 350, y: 70}, {x: 440, y: 110},
                {x: 520, y: 130}, {x: 590, y: 105}
            ];
        } else {
            points = [
                {x: 30, y: 70}, {x: 100, y: 85}, {x: 200, y: 120},
                {x: 300, y: 140}, {x: 400, y: 100}, {x: 500, y: 75},
                {x: 590, y: 65}
            ];
        }

        // Susun path string dengan Quad Bezier Curve
        let d = `M ${points[0].x} ${points[0].y}`;
        for (let i = 1; i < points.length - 1; i++) {
            const xc = (points[i].x + points[i + 1].x) / 2;
            const yc = (points[i].y + points[i + 1].y) / 2;
            d += ` Q ${points[i].x} ${points[i].y}, ${xc} ${yc}`;
        }
        d += ` L ${points[points.length - 1].x} ${points[points.length - 1].y}`;

        strokePath.setAttribute('d', d);
        areaPath.setAttribute('d', d + ` L 590 170 L 30 170 Z`);
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateDOM();
    });
</script>
@endpush

