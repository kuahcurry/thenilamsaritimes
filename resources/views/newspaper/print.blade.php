<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="referrer" content="no-referrer">
    <title>{{ $settings->newspaper_title ?? 'THE CICI TIMES' }} — Commemorative Print Edition</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=UnifrakturMaguntia&family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,600;0,6..72,700;1,6..72,400&family=Inter:wght@400;600;700&display=swap">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Newsreader', Georgia, serif;
            color: #000;
            background: #fff;
            margin: 0;
            padding: 20px;
            font-size: 10pt;
            line-height: 1.35;
        }
        .page {
            max-width: 1000px;
            margin: 0 auto;
        }
        .print-btn-bar {
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
            background: #eee;
            border: 1px solid #ccc;
        }
        .font-masthead { font-family: 'UnifrakturMaguntia', serif; }
        .font-headline { font-family: 'Playfair Display', Georgia, serif; }
        .font-sans { font-family: 'Inter', sans-serif; }
        
        .border-double { border-top: 3px double #000; border-bottom: 3px double #000; }
        .border-top-thick { border-top: 2px solid #000; }
        .border-bottom-thick { border-bottom: 2px solid #000; }
        .border-right { border-right: 1px solid #999; }
        
        .grid-header { display: grid; grid-template-columns: 1fr 2fr 1fr; gap: 15px; align-items: center; text-align: center; }
        .grid-3col { display: grid; grid-template-columns: 1fr 2fr 1fr; gap: 15px; margin-top: 15px; }
        .grid-2col { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px; }

        .drop-cap::first-letter {
            float: left;
            font-family: 'Playfair Display', serif;
            font-size: 3.2rem;
            line-height: 0.8;
            margin-right: 6px;
            font-weight: bold;
        }

        @media print {
            .print-btn-bar { display: none !important; }
            body { padding: 0; }
            @page { margin: 0.4in; size: portrait; }
        }
    </style>
</head>
<body>

    <div class="print-btn-bar">
        <button onclick="window.print()" style="font-size: 14px; font-weight: bold; padding: 8px 18px; background: #000; color: #fff; border: none; cursor: pointer;">
            🖨️ Click to Print / Save as PDF Keepsake
        </button>
    </div>

    <div class="page">
        <!-- Masthead -->
        <div class="grid-header" style="border-bottom: 1px solid #000; padding-bottom: 8px;">
            <div style="text-align: left;">
                <div class="font-sans" style="font-size: 8pt; font-weight: bold; text-transform: uppercase;">Commemorative Edition</div>
                <div style="font-size: 8.5pt; font-style: italic;">{{ $settings->left_ear_text }}</div>
            </div>
            <div>
                <h1 class="font-masthead" style="font-size: 42pt; margin: 0; line-height: 1; text-transform: uppercase;">
                    {{ $settings->newspaper_title }}
                </h1>
                <div style="font-size: 8.5pt; font-style: italic; margin-top: 2px;">
                    "{{ $settings->edition_motto }}"
                </div>
            </div>
            <div style="text-align: right;">
                <div class="font-sans" style="font-size: 8pt; font-weight: bold; text-transform: uppercase;">Forecast</div>
                <div style="font-size: 8.5pt; font-style: italic;">{{ $settings->right_ear_text }}</div>
            </div>
        </div>

        <!-- Date & Info Bar -->
        <div class="border-double" style="padding: 3px 6px; font-size: 8.5pt; display: flex; justify-content: space-between; margin: 4px 0;">
            <span class="font-sans" style="font-weight: bold;">{{ $settings->volume_number }}</span>
            <span style="font-weight: bold;">{{ $settings->issue_date }}</span>
            <span class="font-sans" style="font-weight: bold;">{{ $settings->price }}</span>
        </div>

        <!-- Main 3 Column Broadside Grid -->
        <div class="grid-3col">
            
            <!-- Left Column -->
            <div class="border-right" style="padding-right: 12px;">
                @if(isset($heroSides[0]))
                    <div style="font-size: 7.5pt; font-weight: bold; font-family: 'Inter', sans-serif; text-transform: uppercase; color: #900;">
                        {{ $heroSides[0]->kicker }}
                    </div>
                    <h3 class="font-headline" style="font-size: 13pt; margin: 2px 0 4px 0; line-height: 1.15;">
                        {{ $heroSides[0]->title }}
                    </h3>
                    <div class="font-sans" style="font-size: 7.5pt; font-weight: bold; margin-bottom: 6px;">
                        {{ $heroSides[0]->author }} • {{ $heroSides[0]->dateline }}
                    </div>
                    <div style="text-align: justify; font-size: 8.5pt;">
                        {{ Str::limit($heroSides[0]->content, 450) }}
                    </div>
                @endif

                <div style="border-top: 1px solid #000; margin-top: 10px; padding-top: 8px;">
                    <div class="font-sans" style="font-size: 8pt; font-weight: bold; text-transform: uppercase;">Dispatches</div>
                    @foreach($briefs as $b)
                        <div style="margin-top: 6px; font-size: 8pt;">
                            <strong>{{ $b->title }}:</strong> {{ $b->content }}
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Center Lead Story -->
            <div style="padding: 0 5px;">
                @if($leadStory)
                    <div style="text-align: center;">
                        <div class="font-sans" style="font-size: 8pt; font-weight: bold; text-transform: uppercase; color: #900;">
                            {{ $leadStory->kicker }}
                        </div>
                        <h2 class="font-headline" style="font-size: 22pt; margin: 4px 0 6px 0; line-height: 1.1;">
                            {{ $leadStory->title }}
                        </h2>
                        @if($leadStory->subtitle)
                            <div style="font-size: 9.5pt; font-style: italic; margin-bottom: 6px;">{{ $leadStory->subtitle }}</div>
                        @endif
                    </div>

                    @if($leadStory->image_url)
                        <div style="margin: 6px 0; border: 1px solid #000; width: 100%; max-width: 320px; margin-left: auto; margin-right: auto;">
                            <img src="{{ $leadStory->image_url }}" alt="Photo" style="width: 100%; aspect-ratio: 4/5; object-fit: cover; filter: grayscale(100%); display: block;">
                            <div style="font-size: 7pt; font-style: italic; padding: 2px 4px; display: flex; justify-content: space-between;">
                                <span>{{ $leadStory->image_caption }}</span>
                                <span>{{ $leadStory->image_credit }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="font-sans" style="text-align: center; font-size: 8pt; font-weight: bold; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; padding: 2px 0; margin-bottom: 6px;">
                        {{ $leadStory->author }} • {{ $leadStory->dateline }}
                    </div>

                    <div class="drop-cap" style="text-align: justify; font-size: 9pt; line-height: 1.35;">
                        {{ Str::limit($leadStory->content, 650) }}
                    </div>
                @endif
            </div>

            <!-- Right Column -->
            <div style="border-left: 1px solid #999; padding-left: 12px;">
                @if(isset($heroSides[1]))
                    <div style="font-size: 7.5pt; font-weight: bold; font-family: 'Inter', sans-serif; text-transform: uppercase;">
                        {{ $heroSides[1]->kicker }}
                    </div>
                    <h3 class="font-headline" style="font-size: 13pt; margin: 2px 0 4px 0; line-height: 1.15;">
                        {{ $heroSides[1]->title }}
                    </h3>
                    <div class="font-sans" style="font-size: 7.5pt; font-weight: bold; margin-bottom: 6px;">
                        {{ $heroSides[1]->author }} • {{ $heroSides[1]->dateline }}
                    </div>
                    <div style="text-align: justify; font-size: 8.5pt;">
                        {{ Str::limit($heroSides[1]->content, 350) }}
                    </div>
                @endif

                <!-- Birthday Tributes Snippet -->
                <div style="border-top: 1px solid #000; margin-top: 10px; padding-top: 8px;">
                    <div class="font-sans" style="font-size: 8pt; font-weight: bold; text-transform: uppercase;">Letters to the Editor</div>
                    @foreach($tributes->take(2) as $tr)
                        <div style="margin-top: 6px; font-size: 8pt; font-style: italic; background: #f8f8f8; padding: 4px; border: 1px solid #ddd;">
                            "{{ Str::limit($tr->message, 120) }}"
                            <div class="font-sans" style="font-style: normal; font-weight: bold; font-size: 7pt; text-align: right; margin-top: 2px;">
                                — {{ $tr->sender_name }} ({{ $tr->sender_relation }})
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        <!-- Footer -->
        <div style="border-top: 2px solid #000; margin-top: 15px; padding-top: 6px; font-size: 7.5pt; text-align: center; font-family: 'Inter', sans-serif; text-transform: uppercase;">
            Published with Unconditional Admiration • The Commemorative Keepsake Edition
        </div>
    </div>

</body>
</html>
