@extends('layouts.app')

@section('title', 'Detail Profil Pengelola - Cuaca Pantai Sawarna')

@section('content')
<div class="bg-bg text-ink min-h-[calc(100vh-2.5rem)] flex flex-col justify-between" id="profile-root">

    <!-- Top Wrapper: Grid Layout (Sidebar Capsule + Main Profile Canvas) -->
    <div class="grid grid-cols-1 lg:grid-cols-[auto_minmax(0,1fr)] gap-4 lg:gap-6 items-start">

        <!-- ================= SIDEBAR CAPSULE ================= -->
        <aside class="flex lg:flex-col items-center justify-between lg:justify-start gap-2.5 sm:gap-3 bg-card rounded-[32px] sm:rounded-[36px] p-2 sm:p-2.5 shadow-soft border border-line/60 overflow-x-auto lg:overflow-visible sticky top-3 z-30">
            <!-- 1. Grid / Dashboard -->
            <a href="{{ route('dashboard') }}" aria-label="Dashboard Beranda" title="Kembali ke Dashboard Beranda" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
                <i class="fa-solid fa-table-cells-large text-base sm:text-lg"></i>
            </a>

            <!-- 2. Wallet / Hardware Nodes -->
            <a href="{{ route('settings.index') }}#hardware" aria-label="Perangkat IoT" title="Perangkat & Sensor Lapangan" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
                <i class="fa-solid fa-microchip text-base sm:text-lg"></i>
            </a>

            <!-- 3. Analytics / Charts -->
            <a href="{{ route('dashboard') }}#analytics" aria-label="Analisis Tren" title="Grafik Tren & Riwayat Cuaca" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
                <i class="fa-solid fa-chart-line text-base sm:text-lg"></i>
            </a>

            <!-- 4. Weather Stations / Locations -->
            <button aria-label="Stasiun Pesisir" title="Peta Titik Sensor Sawarna" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all" onclick="switchProfileTab('stations')">
                <i class="fa-solid fa-tower-broadcast text-base sm:text-lg"></i>
            </button>

            <!-- 5. Users / Tim Pengelola (ACTIVE) -->
            <button aria-label="Profil Pengelola" title="Detail Profil Administrator" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-dark text-white grid place-items-center shadow-md transition-all hover:scale-105 active:scale-95">
                <i class="fa-solid fa-user-shield text-sm sm:text-base"></i>
            </button>

            <!-- 6. Calendar / Log Riwayat -->
            <button aria-label="Log & Riwayat" title="Log Aktivitas Pengguna" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all" onclick="switchProfileTab('activity')">
                <i class="fa-regular fa-calendar-check text-base sm:text-lg"></i>
            </button>

            <!-- Flexible Spacer on Desktop -->
            <div class="hidden lg:block flex-1 min-h-[40px]"></div>

            <!-- 7. Settings -->
            <a href="{{ route('settings.index') }}" aria-label="Pengaturan" title="Pengaturan Ambang Batas Sensor" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
                <i class="fa-solid fa-gear text-base sm:text-lg"></i>
            </a>

            <!-- 8. Logout -->
            <a href="{{ route('dashboard') }}" aria-label="Keluar" title="Keluar Sesi" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-bad grid place-items-center transition-all">
                <i class="fa-solid fa-arrow-right-from-bracket text-base sm:text-lg"></i>
            </a>

            <!-- 9. Avatar / Location Profile Badge -->
            <div title="Stasiun Sawarna (SW)" class="w-10 h-10 sm:w-11 sm:h-11 rounded-full overflow-hidden bg-gradient-to-br from-sea to-deep border-2 border-white/70 shadow-sm grid place-items-center text-white font-bold text-xs ring-2 ring-sea transition-all">
                <span>SW</span>
            </div>
        </aside>

        <!-- ================= MAIN PROFILE CONTENT ================= -->
        <main class="flex flex-col gap-4 sm:gap-5 min-w-0">

            <!-- ---------- HEADER BAR & BREADCRUMB ---------- -->
            <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-tint text-sea grid place-items-center shrink-0 shadow-soft">
                        <i class="fa-solid fa-id-card-clip text-lg sm:text-xl"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-ink">Profil Administrator</h1>
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2.5 py-0.5 rounded-full bg-okbg text-ok">
                                <i class="fa-solid fa-circle text-[6px]"></i> {{ $profile['user']['last_active'] }}
                            </span>
                        </div>
                        <p class="text-mute text-xs sm:text-[13.5px] mt-0.5">Kelola identitas pengelola, penugasan stasiun pemantau, dan kredensial keamanan</p>
                    </div>
                </div>

                <div class="flex items-center gap-2.5 sm:gap-3 flex-wrap">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-[10px] bg-card border border-line text-xs font-semibold text-mute hover:text-ink hover:bg-tint transition-all">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('settings.index') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-[10px] bg-card border border-line text-xs font-semibold text-mute hover:text-sea hover:bg-tint transition-all">
                        <i class="fa-solid fa-gear text-xs"></i>
                        <span>Pengaturan</span>
                    </a>
                </div>
            </header>

            <!-- ---------- HERO PROFILE BANNER (SQUIRCLE CARD) ---------- -->
            <section class="squircle-card overflow-hidden border border-line/60 shadow-soft">
                <!-- Oceanic Wave Gradient Header -->
                <div class="h-28 sm:h-32 bg-gradient-to-r from-sea via-deep to-dark relative p-4 sm:p-6 flex items-end justify-between">
                    <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
                    <div class="relative z-10 hidden sm:flex items-center gap-2 text-white/90 text-xs font-medium bg-black/20 backdrop-blur-md px-3 py-1 rounded-full border border-white/10">
                        <i class="fa-solid fa-location-dot text-xs text-sky"></i>
                        <span>{{ $profile['user']['station_name'] }}</span>
                    </div>
                    <span class="relative z-10 text-white/80 text-[11px] font-medium">Terdaftar sejak {{ $profile['user']['joined_at'] }}</span>
                </div>

                <!-- Profile Info & Avatar Overlay -->
                <div class="p-4 sm:p-6 pt-0 relative">
                    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 -mt-12 sm:-mt-14 mb-4">
                        <!-- Avatar with Badge -->
                        <div class="flex items-end gap-3.5 sm:gap-4">
                            <div class="relative group">
                                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-gradient-to-br from-sea to-deep border-4 border-card shadow-card grid place-items-center text-white font-extrabold text-2xl sm:text-3xl tracking-tight">
                                    {{ $profile['user']['avatar_initials'] }}
                                </div>
                                <span class="absolute bottom-1 right-1 w-4 h-4 sm:w-4.5 sm:h-4.5 rounded-full bg-ok border-2 border-card" title="Status Online"></span>
                                <button type="button" onclick="alert('Pilih foto baru untuk memperbarui avatar akun pengelola.')" class="absolute inset-0 rounded-full bg-black/40 text-white opacity-0 group-hover:opacity-100 transition-opacity grid place-items-center text-xs font-semibold backdrop-blur-xs">
                                    <i class="fa-solid fa-camera"></i>
                                </button>
                            </div>

                            <div>
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h2 class="text-lg sm:text-2xl font-bold text-ink">{{ $profile['user']['name'] }}</h2>
                                    <span class="inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-0.5 rounded-full bg-dark text-white">
                                        <i class="fa-solid fa-shield-halved text-[10px] text-sky"></i>
                                        {{ $profile['user']['role_badge'] }}
                                    </span>
                                </div>
                                <p class="text-mute text-xs sm:text-sm font-medium mt-0.5">{{ $profile['user']['title'] }}</p>
                                <p class="text-mute/80 text-[11.5px] mt-0.5">{{ $profile['user']['organization'] }}</p>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="flex items-center gap-2 shrink-0">
                            <button type="button" onclick="switchProfileTab('info')" class="px-3.5 py-2 rounded-[10px] bg-tint text-sea hover:bg-sea hover:text-white transition-all text-xs font-bold flex items-center gap-1.5">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <span>Edit Biodata</span>
                            </button>
                            <button type="button" onclick="switchProfileTab('security')" class="px-3.5 py-2 rounded-[10px] bg-card border border-line text-mute hover:text-ink transition-all text-xs font-semibold flex items-center gap-1.5">
                                <i class="fa-solid fa-key"></i>
                                <span>Ganti Sandi</span>
                            </button>
                        </div>
                    </div>

                    <!-- 4 Metric Quick Stats Grid -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 pt-4 border-t border-line/60">
                        <div class="bg-bg/60 rounded-xl p-3 border border-line/60 flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center shrink-0">
                                <i class="fa-solid fa-calendar-check text-sm"></i>
                            </div>
                            <div>
                                <span class="text-mute text-[11px] font-medium block">Masa Tugas</span>
                                <b class="text-sm font-bold text-ink">{{ $profile['stats']['days_active'] }} Hari</b>
                            </div>
                        </div>

                        <div class="bg-bg/60 rounded-xl p-3 border border-line/60 flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-warnbg text-warn grid place-items-center shrink-0">
                                <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                            </div>
                            <div>
                                <span class="text-mute text-[11px] font-medium block">Alert Ditangani</span>
                                <b class="text-sm font-bold text-ink">{{ $profile['stats']['alerts_handled'] }} Peringatan</b>
                            </div>
                        </div>

                        <div class="bg-bg/60 rounded-xl p-3 border border-line/60 flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center shrink-0">
                                <i class="fa-solid fa-microchip text-sm"></i>
                            </div>
                            <div>
                                <span class="text-mute text-[11px] font-medium block">Node Diawasi</span>
                                <b class="text-sm font-bold text-ink">{{ $profile['stats']['nodes_supervised'] }} Perangkat</b>
                            </div>
                        </div>

                        <div class="bg-bg/60 rounded-xl p-3 border border-line/60 flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-okbg text-ok grid place-items-center shrink-0">
                                <i class="fa-solid fa-signal text-sm"></i>
                            </div>
                            <div>
                                <span class="text-mute text-[11px] font-medium block">Rasio Uptime Stasiun</span>
                                <b class="text-sm font-bold text-ok">{{ $profile['stats']['uptime_rate'] }}</b>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ---------- TAB NAVIGATION PILLS ---------- -->
            <section class="bg-card rounded-[20px] p-2 shadow-soft border border-line/60">
                <nav class="flex items-center gap-1.5 sm:gap-2 overflow-x-auto no-scrollbar" aria-label="Tabs Profil Pengguna">
                    <button onclick="switchProfileTab('info')" id="ptab-btn-info" class="ptab-pill active flex items-center gap-2 px-3.5 sm:px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all shrink-0 bg-dark text-white shadow-sm">
                        <i class="fa-solid fa-id-card text-xs"></i>
                        <span>Informasi Pribadi</span>
                    </button>
                    <button onclick="switchProfileTab('stations')" id="ptab-btn-stations" class="ptab-pill flex items-center gap-2 px-3.5 sm:px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-mute hover:bg-tint hover:text-ink transition-all shrink-0">
                        <i class="fa-solid fa-tower-broadcast text-xs"></i>
                        <span>Penugasan Node & Wilayah</span>
                    </button>
                    <button onclick="switchProfileTab('security')" id="ptab-btn-security" class="ptab-pill flex items-center gap-2 px-3.5 sm:px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-mute hover:bg-tint hover:text-ink transition-all shrink-0">
                        <i class="fa-solid fa-shield-halved text-xs"></i>
                        <span>Keamanan & Sesi</span>
                    </button>
                    <button onclick="switchProfileTab('activity')" id="ptab-btn-activity" class="ptab-pill flex items-center gap-2 px-3.5 sm:px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-mute hover:bg-tint hover:text-ink transition-all shrink-0">
                        <i class="fa-solid fa-clock-rotate-left text-xs"></i>
                        <span>Riwayat Log Aktivitas</span>
                    </button>
                </nav>
            </section>

            <!-- Save Toast Banner -->
            <div id="profile-save-toast" class="hidden items-center justify-between gap-3 px-4 py-3 rounded-2xl bg-okbg border border-ok/30 text-ok transition-all shadow-soft animate-fade-in">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-check text-base"></i>
                    <span class="text-xs sm:text-sm font-semibold">Data profil dan preferensi notifikasi berhasil diperbarui!</span>
                </div>
                <button onclick="document.getElementById('profile-save-toast').classList.add('hidden')" class="text-ok hover:opacity-75">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- ================= TAB 1: INFORMASI PRIBADI ================= -->
            <div id="ptab-content-info" class="ptab-panel flex flex-col gap-4">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    
                    <!-- Form Biodata Utama (2 Kolom) -->
                    <div class="lg:col-span-2 squircle-card p-5 border border-line/60 flex flex-col justify-between gap-4">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                                        <i class="fa-solid fa-user-pen text-sm"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-base font-bold text-ink">Biodata Pengelola Lapangan</h3>
                                        <span class="text-mute text-xs">Informasi kontak darurat dan identitas resmi</span>
                                    </div>
                                </div>
                                <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-tint text-sea">NIP: {{ $profile['user']['nip'] }}</span>
                            </div>

                            <form id="profile-form" action="{{ route('profile.update') }}" method="POST" onsubmit="event.preventDefault(); saveProfileChanges();" class="space-y-3.5">
                                @csrf
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-semibold text-mute mb-1">Nama Lengkap & Gelar</label>
                                        <input type="text" name="name" value="{{ $profile['user']['name'] }}" class="w-full bg-card rounded-xl px-3 py-2 text-xs font-semibold text-ink border border-line focus:outline-none focus:ring-2 ring-sea">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-mute mb-1">Jabatan Operasional</label>
                                        <input type="text" value="{{ $profile['user']['title'] }}" readonly class="w-full bg-bg rounded-xl px-3 py-2 text-xs font-semibold text-mute border border-line">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-semibold text-mute mb-1">Email Resmi</label>
                                        <div class="flex items-center gap-2">
                                            <input type="email" name="email" value="{{ $profile['user']['email'] }}" class="w-full bg-card rounded-xl px-3 py-2 text-xs font-semibold text-ink border border-line focus:outline-none focus:ring-2 ring-sea">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-mute mb-1">Nomor WhatsApp Darurat</label>
                                        <input type="text" name="phone" value="{{ $profile['user']['phone'] }}" class="w-full bg-card rounded-xl px-3 py-2 text-xs font-semibold text-ink border border-line focus:outline-none focus:ring-2 ring-sea">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-mute mb-1">Instansi / Organisasi Penanggung Jawab</label>
                                    <input type="text" name="organization" value="{{ $profile['user']['organization'] }}" class="w-full bg-card rounded-xl px-3 py-2 text-xs font-semibold text-ink border border-line focus:outline-none focus:ring-2 ring-sea">
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-mute mb-1">Alamat Posko / Kantor Pengelola</label>
                                    <textarea name="address" rows="2" class="w-full bg-card rounded-xl p-2.5 text-xs font-semibold text-ink border border-line focus:outline-none focus:ring-2 ring-sea">{{ $profile['user']['address'] }}</textarea>
                                </div>

                                <div class="flex items-center justify-between pt-2">
                                    <span class="text-[11px] text-mute">Perubahan biodata akan dicatat dalam audit log sistem.</span>
                                    <button type="submit" class="px-4 py-2 rounded-[10px] bg-gradient-to-br from-sea to-deep text-white text-xs font-bold shadow-soft hover:opacity-95 active:scale-95 transition-all flex items-center gap-1.5">
                                        <i class="fa-solid fa-floppy-disk"></i>
                                        <span>Simpan Biodata</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Preferensi Notifikasi Pribadi (1 Kolom) -->
                    <div class="squircle-card p-5 border border-line/60 flex flex-col justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2.5 mb-3">
                                <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                                    <i class="fa-solid fa-bell text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-ink">Preferensi Notifikasi</h3>
                                    <span class="text-mute text-xs">Peringatan langsung ke perangkat pribadi</span>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="p-3 rounded-xl bg-bg/60 border border-line/60 flex items-center justify-between">
                                    <div>
                                        <b class="block text-xs font-semibold text-ink">WhatsApp Darurat</b>
                                        <span class="text-[11px] text-mute">Alert level Siaga & Bahaya</span>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" checked class="sr-only peer">
                                        <div class="w-10 h-5 bg-line peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-sea"></div>
                                    </label>
                                </div>

                                <div class="p-3 rounded-xl bg-bg/60 border border-line/60 flex items-center justify-between">
                                    <div>
                                        <b class="block text-xs font-semibold text-ink">Grup Telegram</b>
                                        <span class="text-[11px] text-mute">Saluran siaga relawan rescue</span>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" checked class="sr-only peer">
                                        <div class="w-10 h-5 bg-line peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-sea"></div>
                                    </label>
                                </div>

                                <div class="p-3 rounded-xl bg-bg/60 border border-line/60 flex items-center justify-between">
                                    <div>
                                        <b class="block text-xs font-semibold text-ink">Baterai Node Kritis</b>
                                        <span class="text-[11px] text-mute">Pemberitahuan daya &lt; 20%</span>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" checked class="sr-only peer">
                                        <div class="w-10 h-5 bg-line peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-sea"></div>
                                    </label>
                                </div>

                                <div class="p-3 rounded-xl bg-bg/60 border border-line/60 flex items-center justify-between">
                                    <div>
                                        <b class="block text-xs font-semibold text-ink">Ringkasan Harian Email</b>
                                        <span class="text-[11px] text-mute">Rekap 24 jam setiap jam 00.00</span>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer">
                                        <div class="w-10 h-5 bg-line peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-sea"></div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2 border-t border-line/60 flex items-center justify-between text-xs">
                            <span class="text-mute font-medium">Saluran Prioritas:</span>
                            <span class="font-bold text-sea">WhatsApp & Telegram</span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ================= TAB 2: PENUGASAN STASIUN ================= -->
            <div id="ptab-content-stations" class="ptab-panel hidden flex-col gap-4">
                
                <!-- Info Penugasan Stasiun -->
                <div class="squircle-card p-5 border border-line/60">
                    <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-tint text-sea grid place-items-center">
                                <i class="fa-solid fa-map-location-dot text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-ink">Cakupan Wilayah Pengawasan Sensor Pesisir</h3>
                                <p class="text-mute text-xs">Daftar stasiun IoT cuaca mikro yang berada dalam mandat operasional Anda</p>
                            </div>
                        </div>
                        <a href="https://maps.google.com/?q={{ $profile['user']['coordinates'] }}" target="_blank" class="px-3.5 py-2 rounded-[10px] bg-card border border-line text-xs font-bold text-sea hover:bg-tint transition-all flex items-center gap-1.5 shadow-xs">
                            <i class="fa-solid fa-location-arrow"></i>
                            <span>Buka Titik GPS (Pantai Ciantir)</span>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5">
                        @foreach($profile['assigned_zones'] as $zone)
                        <div class="bg-bg/60 rounded-2xl p-4 border border-line/60 flex flex-col justify-between gap-3">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-[11px] font-bold px-2 py-0.5 rounded-full {{ $zone['status_type'] === 'ok' ? 'bg-okbg text-ok' : 'bg-warnbg text-warn' }}">
                                        {{ $zone['status'] }}
                                    </span>
                                    <i class="fa-solid fa-tower-broadcast text-mute text-xs"></i>
                                </div>
                                <h4 class="font-bold text-sm text-ink mb-1">{{ $zone['name'] }}</h4>
                                <span class="text-xs font-semibold text-sea block mb-2">{{ $zone['type'] }}</span>
                                <p class="text-[11.5px] text-mute">Sensor aktif: {{ $zone['sensors'] }}</p>
                            </div>
                            <div class="pt-2 border-t border-line/60 flex items-center justify-between text-[11px]">
                                <span class="text-mute">Status Jaringan:</span>
                                <b class="text-ok">LoRa Terhubung</b>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Hak Akses Otoritas Super Admin -->
                <div class="squircle-card p-5 border border-line/60">
                    <h3 class="text-base font-bold text-ink mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-key text-sea"></i>
                        <span>Hak Akses & Batas Otoritas Peran (Role Authority)</span>
                    </h3>
                    <p class="text-mute text-xs mb-3">{{ $profile['user']['role_description'] }}</p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2.5">
                        <div class="p-3 rounded-xl bg-bg/60 border border-line/60 flex items-center gap-2.5">
                            <i class="fa-solid fa-circle-check text-ok text-sm"></i>
                            <span class="text-xs font-semibold text-ink">Ubah Ambang Batas Sensor</span>
                        </div>
                        <div class="p-3 rounded-xl bg-bg/60 border border-line/60 flex items-center gap-2.5">
                            <i class="fa-solid fa-circle-check text-ok text-sm"></i>
                            <span class="text-xs font-semibold text-ink">Otorisasi Sirine Evakuasi</span>
                        </div>
                        <div class="p-3 rounded-xl bg-bg/60 border border-line/60 flex items-center gap-2.5">
                            <i class="fa-solid fa-circle-check text-ok text-sm"></i>
                            <span class="text-xs font-semibold text-ink">Regenerasi Device API Key</span>
                        </div>
                        <div class="p-3 rounded-xl bg-bg/60 border border-line/60 flex items-center gap-2.5">
                            <i class="fa-solid fa-circle-check text-ok text-sm"></i>
                            <span class="text-xs font-semibold text-ink">Ekspor Data Riset Cuaca</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ================= TAB 3: KEAMANAN & SESI ================= -->
            <div id="ptab-content-security" class="ptab-panel hidden flex-col gap-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    
                    <!-- Ubah Kata Sandi -->
                    <div class="squircle-card p-5 border border-line/60 flex flex-col justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2.5 mb-3">
                                <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                                    <i class="fa-solid fa-lock text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-ink">Perbarui Kata Sandi</h3>
                                    <span class="text-mute text-xs">Pastikan memakai kombinasi karakter yang kuat</span>
                                </div>
                            </div>

                            <form onsubmit="event.preventDefault(); alert('Permintaan pembaruan kata sandi berhasil diajukan.');" class="space-y-3">
                                <div>
                                    <label class="block text-xs font-semibold text-mute mb-1">Kata Sandi Saat Ini</label>
                                    <input type="password" placeholder="••••••••" class="w-full bg-card rounded-xl px-3 py-2 text-xs font-semibold text-ink border border-line focus:outline-none focus:ring-2 ring-sea">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-mute mb-1">Kata Sandi Baru (Minimal 8 karakter)</label>
                                    <input type="password" placeholder="••••••••" class="w-full bg-card rounded-xl px-3 py-2 text-xs font-semibold text-ink border border-line focus:outline-none focus:ring-2 ring-sea">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-mute mb-1">Konfirmasi Kata Sandi Baru</label>
                                    <input type="password" placeholder="••••••••" class="w-full bg-card rounded-xl px-3 py-2 text-xs font-semibold text-ink border border-line focus:outline-none focus:ring-2 ring-sea">
                                </div>
                                <button type="submit" class="w-full py-2.5 rounded-[10px] bg-dark text-white text-xs font-bold hover:bg-ink transition-all">
                                    Simpan Kata Sandi Baru
                                </button>
                            </form>
                        </div>

                        <!-- 2FA Box -->
                        <div class="p-3.5 rounded-xl bg-bg/70 border border-line/60 flex items-center justify-between">
                            <div>
                                <b class="block text-xs text-ink font-bold">Autentikasi Dua Faktor (2FA)</b>
                                <span class="text-[11px] text-mute">Verifikasi kode OTP via Google Authenticator</span>
                            </div>
                            <span class="text-ok text-xs font-bold px-2.5 py-1 rounded-full bg-okbg">Aktif</span>
                        </div>
                    </div>

                    <!-- Riwayat Sesi Perangkat -->
                    <div class="squircle-card p-5 border border-line/60 flex flex-col justify-between gap-4">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                                        <i class="fa-solid fa-laptop-code text-sm"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-base font-bold text-ink">Perangkat & Sesi Login Aktif</h3>
                                        <span class="text-mute text-xs">Daftar browser yang memiliki akses login</span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3">
                                @foreach($profile['sessions'] as $session)
                                <div class="p-3 rounded-xl bg-bg/60 border border-line/60 flex items-start justify-between gap-3">
                                    <div class="flex items-start gap-2.5">
                                        <div class="mt-0.5 text-sea">
                                            @if(str_contains($session['device'], 'Smartphone'))
                                                <i class="fa-solid fa-mobile-screen-button text-base"></i>
                                            @elseif(str_contains($session['device'], 'Laptop'))
                                                <i class="fa-solid fa-laptop text-base"></i>
                                            @else
                                                <i class="fa-solid fa-desktop text-base"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <b class="text-xs font-semibold text-ink">{{ $session['device'] }}</b>
                                                @if($session['is_current'])
                                                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-full bg-okbg text-ok">Sesi Ini</span>
                                                @endif
                                            </div>
                                            <span class="text-[11px] text-mute block mt-0.5">{{ $session['ip'] }} · {{ $session['location'] }}</span>
                                            <span class="text-[10.5px] text-mute/80">{{ $session['time'] }}</span>
                                        </div>
                                    </div>
                                    @if(!$session['is_current'])
                                    <button type="button" onclick="alert('Sesi pada perangkat ini telah dinonaktifkan.')" class="text-xs text-bad hover:underline font-semibold shrink-0">
                                        Putuskan
                                    </button>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="button" onclick="alert('Semua sesi pada perangkat lain berhasil dikeluarkan.')" class="w-full py-2 px-3 rounded-[10px] bg-card border border-line text-xs font-bold text-bad hover:bg-badbg transition-all">
                            <i class="fa-solid fa-right-from-bracket mr-1.5"></i>Keluar dari Seluruh Sesi Lain
                        </button>
                    </div>

                </div>
            </div>

            <!-- ================= TAB 4: AUDIT LOG AKTIVITAS ================= -->
            <div id="ptab-content-activity" class="ptab-panel hidden flex-col gap-4">
                <div class="squircle-card p-5 border border-line/60">
                    <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center">
                                <i class="fa-solid fa-timeline text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-ink">Jejak Audit Aktivitas Pengguna (Audit Trail)</h3>
                                <p class="text-mute text-xs">Pencatatan riwayat setiap aksi krusial demi akuntabilitas operasional sistem cuaca</p>
                            </div>
                        </div>
                        <button type="button" onclick="alert('Mengunduh seluruh berkas audit log dalam format CSV...');" class="px-3.5 py-2 rounded-[10px] bg-card border border-line text-xs font-semibold text-mute hover:text-ink transition-all flex items-center gap-1.5">
                            <i class="fa-solid fa-download"></i>
                            <span>Ekspor Audit Log</span>
                        </button>
                    </div>

                    <div class="space-y-3">
                        @foreach($profile['recent_activities'] as $act)
                        <div class="p-3.5 rounded-xl bg-bg/60 border border-line/60 flex items-start gap-3.5 transition-all hover:bg-bg">
                            <div class="w-9 h-9 rounded-full bg-tint text-sea grid place-items-center shrink-0 mt-0.5">
                                <i class="fa-solid {{ $act['icon'] }} text-xs"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2 flex-wrap">
                                    <b class="text-xs font-bold text-ink">{{ $act['action'] }}</b>
                                    <span class="text-[11px] font-medium text-mute">{{ $act['time'] }}</span>
                                </div>
                                <p class="text-xs text-mute mt-0.5">{{ $act['detail'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </main>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Tab Switching Functionality for Profile
    function switchProfileTab(tabId) {
        // Sembunyikan seluruh tab panel
        document.querySelectorAll('.ptab-panel').forEach(panel => {
            panel.classList.add('hidden');
            panel.classList.remove('flex');
        });

        // Hapus kelas aktif di tab button
        document.querySelectorAll('.ptab-pill').forEach(btn => {
            btn.classList.remove('active', 'bg-dark', 'text-white', 'shadow-sm');
            btn.classList.add('text-mute');
        });

        // Tampilkan panel terpilih
        const targetPanel = document.getElementById('ptab-content-' + tabId);
        const targetBtn = document.getElementById('ptab-btn-' + tabId);

        if (targetPanel) {
            targetPanel.classList.remove('hidden');
            targetPanel.classList.add('flex');
        }

        if (targetBtn) {
            targetBtn.classList.add('active', 'bg-dark', 'text-white', 'shadow-sm');
            targetBtn.classList.remove('text-mute');
        }
    }

    // Save Profile Changes with Toast Animation
    function saveProfileChanges() {
        const toast = document.getElementById('profile-save-toast');
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

