<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="description" content="Dashboard Cuaca Mikro & Sistem Peringatan Dini Kawasan Wisata Pantai Sawarna, Lebak, Banten">
    <title>@yield('title', 'Dashboard Cuaca Mikro & Peringatan Dini Pantai Sawarna')</title>

    <!-- Google Fonts: Plus Jakarta Sans & DM Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CSS (CDN Standalone Fallback + Config) -->
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', '"DM Sans"', 'system-ui', '-apple-system', 'sans-serif'],
                        display: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        bg: 'var(--bg)',
                        card: 'var(--card)',
                        ink: 'var(--ink)',
                        mute: 'var(--mute)',
                        line: 'var(--line)',
                        sea: 'var(--sea)',
                        deep: 'var(--deep)',
                        sky: 'var(--sky)',
                        tint: 'var(--tint)',
                        dark: 'var(--dark)',
                        ok: 'var(--ok)',
                        okbg: 'var(--okbg)',
                        warn: 'var(--warn)',
                        warnbg: 'var(--warnbg)',
                        bad: 'var(--bad)',
                        badbg: 'var(--badbg)',
                        // Forest / Sage reference tones from image
                        sage: {
                            50: '#f5f7f4',
                            100: '#e8ebe5',
                            200: '#d2d9cc',
                            300: '#b4c0ab',
                            400: '#8ea182',
                            500: '#69815d',
                            600: '#526649',
                            700: '#41513a',
                            800: '#344130',
                            900: '#1c281a',
                        }
                    },
                    boxShadow: {
                        'soft': '0 4px 20px -2px rgba(18, 38, 28, 0.04), 0 2px 6px -1px rgba(18, 38, 28, 0.02)',
                        'card': '0 10px 30px -4px rgba(18, 38, 28, 0.05)',
                        'floating': '0 20px 40px -10px rgba(18, 38, 28, 0.12)',
                    },
                    borderRadius: {
                        'squircle': '20px',
                        'capsule': '36px',
                    }
                }
            }
        };
    </script>

    <style>
        /* Desain Variabel CSS: Warm Sage & Coastal Maritime Palette (Default matches image reference) */
        :root {
            --bg: #e8eae3;         /* Background kanvas hangat/sage seperti di gambar */
            --card: #ffffff;       /* Kartu putih bersih dengan elevasi halus */
            --ink: #1b2d24;        /* Teks utama gelap kontras tinggi */
            --mute: #7a8c82;       /* Teks sekunder & label abu-abu kehijauan */
            --line: #e2e6e0;       /* Garis pemisah halus */
            --sea: #4a6f5d;        /* Hijau sage/forest primer */
            --deep: #325041;       /* Deep forest hijau gelap untuk gradient hero card */
            --sky: #88b19d;        /* Aksen gradien grafik */
            --tint: #eff3ee;       /* Background lingkaran ikon */
            --dark: #1a2c22;       /* Warna tombol aktif navigasi & pencarian */
            --ok: #2c7a51;         /* Hijau status aman (+2.45%) */
            --okbg: #e6f3ec;       /* Background badge hijau aman */
            --warn: #c9831a;       /* Amber status waspada */
            --warnbg: #fff1d6;     /* Background badge waspada */
            --bad: #c54646;        /* Merah status penurunan/bahaya (-4.75%) */
            --badbg: #fdebec;      /* Background badge merah */
        }

        /* Mode Bahari / Ocean Maritime (Bila ingin beralih ke spektrum laut Sawarna asli) */
        [data-theme="maritime"] {
            --bg: #e3eef2;
            --card: #ffffff;
            --ink: #0d2f44;
            --mute: #7a97a6;
            --line: #e1edf2;
            --sea: #0e86b8;
            --deep: #0a5c8a;
            --sky: #8fd3ee;
            --tint: #e6f4fa;
            --dark: #0d2f44;
            --ok: #1b9a72;
            --okbg: #dcf5ec;
            --warn: #c9831a;
            --warnbg: #fff1d6;
            --bad: #c23b3b;
            --badbg: #fbe3e3;
        }

        /* Dark Mode Support */
        .dark, @media (prefers-color-scheme: dark) {
            :root {
                --bg: #0f1713;
                --card: #17241d;
                --ink: #eaf1ec;
                --mute: #859c8f;
                --line: #22352b;
                --sea: #5fa884;
                --deep: #224233;
                --sky: #3d795b;
                --tint: #1b3024;
                --dark: #080f0b;
                --ok: #4fd0a0;
                --okbg: #10382e;
                --warn: #efb04e;
                --warnbg: #3b2f14;
                --bad: #f08080;
                --badbg: #3d1f1f;
            }
        }

        body {
            font-family: "Plus Jakarta Sans", "DM Sans", system-ui, sans-serif;
            background-color: var(--bg);
            color: var(--ink);
            padding-top: env(safe-area-inset-top, 0px);
            padding-bottom: env(safe-area-inset-bottom, 0px);
            -webkit-font-smoothing: antialiased;
        }

        /* Transisi halus */
        .transition-theme {
            transition: background-color 0.25s ease, color 0.25s ease, border-color 0.25s ease;
        }

        /* Card tactile & squircle geometry */
        .squircle-card {
            background-color: var(--card);
            border-radius: 20px;
            box-shadow: 0 4px 20px -2px rgba(18, 38, 28, 0.03), 0 1px 3px 0 rgba(0, 0, 0, 0.02);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .squircle-card:hover {
            box-shadow: 0 8px 26px -4px rgba(18, 38, 28, 0.06);
        }

        /* Isometric floating cards graphic */
        .iso-card-stack {
            perspective: 800px;
        }
        .iso-card {
            transform: rotate(-12deg) skewX(10deg) scale(0.95);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .iso-card:hover {
            transform: rotate(-8deg) skewX(6deg) scale(1) translateY(-6px);
        }

        /* Scrollbar kustom halus */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: var(--line);
            border-radius: 999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--mute);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-bg text-ink min-h-screen selection:bg-sea selection:text-white">

    <div class="max-w-[1600px] mx-auto p-3 sm:p-5 lg:p-7 min-h-screen flex flex-col justify-center">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>

