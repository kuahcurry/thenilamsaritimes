@extends('layouts.app')

@section('content')
<div id="front-page" class="space-y-8">

    <!-- =========================================================================
         SECTION 1: THE FRONT PAGE HERO & MULTI-COLUMN BROADSHEET GRID
    ========================================================================== -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pt-2">
        
        <!-- LEFT COLUMN (3 cols): Retrospectives, Essay & Side Story -->
        <div class="lg:col-span-3 space-y-6 lg:border-r border-[var(--nyt-gray-border)] lg:pr-5">
            @if(isset($heroSides[0]))
                <article class="space-y-2">
                    <div class="text-[10px] font-bold font-sans uppercase tracking-widest text-[var(--nyt-red)]">
                        {{ $heroSides[0]->kicker ?? 'LIFE & LETTERS' }}
                    </div>
                    <h3 class="font-headline text-xl sm:text-2xl font-bold leading-tight hover:underline cursor-pointer">
                        <a href="{{ route('newspaper.article', $heroSides[0]->id) }}">{{ $heroSides[0]->title }}</a>
                    </h3>
                    @if($heroSides[0]->subtitle)
                        <p class="text-xs italic text-[var(--nyt-gray-muted)] leading-snug font-serif">{{ $heroSides[0]->subtitle }}</p>
                    @endif
                    <div class="text-[10px] uppercase font-sans font-semibold text-[var(--nyt-gray-dark)] pt-1">
                        {{ $heroSides[0]->author }} • {{ $heroSides[0]->dateline }}
                    </div>

                    @if($heroSides[0]->image_url)
                        <div class="pt-2">
                            <div class="overflow-hidden aspect-[4/5] w-full border border-[var(--nyt-gray-border)]">
                                <img src="{{ $heroSides[0]->image_url }}" alt="{{ $heroSides[0]->title }}" loading="lazy" decoding="async" class="w-full h-full aspect-[4/5] object-cover filter grayscale hover:grayscale-0 transition duration-300">
                            </div>
                            @if($heroSides[0]->image_caption)
                                <p class="text-[10px] text-[var(--nyt-gray-muted)] italic mt-1 leading-tight">{{ $heroSides[0]->image_caption }}</p>
                            @endif
                        </div>
                    @endif

                    <div class="text-xs text-[var(--nyt-gray-dark)] line-clamp-6 leading-relaxed pt-1">
                        {{ Str::limit($heroSides[0]->content, 260) }}
                    </div>
                    <a href="{{ route('newspaper.article', $heroSides[0]->id) }}" class="inline-block text-[11px] font-sans font-bold uppercase tracking-wider text-[var(--nyt-black)] hover:underline">
                        Lanjut Membaca &rarr;
                    </a>
                </article>
            @endif

            <!-- Mini Dispatches / Briefs -->
            <div class="nyt-border-top-thin pt-4 space-y-4">
                <div class="text-[11px] font-bold font-sans uppercase tracking-wider text-[var(--nyt-black)]">
                    Kabar Dunia Hari Ini
                </div>
                @foreach($briefs as $brief)
                    <div class="space-y-1 text-xs">
                        <h4 class="font-bold font-serif text-[var(--nyt-black)]">{{ $brief->title }}</h4>
                        <p class="text-[var(--nyt-gray-muted)] leading-snug">{{ $brief->content }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- CENTER COLUMN (6 cols): THE DOMINANT LEAD BANNER STORY -->
        <div id="lead-story" class="lg:col-span-6 space-y-4 lg:px-2">
            @if($leadStory)
                <article class="space-y-3">
                    <div class="text-center">
                        <span class="text-[11px] font-bold font-sans uppercase tracking-widest text-[var(--nyt-red)] inline-block border-b border-[var(--nyt-red)] pb-0.5 mb-1">
                            {{ $leadStory->kicker ?? 'COMMEMORATIVE COVER STORY' }}
                        </span>
                        <h2 class="font-headline text-2xl sm:text-4xl md:text-5xl font-bold tracking-tight leading-[1.15] text-[var(--nyt-black)]">
                            <a href="{{ route('newspaper.article', $leadStory->id) }}" class="hover:underline">
                                {{ $leadStory->title }}
                            </a>
                        </h2>
                        @if($leadStory->subtitle)
                            <p class="font-serif italic text-sm sm:text-base text-[var(--nyt-gray-dark)] mt-2 max-w-xl mx-auto leading-relaxed">
                                {{ $leadStory->subtitle }}
                            </p>
                        @endif
                    </div>

                    <!-- Hero Photojournalism Feature Image -->
                    @if($leadStory->image_url)
                        <div class="my-3">
                            <div class="overflow-hidden border border-[var(--nyt-black)] aspect-[4/5] w-full max-w-lg mx-auto">
                                <img src="{{ $leadStory->image_url }}" alt="{{ $leadStory->title }}" fetchpriority="high" decoding="async" class="w-full h-full aspect-[4/5] object-cover filter contrast-[1.05] hover:scale-[1.01] transition duration-500">
                            </div>
                            <div class="flex justify-between items-start text-[11px] text-[var(--nyt-gray-muted)] italic mt-1.5 px-0.5 leading-snug">
                                <span>{{ $leadStory->image_caption ?? 'Sosok istimewa yang dirayakan pada momen spesialnya.' }}</span>
                                <span class="font-sans not-italic text-[10px] uppercase font-semibold text-[var(--nyt-gray-dark)] shrink-0 ml-3">
                                    {{ $leadStory->image_credit ?? 'Biro Foto The Times' }}
                                </span>
                            </div>
                        </div>
                    @endif

                    <!-- Byline & Dateline -->
                    <div class="text-center font-sans text-xs font-semibold uppercase tracking-wider text-[var(--nyt-gray-dark)] py-1 border-y border-[var(--nyt-gray-border)]">
                        {{ $leadStory->author }} • <span class="font-normal">{{ $leadStory->dateline }}</span>
                    </div>

                    <!-- Lead Story Editorial Body (Drop Cap) -->
                    <div class="text-sm sm:text-base leading-relaxed text-[var(--nyt-black)] drop-cap space-y-4 pt-1">
                        @php
                            $paragraphs = explode("\n\n", $leadStory->content);
                        @endphp
                        @foreach($paragraphs as $p)
                            <p>{{ $p }}</p>
                        @endforeach
                    </div>

                    <div class="pt-2 text-center">
                        <a href="{{ route('newspaper.article', $leadStory->id) }}" class="nyt-btn-primary inline-flex items-center gap-1 font-sans text-xs uppercase font-bold tracking-widest px-4 py-2 hover:opacity-90 transition">
                            <span>Baca Liputan Lengkap</span>
                            <span class="material-symbols-outlined !text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </article>
            @endif
        </div>

        <!-- RIGHT COLUMN (3 cols): Right Column Hero & The Interactive Mini Crossword -->
        <div class="lg:col-span-3 space-y-6 lg:border-l border-[var(--nyt-gray-border)] lg:pl-5">
            @if(isset($heroSides[1]))
                <article class="space-y-2">
                    <div class="text-[10px] font-bold font-sans uppercase tracking-widest text-[var(--nyt-accent)]">
                        {{ $heroSides[1]->kicker ?? 'STYLE & CULTURE' }}
                    </div>
                    <h3 class="font-headline text-xl sm:text-2xl font-bold leading-tight hover:underline cursor-pointer">
                        <a href="{{ route('newspaper.article', $heroSides[1]->id) }}">{{ $heroSides[1]->title }}</a>
                    </h3>
                    @if($heroSides[1]->subtitle)
                        <p class="text-xs italic text-[var(--nyt-gray-muted)] leading-snug font-serif">{{ $heroSides[1]->subtitle }}</p>
                    @endif
                    <div class="text-[10px] uppercase font-sans font-semibold text-[var(--nyt-gray-dark)] pt-1">
                        {{ $heroSides[1]->author }} • {{ $heroSides[1]->dateline }}
                    </div>
                    <div class="text-xs text-[var(--nyt-gray-dark)] line-clamp-6 leading-relaxed pt-1">
                        {{ Str::limit($heroSides[1]->content, 260) }}
                    </div>
                    <a href="{{ route('newspaper.article', $heroSides[1]->id) }}" class="inline-block text-[11px] font-sans font-bold uppercase tracking-wider text-[var(--nyt-black)] hover:underline">
                        Lanjut Membaca &rarr;
                    </a>
                </article>
            @endif

            <!-- =========================================================================
                 THE NYT BIRTHDAY MINI CROSSWORD WIDGET
            ========================================================================== -->
            <div id="crossword-section" class="bg-[var(--nyt-paper-darker)] border-2 border-[var(--nyt-black)] p-4 shadow-sm">
                <div class="text-center mb-3">
                    <div class="text-[9px] font-sans uppercase font-bold tracking-widest bg-amber-500 text-black inline-block px-1.5 py-0.5">
                        Permainan Interaktif
                    </div>
                    <h3 class="font-headline text-xl font-bold mt-1 text-[var(--nyt-black)]">
                        {{ $crossword->title ?? 'The Birthday Mini' }}
                    </h3>
                    <p class="text-[11px] font-serif italic text-[var(--nyt-gray-muted)]">
                        {{ $crossword->subtitle ?? "Uji wawasanmu tentang perempuan yang dirayakan!" }}
                    </p>
                </div>

                <!-- 5x5 Crossword Grid -->
                <div id="nyt-crossword-board" class="crossword-grid-container mb-3"></div>

                <!-- Crossword Controls -->
                <div class="flex items-center justify-between gap-2 mb-3 text-[11px]">
                    <button onclick="window.clearCrossword()" class="text-[var(--nyt-gray-muted)] hover:text-[var(--nyt-black)] underline cursor-pointer">Hapus</button>
                    <button onclick="window.revealCrossword()" class="text-amber-700 dark:text-amber-400 font-bold hover:underline cursor-pointer">Lihat Solusi</button>
                </div>

                <!-- Clues Accordion / Tabs -->
                <div class="text-xs space-y-2 border-t border-[var(--nyt-gray-border)] pt-2 max-h-48 overflow-y-auto">
                    <div>
                        <div class="font-sans font-bold uppercase text-[10px] tracking-wider text-[var(--nyt-black)] mb-1">Mendatar</div>
                        <ul class="space-y-1 text-[11px]">
                            @if(isset($crossword->clues_across))
                                @foreach($crossword->clues_across as $c)
                                    <li class="clue-item text-[var(--nyt-gray-dark)]"><strong class="font-sans text-[var(--nyt-black)]">{{ $c['number'] ?? '' }}.</strong> {{ $c['clue'] ?? '' }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="pt-1 border-t border-[var(--nyt-gray-border)]">
                        <div class="font-sans font-bold uppercase text-[10px] tracking-wider text-[var(--nyt-black)] mb-1">Menurun</div>
                        <ul class="space-y-1 text-[11px]">
                            @if(isset($crossword->clues_down))
                                @foreach($crossword->clues_down as $c)
                                    <li class="clue-item text-[var(--nyt-gray-dark)]"><strong class="font-sans text-[var(--nyt-black)]">{{ $c['number'] ?? '' }}.</strong> {{ $c['clue'] ?? '' }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- =========================================================================
         SECTION 2: ARTS & LEISURE PHOTOJOURNALISM GALLERY
    ========================================================================== -->
    <div id="arts-leisure" class="nyt-border-top-thick pt-6 space-y-4">
        <div class="flex items-center justify-between border-b border-[var(--nyt-black)] pb-1">
            <h3 class="font-headline text-2xl font-bold uppercase tracking-wide text-[var(--nyt-black)]">
                Galeri Fotografi
            </h3>
            <span class="font-sans text-[11px] uppercase tracking-widest text-[var(--nyt-gray-muted)]">
                Bagian Arsip II
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($artsLeisure as $art)
                <div class="space-y-2">
                    @if($art->image_url)
                        <div class="overflow-hidden border border-[var(--nyt-gray-border)] aspect-[4/5] w-full">
                            <img src="{{ $art->image_url }}" alt="{{ $art->title }}" loading="lazy" decoding="async" class="w-full h-full aspect-[4/5] object-cover filter grayscale hover:grayscale-0 transition duration-500">
                        </div>
                    @endif
                    <div class="text-[10px] font-sans font-bold uppercase tracking-widest text-[var(--nyt-gray-muted)]">
                        {{ $art->kicker ?? 'PORTFOLIO' }}
                    </div>
                    <h4 class="font-headline text-lg font-bold hover:underline text-[var(--nyt-black)]">
                        <a href="{{ route('newspaper.article', $art->id) }}">{{ $art->title }}</a>
                    </h4>
                    <p class="text-xs text-[var(--nyt-gray-dark)] leading-relaxed">
                        {{ Str::limit($art->content, 180) }}
                    </p>
                    @if($art->image_caption)
                        <div class="text-[10px] italic text-[var(--nyt-gray-muted)] border-t border-[var(--nyt-gray-border)] pt-1">
                            {{ $art->image_caption }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- =========================================================================
         SECTION 3: OPINION & "LETTERS TO THE EDITOR" (GUESTBOOK TRIBUTES)
    ========================================================================== -->
    <div id="opinion-section" class="nyt-border-top-thick pt-6 space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b-2 border-[var(--nyt-black)] pb-2">
            <div>
                <h3 class="font-headline text-2xl sm:text-3xl font-bold tracking-tight text-[var(--nyt-black)]">
                    Opini & Surat Pembaca
                </h3>
                <span class="font-sans text-[11px] uppercase tracking-widest text-[var(--nyt-gray-muted)]">
                    Bagian Arsip III
                </span>
                <p class="text-xs italic font-serif text-[var(--nyt-gray-muted)]">
                    Esai, pesan, dan ucapan perayaan dari orang-orang yang berteman dengan Cici.
                </p>
            </div>

            <!-- Material Web Button to Open Tribute Dialog -->
            <button onclick="document.getElementById('tribute-modal').show()" class="nyt-btn-primary inline-flex items-center gap-1.5 text-xs font-sans uppercase font-bold tracking-wider px-3.5 py-2 transition cursor-pointer">
                <span class="material-symbols-outlined !text-[16px]">edit</span>
                <span>Kirim Surat Ucapan</span>
            </button>
        </div>

        <!-- Featured Op-Ed Essay -->
        @if(isset($opinions[0]))
            <div class="bg-[var(--nyt-paper-darker)] p-6 border-l-4 border-[var(--nyt-black)]">
                <div class="max-w-3xl space-y-2">
                    <span class="text-[10px] font-sans font-bold uppercase tracking-widest text-[var(--nyt-red)]">{{ $opinions[0]->kicker ?? 'ESAI TAMU' }}</span>
                    <h4 class="font-headline text-2xl font-bold text-[var(--nyt-black)]">
                        <a href="{{ route('newspaper.article', $opinions[0]->id) }}" class="hover:underline">{{ $opinions[0]->title }}</a>
                    </h4>
                    <div class="text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)]">{{ $opinions[0]->author }}</div>
                    <div class="text-sm font-serif italic leading-relaxed text-[var(--nyt-gray-dark)] pt-2 whitespace-pre-line">
                        {{ $opinions[0]->content }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Guestbook / Tributes Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @forelse($tributes as $tribute)
                <div class="tribute-box space-y-2">
                    <div class="text-sm font-serif italic text-[var(--nyt-gray-dark)] pt-3 leading-relaxed">
                        "{{ $tribute->message }}"
                    </div>
                    <div class="nyt-border-top-thin pt-2 flex items-center justify-between text-xs font-sans">
                        <span class="font-bold text-[var(--nyt-black)]">{{ $tribute->sender_name }}</span>
                        @if($tribute->sender_relation)
                            <span class="text-[10px] uppercase tracking-wider text-[var(--nyt-gray-muted)] bg-[var(--nyt-paper-darker)] px-1.5 py-0.5 border border-[var(--nyt-gray-border)]">
                                {{ $tribute->sender_relation }}
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-6 text-xs text-[var(--nyt-gray-muted)] italic">
                    Belum ada surat yang diterbitkan. Jadilah yang pertama menulis ucapan!
                </div>
            @endforelse
        </div>
    </div>

    <!-- =========================================================================
         SECTION 4: CLASSIFIEDS, HOROSCOPES & THE BACK PAGE
    ========================================================================== -->
    <div id="classifieds" class="nyt-border-top-thick pt-6 space-y-4">
        <div class="text-[11px] font-sans font-bold uppercase tracking-widest text-center border-b border-[var(--nyt-gray-border)] pb-1 text-[var(--nyt-black)]">
            Bagian Arsip IV • Baris Iklan, Astrologi & Pengumuman Publik
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs">
            @foreach($classifieds as $item)
                <div class="border border-[var(--nyt-gray-border)] p-3 space-y-1 bg-[var(--nyt-card-bg)]">
                    <div class="font-bold font-sans text-[10px] uppercase text-[var(--nyt-gray-muted)]">{{ $item->kicker ?? 'PENGUMUMAN' }}</div>
                    <h5 class="font-bold font-serif text-sm text-[var(--nyt-black)]">{{ $item->title }}</h5>
                    <p class="text-[var(--nyt-gray-dark)] leading-snug">{{ $item->content }}</p>
                </div>
            @endforeach
        </div>
    </div>

</div>

<!-- =========================================================================
     MODALS: SUBMIT TRIBUTE DIALOG (MATERIAL WEB)
========================================================================== -->
<md-dialog id="tribute-modal" class="max-w-xl w-full">
    <div slot="headline" class="w-full px-4 sm:px-8 pt-4 sm:pt-8">
        <div class="flex items-center justify-between border-b-2 border-[var(--nyt-black)] pb-3 sm:pb-4">
            <div class="flex items-center gap-2.5">
                <div>
                    <div class="text-[9px] font-sans font-bold uppercase tracking-widest text-[var(--nyt-red)]">
                        Laporan Peringatan
                    </div>
                    <h3 class="font-headline text-xl sm:text-2xl font-bold text-[var(--nyt-black)] leading-tight">
                        Ucapan ke Perempuan yang Dirayakan
                    </h3>
                </div>
            </div>
            <button type="button" onclick="document.getElementById('tribute-modal').close()" class="text-[var(--nyt-gray-muted)] hover:text-[var(--nyt-black)] text-2xl font-bold cursor-pointer px-2" title="Close">
                &times;
            </button>
        </div>
    </div>
    
    <div slot="content" class="dialog-body space-y-4 px-4 sm:px-8 py-3 sm:py-4">
        <form id="tribute-form" method="POST" action="{{ route('newspaper.tribute.submit') }}" class="space-y-4">
            @csrf
            <p class="text-xs font-serif italic text-[var(--nyt-gray-muted)] bg-[var(--nyt-card-bg)] p-3 border border-[var(--nyt-gray-border)] shadow-sm">
                "Ucapan tulusmu akan dipublikasikan di rubrik Surat pada {{ $settings->newspaper_title ?? 'The Times' }}."
            </p>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">
                        Nama Koresponden *
                    </label>
                    <input type="text" name="sender_name" required placeholder="cth. Fina dan Dea" class="nyt-input w-full font-bold">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">
                        Hubungan / Status
                    </label>
                    <input type="text" name="sender_relation" placeholder="cth. Sahabat, Rekan, Teman" class="nyt-input w-full">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">
                        Ucapan Ulang Tahunmu *
                    </label>
                    <textarea name="message" rows="5" required placeholder="Tulis ucapan, kenangan indah, atau pesan yang ingin Anda sampaikan di sini..." class="nyt-textarea w-full font-serif text-sm leading-relaxed"></textarea>
                </div>
            </div>
        </form>
    </div>

    <div slot="actions" class="w-full flex items-center justify-end gap-2 sm:gap-3 px-4 sm:px-8 pt-3 sm:pt-4 pb-4 sm:pb-8 border-t border-[var(--nyt-gray-border)]">
        <button type="button" onclick="document.getElementById('tribute-modal').close()" class="nyt-btn-secondary px-4 sm:px-5 py-2 sm:py-2.5 text-xs uppercase font-sans font-bold cursor-pointer">
            Batal
        </button>
        <button type="button" onclick="document.getElementById('tribute-form').submit()" class="nyt-btn-primary px-5 sm:px-6 py-2 sm:py-2.5 text-xs font-sans uppercase font-bold tracking-wider transition cursor-pointer">
            Terbitkan Surat &rarr;
        </button>
    </div>
</md-dialog>

<!-- Crossword Victory Dialog -->
<md-dialog id="crossword-victory-dialog" class="max-w-md">
    <div slot="headline" class="w-full text-center px-8 pt-8">
        <div class="font-headline text-2xl font-bold text-amber-900 dark:text-amber-400 border-b-2 border-[var(--nyt-black)] pb-3">
            TEKA-TEKI SELESAI!
        </div>
    </div>
    <div slot="content" class="dialog-body text-center space-y-4 py-4 px-8">
        <p class="text-sm font-serif italic text-[var(--nyt-gray-dark)] leading-relaxed">
            "Pinter banget njir! Kamu dah membuktikan wawasanmu tentang bintang selatan kita {{ $settings->birthday_girl_name ?? 'Cici' }}!"
        </p>
        <div class="text-5xl py-3">Cheers!</div>
    </div>
    <div slot="actions" class="w-full flex justify-center pb-8 pt-4 border-t border-[var(--nyt-gray-border)]">
        <button type="button" onclick="document.getElementById('crossword-victory-dialog').close()" class="nyt-btn-primary px-6 py-2.5 text-xs uppercase font-sans font-bold cursor-pointer">
            Tutup & Lanjut Membaca
        </button>
    </div>
</md-dialog>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const gridData = @json($crossword->grid_matrix ?? []);
        const cluesAcross = @json($crossword->clues_across ?? []);
        const cluesDown = @json($crossword->clues_down ?? []);
        
        // ... (rest of the crossword script remains unchanged)
        if (window.initCrossword && gridData.length > 0) {
            window.initCrossword(gridData, cluesAcross, cluesDown);
        }
    });
</script>
@endpush
