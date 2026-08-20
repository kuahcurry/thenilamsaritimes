@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto my-12 p-8 bg-[var(--nyt-paper-darker)] border-2 border-[var(--nyt-black)] shadow-md">
    <div class="text-center space-y-2 mb-6">
        <div class="text-[10px] font-sans font-bold uppercase tracking-widest bg-[var(--nyt-black)] text-[var(--nyt-paper)] px-2 py-0.5 inline-block">
            Restricted Editorial Access
        </div>
        <h2 class="font-headline text-3xl font-bold text-[var(--nyt-black)]">Newsroom Admin Desk</h2>
        <p class="text-xs font-serif italic text-[var(--nyt-gray-muted)]">
            Enter the editorial desk PIN to manage sections, masthead, crossword, and tributes.
        </p>
    </div>

    <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">
                Editorial PIN
            </label>
            <input type="password" name="pin" required autofocus placeholder="Enter PIN (Default: 1234)" class="nyt-input w-full p-2.5 text-center text-lg tracking-widest font-bold">
            <span class="text-[10px] text-[var(--nyt-gray-muted)] italic block mt-1">Default PIN: <strong class="text-[var(--nyt-black)]">1234</strong></span>
        </div>

        <button type="submit" class="nyt-btn-primary w-full py-2.5 text-xs font-sans uppercase font-bold tracking-widest transition cursor-pointer">
            Unlock Newsroom Desk
        </button>
    </form>
</div>
@endsection
