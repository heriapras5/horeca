@extends('layouts.app')

@section('title', 'Kategori Produk - Pusat Furniture Cafe dan Resto')
@section('meta_description', 'Jelajahi berbagai kategori furnitur cafe dan resto. Temukan kursi cafe, meja cafe, sofa cafe, kursi bar, meja bar, dan lemari display.')

@section('content')


    <section class="py-16 bg-gradient-to-br from-cafe-800 to-cafe-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold">Kategori Produk</h1>
            <p class="text-white/80 mt-2 max-w-2xl mx-auto">Jelajahi koleksi furnitur cafe dan resto kami berdasarkan kategori</p>
        </div>
    </section>

    <section class="py-12" data-aos="slide-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 animate-stagger">
                @foreach ($categories as $cat)
                    <x-category-card :image="$cat->image" :name="$cat->name" :slug="$cat->slug" :description="$cat->description" />
                @endforeach
            </div>
        </div>
    </section>
@endsection
