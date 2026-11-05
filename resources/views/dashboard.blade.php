@extends('layouts.app')

@section('title', 'Beranda Cuaca - Pos Pantau Pantai Sawarna')

@section('content')
<div class="bg-bg text-ink min-h-[calc(100vh-2.5rem)] flex flex-col justify-between" id="dashboard-root">

    <div class="grid grid-cols-1 lg:grid-cols-[260px_minmax(0,1fr)] gap-4 lg:gap-6 items-start">

        <!-- ================= SIDEBAR NAVIGASI RAMAH OPERATOR ================= -->
        <aside class="bg-card rounded-[24px] p-3 sm:p-4 shadow-soft border border-line flex flex-col gap-2 sticky top-3 z-30">
            <!-- Logo & Posko Identitas -->
            <div class="flex items-center gap-3 px-2 py-2 mb-2 border-b border-line/60">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-sea to-deep text-white grid place-items-center font-extrabold text-sm shadow-soft shrink-0">
                    SW
                </div>
                <div class="min-w-0">
                    <h2 class="font-extrabold text-sm text-ink truncate leading-tight">Posko Sawarna</h2>
                    <span class="text-[11px] text-mute font-medium truncate block">Pantai Ciantir · POKDARWIS</span>
                </div>
            </div>

            <!-- Menu Navigasi dengan Ikon + Teks Jelas -->
            <nav class="flex lg:flex-col gap-1.5 overflow-x-auto lg:overflow-visible pb-1 lg:pb-0" aria-label="Menu Utama">
                <!-- 1. Beranda (Active) -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-bold text-xs sm:text-sm bg-dark text-white shadow-sm shrink-0 transition-all">
                    <i class="fa-solid fa-house text-base w-5 text-center"></i>
                    <span>Beranda Cuaca</span>
                </a>

                <!-- 2. Alat Sensor -->
                <a href="{{ route('devices.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-xs sm:text-sm text-mute hover:bg-tint hover:text-ink shrink-0 transition-all">
                    <i class="fa-solid fa-tower-broadcast text-base w-5 text-center text-sea"></i>
                    <span>Kondisi Sensor</span>
                </a>

                <!-- 3. Grafik & Riwayat -->
                <a href="{{ route('analytics.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-xs sm:text-sm text-mute hover:bg-tint hover:text-ink shrink-0 transition-all">
                    <i class="fa-solid fa-chart-line text-base w-5 text-center text-sea"></i>
                    <span>Grafik & Riwayat</span>
                </a>

                <!-- 3. Pengaturan -->
                <a href="{{ route('settings.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-xs sm:text-sm text-mute hover:bg-tint hover:text-ink shrink-0 transition-all">
                    <i class="fa-solid fa-sliders text-base w-5 text-center text-sea"></i>
                    <span>Atur Batas Peringatan</span>
                </a>

                <!-- 4. Profil Petugas -->
                <a href="{{ route('profile.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-xs sm:text-sm text-mute hover:bg-tint hover:text-ink shrink-0 transition-all">
                    <i class="fa-solid fa-user-shield text-base w-5 text-center text-sea"></i>
                    <span>Profil Petugas</span>
                </a>
            </nav>

            <!-- Card Bantuan Petugas Lapangan -->
            <div class="hidden lg:block mt-6 p-3.5 rounded-2xl bg-tint/70 border border-line/60">
                <div class="flex items-center gap-2 text-sea font-bold text-xs mb-1">
                    <i class="fa-solid fa-phone-volume"></i>
                    <span>Kontak Darurat</span>
                </div>
                <p class="text-[11px] text-mute mb-2">Butuh bantuan darurat atau perbaikan sensor di pantai?</p>
                <a href="tel:+6281298765432" class="block w-full text-center py-2 px-3 rounded-lg bg-sea text-white text-xs font-bold hover:bg-deep transition-all">
                    Hubungi Koordinator
                </a>
            </div>

            <!-- Petugas Sedang Piket -->
            <div class="hidden lg:flex items-center gap-2.5 pt-3 mt-auto border-t border-line/60 px-1">
                <div class="w-8 h-8 rounded-full bg-tint text-sea grid place-items-center font-bold text-xs shrink-0">
                    AF
                </div>
                <div class="min-w-0">
                    <span class="text-[11px] text-mute block leading-none">Petugas Jaga:</span>
                    <b class="text-xs text-ink truncate block mt-0.5">Ahmad Fauzi</b>
                </div>
                <span class="w-2.5 h-2.5 rounded-full bg-ok ml-auto" title="Online"></span>
            </div>
        </aside>

        <!-- ================= KONTEN UTAMA OPERATOR ================= -->
        <main class="flex flex-col gap-4 min-w-0">

            <!-- ---------- HEADER BAR SEDERHANA ---------- -->
            <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-card rounded-[20px] p-4 border border-line shadow-soft">
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h1 class="text-xl sm:text-2xl font-extrabold text-ink">Pos Pantau Cuaca Pantai Sawarna</h1>
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-0.5 rounded-full bg-okbg text-ok">
                            <i class="fa-solid fa-circle text-[6px]"></i> Sensor Terhubung
                        </span>
                    </div>
                    <p class="text-mute text-xs sm:text-sm mt-0.5">Pantau keselamatan wisatawan, nelayan pesisir, dan kondisi ombak secara langsung</p>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <span class="text-xs text-mute font-medium bg-bg px-3 py-1.5 rounded-xl border border-line">
                        <i class="fa-regular fa-clock mr-1 text-sea"></i>
                        Diperbarui: <strong>10.00 WIB</strong>
                    </span>
                    <button type="button" onclick="location.reload()" title="Muat Ulang Data" class="p-2 w-9 h-9 rounded-xl bg-card border border-line text-mute hover:text-ink hover:bg-tint transition-all grid place-items-center">
                        <i class="fa-solid fa-rotate-right text-xs"></i>
                    </button>
                </div>
            </header>

            <!-- ---------- BLOK 1: BANNER STATUS KESELAMATAN PANTAI UTAMA ---------- -->
            @if($meta['warning']['active'])
            <section class="bg-warnbg border-2 border-warn/40 rounded-[20px] p-4 sm:p-5 shadow-soft flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-start gap-3.5">
                    <div class="w-12 h-12 rounded-2xl bg-warn text-white grid place-items-center text-xl shrink-0 shadow-sm mt-0.5">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-xs font-black tracking-wider uppercase px-2 py-0.5 rounded-md bg-warn text-white">PERINGATAN OPERATOR</span>
                            <h2 class="text-lg sm:text-xl font-extrabold text-ink">STATUS KAWASAN: WASPADA ANGIN KENCANG</h2>
                        </div>
                        <p class="text-ink/80 text-xs sm:text-sm mt-1 font-medium">
                            Kecepatan angin saat ini <strong>{{ $metrics['angin']['value'] }} km/jam</strong> (Ambang batas aman: <strong>30 km/jam</strong>).
                            <span class="block text-warn font-bold mt-0.5">&rarr; Instruksi: Imbau pengunjung menjauhi tebing karang Tanjung Layar dan pasang bendera kuning di bibir pantai.</span>
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2.5 shrink-0 flex-wrap">
                    <button type="button" onclick="alert('Pesan peringatan telah dikirimkan ke grup WhatsApp Pokdarwis & Relawan Pantai.')" class="px-4 py-2.5 rounded-xl bg-ok text-white text-xs sm:text-sm font-bold shadow-soft hover:opacity-90 active:scale-95 transition-all flex items-center gap-2">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>Kirim Peringatan WA</span>
                    </button>
                    <button type="button" onclick="alert('Status alert diakui oleh operator.')" class="px-3.5 py-2.5 rounded-xl bg-card border border-line text-ink text-xs sm:text-sm font-bold hover:bg-tint transition-all">
                        Konfirmasi Paham
                    </button>
                </div>
            </section>
            @else
            <section class="bg-okbg border-2 border-ok/40 rounded-[20px] p-4 sm:p-5 shadow-soft flex items-center justify-between gap-4">
                <div class="flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-ok text-white grid place-items-center text-xl shrink-0">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>
                    <div>
                        <h2 class="text-base sm:text-lg font-extrabold text-ink">STATUS KAWASAN: PANTAI AMAN & KONDUSIF</h2>
                        <p class="text-mute text-xs sm:text-sm mt-0.5">Semua parameter cuaca berada dalam batas normal. Aktivitas wisata dan nelayan dapat berjalan seperti biasa.</p>
                    </div>
                </div>
                <span class="text-xs font-bold px-3 py-1 rounded-full bg-white text-ok shadow-xs shrink-0">Bendera Hijau</span>
            </section>
            @endif

            <!-- ---------- BLOK 2: 4 KARTU METRIK UTAMA CUACA RAMAH OPERATOR ---------- -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5">
                
                <!-- 1. ANGIN (Hero Focus) -->
                <div class="bg-card rounded-[20px] p-4 sm:p-5 border-2 border-warn/30 shadow-soft flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <div class="w-9 h-9 rounded-xl bg-warnbg text-warn grid place-items-center font-bold">
                                <i class="fa-solid fa-wind text-base"></i>
                            </div>
                            <span class="text-xs font-extrabold tracking-wider uppercase text-mute">Kecepatan Angin</span>
                        </div>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-warnbg text-warn">Waspada</span>
                    </div>

                    <div class="my-2">
                        <div class="text-3xl sm:text-4xl font-black tracking-tight text-ink">
                            {{ $metrics['angin']['value'] }} <span class="text-sm font-semibold text-mute">km/jam</span>
                        </div>
                        <p class="text-xs font-semibold text-warn mt-1">
                            <i class="fa-solid fa-triangle-exclamation mr-1"></i>Melewati batas aman 30 km/jam
                        </p>
                    </div>

                    <div class="pt-3 border-t border-line/60 flex items-center justify-between text-xs text-mute">
                        <span>Arah: <strong>{{ $wind['cardinal'] }} ({{ $wind['degrees'] }}°)</strong></span>
                        <span>Embusan: <strong>{{ $wind['gust'] }} km/j</strong></span>
                    </div>
                </div>

                <!-- 2. HUJAN -->
                <div class="bg-card rounded-[20px] p-4 sm:p-5 border border-line shadow-soft flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <div class="w-9 h-9 rounded-xl bg-tint text-sea grid place-items-center font-bold">
                                <i class="fa-solid fa-droplet text-base"></i>
                            </div>
                            <span class="text-xs font-extrabold tracking-wider uppercase text-mute">Curah Hujan</span>
                        </div>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-okbg text-ok">Aman</span>
                    </div>

                    <div class="my-2">
                        <div class="text-3xl sm:text-4xl font-black tracking-tight text-ink">
                            {{ $metrics['hujan']['value'] }} <span class="text-sm font-semibold text-mute">mm/jam</span>
                        </div>
                        <p class="text-xs font-semibold text-ok mt-1">
                            <i class="fa-solid fa-circle-check mr-1"></i>Gerimis ringan (Batas: 10 mm/j)
                        </p>
                    </div>

                    <div class="pt-3 border-t border-line/60 flex items-center justify-between text-xs text-mute">
                        <span>Kondisi Tanah: <strong>Kering Stabil</strong></span>
                        <span>Potensi Banjir: <strong>Nol</strong></span>
                    </div>
                </div>

                <!-- 3. SUHU UDARA -->
                <div class="bg-card rounded-[20px] p-4 sm:p-5 border border-line shadow-soft flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <div class="w-9 h-9 rounded-xl bg-tint text-sea grid place-items-center font-bold">
                                <i class="fa-solid fa-temperature-half text-base"></i>
                            </div>
                            <span class="text-xs font-extrabold tracking-wider uppercase text-mute">Suhu Udara</span>
                        </div>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-okbg text-ok">Normal</span>
                    </div>

                    <div class="my-2">
                        <div class="text-3xl sm:text-4xl font-black tracking-tight text-ink">
                            {{ $metrics['suhu']['value'] }} <span class="text-sm font-semibold text-mute">°C</span>
                        </div>
                        <p class="text-xs font-semibold text-mute mt-1">
                            Kelembapan udara: <strong>{{ $metrics['kelembapan']['value'] }}%</strong>
                        </p>
                    </div>

                    <div class="pt-3 border-t border-line/60 flex items-center justify-between text-xs text-mute">
                        <span>Udara: <strong>Hangat Pesisir</strong></span>
                        <span>Maks Hari Ini: <strong>30,8 °C</strong></span>
                    </div>
                </div>

                <!-- 4. KONDISI LAUT & TEKANAN -->
                <div class="bg-card rounded-[20px] p-4 sm:p-5 border border-line shadow-soft flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <div class="w-9 h-9 rounded-xl bg-tint text-sea grid place-items-center font-bold">
                                <i class="fa-solid fa-gauge-high text-base"></i>
                            </div>
                            <span class="text-xs font-extrabold tracking-wider uppercase text-mute">Tekanan Udara</span>
                        </div>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-okbg text-ok">Stabil</span>
                    </div>

                    <div class="my-2">
                        <div class="text-3xl sm:text-4xl font-black tracking-tight text-ink">
                            {{ $metrics['tekanan']['value'] }} <span class="text-sm font-semibold text-mute">hPa</span>
                        </div>
                        <p class="text-xs font-semibold text-ok mt-1">
                            <i class="fa-solid fa-water mr-1"></i>Ombak teratur, tidak ada badai
                        </p>
                    </div>

                    <div class="pt-3 border-t border-line/60 flex items-center justify-between text-xs text-mute">
                        <span>Depresi Badai: <strong>Aman (&gt; 1000)</strong></span>
                        <span>Status Gelombang: <strong>Sedang</strong></span>
                    </div>
                </div>

            </section>

            <!-- ---------- BLOK 3: KONDISI ALAT SENSOR & GATEWAY (BEBAS JARGON) ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-3.5">
                
                <!-- KARTU ALAT 1: SENSOR PANTAI -->
                <div class="bg-card rounded-[20px] p-4 sm:p-5 border border-line shadow-soft">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-okbg text-ok grid place-items-center text-lg">
                                <i class="fa-solid fa-solar-panel"></i>
                            </div>
                            <div>
                                <h3 class="font-extrabold text-sm text-ink">Sensor Cuaca di Bibir Pantai</h3>
                                <span class="text-xs text-mute">Tiang Sensor Utama · Pantai Ciantir</span>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-1 rounded-full bg-okbg text-ok">
                            <i class="fa-solid fa-circle text-[6px]"></i> Menyala Normal
                        </span>
                    </div>

                    <div class="space-y-2.5 text-xs">
                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-bg border border-line/60">
                            <span class="text-mute font-medium">Baterai Alat:</span>
                            <span class="font-bold text-ink flex items-center gap-1.5">
                                <i class="fa-solid fa-battery-three-quarters text-ok text-sm"></i>
                                78% (Panel Surya Mengisi Baik)
                            </span>
                        </div>
                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-bg border border-line/60">
                            <span class="text-mute font-medium">Kekuatan Sinyal ke Kantor:</span>
                            <span class="font-bold text-ok flex items-center gap-1">
                                <i class="fa-solid fa-signal"></i> Sangat Kuat (Jarak 1,4 km)
                            </span>
                        </div>
                    </div>
                </div>

                <!-- KARTU ALAT 2: GATEWAY KANTOR -->
                <div class="bg-card rounded-[20px] p-4 sm:p-5 border border-line shadow-soft">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-tint text-sea grid place-items-center text-lg">
                                <i class="fa-solid fa-building-user"></i>
                            </div>
                            <div>
                                <h3 class="font-extrabold text-sm text-ink">Komputer Posko Kantor Desa</h3>
                                <span class="text-xs text-mute">Penerima Data Radio LoRa & Internet 4G</span>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-1 rounded-full bg-okbg text-ok">
                            <i class="fa-solid fa-circle text-[6px]"></i> Terhubung
                        </span>
                    </div>

                    <div class="space-y-2.5 text-xs">
                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-bg border border-line/60">
                            <span class="text-mute font-medium">Koneksi Internet Lapangan:</span>
                            <span class="font-bold text-ok flex items-center gap-1.5">
                                <i class="fa-solid fa-wifi text-sm"></i> 4G Telkomsel Aktif & Cepat
                            </span>
                        </div>
                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-bg border border-line/60">
                            <span class="text-mute font-medium">Penyimpanan & Sinkronisasi:</span>
                            <span class="font-bold text-ink">Semua Data Aman Tersimpan</span>
                        </div>
                    </div>
                </div>

            </section>

            <!-- ---------- BLOK 4: CATATAN PERINGATAN TERAKHIR ---------- -->
            <section class="bg-card rounded-[20px] p-4 sm:p-5 border border-line shadow-soft">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-extrabold text-sm text-ink flex items-center gap-2">
                        <i class="fa-solid fa-clock-rotate-left text-sea"></i>
                        <span>Catatan Riwayat Cuaca Terkini</span>
                    </h3>
                    <span class="text-xs text-mute font-medium">Catatan Otomatis Posko</span>
                </div>

                <div class="space-y-2">
                    @foreach($alerts as $alert)
                    <div class="flex items-center justify-between p-3 rounded-xl bg-bg border border-line/60 gap-3">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-8 h-8 rounded-lg {{ $alert['type'] === 'warn' ? 'bg-warnbg text-warn' : 'bg-okbg text-ok' }} grid place-items-center text-xs shrink-0 font-bold">
                                <i class="fa-solid {{ $alert['type'] === 'warn' ? 'fa-triangle-exclamation' : 'fa-check' }}"></i>
                            </div>
                            <div class="min-w-0">
                                <b class="text-xs sm:text-sm text-ink block truncate">{{ $alert['title'] }}</b>
                                <span class="text-[11px] text-mute">{{ $alert['desc'] }}</span>
                            </div>
                        </div>
                        <span class="text-[11px] font-bold px-2.5 py-1 rounded-full {{ $alert['type'] === 'warn' ? 'bg-warnbg text-warn' : 'bg-okbg text-ok' }} shrink-0">
                            {{ $alert['status'] }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </section>

        </main>
    </div>

</div>
@endsection
