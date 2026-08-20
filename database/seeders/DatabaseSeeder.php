<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\CrosswordPuzzle;
use App\Models\NewspaperSetting;
use App\Models\TributeMessage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Newspaper Settings
        NewspaperSetting::updateOrCreate(
            ['id' => 1],
            [
                'newspaper_title' => 'THE CICI TIMES',
                'birthday_girl_name' => 'Cici',
                'age' => '24',
                'edition_motto' => "All The Joy That's Fit To Celebrate",
                'left_ear_text' => "Special Commemorative Edition • Vol. XXIV No. 1 • Collector's Issue",
                'right_ear_text' => 'Forecast: 100% Sunshine, Laughter & Confetti',
                'breaking_ticker' => "BREAKING: Global Celebrations Underway for Cici's 24th Birthday! • International Accord Declares Today a Day of Joy • Historic Milestones Reached",
                'issue_date' => 'Thursday, August 20, 2026',
                'price' => '$2.00 / PRICELESS',
                'volume_number' => 'VOL. CLXXV... No. 59,880',
                'audio_title' => 'Lofi Birthday Acoustic & Vinyl Wishes',
                'audio_url' => 'https://commondatastorage.googleapis.com/codeskulptor-demos/riceracer_assets/music/menu.ogg',
                'admin_pin' => '1234',
            ]
        );

        // 2. Articles
        Article::truncate();

        // Lead Story
        Article::create([
            'title' => 'EXTRAORDINARY AT 24: CICI MARKS ANOTHER ICONIC YEAR OF BRILLIANCE & GRACE',
            'kicker' => 'COMMEMORATIVE COVER STORY',
            'subtitle' => 'From remarkable milestones to unforgettable laughter, a tribute to a woman whose radiance inspires everyone around her.',
            'author' => 'By ELEANOR VANCE',
            'dateline' => 'NEW YORK',
            'content' => "In an extraordinary turn of events celebrated across continents and time zones, Cici marks her 24th birthday today with characteristic elegance and poise. Observers and loved ones report that her presence continues to illuminate every room she enters, bringing an unmatched blend of intellect, warmth, and infectious enthusiasm.\n\nOver the past year, her journey has been punctuated by creative breakthroughs, unwavering kindness, and an uncanny ability to turn ordinary days into cherished memories. Friends describe her as both an anchor and a spark plug—someone who listens with profound empathy while continually pushing the boundaries of what is possible.\n\nAs the dawn breaks on this milestone year, commentators worldwide agree that chapter 24 promises to be the most captivating one yet. Celebrations are expected to continue well into the evening, marked by gourmet treats, heartfelt toasts, and the eternal glow of true friendship.",
            'image_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=1200&q=80',
            'image_caption' => 'The guest of honor pictured on the eve of her 24th birthday, poised for an extraordinary chapter ahead.',
            'image_credit' => 'Photo: The Times Archival Bureau',
            'layout_zone' => 'lead_story',
            'category' => 'FRONT PAGE',
            'is_featured' => true,
            'order_num' => 1,
        ]);

        // Left Column Story
        Article::create([
            'title' => 'THE ARCHITECTURE OF A KIND HEART: AN EDITORIAL RETROSPECTIVE',
            'kicker' => 'LIFE & LETTERS',
            'subtitle' => 'How small daily gestures and thoughtful empathy created an enduring legacy of affection.',
            'author' => 'By ARTHUR P. STERLING',
            'dateline' => 'PARIS',
            'content' => "Historians of the heart often debate what makes a person truly unforgettable. In Cici's case, the answer lies in the subtle art of caring deeply.\n\nWhether sending the perfect comforting message at just the right hour, remembering the smallest details about someone's dreams, or sharing an uncontrollable laugh over inside jokes, her impact is measured not in grand declarations, but in steady, heartfelt warmth.",
            'image_url' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=800&q=80',
            'image_caption' => 'A timeless candid capturing moments of joy and reflection.',
            'image_credit' => 'Archive Collection',
            'layout_zone' => 'hero_side',
            'category' => 'ESSAY',
            'is_featured' => false,
            'order_num' => 2,
        ]);

        // Right Column Story
        Article::create([
            'title' => 'CHRONICLES OF TASTE: WHY HER AESTHETIC REMAINS UNRIVALED',
            'kicker' => 'STYLE & CULTURE',
            'subtitle' => 'From music playlists to impeccably curated moments, an exploration of effortless chic.',
            'author' => 'By MARGARET HOLLAND',
            'dateline' => 'MILAN',
            'content' => "Style critics have officially conceded: Cici's sense of fashion, atmosphere, and artistic intuition operates on an elevated wavelength.\n\nWhether curating the ultimate cozy evening, choosing the perfect soundtrack, or finding beauty in unexpected corners of the world, she makes elegance appear second nature. As one close confidant noted, 'She doesn't just navigate trends—she defines her own timeless atmosphere.'",
            'image_url' => null,
            'image_caption' => null,
            'image_credit' => null,
            'layout_zone' => 'hero_side',
            'category' => 'STYLE',
            'is_featured' => false,
            'order_num' => 3,
        ]);

        // Opinion / Op-Ed Piece
        Article::create([
            'title' => 'ON BECOMING UNSTOPPABLE: A LOVE LETTER TO 24',
            'kicker' => 'OP-ED COLUMN',
            'subtitle' => 'May this year bring unhurried mornings, fearless dreams, and boundless coffee.',
            'author' => 'By HER CLOSEST CIRCLE',
            'dateline' => 'LONDON',
            'content' => "To our dearest birthday girl:\n\nIf we could print all the reasons you are cherished onto broadsheet newsprint, it would fill the library of Alexandria twice over.\n\nYou bring a rare gentleness paired with an iron resolve. May your 24th trip around the sun be filled with flights to bucket-list destinations, delicious dinners, uninterrupted laughter, and people who remind you every single day just how deeply loved you are.\n\nHappy Birthday, Cici!",
            'image_url' => null,
            'image_caption' => null,
            'image_credit' => null,
            'layout_zone' => 'opinion',
            'category' => 'OPINION',
            'is_featured' => false,
            'order_num' => 4,
        ]);

        // Arts & Leisure Photo Spread
        Article::create([
            'title' => 'ARTS & LEISURE: A GALLERY OF UNFORGETTABLE MEMORIES',
            'kicker' => 'VISUAL JOURNALISM',
            'subtitle' => 'A photojournalistic retrospective showcasing laughter, adventures, and milestones.',
            'author' => 'By THE TIMES PHOTO DESK',
            'dateline' => 'GLOBAL BUREAU',
            'content' => "Curated by those who have walked beside her, this visual chronicle captures the essence of a remarkable journey. Each photograph represents a chapter of resilience, spontaneous joy, and the everlasting bonds of companionship.",
            'image_url' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=1200&q=80',
            'image_caption' => 'A gathering of friends and family celebrating lifelong connections and unforgettable adventures.',
            'image_credit' => 'Times Staff Photographer',
            'layout_zone' => 'arts_leisure',
            'category' => 'ARTS',
            'is_featured' => true,
            'order_num' => 5,
        ]);

        // Global Briefs / Tidbits
        Article::create([
            'title' => 'INTERNATIONAL WEATHER DESK',
            'kicker' => 'DISPATCH',
            'subtitle' => null,
            'author' => 'Staff Meteorologist',
            'dateline' => 'GENEVA',
            'content' => "Meteorologists confirm a high-pressure system of joy hovering directly over the celebration headquarters. Zero percent chance of bad vibes; confetti flurries expected throughout the evening.",
            'image_url' => null,
            'image_caption' => null,
            'image_credit' => null,
            'layout_zone' => 'briefs',
            'category' => 'BRIEFS',
            'is_featured' => false,
            'order_num' => 6,
        ]);

        Article::create([
            'title' => 'MICHELIN GUIDE CULINARY SPECIAL',
            'kicker' => 'GASTRONOMY',
            'subtitle' => null,
            'author' => 'Food & Wine Editor',
            'dateline' => 'TOKYO',
            'content' => "The official Birthday Cake has been awarded three honorary stars for unmatched sweetness, decadent icing, and its ability to inspire genuine happiness.",
            'image_url' => null,
            'image_caption' => null,
            'image_credit' => null,
            'layout_zone' => 'briefs',
            'category' => 'GASTRONOMY',
            'is_featured' => false,
            'order_num' => 7,
        ]);

        // Classifieds / Horoscopes
        Article::create([
            'title' => 'ASTROLOGICAL FORECAST: THE YEAR OF TRIUMPH',
            'kicker' => 'CLASSIFIEDS & STARS',
            'subtitle' => null,
            'author' => 'Times Astrologer',
            'dateline' => 'COSMIC HEADQUARTERS',
            'content' => "LUCKY NUMBERS: 24, 08, 20. The celestial bodies report supreme alignment. Venus grants limitless charm, Jupiter brings unexpected career triumphs, and Mercury guarantees hilarious group chat banter. Do not hesitate to make a grand birthday wish—it is guaranteed to manifest.",
            'image_url' => null,
            'image_caption' => null,
            'image_credit' => null,
            'layout_zone' => 'classifieds',
            'category' => 'HOROSCOPE',
            'is_featured' => false,
            'order_num' => 8,
        ]);

        // 3. Crossword Puzzle
        CrosswordPuzzle::truncate();
        CrosswordPuzzle::create([
            'title' => 'The Birthday Mini-Crossword',
            'subtitle' => "Test how well you know today's guest of honor",
            'grid_rows' => 5,
            'grid_cols' => 5,
            'grid_matrix' => [
                [
                    ['char' => 'C', 'number' => 1, 'isBlack' => false],
                    ['char' => 'A', 'number' => 2, 'isBlack' => false],
                    ['char' => 'K', 'number' => 3, 'isBlack' => false],
                    ['char' => 'E', 'number' => 4, 'isBlack' => false],
                    ['char' => 'S', 'number' => 5, 'isBlack' => false],
                ],
                [
                    ['char' => 'I', 'number' => 6, 'isBlack' => false],
                    ['char' => 'C', 'number' => 0, 'isBlack' => false],
                    ['char' => 'O', 'number' => 0, 'isBlack' => false],
                    ['char' => 'N', 'number' => 0, 'isBlack' => false],
                    ['char' => 'M', 'number' => 0, 'isBlack' => false],
                ],
                [
                    ['char' => 'C', 'number' => 7, 'isBlack' => false],
                    ['char' => 'O', 'number' => 0, 'isBlack' => false],
                    ['char' => 'Z', 'number' => 0, 'isBlack' => false],
                    ['char' => 'Y', 'number' => 0, 'isBlack' => false],
                    ['char' => 'I', 'number' => 0, 'isBlack' => false],
                ],
                [
                    ['char' => 'I', 'number' => 8, 'isBlack' => false],
                    ['char' => 'R', 'number' => 0, 'isBlack' => false],
                    ['char' => 'I', 'number' => 0, 'isBlack' => false],
                    ['char' => 'S', 'number' => 0, 'isBlack' => false],
                    ['char' => 'L', 'number' => 0, 'isBlack' => false],
                ],
                [
                    ['char' => 'S', 'number' => 9, 'isBlack' => false],
                    ['char' => 'N', 'number' => 0, 'isBlack' => false],
                    ['char' => 'A', 'number' => 0, 'isBlack' => false],
                    ['char' => 'P', 'number' => 0, 'isBlack' => false],
                    ['char' => 'E', 'number' => 0, 'isBlack' => false],
                ],
            ],
            'clues_across' => [
                ['number' => 1, 'clue' => 'Sweet birthday dessert with candles', 'answer' => 'CAKES'],
                ['number' => 6, 'clue' => 'A legendary or highly admired person (like today\'s birthday girl!)', 'answer' => 'ICON'],
                ['number' => 7, 'clue' => 'Warm, comfortable, and snug vibes', 'answer' => 'COZY'],
                ['number' => 8, 'clue' => 'A delicate flower or eye rainbow', 'answer' => 'IRIS'],
                ['number' => 9, 'clue' => 'Take a quick photograph or break with a click', 'answer' => 'SNAP'],
            ],
            'clues_down' => [
                ['number' => 1, 'clue' => 'First letters of our birthday star (The one and only!)', 'answer' => 'CICIS'],
                ['number' => 2, 'clue' => 'Nut or tree found in autumn (anagram of CORAN)', 'answer' => 'ACORN'],
                ['number' => 3, 'clue' => 'A Japanese word for warm tea coziness & harmony', 'answer' => 'KOZIA'],
                ['number' => 4, 'clue' => 'Appreciated or enjoyed (past tense)', 'answer' => 'ENYSP'],
                ['number' => 5, 'clue' => 'Bright facial expression sparked by joy', 'answer' => 'SMILE'],
            ],
        ]);

        // 4. Tribute Messages
        TributeMessage::truncate();
        TributeMessage::create([
            'sender_name' => 'Maya & Sofia',
            'sender_relation' => 'Best Friends',
            'message' => "To the most radiant soul we know: Happy 24th Birthday! Thank you for the endless late-night talks, the spontaneous road trips, and for always being our biggest cheerleader. The world is so much brighter with you in it!",
            'photo_url' => null,
            'is_approved' => true,
            'is_featured' => true,
        ]);

        TributeMessage::create([
            'sender_name' => 'Julian',
            'sender_relation' => 'Brother',
            'message' => "Happy birthday to the coolest sister in the universe. Proud of everything you've conquered this year and can't wait to see what heights you reach next.",
            'photo_url' => null,
            'is_approved' => true,
            'is_featured' => true,
        ]);

        TributeMessage::create([
            'sender_name' => 'The Book Club & Coffee Crew',
            'sender_relation' => 'Close Friends',
            'message' => "Wishing our favorite conversation partner the happiest of birthdays. May your year be packed with incredible books, delicious pastries, and endless sunshine!",
            'photo_url' => null,
            'is_approved' => true,
            'is_featured' => true,
        ]);
    }
}
