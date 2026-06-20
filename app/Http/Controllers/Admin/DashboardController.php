<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\PageView;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'visitors_today' => PageView::whereDate('visited_at', today())->count(),
            'visitors_week'  => PageView::where('visited_at', '>=', now()->subDays(7))->count(),
            'visitors_month' => PageView::whereMonth('visited_at', now()->month)
                                   ->whereYear('visited_at', now()->year)->count(),
            'visitors_year'  => PageView::whereYear('visited_at', now()->year)->count(),
            'visitors_total' => PageView::count(),
            'messages'       => ContactMessage::where('is_read', false)->count(),
        ];

        $visitorChart = PageView::selectRaw('DATE(visited_at) as date, COUNT(*) as total')
            ->where('visited_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        $topProductViews = PageView::selectRaw('page, COUNT(*) as total')
            ->where('page', 'like', '%/produk/%')
            ->groupBy('page')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $slugs = $topProductViews->pluck('page')->map(fn($p) => basename($p));
        $products = Product::with('images')->whereIn('slug', $slugs)->get()->keyBy('slug');

        $topProducts = [];
        foreach ($topProductViews as $pv) {
            $_slug = basename($pv->page);
            $_prod = $products->get($_slug);
            $topProducts[] = (object) [
                'name'  => $_prod ? $_prod->name : $_slug,
                'slug'  => $_slug,
                'image' => $_prod && $_prod->images->count()
                    ? (Str::startsWith($_prod->images[0]->image, 'http') ? $_prod->images[0]->image : asset('storage/' . $_prod->images[0]->image))
                    : null,
                'total' => $pv->total,
            ];
        }

        $recentMessages = ContactMessage::latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'visitorChart', 'topProducts', 'recentMessages'));
    }
}
