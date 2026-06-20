<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('material', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($categoryId = $request->get('category')) {
            $query->where('product_category_id', $categoryId);
        }

        if ($status = $request->get('status')) {
            $query->where('is_active', $status === 'active');
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        $categories = ProductCategory::where('is_active', true)->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = ProductCategory::where('is_active', true)->get();
        return view('admin.products.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'name'                => 'required|string|max:255',
            'code'                => 'nullable|string|max:50|unique:products,code',
            'description'         => 'nullable|string',
            'material'            => 'nullable|string|max:255',
            'finishing'           => 'nullable|string|max:255',
            'dimensions'          => 'nullable|string|max:255',
            'weight'              => 'nullable|string|max:255',
            'price'               => 'nullable|numeric|min:0',
            'hpp'                 => 'nullable|numeric|min:0',
            'is_active'           => 'boolean',
            'images'              => 'nullable|array',
            'images.*'            => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data['slug']      = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        $product = Product::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $file) {
                $path = $file->store('uploads', 'public');
                $product->images()->create(['image' => $path, 'sort_order' => $i]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::where('is_active', true)->get();
        $product->load('images');
        return view('admin.products.form', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'name'                => 'required|string|max:255',
            'code'                => 'nullable|string|max:50|unique:products,code,' . $product->id,
            'description'         => 'nullable|string',
            'material'            => 'nullable|string|max:255',
            'finishing'           => 'nullable|string|max:255',
            'dimensions'          => 'nullable|string|max:255',
            'weight'              => 'nullable|string|max:255',
            'price'               => 'nullable|numeric|min:0',
            'hpp'                 => 'nullable|numeric|min:0',
            'is_active'           => 'boolean',
            'images'              => 'nullable|array',
            'images.*'            => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data['slug']      = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        $product->update($data);

        if ($request->hasFile('images')) {
            foreach ($product->images as $oldImg) {
                \Storage::disk('public')->delete($oldImg->image);
            }
            $product->images()->delete();
            foreach ($request->file('images') as $i => $file) {
                $path = $file->store('uploads', 'public');
                $product->images()->create(['image' => $path, 'sort_order' => $i]);
            }
        } elseif ($request->boolean('remove_all_images')) {
            foreach ($product->images as $oldImg) {
                \Storage::disk('public')->delete($oldImg->image);
            }
            $product->images()->delete();
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $img) {
            \Storage::disk('public')->delete($img->image);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
