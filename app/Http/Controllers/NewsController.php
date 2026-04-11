<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\News;
use App\Models\NewsCategory;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with('category')->where('status', 'published')->latest('published_at');

        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $news = $query->paginate(12);
        $categories = NewsCategory::all();

        return view('news.index', compact('news', 'categories'));
    }

    public function show($slug)
    {
        $article = News::with(['category', 'author'])->where('slug', $slug)->firstOrFail();
        
        // Luân phiên tăng lượt xem (giản đơn)
        $article->increment('views');

        $related = News::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->limit(3)
            ->get();

        return view('news.show', compact('article', 'related'));
    }
}
