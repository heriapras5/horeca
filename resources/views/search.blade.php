@extends('layouts.app')

@section('title', $q ? "Pencarian \"$q\" - $_globalSiteName" : "Pencarian - $_globalSiteName")
@section('meta_description', $q ? "Hasil pencarian untuk \"$q\" - Temukan produk furnitur cafe dan resto." : "Cari produk furnitur cafe dan resto.")

@section('content')
    @php $query = request('q', ''); @endphp

    <section class="py-16 bg-gradient-to-br from-cafe-800 to-cafe-900 text-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-4">Pencarian</h1>
            <form action="/search" method="GET" class="relative max-w-xl mx-auto">
                <input type="text" name="q" value="{{ $query }}" placeholder="Cari produk atau artikel..." class="w-full pl-12 pr-4 py-4 border border-white/20 bg-white/10 text-white placeholder-white/50 rounded-xl focus:ring-2 focus:ring-white/30 focus:border-white/50 outline-none text-lg transition-all duration-200">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </form>
        </div>
    </section>

    <section class="py-10" data-aos="slide-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($query)
                <p class="text-gray-600 mb-8" data-aos="fade-in">
                    Hasil pencarian untuk: <strong>"{{ $query }}"</strong>
                    <span class="text-gray-400 text-sm ml-2">
                        ({{ $products->total() }} produk, {{ $blogs->total() }} artikel)
                    </span>
                </p>

                @if ($products->count() > 0 || $blogs->count() > 0)
                    @if ($products->count() > 0)
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk <span class="text-base font-normal text-gray-400">({{ $products->total() }})</span></h2>
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-4 animate-stagger">
                            @foreach ($products as $product)
                                <x-product-card
                                    :image="$product->images->first()?->image ?? 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=600&q=80'"
                                    :name="$product->name"
                                    :slug="$product->slug"
                                    :category="$product->category?->name ?? ''"
                                    :material="$product->material"
                                    :finishing="$product->finishing"
                                    :dimensions="$product->dimensions"
                                />
                            @endforeach
                        </div>
                        <div class="mb-12">
                            <x-pagination :currentPage="$products->currentPage()" :totalPages="$products->lastPage()" :baseUrl="url('/search')" param="product_page" />
                        </div>
                    @endif

                    @if ($blogs->count() > 0)
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Artikel <span class="text-base font-normal text-gray-400">({{ $blogs->total() }})</span></h2>
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-4 animate-stagger">
                            @foreach ($blogs as $blog)
                                <x-blog-card
                                    :thumbnail="$blog->thumbnail"
                                    :title="$blog->title"
                                    :slug="$blog->slug"
                                    :category="$blog->category?->name ?? ''"
                                    :excerpt="$blog->excerpt"
                                    :date="$blog->created_at?->format('d M Y') ?? ''"
                                />
                            @endforeach
                        </div>
                        <div>
                            <x-pagination :currentPage="$blogs->currentPage()" :totalPages="$blogs->lastPage()" :baseUrl="url('/search')" param="blog_page" />
                        </div>
                    @endif
                @else
                    <div class="text-center py-16">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ditemukan</h3>
                        <p class="text-gray-400">Maaf, tidak ada hasil untuk "{{ $query }}". Coba kata kunci lain.</p>
                    </div>
                @endif
            @else
                <div class="text-center py-16">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Cari Produk atau Artikel</h3>
                    <p class="text-gray-400">Masukkan kata kunci untuk mencari produk dan artikel.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
