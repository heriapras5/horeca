@extends('layouts.app')

@php
    $_firstImg = $product->images->first()?->image ?? '';
    $_ogImg = $_firstImg ? (Str::startsWith($_firstImg, 'http') ? $_firstImg : asset('storage/' . $_firstImg)) : '';
@endphp

@section('title', $product->name . ' - Pusat Furniture Cafe dan Resto')
@section('meta_description', 'Detail produk ' . $product->name . ' dari Pusat Furniture Cafe dan Resto. ' . strip_tags($product->description ?? ''))
@section('og_image', $_ogImg)
@section('og_type', 'product')

@section('content')
    <section class="py-8 md:py-10 bg-white" data-aos="slide-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-breadcrumb hideHome :items="[['label' => $product->category?->name ?? '', 'url' => '/kategori/' . ($product->category?->slug ?? '#')], ['label' => $product->name]]" />

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12 mt-6">
                <div data-aos="slide-left">
                    <div class="swiper product-gallery-main rounded-2xl overflow-hidden bg-gray-100 shadow-md">
                        <div class="swiper-wrapper">
                            @foreach ($product->images as $index => $img)
                                @php $_src = Str::startsWith($img->image, 'http') ? $img->image : asset('storage/' . $img->image); @endphp
                                <div class="swiper-slide">
                                    <a href="{{ $_src }}" data-fancybox="gallery" data-caption="{{ $product->name }} - Gambar {{ $index + 1 }}" class="block aspect-[4/3]">
                                        <img src="{{ $_src }}" alt="{{ $product->name }} - Gambar {{ $index + 1 }}" class="w-full h-full object-cover">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next product-gallery-next"></div>
                        <div class="swiper-button-prev product-gallery-prev"></div>
                    </div>
                    @if ($product->images->count() > 1)
                        <div class="swiper product-gallery-thumbs mt-4">
                            <div class="swiper-wrapper">
                                @foreach ($product->images as $index => $img)
                                    @php $_src = Str::startsWith($img->image, 'http') ? $img->image : asset('storage/' . $img->image); @endphp
                                    <div class="swiper-slide">
                                        <div class="aspect-square rounded-xl overflow-hidden bg-gray-100 border-2 border-transparent transition-all duration-200">
                                            <img src="{{ $_src }}" alt="{{ $product->name }} - Gambar {{ $index + 1 }}" class="w-full h-full object-cover">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div data-aos="slide-right">
                    <span class="inline-block px-3 py-1 text-sm font-medium text-cafe-600 bg-cafe-50 rounded-full mb-3">{{ $product->category?->name ?? '' }}</span>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $product->name }}</h1>

                    @if (!empty($product->code))
                        <p class="mt-2 inline-block px-2.5 py-0.5 text-xs font-mono font-medium text-gray-500 bg-gray-100 rounded-md">Kode: {{ $product->code }}</p>
                    @endif

                    <div class="mt-5 bg-gray-50 rounded-xl p-5 space-y-3">
                        @if (!empty($product->material))
                            <div class="flex items-center gap-3 text-gray-700">
                                <i class="fas fa-cubes w-4 text-cafe-500 text-center"></i>
                                <div>
                                    <p class="text-[11px] text-gray-400 uppercase tracking-wider">Material</p>
                                    <p class="text-sm font-medium">{{ $product->material }}</p>
                                </div>
                            </div>
                        @endif
                        @if (!empty($product->finishing))
                            <div class="flex items-center gap-3 text-gray-700">
                                <i class="fas fa-palette w-4 text-cafe-500 text-center"></i>
                                <div>
                                    <p class="text-[11px] text-gray-400 uppercase tracking-wider">Finishing</p>
                                    <p class="text-sm font-medium">{{ $product->finishing }}</p>
                                </div>
                            </div>
                        @endif
                        @if (!empty($product->dimensions))
                            <div class="flex items-center gap-3 text-gray-700 pt-3 border-t border-gray-200">
                                <i class="fas fa-ruler-combined w-4 text-cafe-500 text-center"></i>
                                <div>
                                    <p class="text-[11px] text-gray-400 uppercase tracking-wider">Dimensi</p>
                                    <p class="text-sm font-medium">{{ $product->dimensions }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    @php $_waPd = ($_globalSettings['whatsapp_number'] ?? null) ?: ''; @endphp
                    @if ($_waPd)
                    <div class="mt-6">
                        <a href="https://wa.me/{{ $_waPd }}?text=Halo%20{{ urlencode($_globalSiteName) }}%2C%20saya%20tertarik%20dengan%20produk%20{{ urlencode($product->name) }}%20({{ urlencode(url()->current()) }})" target="_blank" rel="noopener noreferrer" class="btn-wa w-full text-sm">
                            <svg class="w-4 h-4 mr-1.5 inline" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                            Pesan via WhatsApp
                        </a>
                    </div>
                    @endif

                    @if (!empty($product->description))
                        <div class="mt-8">
                            <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-3">Deskripsi Produk</h2>
                            <div class="text-sm md:text-base text-gray-600 leading-relaxed [&_h2]:text-lg [&_h2]:font-bold [&_h2]:text-gray-800 [&_h2]:mt-5 [&_h2]:mb-3 [&_h3]:font-semibold [&_h3]:text-gray-800 [&_h3]:mt-4 [&_h3]:mb-2 [&_p]:mb-3 [&_p]:leading-relaxed [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:space-y-1 [&_ul]:mb-3 [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:space-y-1 [&_ol]:mb-3">
                                {!! $product->description !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if ($relatedProducts->count() > 0)
        <section class="py-12 bg-white border-t border-gray-200" data-aos="slide-up">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-8" data-aos="fade-in">Produk Terkait</h2>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 animate-stagger">
                    @foreach ($relatedProducts as $rp)
                        <x-product-card :image="$rp->images->first()?->image ?? 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=600&q=80'" :name="$rp->name" :slug="$rp->slug" :category="$rp->category?->name ?? ''" :material="$rp->material" :finishing="$rp->finishing" :dimensions="$rp->dimensions" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @push('scripts')
    <script>
        $('[data-fancybox="gallery"]').fancybox({
            buttons: ['zoom', 'slideShow', 'download', 'close'],
            smallBtn: false,
            touch: { vertical: true },
            infobar: true,
            animationEffect: 'zoom',
            transitionEffect: 'slide',
        });
    </script>
    @endpush

    @if ($product->images->isNotEmpty())
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": {!! json_encode($product->name) !!},
        "description": {!! json_encode(strip_tags($product->description ?? '')) !!},
        "image": {!! json_encode($_ogImg) !!},
        "material": {!! json_encode($product->material ?? '') !!},
        "category": {!! json_encode($product->category?->name ?? '') !!},
        "brand": {
            "@type": "Brand",
            "name": "Pusat Furniture Cafe dan Resto"
        }
    }
    </script>
    @endif
@endsection
