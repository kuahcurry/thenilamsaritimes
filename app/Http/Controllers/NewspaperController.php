<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CrosswordPuzzle;
use App\Models\NewspaperSetting;
use App\Models\TributeMessage;
use Illuminate\Http\Request;

class NewspaperController extends Controller
{
    public function index()
    {
        $settings = NewspaperSetting::current();
        
        $allArticles = Article::orderBy('order_num', 'asc')->get();
        $articlesByZone = $allArticles->groupBy('layout_zone');

        $leadStory = $articlesByZone->get('lead_story', collect())->first();
        $heroSides = $articlesByZone->get('hero_side', collect())->take(2);
        $opinions = $articlesByZone->get('opinion', collect());
        $artsLeisure = $articlesByZone->get('arts_leisure', collect());
        $briefs = $articlesByZone->get('briefs', collect());
        $classifieds = $articlesByZone->get('classifieds', collect());

        $crossword = CrosswordPuzzle::first();
        $tributes = TributeMessage::where('is_approved', true)->orderBy('is_featured', 'desc')->orderBy('created_at', 'desc')->get();

        return view('newspaper.index', compact(
            'settings',
            'leadStory',
            'heroSides',
            'opinions',
            'artsLeisure',
            'briefs',
            'classifieds',
            'allArticles',
            'crossword',
            'tributes'
        ));
    }

    public function showArticle($id)
    {
        $settings = NewspaperSetting::current();
        $article = Article::findOrFail($id);
        $relatedArticles = Article::where('id', '!=', $id)->inRandomOrder()->take(3)->get();

        return view('newspaper.article', compact('settings', 'article', 'relatedArticles'));
    }

    public function submitTribute(Request $request)
    {
        $validated = $request->validate([
            'sender_name' => 'required|string|max:100',
            'sender_relation' => 'nullable|string|max:100',
            'message' => 'required|string|max:2000',
            'photo_url' => 'nullable|string|max:2000',
        ]);

        $validated['is_approved'] = true; // Auto-approved for celebratory ease, can be toggled by admin
        TributeMessage::create($validated);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Your birthday message has been published in the edition!']);
        }

        return redirect()->back()->with('success', 'Your birthday message has been published to the edition!');
    }

    public function printKeepsake()
    {
        $allArticles = Article::orderBy('order_num', 'asc')->get();
        $articlesByZone = $allArticles->groupBy('layout_zone');

        $leadStory = $articlesByZone->get('lead_story', collect())->first();
        $heroSides = $articlesByZone->get('hero_side', collect())->take(2);
        $opinions = $articlesByZone->get('opinion', collect())->take(2);
        $artsLeisure = $articlesByZone->get('arts_leisure', collect())->first();
        $briefs = $articlesByZone->get('briefs', collect())->take(2);
        $classifieds = $articlesByZone->get('classifieds', collect())->take(2);
        $tributes = TributeMessage::where('is_approved', true)->take(4)->get();
        $crossword = CrosswordPuzzle::first();

        return view('newspaper.print', compact(
            'settings',
            'leadStory',
            'heroSides',
            'opinions',
            'artsLeisure',
            'briefs',
            'classifieds',
            'tributes',
            'crossword'
        ));
    }
}
