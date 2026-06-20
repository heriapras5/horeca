@extends('layouts.app')

@section('title', 'Blog - Pusat Furniture Cafe dan Resto')
@section('meta_description', 'Baca artikel menarik seputar furnitur cafe dan resto, tips memilih furnitur, inspirasi desain interior, dan informasi terbaru.')

@section('content')


    <section class="py-16 bg-gradient-to-br from-cafe-800 to-cafe-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold">Blog Pusat Furniture Cafe dan Resto</h1>
            <p class="text-white/80 mt-2 max-w-2xl mx-auto">Tips, inspirasi, dan informasi seputar furnitur cafe dan resto</p>
        </div>
    </section>

    <section class="py-10 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-nowrap sm:flex-wrap gap-2 sm:gap-3 mb-10 overflow-x-auto pb-1 scrollbar-hide">
                <a href="/blog"
                   class="shrink-0 px-3.5 sm:px-5 py-1.5 sm:py-2 rounded-full text-sm font-medium transition-all duration-200
                   {{ !request('kategori') ? 'bg-cafe-500 text-white shadow-md' : 'bg-white border border-gray-200 text-gray-600 hover:border-cafe-300 hover:text-cafe-600' }}">
                    Semua
                </a>
                @foreach ($blogCategories as $cat)
                    <a href="{{ '/blog?kategori=' . urlencode($cat->name) }}"
                       class="shrink-0 px-3.5 sm:px-5 py-1.5 sm:py-2 rounded-full text-sm font-medium transition-all duration-200
                       {{ request('kategori') === $cat->name ? 'bg-cafe-500 text-white shadow-md' : 'bg-white border border-gray-200 text-gray-600 hover:border-cafe-300 hover:text-cafe-600' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            <div class="lg:grid lg:grid-cols-3 lg:gap-8" data-aos="slide-up">
                <div class="lg:col-span-2">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6 animate-stagger">
                        @foreach ($blogs as $blog)
                            <x-blog-card :thumbnail="$blog->thumbnail" :title="$blog->title" :slug="$blog->slug" :category="$blog->category?->name ?? ''" :excerpt="$blog->excerpt" :date="$blog->created_at?->format('d M Y') ?? ''" />
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $blogs->links() }}
                    </div>
                </div>

                <aside class="mt-10 lg:mt-0" data-aos="slide-right">
                    <div class="bg-white rounded-xl shadow-md p-6 sticky top-28">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Artikel Terbaru</h3>
                        <ul class="space-y-4">
                            @foreach ($recentPosts as $post)
                                <li>
                                    <a href="/blog/{{ $post->slug }}" class="flex items-start space-x-3 group">
                                        @php $_rThumb = $post->thumbnail && Str::startsWith($post->thumbnail, 'http') ? $post->thumbnail : asset('storage/' . $post->thumbnail); @endphp
                                        <img src="{{ $_rThumb }}" alt="{{ $post->title }}" class="w-16 h-16 rounded-lg object-cover shrink-0">
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-700 group-hover:text-cafe-600 transition-colors duration-200 line-clamp-2">{{ $post->title }}</h4>
                                            <span class="text-xs text-gray-400">{{ $post->created_at?->format('d M Y') ?? '' }}</span>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <h3 class="text-lg font-semibold text-gray-800 mt-8 mb-4">Kategori</h3>
                        <ul class="space-y-2">
                            @foreach ($blogCategories as $cat)
                                <li>
                                    <a href="/blog?kategori={{ urlencode($cat->name) }}" class="text-gray-600 hover:text-cafe-500 transition-colors duration-200 text-sm flex items-center justify-between">
                                        <span>{{ $cat->name }}</span>
                                        <span class="text-xs text-gray-400">({{ $cat->blogs_count ?? 0 }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
