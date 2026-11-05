@extends('layouts.app')

@section('title', 'Kondisi Alat Sensor - Pos Pantau Pantai Sawarna')

@section('content')
<div class="bg-bg text-ink min-h-[calc(100vh-2.5rem)] flex flex-col justify-between" id="devices-root">

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
                <!-- 1. Beranda -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-xs sm:text-sm text-mute hover:bg-tint hover:text-ink shrink-0 transition-all">
                    <i class="fa-solid fa-house text-base w-5 text-center text-sea"></i>
                    <span>Beranda Cuaca</span>
                </a>

                <!-- 2. Alat Sensor (Active) -->
                <a href="{{ route('devices.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-bold text-xs sm:text-sm bg-dark text-white shadow-sm shrink-0 transition-all">
                    <i class="fa-solid fa-tower-broadcast text-base w-5 text-center"></i>
                    <span>Kondisi Sensor</span>
                </a>

                <!-- 3. Grafik & Riwayat -->
                <a href="{{ route('analytics.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-xs sm:text-sm text-mute hover:bg-tint hover:text-ink shrink-0 transition-all">
                    <i class="fa-solid fa-chart-line text-base w-5 text-center text-sea"></i>
                    <span>Grafik & Riwayat</span>
                </a>

                <!-- 4. Pengaturan -->
                <a href="{{ route('settings.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-xs sm:text-sm text-mute hover:bg-tint hover:text-ink shrink-0 transition-all">
                    <i class="fa-solid fa-sliders text-base w-5 text-center text-sea"></i>
                    <span>Atur Batas Peringatan</span>
                </a>

                <!-- 5. Profil Petugas -->
                <a href="{{ route('profile.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-xs sm:text-sm text-mute hover:bg-tint hover:text-ink shrink-0 transition-all">
                    <i class="fa-solid fa-user-shield text-base w-5 text-center text-sea"></i>
                    <span>Profil Petugas</span>
                </a>
            </nav>

            <!-- Card Bantuan Petugas Lapangan -->
            <div class="hidden lg:block mt-6 p-3.5 rounded-2xl bg-tint/70 border border-line/60">
                <div class="flex items-center gap-2 text-sea font-bold text-xs mb-1">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                    <span>Bantuan Alat</span>
                </div>
                <p class="text-[11px] text-mute mb-2">Jika sensor pantai tidak mengirim data &gt; 10 menit, hubungi teknisi.</p>
                <a href="tel:+6281298765432" class="block w-full text-center py-2 px-3 rounded-lg bg-sea text-white text-xs font-bold hover:bg-deep transition-all">
                    Lapor Alat Rusak
                </a>
            </div>

<<<<<<< Updated upstream
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
            <a href="{{ route('profile.index') }}" title="Profil Administrator Sawarna" class="w-10 h-10 sm:w-11 sm:h-11 rounded-full overflow-hidden bg-gradient-to-br from-sea to-deep border-2 border-white/70 shadow-sm grid place-items-center text-white font-bold text-xs cursor-pointer hover:ring-2 ring-sea transition-all">
                <span>SW</span>
            </a>
=======
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
>>>>>>> Stashed changes
        </aside>

        <!-- ================= KONTEN UTAMA MANAJEMEN ALAT ================= -->
        <main class="flex flex-col gap-4 min-w-0">

            <!-- ---------- HEADER BAR ---------- -->
            <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-card rounded-[20px] p-4 border border-line shadow-soft">
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h1 class="text-xl sm:text-2xl font-extrabold text-ink">Kondisi Alat & Sensor Lapangan</h1>
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-0.5 rounded-full bg-okbg text-ok">
                            <i class="fa-solid fa-circle text-[6px]"></i> 2 Perangkat Normal
                        </span>
                    </div>
                    <p class="text-mute text-xs sm:text-sm mt-0.5">Periksa daya baterai solar panel, status pemancar LoRa, dan kesehatan tiap sensor cuaca</p>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <button type="button" onclick="alert('Mengirim sinyal tes ke sensor pantai... Respon: Normal (1 detik).')" class="px-3.5 py-2 rounded-xl bg-tint text-sea text-xs font-bold hover:bg-sea hover:text-white transition-all flex items-center gap-1.5">
                        <i class="fa-solid fa-signal text-xs"></i>
                        <span>Cek Sinyal Sensor</span>
                    </button>
                    <a href="{{ route('dashboard') }}" class="px-3.5 py-2 rounded-xl bg-card border border-line text-xs font-semibold text-mute hover:text-ink transition-all">
                        Kembali
                    </a>
                </div>
            </header>

            <!-- ---------- RINGKASAN STATUS KESEHATAN ALAT ---------- -->
            <section class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
                <div class="bg-card rounded-[20px] p-4 border border-line shadow-soft flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-okbg text-ok grid place-items-center text-lg font-bold shrink-0">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div>
                        <span class="text-mute text-xs font-medium block">Status Seluruh Alat</span>
                        <b class="text-base font-extrabold text-ink">Berfungsi Normal</b>
                        <span class="text-[11px] text-ok font-semibold block">7 dari 7 sensor aktif</span>
                    </div>
                </div>

                <div class="bg-card rounded-[20px] p-4 border border-line shadow-soft flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-tint text-sea grid place-items-center text-lg font-bold shrink-0">
                        <i class="fa-solid fa-solar-panel"></i>
                    </div>
                    <div>
                        <span class="text-mute text-xs font-medium block">Baterai & Panel Surya</span>
                        <b class="text-base font-extrabold text-ink">Baterai 78%</b>
                        <span class="text-[11px] text-mute font-semibold block">Panel mengisi daya (17,9 V)</span>
                    </div>
                </div>

                <div class="bg-card rounded-[20px] p-4 border border-line shadow-soft flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-okbg text-ok grid place-items-center text-lg font-bold shrink-0">
                        <i class="fa-solid fa-wifi"></i>
                    </div>
                    <div>
                        <span class="text-mute text-xs font-medium block">Koneksi Internet Posko</span>
                        <b class="text-base font-extrabold text-ink">4G Telkomsel Aktif</b>
                        <span class="text-[11px] text-ok font-semibold block">Data terkirim lancar</span>
                    </div>
                </div>
            </section>

            <!-- ---------- 2 NODE UTAMA: PANTAI & KANTOR ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                
                <!-- NODE 1: TIANG SENSOR PANTAI CIANTIR -->
                <div class="bg-card rounded-[20px] p-5 border border-line shadow-soft flex flex-col justify-between gap-4">
                    <div>
                        <div class="flex items-center justify-between mb-3 pb-3 border-b border-line/60">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-2xl bg-tint text-sea grid place-items-center text-lg">
                                    <i class="fa-solid fa-tower-broadcast"></i>
                                </div>
                                <div>
                                    <h3 class="font-extrabold text-base text-ink">Tiang Sensor Pantai Ciantir</h3>
                                    <span class="text-xs text-mute">Kode: SW-EDGE-01 · Posisi Bibir Pantai</span>
                                </div>
                            </div>
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-okbg text-ok">Menyala</span>
                        </div>

                        <div class="space-y-3">
                            <div class="p-3 rounded-xl bg-bg border border-line/60">
                                <span class="text-xs text-mute block mb-1 font-medium">Kekuatan Baterai Saat Ini:</span>
                                <div class="flex items-center gap-3">
                                    <div class="flex-1 bg-line rounded-full h-3 overflow-hidden">
                                        <div class="bg-ok h-full rounded-full" style="width: 78%"></div>
                                    </div>
                                    <b class="text-xs text-ink font-extrabold">78%</b>
                                </div>
                                <span class="text-[11px] text-mute mt-1 block">Panel surya bekerja normal mengisi daya baterai cadangan.</span>
                            </div>

                            <div class="p-3 rounded-xl bg-bg border border-line/60 flex items-center justify-between text-xs">
                                <span class="text-mute font-medium">Jarak Pemancar ke Kantor:</span>
                                <b class="text-ink">1,42 km (Sinyal Sangat Kuat)</b>
                            </div>

                            <div class="p-3 rounded-xl bg-bg border border-line/60 flex items-center justify-between text-xs">
                                <span class="text-mute font-medium">Pengiriman Terakhir:</span>
                                <b class="text-ok">1 menit lalu (Otomatis Tiap Menit)</b>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 rounded-xl bg-tint/60 text-xs text-ink flex items-center gap-2">
                        <i class="fa-solid fa-circle-info text-sea"></i>
                        <span>Jika baterai &lt; 20%, lampu peringatan posko akan otomatis menyala.</span>
                    </div>
                </div>

                <!-- NODE 2: GATEWAY KANTOR PENGELOLA -->
                <div class="bg-card rounded-[20px] p-5 border border-line shadow-soft flex flex-col justify-between gap-4">
                    <div>
                        <div class="flex items-center justify-between mb-3 pb-3 border-b border-line/60">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-2xl bg-tint text-sea grid place-items-center text-lg">
                                    <i class="fa-solid fa-server"></i>
                                </div>
                                <div>
                                    <h3 class="font-extrabold text-base text-ink">Komputer Posko Kantor Desa</h3>
                                    <span class="text-xs text-mute">Kode: SW-SINK-01 · Gedung Sekretariat Pokdarwis</span>
                                </div>
                            </div>
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-okbg text-ok">Terhubung</span>
                        </div>

                        <div class="space-y-3">
                            <div class="p-3 rounded-xl bg-bg border border-line/60 flex items-center justify-between text-xs">
                                <span class="text-mute font-medium">Penerimaan Data Radio:</span>
                                <b class="text-ok">Lancar 99,4% Tanpa Gangguan</b>
                            </div>

                            <div class="p-3 rounded-xl bg-bg border border-line/60 flex items-center justify-between text-xs">
                                <span class="text-mute font-medium">Status Internet 4G:</span>
                                <b class="text-ok font-bold"><i class="fa-solid fa-wifi mr-1"></i> Stabil (Telkomsel)</b>
                            </div>

                            <div class="p-3 rounded-xl bg-bg border border-line/60 flex items-center justify-between text-xs">
                                <span class="text-mute font-medium">Penyimpanan Cadangan Offline:</span>
                                <b class="text-ink">Kapasitas Kosong 94% (Sangat Luang)</b>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 rounded-xl bg-okbg/60 text-xs text-ok font-semibold flex items-center gap-2">
                        <i class="fa-solid fa-shield-check"></i>
                        <span>Saat internet mati, data otomatis disimpan dan akan dikirim begitu sinyal kembali.</span>
                    </div>
                </div>

            </section>

            <!-- ---------- DAFTAR SENSOR TERPASANG & CARA CEK ---------- -->
            <section class="bg-card rounded-[20px] p-4 sm:p-5 border border-line shadow-soft">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-extrabold text-sm text-ink flex items-center gap-2">
                        <i class="fa-solid fa-list-check text-sea"></i>
                        <span>Daftar Sensor Cuaca yang Sedang Bekerja</span>
                    </h3>
                    <span class="text-xs text-mute font-medium">Kondisi Lapangan</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                    <div class="p-3.5 rounded-xl bg-bg border border-line/60 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-tint text-sea grid place-items-center text-sm font-bold">
                                <i class="fa-solid fa-wind"></i>
                            </div>
                            <div>
                                <b class="text-xs text-ink block">Sensor Angin (Anemometer)</b>
                                <span class="text-[11px] text-mute">Pembacaan: 34 km/jam</span>
                            </div>
                        </div>
                        <span class="text-[11px] font-bold text-ok bg-okbg px-2 py-0.5 rounded-full">Bagus</span>
                    </div>

                    <div class="p-3.5 rounded-xl bg-bg border border-line/60 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-tint text-sea grid place-items-center text-sm font-bold">
                                <i class="fa-solid fa-droplet"></i>
                            </div>
                            <div>
                                <b class="text-xs text-ink block">Pengukur Curah Hujan</b>
                                <span class="text-[11px] text-mute">Pembacaan: 3,2 mm/jam</span>
                            </div>
                        </div>
                        <span class="text-[11px] font-bold text-ok bg-okbg px-2 py-0.5 rounded-full">Bagus</span>
                    </div>

                    <div class="p-3.5 rounded-xl bg-bg border border-line/60 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-tint text-sea grid place-items-center text-sm font-bold">
                                <i class="fa-solid fa-temperature-half"></i>
                            </div>
                            <div>
                                <b class="text-xs text-ink block">Sensor Suhu & Kelembapan</b>
                                <span class="text-[11px] text-mute">Pembacaan: 29,4 °C · 84%</span>
                            </div>
                        </div>
                        <span class="text-[11px] font-bold text-ok bg-okbg px-2 py-0.5 rounded-full">Bagus</span>
                    </div>
                </div>

                <!-- Petunjuk Perawatan Singkat -->
                <div class="mt-4 p-3.5 rounded-xl bg-tint/60 border border-line/60 flex items-start gap-3 text-xs">
                    <i class="fa-solid fa-lightbulb text-sea text-base mt-0.5"></i>
                    <div>
                        <b class="text-ink block mb-0.5">Petunjuk Perawatan Rutin Petugas:</b>
                        <span class="text-mute">
                            Setiap 1 minggu sekali, bersihkan corong sensor penampung hujan dari daun kering atau butiran pasir pantai. Bila kaca panel surya kotor terkena uap garam laut, seka dengan kain bersih dan air tawar.
                        </span>
                    </div>
                </div>
            </section>

        </main>
    </div>

</div>
@endsection
