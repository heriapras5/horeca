@extends('layouts.app')

@section('title', 'Pusat Furniture Cafe dan Resto')
@section('og_title', 'Pusat Furniture Cafe dan Resto')
@section('og_type', 'website')

@push('styles')
<style>
    .hero-slide-img {
        transform: scale(1);
        transition: transform 8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .swiper-slide-active .hero-slide-img {
        transform: scale(1.12);
    }
    .hero-swiper .hero-title {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .hero-swiper .swiper-slide-active .hero-title {
        opacity: 1;
        transform: translateY(0);
        transition-delay: 0.3s;
    }
    .hero-swiper .hero-subtitle {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .hero-swiper .swiper-slide-active .hero-subtitle {
        opacity: 1;
        transform: translateY(0);
        transition-delay: 0.5s;
    }
    .hero-swiper .hero-btn-group {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .hero-swiper .swiper-slide-active .hero-btn-group {
        opacity: 1;
        transform: translateY(0);
        transition-delay: 0.7s;
    }
    .hero-swiper .hero-badge {
        opacity: 0;
    }
    .hero-swiper .swiper-slide-active .hero-badge {
        animation: heroFadeInDown 0.6s ease-out 0.1s forwards;
    }
    @keyframes heroFadeInDown {
        from { opacity: 0; transform: translateY(-15px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
    @php
        if (empty($slides)) {
            $slides = [
                ['image' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=1600&q=80', 'title' => 'Furnitur Cafe & Resto Berkualitas', 'subtitle' => 'Lengkapi usaha kuliner Anda dengan furnitur premium yang nyaman dan estetis.', 'button_url' => '/produk', 'button_text' => 'Lihat Koleksi'],
                ['image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1600&q=80', 'title' => 'Koleksi Terbaru ' . date('Y'), 'subtitle' => 'Temukan desain furnitur cafe dan resto terbaru dengan kualitas terbaik.', 'button_url' => '/produk', 'button_text' => 'Lihat Koleksi'],
                ['image' => 'https://images.unsplash.com/photo-1445116572660-236099ec97a0?w=1600&q=80', 'title' => 'Furnitur Berkualitas Tinggi', 'subtitle' => 'Kayu pilihan dari sumber berkelanjutan, dirancang khusus untuk cafe dan resto.', 'button_url' => '/produk', 'button_text' => 'Lihat Koleksi'],
            ];
        }
    @endphp

    <section class="relative">
        <x-hero-slider :slides="$slides" />
    </section>

    <section class="py-16 md:py-24 bg-cream-50" data-aos="slide-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="section-title" data-aos="fade-in">Kategori Produk</h2>
            <p class="section-subtitle" data-aos="fade-in">Pilih kategori untuk menemukan furnitur cafe dan resto yang Anda cari</p>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mt-12 animate-stagger">
                @foreach ($categories as $cat)
                    <x-category-card :image="$cat->image" :name="$cat->name" :slug="$cat->slug" :description="$cat->description" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 md:py-24 bg-white" data-aos="slide-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="section-title" data-aos="fade-in">Produk Terbaru</h2>
            <p class="section-subtitle" data-aos="fade-in">Koleksi furnitur cafe dan resto terbaru dari Pusat Furniture</p>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mt-12 animate-stagger">
                @foreach ($products as $product)
                    <x-product-card :image="$product->images->first()?->image ?? 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=600&q=80'" :name="$product->name" :slug="$product->slug" :category="$product->category?->name ?? ''" :material="$product->material" :finishing="$product->finishing" :dimensions="$product->dimensions" />
                @endforeach
            </div>
            <div class="text-center mt-8" data-aos="fade-in">
                <a href="/produk" class="btn-primary">Lihat Semua Produk</a>
            </div>
        </div>
    </section>


    <x-seo-head type="Organization" name="Pusat Furniture Cafe dan Resto" />
@endsection
