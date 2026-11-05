<!-- ================= SIDEBAR CAPSULE (PRESERVED DESIGN) ================= -->
<aside class="flex lg:flex-col items-center justify-between lg:justify-start gap-2.5 sm:gap-3 bg-card rounded-[32px] sm:rounded-[36px] p-2 sm:p-2.5 shadow-soft border border-line/60 overflow-x-auto lg:overflow-visible sticky top-3 z-30 shrink-0">
    <!-- 1. Grid / Dashboard -->
    <a href="{{ route('dashboard') }}" aria-label="Dashboard Beranda" title="Kembali ke Dashboard Beranda" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full {{ request()->routeIs('dashboard*') ? 'bg-dark text-white shadow-md hover:scale-105 active:scale-95' : 'text-mute hover:bg-tint hover:text-sea' }} grid place-items-center transition-all">
        <i class="fa-solid fa-table-cells-large text-base sm:text-lg"></i>
    </a>

    <!-- 2. Perangkat Sensor -->
    <a href="{{ route('devices.index') }}" aria-label="Perangkat IoT" title="Perangkat & Sensor Lapangan" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full {{ request()->routeIs('devices.*') ? 'bg-dark text-white shadow-md hover:scale-105 active:scale-95' : 'text-mute hover:bg-tint hover:text-sea' }} grid place-items-center transition-all">
        <i class="fa-solid fa-microchip text-base sm:text-lg"></i>
    </a>

    <!-- 3. Grafik Tren -->
    <a href="{{ route('analytics.index') }}" aria-label="Analisis Tren" title="Grafik Tren & Riwayat Cuaca" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full {{ request()->routeIs('analytics.*') ? 'bg-dark text-white shadow-md hover:scale-105 active:scale-95' : 'text-mute hover:bg-tint hover:text-sea' }} grid place-items-center transition-all">
        <i class="fa-solid fa-chart-line text-base sm:text-lg"></i>
    </a>

    <!-- 4. Stasiun Pesisir -->
    <a href="{{ route('devices.index') }}" aria-label="Stasiun Pesisir" title="Peta Titik Sensor Sawarna" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
        <i class="fa-solid fa-tower-broadcast text-base sm:text-lg"></i>
    </a>

    <!-- 5. Profil Petugas -->
    <a href="{{ route('profile.index') }}" aria-label="Profil Petugas" title="Detail Profil Pengelola & Akses" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full {{ request()->routeIs('profile.*') ? 'bg-dark text-white shadow-md hover:scale-105 active:scale-95' : 'text-mute hover:bg-tint hover:text-sea' }} grid place-items-center transition-all">
        <i class="fa-solid fa-user-shield text-sm sm:text-base"></i>
    </a>

    <!-- 6. Log & Peringatan / Calendar -->
    <a href="{{ route('analytics.index') }}" aria-label="Log & Peringatan" title="Log Peringatan Dini" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-sea grid place-items-center transition-all">
        <i class="fa-regular fa-calendar-check text-base sm:text-lg"></i>
    </a>

    <!-- Flexible Spacer on Desktop -->
    <div class="hidden lg:block flex-1 min-h-[40px]"></div>

    <!-- 7. Pengaturan -->
    <a href="{{ route('settings.index') }}" aria-label="Pengaturan" title="Pengaturan Ambang Batas Sensor" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full {{ request()->routeIs('settings.*') ? 'bg-dark text-white shadow-md hover:scale-105 active:scale-95' : 'text-mute hover:bg-tint hover:text-sea' }} grid place-items-center transition-all">
        <i class="fa-solid fa-gear text-base sm:text-lg"></i>
    </a>

    <!-- 8. Keluar -->
    <a href="{{ route('dashboard') }}" aria-label="Keluar" title="Keluar Sesi" class="nav-btn w-10 h-10 sm:w-11 sm:h-11 rounded-full text-mute hover:bg-tint hover:text-bad grid place-items-center transition-all">
        <i class="fa-solid fa-arrow-right-from-bracket text-base sm:text-lg"></i>
    </a>

    <!-- 9. Avatar Badge -->
    <a href="{{ route('profile.index') }}" title="Profil Administrator Sawarna" class="w-10 h-10 sm:w-11 sm:h-11 rounded-full overflow-hidden bg-dark border-2 border-white/70 shadow-sm grid place-items-center text-white font-bold text-xs cursor-pointer hover:ring-2 ring-sea transition-all">
        <span>SW</span>
    </a>
</aside>

