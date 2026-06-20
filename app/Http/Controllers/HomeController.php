<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Slide;

class HomeController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::where('is_active', true)->get();
        $products = Product::with('category', 'images')->where('is_active', true)->latest()->take(6)->get();

        $slides = Slide::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn($s) => [
                'image' => $s->image_url,
                'title' => $s->title,
                'subtitle' => $s->subtitle,
                'button_url' => $s->button_url ?: '/produk',
                'button_text' => $s->button_text ?: 'Lihat Koleksi',
            ])
            ->toArray();

        if (empty($slides)) {
            $slides = [
                ['image' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=1600&q=80', 'title' => 'Furnitur Cafe & Resto Berkualitas', 'subtitle' => 'Lengkapi usaha kuliner Anda dengan furnitur premium yang nyaman dan estetis.', 'button_url' => '/produk', 'button_text' => 'Lihat Koleksi'],
                ['image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1600&q=80', 'title' => 'Koleksi Terbaru ' . date('Y'), 'subtitle' => 'Temukan desain furnitur cafe dan resto terbaru dengan kualitas terbaik.', 'button_url' => '/produk', 'button_text' => 'Lihat Koleksi'],
                ['image' => 'https://images.unsplash.com/photo-1445116572660-236099ec97a0?w=1600&q=80', 'title' => 'Furnitur Berkualitas Tinggi', 'subtitle' => 'Kayu pilihan dari sumber berkelanjutan, dirancang khusus untuk cafe dan resto.', 'button_url' => '/produk', 'button_text' => 'Lihat Koleksi'],
            ];
        }

        return view('home', compact('categories', 'products', 'slides'));
    }
}
