@props(['image' => '', 'name' => '', 'slug' => '', 'category' => '', 'material' => '', 'finishing' => '', 'dimensions' => ''])

@php $src = $image ? (Str::startsWith($image, 'http') ? $image : asset('storage/' . $image)) : 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=600&q=80'; @endphp

<div class="card group animate-on-scroll hover:-translate-y-1.5 hover:shadow-lg transition-all duration-300">
    <a href="/produk/{{ $slug }}" class="block">
        <div class="aspect-[4/3] overflow-hidden bg-gray-100 relative">
            <img src="{{ $src }}" alt="{{ $name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            <span class="absolute top-3 left-3 inline-block px-2.5 py-1 text-[11px] font-semibold text-cafe-700 bg-white/90 backdrop-blur-sm rounded-full tracking-wide uppercase shadow-sm">{{ $category }}</span>
        </div>
        <div class="p-4 md:p-5">
            <h3 class="text-sm md:text-[15px] font-bold text-gray-900 group-hover:text-cafe-600 transition-colors duration-200 leading-snug">{{ $name }}</h3>
            @if ($material || $finishing || $dimensions)
                <div class="mt-2.5 space-y-1.5">
                    @if ($material && $finishing)
                        <div class="grid grid-cols-2 gap-x-2">
                            <p class="text-gray-500 text-xs flex items-center gap-1.5">
                                <i class="fas fa-cubes text-cafe-400 w-3.5 text-center"></i>
                                <span class="truncate">{{ $material }}</span>
                            </p>
                            <p class="text-gray-500 text-xs flex items-center gap-1.5">
                                <i class="fas fa-palette text-cafe-400 w-3.5 text-center"></i>
                                <span class="truncate">{{ $finishing }}</span>
                            </p>
                        </div>
                    @else
                        @if ($material)
                            <p class="text-gray-500 text-xs flex items-center gap-1.5">
                                <i class="fas fa-cubes text-cafe-400 w-3.5 text-center"></i>
                                <span>{{ $material }}</span>
                            </p>
                        @endif
                        @if ($finishing)
                            <p class="text-gray-500 text-xs flex items-center gap-1.5">
                                <i class="fas fa-palette text-cafe-400 w-3.5 text-center"></i>
                                <span>{{ $finishing }}</span>
                            </p>
                        @endif
                    @endif
                    @if ($dimensions)
                        <p class="text-gray-500 text-xs flex items-center gap-1.5">
                            <i class="fas fa-ruler-combined text-cafe-400 w-3.5 text-center"></i>
                            <span>{{ $dimensions }}</span>
                        </p>
                    @endif
                </div>
            @endif
            <div class="mt-3 pt-3 border-t border-gray-100">
                <span class="inline-flex items-center text-xs font-semibold text-cafe-500 group-hover:text-cafe-600 transition-colors duration-200">
                    Lihat Detail
                    <svg class="w-3.5 h-3.5 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            </div>
        </div>
    </a>
</div>
