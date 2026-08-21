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
        
        $leadStory = Article::where('layout_zone', 'lead_story')->orderBy('order_num', 'asc')->first();
        $heroSides = Article::where('layout_zone', 'hero_side')->orderBy('order_num', 'asc')->take(2)->get();
        $opinions = Article::where('layout_zone', 'opinion')->orderBy('order_num', 'asc')->get();
        $artsLeisure = Article::where('layout_zone', 'arts_leisure')->orderBy('order_num', 'asc')->get();
        $briefs = Article::where('layout_zone', 'briefs')->orderBy('order_num', 'asc')->get();
        $classifieds = Article::where('layout_zone', 'classifieds')->orderBy('order_num', 'asc')->get();
        
        $allArticles = Article::orderBy('order_num', 'asc')->get();
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
        $settings = NewspaperSetting::current();
        $leadStory = Article::where('layout_zone', 'lead_story')->first();
        $heroSides = Article::where('layout_zone', 'hero_side')->take(2)->get();
        $opinions = Article::where('layout_zone', 'opinion')->take(2)->get();
        $artsLeisure = Article::where('layout_zone', 'arts_leisure')->first();
        $briefs = Article::where('layout_zone', 'briefs')->take(2)->get();
        $classifieds = Article::where('layout_zone', 'classifieds')->take(2)->get();
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
