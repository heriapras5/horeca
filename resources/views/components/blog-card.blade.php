@props(['thumbnail' => '', 'title' => '', 'slug' => '', 'category' => '', 'excerpt' => '', 'date' => ''])

@php $src = $thumbnail ? (Str::startsWith($thumbnail, 'http') ? $thumbnail : asset('storage/' . $thumbnail)) : 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=600&q=80'; @endphp

<div class="card group animate-on-scroll hover:-translate-y-1.5 hover:shadow-lg transition-all duration-300">
    <a href="/blog/{{ $slug }}" class="block">
        <div class="aspect-[4/3] overflow-hidden bg-gray-100 relative">
            <img src="{{ $src }}" alt="{{ $title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            <span class="absolute top-2.5 left-2.5 sm:top-3 sm:left-3 inline-block px-2 py-0.5 sm:px-2.5 sm:py-1 text-[11px] sm:text-xs font-semibold text-cafe-700 bg-white/90 backdrop-blur-sm rounded-full tracking-wide uppercase shadow-sm">{{ $category }}</span>
        </div>
        <div class="p-3 sm:p-4 md:p-5">
            <span class="block text-[10px] sm:text-[11px] text-gray-400 mb-1.5 sm:mb-2">{{ $date }}</span>
            <h3 class="text-[13px] sm:text-sm md:text-[15px] font-bold text-gray-900 group-hover:text-cafe-600 transition-colors duration-200 leading-snug line-clamp-2">{{ $title }}</h3>
            @if ($excerpt)
                <p class="text-gray-500 text-[11px] sm:text-xs mt-1.5 sm:mt-2 leading-relaxed line-clamp-2">{{ $excerpt }}</p>
            @endif
            <div class="mt-2 sm:mt-3 pt-2 sm:pt-3 border-t border-gray-100">
                <span class="inline-flex items-center text-[11px] sm:text-xs font-semibold text-cafe-500 group-hover:text-cafe-600 transition-colors duration-200">
                    Baca Selengkapnya
                    <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            </div>
        </div>
    </a>
</div>
