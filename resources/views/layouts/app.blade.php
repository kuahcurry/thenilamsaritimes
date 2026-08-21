<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="no-referrer">
    <title>{{ $settings->newspaper_title ?? 'THE CICI TIMES' }} — {{ $settings->birthday_girl_name ?? 'Birthday' }} Special Edition</title>
    <meta name="description" content="A special commemorative New York Times edition celebrating {{ $settings->birthday_girl_name ?? 'our birthday star' }}'s {{ $settings->age ?? '' }}th birthday.">

    <!-- Favicon (NYT Gothic 'C' Style) -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.svg') }}">

    <!-- Resource Hints & Preconnect for Speed -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://lh3.googleusercontent.com" crossorigin>
    <link rel="dns-prefetch" href="https://lh3.googleusercontent.com">

    <!-- Material Symbols & Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased min-h-screen flex flex-col justify-between">

    <!-- 1. Top Breaking News Ribbon (High-contrast across themes) -->
    <header class="breaking-ribbon py-1 px-3 border-b border-[var(--nyt-gray-border)] no-print flex items-center justify-between">
        <div class="flex items-center gap-2 overflow-hidden w-full">
            <span class="ticker-badge text-white text-[10px] font-bold px-2 py-0.5 uppercase tracking-wider rounded-none shrink-0 flex items-center gap-1">
                <span class="inline-block w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                Buletin Spesial
            </span>
            <div class="ticker-wrap flex-1">
                <div class="ticker-move text-xs tracking-wider font-semibold">
                    {{ $settings->breaking_ticker ?? "BREAKING: Global Celebrations Underway for Cici's Special Day! • Historic Milestones Ahead • Outpouring of Love Reported Worldwide" }}
                </div>
            </div>
        </div>
    </header>

    <!-- 2. Utility Header (Theme, Confetti, Audio Toast, Admin Link) -->
    <div class="bg-[var(--nyt-paper-darker)] border-b border-[var(--nyt-gray-border)] py-2 px-3 sm:px-4 no-print text-xs">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2.5 sm:gap-3">
            
            <!-- Left: Vintage Vinyl Audio Player & Confetti -->
            <div class="flex items-center justify-between w-full sm:w-auto gap-2">
                <div class="flex items-center gap-2">
                    <audio id="vintage-audio-el" src="{{ $settings->audio_url ?? 'https://commondatastorage.googleapis.com/codeskulptor-demos/riceracer_assets/music/menu.ogg' }}" preload="none"></audio>
                    <div class="audio-toast-card flex items-center gap-2 py-1 px-2 bg-[var(--nyt-card-bg)] border border-[var(--nyt-gray-border)] shadow-xs rounded-sm">
                        <!-- Spinning Vinyl Record Disc -->
                        <button id="audio-play-btn" type="button" class="relative group cursor-pointer flex items-center justify-center focus:outline-none shrink-0" title="Putar Musik / Piringan Hitam">
                            <div id="vinyl-disc" class="vinyl-record w-7 h-7 sm:w-8 sm:h-8 rounded-full flex items-center justify-center shadow-md relative transition-transform duration-300 group-hover:scale-105">
                                <!-- Golden Vinyl Center Label -->
                                <div class="w-3 h-3 sm:w-3.5 sm:h-3.5 rounded-full bg-amber-500 border border-amber-300 flex items-center justify-center shadow-inner">
                                    <div class="w-1 h-1 rounded-full bg-[var(--nyt-black)]"></div>
                                </div>
                            </div>
                            <!-- Play/Pause Overlay Icon on hover -->
                            <div id="vinyl-play-overlay" class="absolute inset-0 flex items-center justify-center bg-black/40 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                <span id="audio-play-icon" class="material-symbols-outlined text-white !text-[14px]">play_arrow</span>
                            </div>
                        </button>

                        <div class="leading-tight">
                            <div class="font-bold text-[9px] sm:text-[10px] uppercase tracking-wider text-[var(--nyt-black)] flex items-center gap-1">
                                <span>Piringan Hitam</span>
                                <span id="vinyl-status-dot" class="inline-block w-1.5 h-1.5 rounded-full bg-amber-500 hidden animate-ping"></span>
                            </div>
                            <div id="audio-status-text" class="text-[9px] text-[var(--nyt-gray-muted)] truncate max-w-[100px] sm:max-w-[130px]">
                                {{ $settings->audio_title ?? 'Klik untuk Putar' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-1.5">
                    <button onclick="window.celebrateConfetti()" type="button" class="inline-flex items-center gap-1 bg-amber-500 hover:bg-amber-600 text-black font-bold text-[10px] sm:text-[11px] px-2.5 sm:px-3 py-1 rounded-sm shadow-sm transition cursor-pointer shrink-0">
                        <span>Confetti!</span>
                    </button>

                    <a href="{{ route('newspaper.print') }}" target="_blank" class="nyt-btn-secondary inline-flex items-center gap-1 text-[10px] sm:text-[11px] px-2 sm:px-2.5 py-1 rounded-sm transition shrink-0">
                        <span class="material-symbols-outlined !text-[13px]">print</span>
                        <span class="hidden sm:inline">Cetak Surat Kabar</span>
                    </a>
                </div>
            </div>

            <!-- Right: Reading Mode & Admin -->
            <div class="flex items-center justify-between w-full sm:w-auto gap-2">
                <div class="theme-controls flex items-center gap-0.5 sm:gap-1 p-0.5 rounded border border-[var(--nyt-gray-border)] bg-[var(--nyt-card-bg)]">
                    <button data-newspaper-theme="classic" class="px-2 py-0.5 text-[9px] sm:text-[10px] font-sans rounded cursor-pointer transition font-medium" title="Classic Newsprint">Classic</button>
                    <button data-newspaper-theme="sepia" class="px-2 py-0.5 text-[9px] sm:text-[10px] font-sans rounded cursor-pointer transition font-medium" title="Vintage Archival">Sepia</button>
                    <button data-newspaper-theme="night" class="px-2 py-0.5 text-[9px] sm:text-[10px] font-sans rounded cursor-pointer transition font-medium" title="Night Edition">Nighty</button>
                </div>

                @if(session('is_admin'))
                    <a href="{{ route('admin.index') }}" class="inline-flex items-center gap-1 bg-red-800 text-white text-[10px] sm:text-[11px] font-bold px-2.5 py-1 rounded-sm hover:bg-red-900 transition shrink-0">
                        <span class="material-symbols-outlined !text-[13px]">edit_note</span>
                        <span>Redaksi</span>
                    </a>
                @else
                    <a href="{{ route('admin.index') }}" class="inline-flex items-center gap-1 text-[var(--nyt-gray-muted)] hover:text-[var(--nyt-black)] text-[10px] sm:text-[11px] px-2 py-1 transition shrink-0">
                        <span class="material-symbols-outlined !text-[13px]">lock</span>
                        <span>Admin</span>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- 3. Classic NYT Masthead & Broadsheet Header -->
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 w-full pt-2 sm:pt-4">
        
        <!-- Masthead Grid: Left Ear, Center Old English Title, Right Ear -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-2 sm:gap-3 items-center py-2 border-b border-[var(--nyt-black)]">
            
            <!-- Left Ear -->
            <div class="md:col-span-3 text-center md:text-left border-b md:border-b-0 md:border-r border-[var(--nyt-gray-border)] pr-0 md:pr-3 pb-2 md:pb-0">
                <div class="text-[9px] sm:text-[10px] uppercase tracking-widest font-sans font-bold text-[var(--nyt-gray-muted)]">
                    Edisi Peringatan
                </div>
                <div class="text-[11px] sm:text-xs font-serif italic text-[var(--nyt-black)] mt-0.5 leading-snug">
                    {{ $settings->left_ear_text ?? "Special Commemorative Edition • Vol. XXIV No. 1 • Collector's Issue" }}
                </div>
            </div>

            <!-- Center Old English Masthead -->
            <div class="md:col-span-6 text-center px-1 sm:px-2 my-1 sm:my-0">
                <a href="{{ route('newspaper.index') }}" class="inline-block hover:opacity-90 transition max-w-full">
                    <h1 class="font-masthead text-3xl sm:text-6xl md:text-7xl font-bold tracking-tight text-[var(--nyt-black)] uppercase scale-y-110 select-none break-words leading-tight sm:leading-none">
                        {{ $settings->newspaper_title ?? 'THE CICI TIMES' }}
                    </h1>
                </a>
                <div class="text-[10px] sm:text-[11px] font-serif italic text-[var(--nyt-gray-muted)] mt-1 tracking-wide">
                    "{{ $settings->edition_motto ?? "All The Joy That's Fit To Celebrate" }}"
                </div>
            </div>

            <!-- Right Ear -->
            <div class="md:col-span-3 text-center md:text-right border-t md:border-t-0 md:border-l border-[var(--nyt-gray-border)] pl-0 md:pl-3 pt-2 md:pt-0">
                <div class="text-[9px] sm:text-[10px] uppercase tracking-widest font-sans font-bold text-[var(--nyt-gray-muted)]">
                    Prakiraan Perayaan
                </div>
                <div class="text-[11px] sm:text-xs font-serif italic text-[var(--nyt-black)] mt-0.5 leading-snug">
                    {{ $settings->right_ear_text ?? "Forecast: 100% Sunshine, Laughter & Confetti" }}
                </div>
            </div>
        </div>

        <!-- Sub-Masthead Metadata Bar (Issue, Date, Price, City) -->
        <div class="nyt-border-double py-1.5 my-1.5 text-center text-xs font-serif flex flex-col sm:flex-row items-center justify-between gap-1 px-2 text-[var(--nyt-gray-dark)]">
            <span class="font-sans text-[10px] sm:text-[11px] tracking-wider uppercase font-semibold">{{ $settings->volume_number ?? 'VOL. CLXXV... No. 59,880' }}</span>
            <span class="font-bold text-[12px] sm:text-[13px] text-[var(--nyt-black)] py-0.5 sm:py-0 border-y sm:border-y-0 border-[var(--nyt-gray-border)] sm:border-none w-full sm:w-auto">{{ $settings->issue_date }}</span>
            <span class="font-sans text-[10px] sm:text-[11px] tracking-wider uppercase font-semibold">{{ $settings->price ?? '$2.00 / PRICELESS' }}</span>
        </div>

        <!-- Section Navigation Ribbon -->
        <nav class="border-b-2 border-[var(--nyt-black)] py-1 mb-4 no-print overflow-x-auto scrollbar-none">
            <ul class="flex items-center justify-start sm:justify-center min-w-max gap-4 sm:gap-8 px-2 text-xs uppercase font-sans font-semibold tracking-wider text-[var(--nyt-black)]">
                <li><a href="{{ route('newspaper.index') }}#front-page" class="hover:underline">Halaman Utama</a></li>
                <li><a href="{{ route('newspaper.index') }}#lead-story" class="hover:underline">Berita Utama</a></li>
                <li><a href="{{ route('newspaper.index') }}#arts-leisure" class="hover:underline">Galeri dan Kenangan</a></li>
                <li><a href="{{ route('newspaper.index') }}#crossword-section" class="hover:underline text-amber-600 dark:text-amber-400">Teka-Teki Silang</a></li>
                <li><a href="{{ route('newspaper.index') }}#opinion-section" class="hover:underline">Opini & Surat Pembaca</a></li>
                <li><a href="{{ route('newspaper.index') }}#classifieds" class="hover:underline">Astrologi dan Iklan</a></li>
            </ul>
        </nav>
    </div>

    <!-- Main Content Area -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex-grow">
        @if(session('success'))
            <div class="mb-4 bg-emerald-100 dark:bg-emerald-950/80 border-l-4 border-emerald-600 p-3 text-sm text-emerald-900 dark:text-emerald-200 flex items-center justify-between no-print">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-emerald-700 dark:text-emerald-400 hover:opacity-80 font-bold">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 dark:bg-red-950/80 border-l-4 border-red-600 p-3 text-sm text-red-900 dark:text-red-200 flex items-center justify-between no-print">
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-red-700 dark:text-red-400 hover:opacity-80 font-bold">&times;</button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Broadsheet Footer -->
    <footer class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full mt-12 mb-6 pt-6 border-t-2 border-[var(--nyt-black)] text-center text-xs font-serif text-[var(--nyt-gray-muted)]">
        <div class="font-masthead text-2xl font-bold tracking-tight text-[var(--nyt-black)] mb-2">
            {{ $settings->newspaper_title ?? 'THE CICI TIMES' }}
        </div>
        <p class="max-w-2xl mx-auto text-xs italic mb-3">
            Diterbitkan dengan kebanggaan fill the blank. Hak cipta dilindungi oleh teman, keluarga, dan orang terkasih di seluruh dunia.
        </p>
        <div class="nyt-border-top-thin pt-2 text-[10px] uppercase font-sans tracking-widest flex flex-wrap items-center justify-between gap-2">
            <span>Edisi #1 • Isu Arsip Spesial</span>
            <span>Dicetak dengan Penuh Perayaan</span>
            <a href="{{ route('admin.index') }}" class="hover:underline">CMS Redaksi</a>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
