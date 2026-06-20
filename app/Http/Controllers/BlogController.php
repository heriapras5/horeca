<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    public function index()
    {
        $blogCategories = BlogCategory::where('is_active', true)->get();
        $categoryFilter = request('kategori');
        $blogs = Blog::with('category')->where('is_active', true);
        if ($categoryFilter) {
            $blogs->whereHas('category', function ($q) use ($categoryFilter) {
                $q->where('name', $categoryFilter);
            });
        }
        $blogs = $blogs->latest()->paginate(6)->withQueryString();
        $recentPosts = Blog::with('category')->where('is_active', true)->latest()->take(5)->get();
        return view('blog-list', compact('blogs', 'recentPosts', 'blogCategories'));
    }

    public function show($slug)
    {
        $article = Blog::with('category')->where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedPosts = Blog::with('category')->where('blog_category_id', $article->blog_category_id)
            ->where('id', '!=', $article->id)
            ->where('is_active', true)
            ->latest()
            ->take(3)
            ->get();
        return view('blog-detail', compact('article', 'relatedPosts'));
    }
}
