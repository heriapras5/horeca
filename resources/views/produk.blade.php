@extends('layouts.app')

@section('title', 'Semua Produk - Pusat Furniture Cafe dan Resto')
@section('meta_description', 'Jelajahi semua koleksi furnitur cafe dan resto. Temukan kursi cafe, meja cafe, sofa cafe, kursi bar, meja bar, dan lemari display.')

@section('content')


    <section class="py-16 bg-gradient-to-br from-cafe-800 to-cafe-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold">Semua Produk</h1>
            <p class="text-white/80 mt-2 max-w-2xl mx-auto">Jelajahi seluruh koleksi furnitur cafe dan resto berkualitas</p>
        </div>
    </section>

    <section class="py-10 bg-white" data-aos="slide-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 animate-stagger">
                @foreach ($products as $product)
                    <x-product-card :image="$product->images->first()?->image ?? 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=600&q=80'" :name="$product->name" :slug="$product->slug" :category="$product->category?->name ?? ''" :material="$product->material" :finishing="$product->finishing" :dimensions="$product->dimensions" />
                @endforeach
            </div>
        </div>
    </section>
@endsection
