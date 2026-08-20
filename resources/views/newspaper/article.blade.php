@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6 space-y-6">

    <div class="no-print">
        <a href="{{ route('newspaper.index') }}" class="inline-flex items-center gap-1 text-xs uppercase font-sans font-bold tracking-wider text-[var(--nyt-gray-muted)] hover:text-[var(--nyt-black)] transition">
            <span class="material-symbols-outlined !text-[14px]">arrow_back</span>
            <span>Kembali ke halaman utama</span>
        </a>
    </div>

    <!-- Article Header -->
    <header class="space-y-3 border-b-2 border-[var(--nyt-black)] pb-4">
        @if($article->kicker)
            <div class="text-xs font-sans font-bold uppercase tracking-widest text-[var(--nyt-red)]">
                {{ $article->kicker }}
            </div>
        @endif

        <h1 class="font-headline text-3xl sm:text-5xl md:text-6xl font-bold tracking-tight text-[var(--nyt-black)] leading-[1.15]">
            {{ $article->title }}
        </h1>

        @if($article->subtitle)
            <p class="font-serif text-lg sm:text-xl italic text-[var(--nyt-gray-dark)] leading-relaxed">
                {{ $article->subtitle }}
            </p>
        @endif

        <div class="nyt-border-double py-2 flex flex-wrap items-center justify-between text-xs font-sans uppercase tracking-wider text-[var(--nyt-gray-dark)]">
            <div class="font-bold">
                {{ $article->author }} • <span class="font-normal">{{ $article->dateline }}</span>
            </div>
            <div class="text-[11px] text-[var(--nyt-gray-muted)]">
                {{ $article->created_at->format('F d, Y') }}
            </div>
        </div>
    </header>

    <!-- Article Main Image -->
    @if($article->image_url)
        <div class="space-y-1.5 my-6 max-w-xl mx-auto">
            <div class="border border-[var(--nyt-black)] overflow-hidden aspect-[4/5] w-full">
                <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full aspect-[4/5] object-cover">
            </div>
            <div class="flex justify-between items-start text-xs text-[var(--nyt-gray-muted)] italic px-1">
                <span>{{ $article->image_caption ?? '' }}</span>
                <span class="font-sans not-italic font-semibold text-[10px] uppercase ml-4 shrink-0">{{ $article->image_credit ?? '' }}</span>
            </div>
        </div>
    @endif

    <!-- Editorial Article Content -->
    <article class="prose max-w-none text-base sm:text-lg leading-relaxed font-serif text-[var(--nyt-black)] drop-cap space-y-6">
        @php
            $paragraphs = explode("\n\n", $article->content);
        @endphp
        @foreach($paragraphs as $p)
            <p class="leading-relaxed">{{ $p }}</p>
        @endforeach
    </article>

    <!-- Share & Celebrate Box -->
    <div class="nyt-border-double p-4 my-8 bg-[var(--nyt-paper-darker)] flex flex-wrap items-center justify-between gap-4">
        <div>
            <h4 class="font-headline font-bold text-base text-[var(--nyt-black)]">Menikmati Tulisan ini?</h4>
            <p class="text-xs italic text-[var(--nyt-gray-muted)] font-serif">Tulis ucapan di bagian Opini & Surat Pembaca</p>
        </div>
        <div class="flex items-center gap-2">
            <button onclick="window.celebrateConfetti()" class="bg-amber-500 hover:bg-amber-600 text-black px-4 py-1.5 text-xs font-sans uppercase font-bold tracking-wider rounded-none cursor-pointer">
                Confetti!
            </button>
            <a href="{{ route('newspaper.index') }}#opinion-section" class="nyt-btn-primary px-4 py-1.5 text-xs font-sans uppercase font-bold tracking-wider">
                Tulis Ucapan!
            </a>
        </div>
    </div>

    <!-- Related Articles -->
    @if($relatedArticles->count() > 0)
        <div class="nyt-border-top-thick pt-6 space-y-4">
            <h3 class="font-headline text-xl font-bold uppercase tracking-wider text-[var(--nyt-black)]">
                Berita lain dari edisi ini
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($relatedArticles as $rel)
                    <div class="space-y-1 text-xs">
                        <div class="text-[9px] font-sans font-bold uppercase text-[var(--nyt-red)]">{{ $rel->kicker ?? 'SPECIAL' }}</div>
                        <h4 class="font-bold font-serif text-sm hover:underline">
                            <a href="{{ route('newspaper.article', $rel->id) }}">{{ $rel->title }}</a>
                        </h4>
                        <p class="text-[var(--nyt-gray-muted)] line-clamp-2 leading-tight">{{ Str::limit($rel->content, 90) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection
