@extends('layouts.app')

@section('title', 'Kondisi Alat Sensor - Pos Pantau Pantai Sawarna')

@section('content')
<div class="bg-bg text-ink min-h-[calc(100vh-2.5rem)] flex flex-col justify-between" id="devices-root">

    <div class="grid grid-cols-1 lg:grid-cols-[auto_minmax(0,1fr)] gap-4 lg:gap-6 items-start">

        @include('partials.sidebar')

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