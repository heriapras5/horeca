<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::where('is_active', true)->get();
        return view('categories', compact('categories'));
    }

    public function show($slug)
    {
        $category = ProductCategory::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $products = Product::with('category', 'images')->where('product_category_id', $category->id)->where('is_active', true)->get();
        return view('category-products', [
            'categoryName' => $category->name,
            'categoryDescription' => $category->description,
            'categorySlug' => $category->slug,
            'products' => $products,
        ]);
    }
}
