@extends('layouts.app')

@section('title', 'Profil Petugas Posko - Cuaca Pantai Sawarna')

@section('content')
<div class="bg-bg text-ink min-h-[calc(100vh-2.5rem)] flex flex-col justify-between" id="profile-root">

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

                <!-- 4. Pengaturan -->
                <a href="{{ route('settings.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-xs sm:text-sm text-mute hover:bg-tint hover:text-ink shrink-0 transition-all">
                    <i class="fa-solid fa-sliders text-base w-5 text-center text-sea"></i>
                    <span>Atur Batas Peringatan</span>
                </a>

                <!-- 5. Profil Petugas (Active) -->
                <a href="{{ route('profile.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-bold text-xs sm:text-sm bg-dark text-white shadow-sm shrink-0 transition-all">
                    <i class="fa-solid fa-user-shield text-base w-5 text-center"></i>
                    <span>Profil Petugas</span>
                </a>
            </nav>

            <!-- Card Bantuan Petugas Lapangan -->
            <div class="hidden lg:block mt-6 p-3.5 rounded-2xl bg-tint/70 border border-line/60">
                <div class="flex items-center gap-2 text-sea font-bold text-xs mb-1">
                    <i class="fa-solid fa-shield"></i>
                    <span>Tugas Piket Hari Ini</span>
                </div>
                <p class="text-[11px] text-mute mb-2">Pantau kondisi angin pasang sore hari & pastikan sirine posko siap digunakan.</p>
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

        <!-- ================= KONTEN UTAMA PROFIL ================= -->
        <main class="flex flex-col gap-4 min-w-0">

            <!-- ---------- HEADER BAR ---------- -->
            <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-card rounded-[20px] p-4 border border-line shadow-soft">
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h1 class="text-xl sm:text-2xl font-extrabold text-ink">Profil Petugas Posko Cuaca</h1>
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-0.5 rounded-full bg-okbg text-ok">
                            <i class="fa-solid fa-circle text-[6px]"></i> Sedang Bertugas (Piket)
                        </span>
                    </div>
                    <p class="text-mute text-xs sm:text-sm mt-0.5">Identitas penanggung jawab posko pantau Pantai Ciantir hari ini</p>
                </div>

                <div class="flex items-center gap-2.5 shrink-0">
                    <a href="{{ route('dashboard') }}" class="px-3.5 py-2 rounded-xl bg-card border border-line text-xs font-semibold text-mute hover:text-ink transition-all">
                        Kembali ke Beranda
                    </a>
                    <button type="button" onclick="saveProfile()" class="px-4 py-2 rounded-xl bg-gradient-to-br from-sea to-deep text-white text-xs font-bold shadow-soft hover:opacity-95 transition-all flex items-center gap-1.5">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan Biodata</span>
                    </button>
                </div>
            </header>

            <!-- Save Toast Banner -->
            <div id="profile-save-toast" class="hidden items-center justify-between gap-3 px-4 py-3 rounded-2xl bg-okbg border border-ok/30 text-ok transition-all shadow-soft animate-fade-in">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-check text-base"></i>
                    <span class="text-xs sm:text-sm font-semibold">Data biodata petugas posko berhasil diperbarui!</span>
                </div>
                <button onclick="document.getElementById('profile-save-toast').classList.add('hidden')" class="text-ok hover:opacity-75">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- HERO OPERATOR CARD -->
            <section class="bg-card rounded-[20px] p-5 sm:p-6 border border-line shadow-soft flex flex-col sm:flex-row items-center sm:items-start gap-5">
                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-gradient-to-br from-sea to-deep text-white grid place-items-center text-3xl font-black shadow-card shrink-0">
                    AF
                </div>
                <div class="text-center sm:text-left flex-1 min-w-0">
                    <div class="flex items-center justify-center sm:justify-start gap-2 flex-wrap">
                        <h2 class="text-xl sm:text-2xl font-black text-ink">{{ $profile['user']['name'] }}</h2>
                        <span class="text-xs font-bold px-2.5 py-0.5 rounded-full bg-dark text-white">Operator Posko</span>
                    </div>
                    <p class="text-sm font-semibold text-sea mt-0.5">{{ $profile['user']['title'] }}</p>
                    <p class="text-xs text-mute mt-1">Stasiun: <strong>Pos Pantau Pantai Ciantir (SW-NODE-01)</strong> · Aktif sejak 2024</p>
                </div>
            </section>

            <!-- FORM BIODATA RAMAH OPERATOR -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                
                <div class="bg-card rounded-[20px] p-5 border border-line shadow-soft">
                    <h3 class="font-extrabold text-base text-ink mb-3 flex items-center gap-2">
                        <i class="fa-solid fa-address-card text-sea"></i>
                        <span>Kontak Darurat Petugas</span>
                    </h3>

                    <div class="space-y-3 text-xs">
                        <div>
                            <label class="text-mute font-bold block mb-1">Nama Lengkap Petugas</label>
                            <input type="text" value="{{ $profile['user']['name'] }}" class="w-full bg-card rounded-xl p-2.5 text-xs font-bold text-ink border border-line">
                        </div>
                        <div>
                            <label class="text-mute font-bold block mb-1">Nomor WhatsApp Aktif (Untuk Panggilan Darurat)</label>
                            <input type="text" value="{{ $profile['user']['phone'] }}" class="w-full bg-card rounded-xl p-2.5 text-xs font-bold text-ink border border-line">
                        </div>
                        <div>
                            <label class="text-mute font-bold block mb-1">Email Resmi</label>
                            <input type="email" value="{{ $profile['user']['email'] }}" class="w-full bg-card rounded-xl p-2.5 text-xs font-bold text-ink border border-line">
                        </div>
                        <div>
                            <label class="text-mute font-bold block mb-1">Pos Jaga Lapangan</label>
                            <input type="text" value="Posko Pantau Pantai Ciantir, Sawarna" readonly class="w-full bg-bg rounded-xl p-2.5 text-xs font-semibold text-mute border border-line">
                        </div>
                    </div>
                </div>

                <div class="bg-card rounded-[20px] p-5 border border-line shadow-soft flex flex-col justify-between">
                    <div>
                        <h3 class="font-extrabold text-base text-ink mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-lock text-sea"></i>
                            <span>Ganti Kata Sandi Akun</span>
                        </h3>
                        <p class="text-xs text-mute mb-3">Ubah kata sandi secara berkala untuk menjaga keamanan akun pos pantau.</p>

                        <div class="space-y-3 text-xs">
                            <input type="password" placeholder="Kata sandi saat ini" class="w-full bg-card rounded-xl p-2.5 text-xs border border-line">
                            <input type="password" placeholder="Kata sandi baru (minimal 8 huruf/angka)" class="w-full bg-card rounded-xl p-2.5 text-xs border border-line">
                        </div>
                    </div>

                    <button type="button" onclick="alert('Kata sandi petugas berhasil diubah!')" class="mt-4 w-full py-2.5 rounded-xl bg-dark text-white text-xs font-bold hover:bg-ink transition-all">
                        Simpan Kata Sandi Baru
                    </button>
                </div>

            </div>

        </main>
    </div>

</div>
@endsection

@push('scripts')
<script>
function saveProfile() {
    const t = document.getElementById('profile-save-toast');
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
