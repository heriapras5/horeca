@props(['image' => '', 'name' => '', 'slug' => '', 'description' => ''])

@php $src = $image ? (Str::startsWith($image, 'http') ? $image : asset('storage/' . $image)) : 'https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=600&q=80'; @endphp

<a href="/kategori/{{ $slug }}" class="group relative block overflow-hidden rounded-xl shadow-sm hover:shadow-lg border border-gray-100/20 transition-all duration-300 animate-on-scroll">
    <div class="aspect-[4/3] overflow-hidden">
        <img src="{{ $src }}" alt="{{ $name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/20 to-transparent">
        <div class="absolute bottom-0 left-0 right-0 p-5 md:p-6">
            <h3 class="text-base md:text-xl font-bold text-white mb-1 leading-snug">{{ $name }}</h3>
            @if ($description)
                <p class="text-white/70 text-xs md:text-sm leading-relaxed line-clamp-2">{{ $description }}</p>
            @endif
        </div>
    </div>
</a>
