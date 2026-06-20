@extends('layouts.app')

@php
    $_thumb = $article->thumbnail ?? '';
    $_ogThumb = $_thumb ? (Str::startsWith($_thumb, 'http') ? $_thumb : asset('storage/' . $_thumb)) : '';
    $_currentUrl = url()->current();
    $_titleEncoded = urlencode($article->title);
    $_urlEncoded = urlencode($_currentUrl);
    $_readTime = ceil(str_word_count(strip_tags($article->content ?? '')) / 200);
    $_authorName = $article->author ?? 'Pusat Furniture Cafe dan Resto';
@endphp

@section('title', $article->title . ' - Blog Pusat Furniture')
@section('meta_description', Str::limit(strip_tags($article->content ?? ''), 160))
@section('og_image', $_ogThumb)
@section('og_type', 'article')

@section('content')

    <article class="bg-white">
        <section class="pt-28 pb-8 md:pb-12">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="mb-6" itemscope itemtype="https://schema.org/BreadcrumbList">
                    <ol class="flex items-center space-x-2 text-sm text-gray-400 flex-wrap">
                        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="/" itemprop="item" class="hover:text-cafe-500 transition-colors duration-200">
                                <span itemprop="name">Beranda</span>
                            </a>
                            <meta itemprop="position" content="1">
                        </li>
                        <li>
                            <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </li>
                        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="/blog" itemprop="item" class="hover:text-cafe-500 transition-colors duration-200">
                                <span itemprop="name">Blog</span>
                            </a>
                            <meta itemprop="position" content="2">
                        </li>
                        <li>
                            <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </li>
                        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <span itemprop="name" class="text-gray-600 truncate max-w-[180px] sm:max-w-xs inline-block align-middle">{{ $article->title }}</span>
                            <meta itemprop="position" content="3">
                        </li>
                    </ol>
                </nav>

                @if ($article->category)
                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold text-cafe-600 bg-cafe-50 rounded-full mb-4">{{ $article->category->name }}</span>
                @endif

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight">{{ $article->title }}</h1>

                <div class="flex flex-wrap items-center gap-x-3 gap-y-1.5 mt-5 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-cafe-500 flex items-center justify-center text-white text-xs font-bold shrink-0">
                            {{ strtoupper(substr($_authorName, 0, 1)) }}
                        </div>
                        <span class="font-medium text-gray-700">{{ $_authorName }}</span>
                    </div>
                    <span class="text-gray-300">•</span>
                    <span class="flex items-center gap-1.5">
                        <i class="far fa-calendar text-gray-400"></i>
                        {{ $article->created_at?->format('d M Y') ?? '' }}
                    </span>
                    @if ($_readTime > 0)
                        <span class="text-gray-300">•</span>
                        <span class="flex items-center gap-1.5">
                            <i class="far fa-clock text-gray-400"></i>
                            {{ $_readTime }} menit baca
                        </span>
                    @endif
                </div>
            </div>
        </section>

        @if (!empty($article->thumbnail))
            <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-10 md:mb-14">
                <div class="aspect-video rounded-2xl overflow-hidden bg-gray-100 shadow-xl">
                    <img src="{{ $_ogThumb }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                </div>
            </section>
        @endif

        <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 md:pb-16">
            @if (!empty($article->content))
                <div class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-p:text-gray-700 prose-p:leading-relaxed prose-a:text-cafe-500 hover:prose-a:text-cafe-600 prose-a:no-underline hover:prose-a:underline prose-img:rounded-xl prose-img:shadow-md prose-img:w-full prose-li:marker:text-cafe-500">
                    {!! $article->content !!}
                </div>
            @endif

            <div class="mt-12 pt-8 border-t border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">
                    <a href="/blog" class="inline-flex items-center gap-2 px-5 py-2.5 bg-cafe-500 text-white font-medium rounded-lg hover:bg-cafe-600 transition-colors shadow-sm text-sm">
                        <i class="fas fa-arrow-left"></i> Kembali ke Blog
                    </a>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-500 mr-1">Bagikan:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $_urlEncoded }}" target="_blank" rel="noopener noreferrer" aria-label="Bagikan ke Facebook" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 hover:bg-[#1877F2] hover:text-white transition-all duration-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ $_titleEncoded }}&url={{ $_urlEncoded }}" target="_blank" rel="noopener noreferrer" aria-label="Bagikan ke Twitter" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 hover:bg-[#1DA1F2] hover:text-white transition-all duration-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723 10.054 10.054 0 01-3.127 1.184 4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.937 4.937 0 004.604 3.417 9.868 9.868 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63a9.936 9.936 0 002.46-2.548l-.047-.02z"/></svg>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $_urlEncoded }}" target="_blank" rel="noopener noreferrer" aria-label="Bagikan ke LinkedIn" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 hover:bg-[#0A66C2] hover:text-white transition-all duration-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="https://wa.me/?text={{ $_titleEncoded }}%20-%20{{ $_urlEncoded }}" target="_blank" rel="noopener noreferrer" aria-label="Bagikan ke WhatsApp" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 hover:bg-[#25D366] hover:text-white transition-all duration-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </article>

    @if (isset($relatedPosts) && $relatedPosts->count() > 0)
        <section class="py-14 md:py-16 bg-cream-50 border-t border-gray-100" data-aos="slide-up">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Artikel Terkait</h2>
                    <p class="text-gray-500 mt-2 max-w-md mx-auto">Baca juga artikel menarik lainnya dari kategori yang sama</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 animate-stagger">
                    @foreach ($relatedPosts as $rp)
                        <x-blog-card
                            :thumbnail="$rp->thumbnail"
                            :title="$rp->title"
                            :slug="$rp->slug"
                            :category="$rp->category?->name ?? ''"
                            :excerpt="$rp->excerpt ?? ''"
                            :date="$rp->created_at?->format('d M Y') ?? ''"
                        />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @push('scripts')
    <script>
        $('[data-fancybox="blog"]').fancybox({
            thumbs: { autoStart: true },
            buttons: ['zoom', 'thumbs', 'close'],
            smallBtn: true,
            touch: { vertical: true },
            infobar: true,
        });
    </script>
    @endpush

    @if (!empty($article->content))
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BlogPosting",
        "headline": "{{ $article->title }}",
        "image": "{{ $_ogThumb }}",
        "datePublished": "{{ $article->created_at?->format('c') ?? '' }}",
        "author": {
            "@type": "Organization",
            "name": "{{ $article->author ?? 'Pusat Furniture Cafe dan Resto' }}"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Pusat Furniture Cafe dan Resto"
        },
        "description": "{{ Str::limit(strip_tags($article->content ?? ''), 200) }}"
    }
    </script>
    @endif
@endsection