@props(['slides' => []])

<div class="hero-swiper swiper relative w-full h-[60vh] min-h-[400px] md:min-h-[500px] lg:h-[85vh] lg:min-h-[600px]">
    <div class="swiper-wrapper">
        @foreach ($slides as $slide)
            @php
                $_img = $slide['image'] ?? '';
                $_src = $_img ? (Str::startsWith($_img, 'http') ? $_img : asset('storage/'.$_img)) : 'https://images.unsplash.com/photo-1506439773649-6e0eb8cfb237?w=1600&q=80';
            @endphp
            <div class="swiper-slide relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-tr from-black/80 via-black/40 to-transparent z-10"></div>
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black/30 z-10"></div>
                <img src="{{ $_src }}" alt="{{ $slide['title'] }}"
                     class="w-full h-full object-cover hero-slide-img">
                <div class="absolute inset-0 z-20 flex items-center">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                        <div class="max-w-3xl mx-auto lg:mx-0 lg:max-w-2xl text-center lg:text-left">
                            <span class="hero-badge inline-block px-4 py-1.5 mb-5 text-xs font-semibold uppercase tracking-widest text-white/90 bg-white/10 backdrop-blur-sm rounded-full border border-white/20">
                                {{ $_globalSiteName ?? 'Pusat Furniture Cafe dan Resto' }}
                            </span>
                            <h1 class="hero-title text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold text-white leading-[1.1] mb-5">
                                {{ $slide['title'] }}
                            </h1>
                            <p class="hero-subtitle text-base sm:text-lg md:text-xl text-white/80 max-w-xl mx-auto lg:mx-0 mb-8 leading-relaxed">
                                {{ $slide['subtitle'] }}
                            </p>
                            <div class="hero-btn-group flex flex-wrap gap-4 justify-center lg:justify-start">
                                <a href="{{ $slide['button_url'] }}"
                                   class="group relative inline-flex items-center gap-2 px-8 py-3.5 bg-white text-cafe-700 font-semibold rounded-full shadow-2xl hover:bg-cafe-50 transition-all duration-300 overflow-hidden">
                                    <span class="relative z-10">{{ $slide['button_text'] }}</span>
                                    <svg class="relative z-10 w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                                @if ($slide['button_secondary_url'] ?? false)
                                    <a href="{{ $slide['button_secondary_url'] }}"
                                       class="inline-flex items-center gap-2 px-8 py-3.5 border-2 border-white/40 text-white font-semibold rounded-full hover:bg-white/10 hover:border-white/60 transition-all duration-300 backdrop-blur-sm">
                                        {{ $slide['button_secondary_text'] }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="swiper-pagination !bottom-8 !flex !justify-center lg:!justify-start lg:!left-[calc((100%-80rem)/2+2rem)] lg:!bottom-10 gap-2 z-20"></div>

    <div class="absolute bottom-8 right-8 z-20 hidden lg:block">
        <div class="flex items-center gap-3 text-white/60 text-sm font-mono">
            <span class="hero-current-slide">01</span>
            <span class="w-8 h-px bg-white/30"></span>
            <span class="hero-total-slides">{{ str_pad(count($slides), 2, '0', STR_PAD_LEFT) }}</span>
        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 hidden md:block animate-bounce">
        <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
    </div>
</div>
