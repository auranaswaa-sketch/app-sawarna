@extends('layouts.app')

@section('title', 'Atur Batas Peringatan - Pos Pantau Pantai Sawarna')

@section('content')
<div class="bg-bg text-ink min-h-[calc(100vh-2.5rem)] flex flex-col justify-between" id="settings-root">

    <div class="grid grid-cols-1 lg:grid-cols-[auto_minmax(0,1fr)] gap-4 lg:gap-6 items-start">

        @include('partials.sidebar')

        <!-- ================= KONTEN UTAMA SETTING ================= -->
        <main class="flex flex-col gap-4 min-w-0">

            <!-- ---------- HEADER BAR ---------- -->
            <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-card rounded-[20px] p-4 border border-line shadow-soft">
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h1 class="text-xl sm:text-2xl font-extrabold text-ink">Atur Batas Peringatan Cuaca</h1>
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-0.5 rounded-full bg-tint text-sea">
                            <i class="fa-solid fa-shield-halved text-[10px]"></i> Pengaturan Posko
                        </span>
                    </div>
                    <p class="text-mute text-xs sm:text-sm mt-0.5">Tentukan kapan alarm bahaya angin kencang atau hujan lebat berbunyi</p>
                </div>

                <div class="flex items-center gap-2.5 shrink-0">
                    <a href="{{ route('dashboard') }}" class="px-3.5 py-2 rounded-xl bg-card border border-line text-xs font-semibold text-mute hover:text-ink transition-all">
                        Kembali
                    </a>
                    <button type="button" onclick="saveAllSettings()" class="px-4 py-2 rounded-xl bg-gradient-to-br from-sea to-deep text-white text-xs font-bold shadow-soft hover:opacity-95 active:scale-95 transition-all flex items-center gap-1.5">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </header>

            <!-- Save Toast Banner -->
            <div id="save-toast" class="hidden items-center justify-between gap-3 px-4 py-3 rounded-2xl bg-okbg border border-ok/30 text-ok transition-all shadow-soft animate-fade-in">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-check text-base"></i>
                    <span class="text-xs sm:text-sm font-semibold">Batas peringatan cuaca berhasil disimpan dan langsung aktif di posko!</span>
                </div>
                <button onclick="document.getElementById('save-toast').classList.add('hidden')" class="text-ok hover:opacity-75">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- TAB PILL SEDERHANA -->
            <section class="bg-card rounded-[20px] p-2 border border-line shadow-soft">
                <nav class="flex items-center gap-2 overflow-x-auto" aria-label="Tabs Pengaturan">
                    <button onclick="switchTab('thresholds')" id="tab-btn-thresholds" class="tab-pill active flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-dark text-white">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>1. Batas Bahaya Cuaca</span>
                    </button>
                    <button onclick="switchTab('notifications')" id="tab-btn-notifications" class="tab-pill flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-mute hover:bg-tint hover:text-ink">
                        <i class="fa-solid fa-phone"></i>
                        <span>2. Nomor Kontak Peringatan</span>
                    </button>
                    <button onclick="switchTab('profile')" id="tab-btn-profile" class="tab-pill flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-mute hover:bg-tint hover:text-ink">
                        <i class="fa-solid fa-building"></i>
                        <span>3. Info Posko Pantau</span>
                    </button>
                </nav>
            </section>

            <!-- TAB 1: BATAS BAHAYA CUACA -->
            <div id="tab-content-thresholds" class="tab-panel flex flex-col gap-4">
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    
                    <!-- 1. ATUR ANGIN KENCANG -->
                    <div class="bg-card rounded-[20px] p-5 border border-line shadow-soft flex flex-col justify-between gap-4">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-10 h-10 rounded-xl bg-warnbg text-warn grid place-items-center font-bold">
                                        <i class="fa-solid fa-wind text-base"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-extrabold text-base text-ink">Batas Bahaya Angin</h3>
                                        <span class="text-xs text-mute">Saat ini: <strong>34 km/jam</strong></span>
                                    </div>
                                </div>
                                <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-warnbg text-warn">Waspada Aktif</span>
                            </div>
                            <p class="text-xs text-mute mb-4">Jika angin melebihi angka di bawah, layar posko akan menyala kuning/merah untuk memberi tahu operator agar mengimbau wisatawan.</p>

                            <div class="space-y-4">
                                <!-- Batas Kuning -->
                                <div class="p-3.5 rounded-xl bg-bg border border-line/60">
                                    <div class="flex items-center justify-between text-xs mb-1 font-bold">
                                        <span class="text-warn flex items-center gap-1.5">
                                            <i class="fa-solid fa-triangle-exclamation"></i> Batas Waspada (Bendera Kuning)
                                        </span>
                                        <b class="text-ink text-sm" id="wind_waspada_text">30 km/jam</b>
                                    </div>
                                    <input type="range" min="15" max="50" value="30" class="w-full accent-warn cursor-pointer" oninput="document.getElementById('wind_waspada_text').textContent = this.value + ' km/jam'">
                                    <span class="text-[11px] text-mute block mt-1">Standar BMKG: 30 km/jam.</span>
                                </div>

                                <!-- Batas Merah -->
                                <div class="p-3.5 rounded-xl bg-bg border border-line/60">
                                    <div class="flex items-center justify-between text-xs mb-1 font-bold">
                                        <span class="text-bad flex items-center gap-1.5">
                                            <i class="fa-solid fa-radiation"></i> Batas Bahaya Badai (Bendera Merah)
                                        </span>
                                        <b class="text-ink text-sm" id="wind_bahaya_text">60 km/jam</b>
                                    </div>
                                    <input type="range" min="40" max="100" value="60" class="w-full accent-bad cursor-pointer" oninput="document.getElementById('wind_bahaya_text').textContent = this.value + ' km/jam'">
                                    <span class="text-[11px] text-mute block mt-1">Wisatawan wajib keluar dari area pantai dan menjauhi karang.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. ATUR HUJAN LEBAT -->
                    <div class="bg-card rounded-[20px] p-5 border border-line shadow-soft flex flex-col justify-between gap-4">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-10 h-10 rounded-xl bg-tint text-sea grid place-items-center font-bold">
                                        <i class="fa-solid fa-droplet text-base"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-extrabold text-base text-ink">Batas Curah Hujan</h3>
                                        <span class="text-xs text-mute">Saat ini: <strong>3,2 mm/jam (Gerimis)</strong></span>
                                    </div>
                                </div>
                                <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-okbg text-ok">Aman</span>
                            </div>
                            <p class="text-xs text-mute mb-4">Mengantisipasi banjir rob atau air laut meluap ke warung pesisir dan jembatan gantung.</p>

                            <div class="space-y-4">
                                <div class="p-3.5 rounded-xl bg-bg border border-line/60">
                                    <div class="flex items-center justify-between text-xs mb-1 font-bold">
                                        <span class="text-warn flex items-center gap-1.5">
                                            <i class="fa-solid fa-cloud-rain"></i> Batas Hujan Sedang / Waspada
                                        </span>
                                        <b class="text-ink text-sm" id="rain_waspada_text">10 mm/jam</b>
                                    </div>
                                    <input type="range" min="5" max="25" value="10" class="w-full accent-warn cursor-pointer" oninput="document.getElementById('rain_waspada_text').textContent = this.value + ' mm/jam'">
                                </div>

                                <div class="p-3.5 rounded-xl bg-bg border border-line/60">
                                    <div class="flex items-center justify-between text-xs mb-1 font-bold">
                                        <span class="text-bad flex items-center gap-1.5">
                                            <i class="fa-solid fa-cloud-showers-heavy"></i> Batas Hujan Lebat / Bahaya
                                        </span>
                                        <b class="text-ink text-sm" id="rain_bahaya_text">35 mm/jam</b>
                                    </div>
                                    <input type="range" min="20" max="70" value="35" class="w-full accent-bad cursor-pointer" oninput="document.getElementById('rain_bahaya_text').textContent = this.value + ' mm/jam'">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- TAB 2: KONTAK DARURAT WHATSAPP -->
            <div id="tab-content-notifications" class="tab-panel hidden flex-col gap-4">
                <div class="bg-card rounded-[20px] p-5 border border-line shadow-soft">
                    <h3 class="font-extrabold text-base text-ink mb-1 flex items-center gap-2">
                        <i class="fa-brands fa-whatsapp text-ok text-lg"></i>
                        <span>Nomor WhatsApp yang Diberitahu Saat Bahaya</span>
                    </h3>
                    <p class="text-xs text-mute mb-4">Pesan otomatis akan langsung terkirim ke nomor di bawah jika cuaca melewati batas bahaya.</p>

                    <div class="space-y-3 max-w-xl">
                        <div>
                            <label class="text-xs text-mute font-bold block mb-1">Nomor WhatsApp Ketua POKDARWIS</label>
                            <input type="text" value="+62 812-8899-7711" class="w-full bg-card rounded-xl p-2.5 text-xs font-bold border border-line">
                        </div>
                        <div>
                            <label class="text-xs text-mute font-bold block mb-1">Nomor WhatsApp Koordinator Balawista / Tim SAR</label>
                            <input type="text" value="+62 878-3344-5522" class="w-full bg-card rounded-xl p-2.5 text-xs font-bold border border-line">
                        </div>
                        <div>
                            <label class="text-xs text-mute font-bold block mb-1">ID Grup Telegram Relawan Pantai</label>
                            <input type="text" value="-1002938475829 (Grup Siaga Sawarna)" class="w-full bg-card rounded-xl p-2.5 text-xs font-bold border border-line">
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-t border-line/60">
                        <button type="button" onclick="alert('Pesan uji coba telah dikirim ke nomor WhatsApp pengelola!')" class="px-4 py-2.5 rounded-xl bg-tint text-sea text-xs font-bold hover:bg-sea hover:text-white transition-all flex items-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>Coba Kirim Pesan Tes Sekarang</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- TAB 3: INFO POSKO -->
            <div id="tab-content-profile" class="tab-panel hidden flex-col gap-4">
                <div class="bg-card rounded-[20px] p-5 border border-line shadow-soft max-w-xl">
                    <h3 class="font-extrabold text-base text-ink mb-1 flex items-center gap-2">
                        <i class="fa-solid fa-location-dot text-sea"></i>
                        <span>Lokasi Pos Pantau & Stasiun</span>
                    </h3>
                    <div class="space-y-3 mt-3 text-xs">
                        <div>
                            <span class="text-mute block font-medium">Nama Stasiun:</span>
                            <b class="text-ink font-bold text-sm">Pos Pantau Pantai Ciantir - Sawarna</b>
                        </div>
                        <div>
                            <span class="text-mute block font-medium">Alamat:</span>
                            <span class="text-ink font-semibold">Jl. Pantai Ciantir No. 8, Desa Sawarna, Kec. Bayah, Kab. Lebak, Banten</span>
                        </div>
                        <div>
                            <span class="text-mute block font-medium">Titik Koordinat:</span>
                            <span class="font-mono text-ink font-bold">-6.98520, 106.31140</span>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

</div>
@endsection

@push('scripts')
<script>
function switchTab(tabId) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
    document.querySelectorAll('.tab-pill').forEach(b => {
        b.classList.remove('active', 'bg-dark', 'text-white');
        b.classList.add('text-mute');
    });
    const p = document.getElementById('tab-content-' + tabId);
    const b = document.getElementById('tab-btn-' + tabId);
    if (p) p.classList.remove('hidden');
    if (b) {
        b.classList.add('active', 'bg-dark', 'text-white');
        b.classList.remove('text-mute');
    }
}

function saveAllSettings() {
    const t = document.getElementById('save-toast');
    t.classList.remove('hidden');
    t.classList.add('flex');
    window.scrollTo({ top: 0, behavior: 'smooth' });
    setTimeout(() => {
        t.classList.add('hidden');
        t.classList.remove('flex');
    }, 4000);
}
</script>
@endpush
