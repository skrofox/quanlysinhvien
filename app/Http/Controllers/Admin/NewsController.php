<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

use App\Models\NewsCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::with('category')->latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = NewsCategory::all();
        return view('admin.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:news_categories,id',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title) . '-' . time();
        $data['user_id'] = Auth::id();
        $data['published_at'] = $request->status == 'published' ? now() : null;
        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('news', 'public');
            $data['thumbnail'] = Storage::url($path);
        }

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Bài viết đã được tạo thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $categories = NewsCategory::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:news_categories,id',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->all();

        if ($news->title !== $request->title) {
            $data['slug'] = Str::slug($request->title) . '-' . time();
        }

        if ($news->status !== $request->status && $request->status == 'published') {
            $data['published_at'] = now();
        }

        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists and is a local file
            if ($news->thumbnail && strpos($news->thumbnail, '/storage/') !== false) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $news->thumbnail));
            }
            $path = $request->file('thumbnail')->store('news', 'public');
            $data['thumbnail'] = Storage::url($path);
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Bài viết đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        if ($news->thumbnail && strpos($news->thumbnail, '/storage/') !== false) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $news->thumbnail));
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Bài viết đã được xóa.');
    }
}
