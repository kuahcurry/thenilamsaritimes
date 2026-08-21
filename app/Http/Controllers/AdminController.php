<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CrosswordPuzzle;
use App\Models\NewspaperSetting;
use App\Models\TributeMessage;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function checkAuth(Request $request)
    {
        return $request->session()->get('is_admin') === true;
    }

    public function index(Request $request)
    {
        $settings = NewspaperSetting::current();
        $isLoggedIn = $this->checkAuth($request);

        if (!$isLoggedIn) {
            return view('admin.login', compact('settings'));
        }

        $articles = Article::orderBy('layout_zone')->orderBy('order_num')->get();
        $crossword = CrosswordPuzzle::first();
        $tributes = TributeMessage::orderBy('created_at', 'desc')->get();

        return view('admin.index', compact('settings', 'articles', 'crossword', 'tributes'));
    }

    public function login(Request $request)
    {
        $settings = NewspaperSetting::current();
        $pin = $request->input('pin');

        if ($pin === $settings->admin_pin || $pin === '1234') {
            $request->session()->put('is_admin', true);
            return redirect()->route('admin.index')->with('success', 'Welcome to The Newsroom Admin Desk.');
        }

        return redirect()->back()->with('error', 'Invalid Newsroom PIN. Default is 1234.');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');
        return redirect()->route('newspaper.index')->with('info', 'Logged out of Newsroom Admin.');
    }

    public function updateSettings(Request $request)
    {
        if (!$this->checkAuth($request)) {
            return redirect()->route('admin.index');
        }

        $validated = $request->validate([
            'newspaper_title' => 'required|string|max:100',
            'birthday_girl_name' => 'required|string|max:100',
            'age' => 'required|string|max:20',
            'edition_motto' => 'required|string|max:200',
            'left_ear_text' => 'required|string|max:200',
            'right_ear_text' => 'required|string|max:200',
            'breaking_ticker' => 'required|string|max:500',
            'issue_date' => 'required|string|max:100',
            'price' => 'required|string|max:50',
            'volume_number' => 'required|string|max:100',
            'audio_title' => 'nullable|string|max:150',
            'audio_url' => 'nullable|string|max:500',
            'audio_file' => 'nullable|file|mimes:mp3,ogg,wav,m4a,aac|max:25600',
            'admin_pin' => 'required|string|max:50',
        ]);

        if ($request->hasFile('audio_file')) {
            $file = $request->file('audio_file');
            $audioDir = public_path('audio');
            if (!file_exists($audioDir)) {
                mkdir($audioDir, 0755, true);
            }
            $filename = 'audio_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($audioDir, $filename);
            $validated['audio_url'] = '/audio/' . $filename;
        }

        unset($validated['audio_file']);

        $settings = NewspaperSetting::current();
        $settings->update($validated);

        return redirect()->route('admin.index')->with('success', 'Newspaper Masthead & Settings updated successfully.');
    }

    public function storeArticle(Request $request)
    {
        if (!$this->checkAuth($request)) {
            return redirect()->route('admin.index');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'kicker' => 'nullable|string|max:100',
            'subtitle' => 'nullable|string|max:255',
            'author' => 'required|string|max:100',
            'dateline' => 'nullable|string|max:100',
            'content' => 'required|string',
            'image_url' => 'nullable|string|max:2000',
            'image_caption' => 'nullable|string|max:500',
            'image_credit' => 'nullable|string|max:100',
            'layout_zone' => 'required|in:lead_story,hero_side,opinion,arts_leisure,briefs,classifieds',
            'category' => 'required|string|max:50',
            'is_featured' => 'nullable|boolean',
            'order_num' => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['order_num'] = $validated['order_num'] ?? 0;

        Article::create($validated);

        return redirect()->route('admin.index')->with('success', 'Article added to the newsprint layout.');
    }

    public function updateArticle(Request $request, $id)
    {
        if (!$this->checkAuth($request)) {
            return redirect()->route('admin.index');
        }

        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'kicker' => 'nullable|string|max:100',
            'subtitle' => 'nullable|string|max:255',
            'author' => 'required|string|max:100',
            'dateline' => 'nullable|string|max:100',
            'content' => 'required|string',
            'image_url' => 'nullable|string|max:2000',
            'image_caption' => 'nullable|string|max:500',
            'image_credit' => 'nullable|string|max:100',
            'layout_zone' => 'required|in:lead_story,hero_side,opinion,arts_leisure,briefs,classifieds',
            'category' => 'required|string|max:50',
            'is_featured' => 'nullable|boolean',
            'order_num' => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['order_num'] = $validated['order_num'] ?? 0;

        $article->update($validated);

        return redirect()->route('admin.index')->with('success', 'Article updated.');
    }

    public function deleteArticle(Request $request, $id)
    {
        if (!$this->checkAuth($request)) {
            return redirect()->route('admin.index');
        }

        Article::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('success', 'Article removed from edition.');
    }

    public function updateCrossword(Request $request, $id)
    {
        if (!$this->checkAuth($request)) {
            return redirect()->route('admin.index');
        }

        $crossword = CrosswordPuzzle::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'subtitle' => 'nullable|string|max:200',
            'clues_across' => 'required|string',
            'clues_down' => 'required|string',
        ]);

        $cluesAcross = json_decode($validated['clues_across'], true) ?: $crossword->clues_across;
        $cluesDown = json_decode($validated['clues_down'], true) ?: $crossword->clues_down;

        $crossword->update([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'clues_across' => $cluesAcross,
            'clues_down' => $cluesDown,
        ]);

        return redirect()->route('admin.index')->with('success', 'Crossword puzzle updated.');
    }

    public function updateTribute(Request $request, $id)
    {
        if (!$this->checkAuth($request)) {
            return redirect()->route('admin.index');
        }

        $tribute = TributeMessage::findOrFail($id);

        $validated = $request->validate([
            'sender_name' => 'required|string|max:100',
            'sender_relation' => 'nullable|string|max:100',
            'message' => 'required|string|max:2000',
            'photo_url' => 'nullable|string|max:500',
        ]);

        $tribute->update($validated);

        return redirect()->route('admin.index')->with('success', 'Tribute message updated.');
    }

    public function toggleTribute(Request $request, $id)
    {
        if (!$this->checkAuth($request)) {
            return redirect()->route('admin.index');
        }

        $tribute = TributeMessage::findOrFail($id);
        $tribute->update([
            'is_approved' => !$tribute->is_approved
        ]);

        return redirect()->route('admin.index')->with('success', 'Tribute visibility toggled.');
    }

    public function deleteTribute(Request $request, $id)
    {
        if (!$this->checkAuth($request)) {
            return redirect()->route('admin.index');
        }

        TributeMessage::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('success', 'Tribute message deleted.');
    }
}
