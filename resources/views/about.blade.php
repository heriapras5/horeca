@extends('layouts.app')

@section('title', 'Tentang Kami - Pusat Furniture Cafe dan Resto')
@section('meta_description', 'Kenali lebih dekat Pusat Furniture Cafe dan Resto, penyedia furnitur berkualitas untuk cafe dan resto.')

@section('content')
    @php
        $_aboutTitle   = $_globalSettings['about_title'] ?? 'Tentang Pusat Furniture';
        $_aboutDesc    = $_globalSettings['about_description'] ?? '';
        $_aboutVision  = $_globalSettings['about_vision'] ?? '';
        $_aboutMission = $_globalSettings['about_mission'] ?? '';
        $_aboutImgRaw  = $_globalSettings['about_image'] ?? '';
        $_aboutImg     = $_aboutImgRaw ? (\Illuminate\Support\Str::startsWith($_aboutImgRaw, 'http') ? $_aboutImgRaw : asset('storage/' . $_aboutImgRaw)) : null;
        $_waNumber     = $_globalSettings['whatsapp_number'] ?? '6281234567890';
    @endphp

    <section class="py-16 bg-gradient-to-br from-cafe-800 to-cafe-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold">Tentang Kami</h1>
            <p class="text-white/80 mt-2 max-w-2xl mx-auto">Kenali lebih dekat Pusat Furniture Cafe dan Resto, penyedia furnitur berkualitas untuk cafe dan resto.</p>
        </div>
    </section>

    @if ($_aboutImg || $_aboutDesc)
    <section class="py-20 md:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                @if ($_aboutImg)
                <div class="overflow-hidden rounded-2xl shadow-xl shadow-gray-200/50">
                    <img src="{{ $_aboutImg }}" alt="{{ $_aboutTitle }}" class="w-full aspect-[4/3] object-cover hover:scale-[1.02] transition-transform duration-700">
                </div>
                @endif
                <div class="{{ $_aboutImg ? '' : 'lg:col-span-2 text-center' }}">
                    <div class="w-12 h-1 bg-cafe-500 rounded-full mb-6"></div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">{{ $_aboutTitle }}</h2>
                    <div class="text-gray-600 text-base md:text-lg leading-relaxed prose prose-gray max-w-none">
                        {!! $_aboutDesc !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if ($_aboutVision || $_aboutMission)
    <section class="py-20 md:py-28 bg-cream-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <span class="inline-block text-sm font-semibold text-cafe-500 uppercase tracking-[0.2em]">Arah & Tujuan</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">Visi & Misi</h2>
                <p class="text-gray-500 mt-3 max-w-2xl mx-auto">Komitmen kami dalam memberikan produk dan pelayanan terbaik</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @if ($_aboutVision)
                <div class="bg-white rounded-2xl p-8 md:p-10 shadow-sm">
                    <div class="w-12 h-12 bg-cafe-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Visi</h3>
                    <div class="text-gray-600 leading-relaxed prose prose-gray max-w-none">
                        {!! $_aboutVision !!}
                    </div>
                </div>
                @endif
                @if ($_aboutMission)
                <div class="bg-white rounded-2xl p-8 md:p-10 shadow-sm">
                    <div class="w-12 h-12 bg-cafe-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Misi</h3>
                    <div class="text-gray-600 leading-relaxed prose prose-gray max-w-none">
                        {!! $_aboutMission !!}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    <section class="py-20 md:py-24 text-center bg-gradient-to-r from-cafe-700 to-cafe-600 text-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Melengkapi Cafe atau Resto Anda?</h2>
            <p class="text-lg text-white/70 mb-10 max-w-xl mx-auto">Hubungi kami untuk konsultasi dan pemesanan furnitur cafe dan resto</p>
            <a href="https://wa.me/{{ $_waNumber }}?text=Halo%2C%20saya%20ingin%20bertanya%20tentang%20produk%20furnitur%20cafe%20dan%20resto" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-8 py-4 bg-white text-cafe-600 font-semibold rounded-xl shadow-md hover:bg-gray-100 transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                Hubungi via WhatsApp
            </a>
        </div>
    </section>
@endsection
