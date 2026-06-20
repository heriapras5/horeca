<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'images')->where('is_active', true)->latest()->get();
        return view('produk', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::with('category', 'images')->where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedProducts = Product::with('images', 'category')->where('product_category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();
        return view('product-detail', compact('product', 'relatedProducts'));
    }
}
