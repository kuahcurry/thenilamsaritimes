@extends('layouts.app')

@section('content')
<div class="py-4 space-y-6">

    <!-- Admin Header Bar -->
    <div class="nyt-btn-primary p-4 flex flex-wrap items-center justify-between gap-4 border border-[var(--nyt-black)]">
        <div>
            <div class="text-[10px] font-sans font-bold uppercase tracking-widest text-amber-400">
                Editorial Control Desk
            </div>
            <h2 class="font-headline text-2xl sm:text-3xl font-bold tracking-tight">
                Newsroom Management Center
            </h2>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('newspaper.index') }}" target="_blank" class="nyt-btn-secondary inline-flex items-center gap-1.5 text-xs font-sans uppercase font-bold tracking-wider px-3.5 py-2 transition">
                <span class="material-symbols-outlined !text-[16px]">visibility</span>
                <span>Live Newspaper Preview</span>
            </a>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 bg-red-800 hover:bg-red-700 text-white text-xs font-sans uppercase font-bold tracking-wider px-3.5 py-2 transition cursor-pointer">
                    <span class="material-symbols-outlined !text-[16px]">logout</span>
                    <span>Exit Desk</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Material Web Tabs Navigation -->
    <md-tabs id="admin-tabs" aria-label="Newsroom sections">
        <md-primary-tab id="tab-masthead" active>
            <span class="material-symbols-outlined" slot="icon">newspaper</span>
            Masthead & Birthday Settings
        </md-primary-tab>
        <md-primary-tab id="tab-articles">
            <span class="material-symbols-outlined" slot="icon">article</span>
            Articles & Layout Grid ({{ $articles->count() }})
        </md-primary-tab>
        <md-primary-tab id="tab-crossword">
            <span class="material-symbols-outlined" slot="icon">grid_on</span>
            Crossword Puzzle
        </md-primary-tab>
        <md-primary-tab id="tab-tributes">
            <span class="material-symbols-outlined" slot="icon">favorite</span>
            Letters & Tributes ({{ $tributes->count() }})
        </md-primary-tab>
    </md-tabs>

    <!-- =========================================================================
         TAB 1: MASTHEAD & BIRTHDAY SETTINGS
    ========================================================================== -->
    <div id="panel-masthead" class="admin-tab-panel bg-[var(--nyt-paper-darker)] border border-[var(--nyt-gray-border)] p-6 space-y-6">
        <div class="border-b border-[var(--nyt-black)] pb-2">
            <h3 class="font-headline text-2xl font-bold text-[var(--nyt-black)]">
                Masthead & Birthday Commemorative Metadata
            </h3>
            <p class="text-xs italic font-serif text-[var(--nyt-gray-muted)]">
                Customize the frontpage title, birthday star's name & age, ears, ticker ribbon, date, and background audio toast.
            </p>
        </div>

        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Newspaper Title (Old English Masthead) *</label>
                    <input type="text" name="newspaper_title" value="{{ old('newspaper_title', $settings->newspaper_title) }}" required class="nyt-input w-full font-serif font-bold text-base">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Birthday Girl's Name *</label>
                    <input type="text" name="birthday_girl_name" value="{{ old('birthday_girl_name', $settings->birthday_girl_name) }}" required class="nyt-input w-full font-bold">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Age Milestone (e.g. 24) *</label>
                    <input type="text" name="age" value="{{ old('age', $settings->age) }}" required class="nyt-input w-full font-bold">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Edition Motto *</label>
                    <input type="text" name="edition_motto" value="{{ old('edition_motto', $settings->edition_motto) }}" required class="nyt-input w-full font-serif italic">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Left Ear (Commemorative Badge) *</label>
                    <input type="text" name="left_ear_text" value="{{ old('left_ear_text', $settings->left_ear_text) }}" required class="nyt-input w-full font-serif">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Right Ear (Celebration Forecast) *</label>
                    <input type="text" name="right_ear_text" value="{{ old('right_ear_text', $settings->right_ear_text) }}" required class="nyt-input w-full font-serif">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Breaking News Ticker Ribbon *</label>
                    <textarea name="breaking_ticker" rows="2" required class="nyt-textarea w-full font-mono">{{ old('breaking_ticker', $settings->breaking_ticker) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Issue Date String *</label>
                    <input type="text" name="issue_date" value="{{ old('issue_date', $settings->issue_date) }}" required class="nyt-input w-full font-serif">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Price Tag *</label>
                    <input type="text" name="price" value="{{ old('price', $settings->price) }}" required class="nyt-input w-full font-serif">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Volume & Issue Tag *</label>
                    <input type="text" name="volume_number" value="{{ old('volume_number', $settings->volume_number) }}" required class="nyt-input w-full font-serif">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Admin Newsroom PIN *</label>
                    <input type="text" name="admin_pin" value="{{ old('admin_pin', $settings->admin_pin) }}" required class="nyt-input w-full font-bold">
                </div>

                <div class="md:col-span-2 nyt-card p-4 space-y-3 mt-2">
                    <div class="flex items-center gap-2 border-b border-[var(--nyt-gray-border)] pb-1.5">
                        <span class="material-symbols-outlined !text-[18px]">graphic_eq</span>
                        <h4 class="font-headline font-bold text-sm text-[var(--nyt-black)]">Audio Toast & Background Music Setup</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Track Title</label>
                            <input type="text" name="audio_title" value="{{ old('audio_title', $settings->audio_title) }}" placeholder="e.g. Birthday Serenade & Voice Notes" class="nyt-input w-full">
                        </div>

                        <div>
                            <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">
                                Upload MP3 Directly from Device
                            </label>
                            <input type="file" name="audio_file" accept=".mp3,.ogg,.wav,.m4a,.aac" class="nyt-input w-full text-xs">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">
                                Or Audio URL / Local Path
                            </label>
                            <input type="text" name="audio_url" value="{{ old('audio_url', $settings->audio_url) }}" placeholder="/audio/song.mp3 or https://..." class="nyt-input w-full font-mono text-xs">
                            
                            <!-- Helpful Audio URL Guide -->
                            <div class="bg-[var(--nyt-paper)] border border-[var(--nyt-gray-border)] p-2.5 mt-2 text-[11px] text-[var(--nyt-gray-dark)] space-y-1">
                                <div class="font-bold font-sans uppercase text-[10px] text-[var(--nyt-black)] flex items-center gap-1">
                                    <span class="material-symbols-outlined !text-[14px]">info</span>
                                    <span>How to host & link your MP3:</span>
                                </div>
                                <ul class="list-disc list-inside space-y-0.5 text-[10.5px]">
                                    <li><strong>Direct Upload:</strong> Choose a file in "Upload MP3" above and click Save.</li>
                                    <li><strong>Local Folder:</strong> Copy your <code>song.mp3</code> into <code>public/audio/</code> and enter <code>/audio/song.mp3</code>.</li>
                                    <li><strong>Dropbox:</strong> Upload to Dropbox, create a share link, and change <code>dl=0</code> to <code>raw=1</code> (e.g. <code>https://www.dropbox.com/s/.../song.mp3?raw=1</code>).</li>
                                    <li><strong>Discord / GitHub:</strong> Upload to a Discord channel or GitHub release and paste the direct media URL.</li>
                                    <li><strong>Free Audio Hosts:</strong> Direct MP3 links from sites like Catbox.moe, Archive.org, or Cloudinary.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="pt-4 border-t border-[var(--nyt-gray-border)]">
                <button type="submit" class="nyt-btn-primary px-6 py-2.5 text-xs font-sans uppercase font-bold tracking-widest transition cursor-pointer">
                    Save Masthead & Settings
                </button>
            </div>
        </form>
    </div>

    <!-- =========================================================================
         TAB 2: ARTICLES & LAYOUT GRID MANAGER
    ========================================================================== -->
    <div id="panel-articles" class="admin-tab-panel hidden space-y-6">
        
        <div class="flex items-center justify-between bg-[var(--nyt-paper-darker)] p-4 border border-[var(--nyt-gray-border)]">
            <div>
                <h3 class="font-headline text-2xl font-bold text-[var(--nyt-black)]">Newsprint Layout & Articles</h3>
                <p class="text-xs italic font-serif text-[var(--nyt-gray-muted)]">Manage stories, kickers, photos, and assign layout zones.</p>
            </div>
            <button onclick="document.getElementById('new-article-dialog').show()" class="nyt-btn-primary inline-flex items-center gap-1.5 text-xs font-sans uppercase font-bold tracking-wider px-3.5 py-2 transition cursor-pointer">
                <span class="material-symbols-outlined !text-[16px]">add</span>
                <span>Compose New Story</span>
            </button>
        </div>

        <!-- Articles Table -->
        <div class="overflow-x-auto nyt-card">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-[var(--nyt-paper-darker)] border-b border-[var(--nyt-gray-border)] font-sans uppercase text-[10px] tracking-wider text-[var(--nyt-gray-dark)]">
                        <th class="p-3">Zone / Category</th>
                        <th class="p-3">Headline & Kicker</th>
                        <th class="p-3">Byline & Dateline</th>
                        <th class="p-3">Image</th>
                        <th class="p-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--nyt-gray-border)]">
                    @foreach($articles as $art)
                        <tr class="hover:bg-neutral-500/10">
                            <td class="p-3 align-top whitespace-nowrap">
                                <span class="inline-block px-2 py-0.5 text-[10px] font-sans font-bold uppercase tracking-wide bg-[var(--nyt-paper-darker)] text-[var(--nyt-black)] border border-[var(--nyt-gray-border)]">
                                    {{ str_replace('_', ' ', $art->layout_zone) }}
                                </span>
                                <div class="text-[10px] text-[var(--nyt-gray-muted)] uppercase mt-1">{{ $art->category }}</div>
                            </td>
                            <td class="p-3 align-top max-w-sm">
                                @if($art->kicker)
                                    <div class="text-[9px] font-sans font-bold uppercase text-[var(--nyt-red)]">{{ $art->kicker }}</div>
                                @endif
                                <div class="font-serif font-bold text-sm text-[var(--nyt-black)]">{{ $art->title }}</div>
                                @if($art->subtitle)
                                    <div class="text-[11px] font-serif italic text-[var(--nyt-gray-muted)] truncate">{{ $art->subtitle }}</div>
                                @endif
                            </td>
                            <td class="p-3 align-top whitespace-nowrap">
                                <div class="font-semibold text-[var(--nyt-black)]">{{ $art->author }}</div>
                                <div class="text-[10px] text-[var(--nyt-gray-muted)]">{{ $art->dateline }}</div>
                            </td>
                            <td class="p-3 align-top whitespace-nowrap">
                                @if($art->image_url)
                                    <img src="{{ $art->image_url }}" alt="Thumb" class="w-12 h-12 object-cover border border-[var(--nyt-gray-border)]">
                                @else
                                    <span class="text-[10px] text-[var(--nyt-gray-muted)] italic">No image</span>
                                @endif
                            </td>
                            <td class="p-3 align-top text-right whitespace-nowrap space-x-2">
                                <button type="button" onclick="openEditArticleModal({{ json_encode($art) }})" class="text-amber-700 dark:text-amber-400 hover:underline font-sans uppercase font-bold text-[10px] cursor-pointer">
                                    Edit
                                </button>

                                <form method="POST" action="{{ route('admin.articles.delete', $art->id) }}" class="inline" onsubmit="return confirm('Remove this article from the edition?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700 font-sans uppercase font-bold text-[10px] cursor-pointer">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- =========================================================================
         TAB 3: CROSSWORD PUZZLE EDITOR
    ========================================================================== -->
    <div id="panel-crossword" class="admin-tab-panel hidden bg-[var(--nyt-paper-darker)] border border-[var(--nyt-gray-border)] p-6 space-y-6">
        <div class="border-b border-[var(--nyt-black)] pb-2">
            <h3 class="font-headline text-2xl font-bold text-[var(--nyt-black)]">Crossword Puzzle Clues Editor</h3>
            <p class="text-xs italic font-serif text-[var(--nyt-gray-muted)]">Customize clues and answers about the birthday girl.</p>
        </div>

        @if($crossword)
            <form method="POST" action="{{ route('admin.crossword.update', $crossword->id) }}" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Puzzle Title</label>
                        <input type="text" name="title" value="{{ old('title', $crossword->title) }}" required class="nyt-input w-full">
                    </div>
                    <div>
                        <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Puzzle Subtitle</label>
                        <input type="text" name="subtitle" value="{{ old('subtitle', $crossword->subtitle) }}" class="nyt-input w-full">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Clues Across (JSON Format)</label>
                    <textarea name="clues_across" rows="6" class="nyt-textarea w-full font-mono text-xs">{{ json_encode($crossword->clues_across, JSON_PRETTY_PRINT) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Clues Down (JSON Format)</label>
                    <textarea name="clues_down" rows="6" class="nyt-textarea w-full font-mono text-xs">{{ json_encode($crossword->clues_down, JSON_PRETTY_PRINT) }}</textarea>
                </div>

                <div class="pt-2">
                    <button type="submit" class="nyt-btn-primary px-6 py-2.5 text-xs font-sans uppercase font-bold tracking-widest transition cursor-pointer">
                        Save Crossword Puzzle
                    </button>
                </div>
            </form>
        @endif
    </div>

    <!-- =========================================================================
         TAB 4: LETTERS & TRIBUTES MODERATION
    ========================================================================== -->
    <div id="panel-tributes" class="admin-tab-panel hidden space-y-6">
        <div class="bg-[var(--nyt-paper-darker)] p-4 border border-[var(--nyt-gray-border)]">
            <h3 class="font-headline text-2xl font-bold text-[var(--nyt-black)]">Birthday Letters & Tributes Moderation</h3>
            <p class="text-xs italic font-serif text-[var(--nyt-gray-muted)]">Approve, edit, or manage guestbook messages.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($tributes as $tr)
                <div class="nyt-card p-4 space-y-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="font-bold text-sm text-[var(--nyt-black)]">{{ $tr->sender_name }}</span>
                            @if($tr->sender_relation)
                                <span class="text-[10px] uppercase text-[var(--nyt-gray-muted)] ml-1">({{ $tr->sender_relation }})</span>
                            @endif
                        </div>
                        <span class="text-[10px] font-sans font-bold uppercase px-2 py-0.5 {{ $tr->is_approved ? 'bg-emerald-200 text-emerald-900 dark:bg-emerald-900 dark:text-emerald-200' : 'bg-neutral-300 text-neutral-800 dark:bg-neutral-800 dark:text-neutral-300' }}">
                            {{ $tr->is_approved ? 'Published' : 'Hidden' }}
                        </span>
                    </div>

                    <p class="text-xs font-serif italic text-[var(--nyt-gray-dark)] leading-relaxed">
                        "{{ $tr->message }}"
                    </p>

                    <div class="flex items-center justify-between pt-2 border-t border-[var(--nyt-gray-border)] text-xs">
                        <div class="flex items-center gap-3">
                            <button type="button" onclick="openEditTributeModal({{ json_encode($tr) }})" class="text-amber-700 dark:text-amber-400 hover:underline font-sans uppercase font-bold text-[10px] cursor-pointer">
                                Edit
                            </button>

                            <form method="POST" action="{{ route('admin.tributes.toggle', $tr->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="text-[var(--nyt-black)] hover:underline font-sans uppercase font-bold text-[10px] cursor-pointer">
                                    {{ $tr->is_approved ? 'Hide from Edition' : 'Publish to Edition' }}
                                </button>
                            </form>
                        </div>

                        <form method="POST" action="{{ route('admin.tributes.delete', $tr->id) }}" onsubmit="return confirm('Delete this tribute message?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700 font-sans uppercase font-bold text-[10px] cursor-pointer">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

<!-- 1. Compose Article Dialog -->
<md-dialog id="new-article-dialog" class="max-w-2xl">
    <div slot="headline" class="w-full px-8 pt-8">
        <div class="flex items-center justify-between border-b-2 border-[var(--nyt-black)] pb-4">
            <div class="font-headline text-xl font-bold text-[var(--nyt-black)]">
                Compose New Story for Newsprint
            </div>
            <button type="button" onclick="document.getElementById('new-article-dialog').close()" class="text-[var(--nyt-gray-muted)] hover:text-[var(--nyt-black)] text-2xl font-bold cursor-pointer px-2">
                &times;
            </button>
        </div>
    </div>
    <div slot="content" class="dialog-body space-y-5 px-8 py-4">
        <form id="new-article-form" method="POST" action="{{ route('admin.articles.store') }}" class="space-y-4">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Headline *</label>
                    <input type="text" name="title" required placeholder="e.g. EXTRAORDINARY AT 24..." class="nyt-input w-full font-serif font-bold">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Kicker (Overline Tag)</label>
                    <input type="text" name="kicker" placeholder="e.g. SPECIAL REPORT" class="nyt-input w-full">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Layout Zone *</label>
                    <select name="layout_zone" required class="nyt-select w-full font-sans font-semibold">
                        <option value="lead_story">Center Lead Story (Cover Hero)</option>
                        <option value="hero_side">Flanking Side Column (Left/Right)</option>
                        <option value="arts_leisure">Arts & Leisure Photo Spread</option>
                        <option value="opinion">Opinion & Guest Essay</option>
                        <option value="briefs">World Briefs / Dispatches</option>
                        <option value="classifieds">Classifieds & Horoscopes</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Subtitle / Deck</label>
                    <input type="text" name="subtitle" placeholder="A secondary explanatory summary..." class="nyt-input w-full font-serif italic">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Author Byline *</label>
                    <input type="text" name="author" value="Special to The Times" required class="nyt-input w-full">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Dateline</label>
                    <input type="text" name="dateline" value="NEW YORK" class="nyt-input w-full">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Article Content *</label>
                    <textarea name="content" rows="6" required placeholder="Write article narrative here. Paragraphs separated by blank lines will format into editorial columns." class="nyt-textarea w-full font-serif text-sm"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Feature Image URL</label>
                    <input type="url" name="image_url" placeholder="https://..." class="nyt-input w-full">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Image Caption</label>
                    <input type="text" name="image_caption" placeholder="Photo caption..." class="nyt-input w-full">
                </div>

                <input type="hidden" name="category" value="CELEBRATION">
            </div>
        </form>
    </div>

    <div slot="actions" class="w-full flex items-center justify-end gap-3 px-8 pt-4 pb-8 border-t border-[var(--nyt-gray-border)]">
        <button type="button" onclick="document.getElementById('new-article-dialog').close()" class="nyt-btn-secondary px-5 py-2.5 text-xs uppercase font-sans font-bold cursor-pointer">
            Cancel
        </button>
        <button type="button" onclick="document.getElementById('new-article-form').submit()" class="nyt-btn-primary px-6 py-2.5 text-xs uppercase font-sans font-bold tracking-wider transition cursor-pointer">
            Publish Story
        </button>
    </div>
</md-dialog>

<!-- 2. Edit Article Dialog -->
<md-dialog id="edit-article-dialog" class="max-w-2xl">
    <div slot="headline" class="w-full px-8 pt-8">
        <div class="flex items-center justify-between border-b-2 border-[var(--nyt-black)] pb-4">
            <div class="font-headline text-xl font-bold text-[var(--nyt-black)]">
                ✏️ Edit Story & Layout Placement
            </div>
            <button type="button" onclick="document.getElementById('edit-article-dialog').close()" class="text-[var(--nyt-gray-muted)] hover:text-[var(--nyt-black)] text-2xl font-bold cursor-pointer px-2">
                &times;
            </button>
        </div>
    </div>
    <div slot="content" class="dialog-body space-y-5 px-8 py-4">
        <form id="edit-article-form" method="POST" action="" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Headline *</label>
                    <input type="text" id="edit-art-title" name="title" required class="nyt-input w-full font-serif font-bold">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Kicker (Overline Tag)</label>
                    <input type="text" id="edit-art-kicker" name="kicker" class="nyt-input w-full">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Layout Zone *</label>
                    <select id="edit-art-zone" name="layout_zone" required class="nyt-select w-full font-sans font-semibold">
                        <option value="lead_story">Center Lead Story (Cover Hero)</option>
                        <option value="hero_side">Flanking Side Column (Left/Right)</option>
                        <option value="arts_leisure">Arts & Leisure Photo Spread</option>
                        <option value="opinion">Opinion & Guest Essay</option>
                        <option value="briefs">World Briefs / Dispatches</option>
                        <option value="classifieds">Classifieds & Horoscopes</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Subtitle / Deck</label>
                    <input type="text" id="edit-art-subtitle" name="subtitle" class="nyt-input w-full font-serif italic">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Author Byline *</label>
                    <input type="text" id="edit-art-author" name="author" required class="nyt-input w-full">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Dateline</label>
                    <input type="text" id="edit-art-dateline" name="dateline" class="nyt-input w-full">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Article Content *</label>
                    <textarea id="edit-art-content" name="content" rows="6" required class="nyt-textarea w-full font-serif text-sm"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Feature Image URL</label>
                    <input type="url" id="edit-art-image" name="image_url" class="nyt-input w-full">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Image Caption</label>
                    <input type="text" id="edit-art-caption" name="image_caption" class="nyt-input w-full">
                </div>

                <input type="hidden" name="category" value="CELEBRATION">
            </div>
        </form>
    </div>

    <div slot="actions" class="w-full flex items-center justify-end gap-3 px-8 pt-4 pb-8 border-t border-[var(--nyt-gray-border)]">
        <button type="button" onclick="document.getElementById('edit-article-dialog').close()" class="nyt-btn-secondary px-5 py-2.5 text-xs uppercase font-sans font-bold cursor-pointer">
            Cancel
        </button>
        <button type="button" onclick="document.getElementById('edit-article-form').submit()" class="nyt-btn-primary px-6 py-2.5 text-xs uppercase font-sans font-bold tracking-wider transition cursor-pointer">
            Update Story
        </button>
    </div>
</md-dialog>

<!-- 3. Edit Tribute Dialog -->
<md-dialog id="edit-tribute-dialog" class="max-w-lg">
    <div slot="headline" class="w-full px-8 pt-8">
        <div class="flex items-center justify-between border-b-2 border-[var(--nyt-black)] pb-4">
            <div class="font-headline text-xl font-bold text-[var(--nyt-black)]">
                ✏️ Edit Letter / Tribute Message
            </div>
            <button type="button" onclick="document.getElementById('edit-tribute-dialog').close()" class="text-[var(--nyt-gray-muted)] hover:text-[var(--nyt-black)] text-2xl font-bold cursor-pointer px-2">
                &times;
            </button>
        </div>
    </div>
    <div slot="content" class="dialog-body space-y-5 px-8 py-4">
        <form id="edit-tribute-form" method="POST" action="" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Sender Name *</label>
                    <input type="text" id="edit-tr-name" name="sender_name" required class="nyt-input w-full font-bold">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Relation / Title Attribute</label>
                    <input type="text" id="edit-tr-relation" name="sender_relation" placeholder="e.g. Best Friend, Sister" class="nyt-input w-full">
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Tribute Message *</label>
                    <textarea id="edit-tr-message" name="message" rows="5" required class="nyt-textarea w-full font-serif text-sm leading-relaxed"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-sans font-bold uppercase text-[var(--nyt-gray-dark)] mb-1">Photo URL (Optional)</label>
                    <input type="url" id="edit-tr-photo" name="photo_url" placeholder="https://..." class="nyt-input w-full">
                </div>
            </div>
        </form>
    </div>

    <div slot="actions" class="w-full flex items-center justify-end gap-3 px-8 pt-4 pb-8 border-t border-[var(--nyt-gray-border)]">
        <button type="button" onclick="document.getElementById('edit-tribute-dialog').close()" class="nyt-btn-secondary px-5 py-2.5 text-xs uppercase font-sans font-bold cursor-pointer">
            Cancel
        </button>
        <button type="button" onclick="document.getElementById('edit-tribute-form').submit()" class="nyt-btn-primary px-6 py-2.5 text-xs uppercase font-sans font-bold tracking-wider transition cursor-pointer">
            Update Tribute
        </button>
    </div>
</md-dialog>
@endsection

@push('scripts')
<script>
    function openEditArticleModal(art) {
        const dialog = document.getElementById('edit-article-dialog');
        const form = document.getElementById('edit-article-form');
        if (!dialog || !form) return;

        form.action = `/admin/articles/${art.id}`;
        document.getElementById('edit-art-title').value = art.title || '';
        document.getElementById('edit-art-kicker').value = art.kicker || '';
        document.getElementById('edit-art-subtitle').value = art.subtitle || '';
        document.getElementById('edit-art-zone').value = art.layout_zone || 'lead_story';
        document.getElementById('edit-art-author').value = art.author || '';
        document.getElementById('edit-art-dateline').value = art.dateline || '';
        document.getElementById('edit-art-content').value = art.content || '';
        document.getElementById('edit-art-image').value = art.image_url || '';
        document.getElementById('edit-art-caption').value = art.image_caption || '';

        dialog.show();
    }

    function openEditTributeModal(tr) {
        const dialog = document.getElementById('edit-tribute-dialog');
        const form = document.getElementById('edit-tribute-form');
        if (!dialog || !form) return;

        form.action = `/admin/tributes/${tr.id}`;
        document.getElementById('edit-tr-name').value = tr.sender_name || '';
        document.getElementById('edit-tr-relation').value = tr.sender_relation || '';
        document.getElementById('edit-tr-message').value = tr.message || '';
        document.getElementById('edit-tr-photo').value = tr.photo_url || '';

        dialog.show();
    }

    document.addEventListener('DOMContentLoaded', () => {
        const tabs = document.getElementById('admin-tabs');
        if (!tabs) return;

        const panels = {
            0: document.getElementById('panel-masthead'),
            1: document.getElementById('panel-articles'),
            2: document.getElementById('panel-crossword'),
            3: document.getElementById('panel-tributes')
        };

        tabs.addEventListener('change', () => {
            const activeIndex = tabs.activeTabIndex;
            Object.keys(panels).forEach(idx => {
                if (parseInt(idx) === activeIndex) {
                    panels[idx].classList.remove('hidden');
                } else {
                    panels[idx].classList.add('hidden');
                }
            });
        });
    });
</script>
@endpush
