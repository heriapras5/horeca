@php
    $navCategories = \App\Models\ProductCategory::where('is_active', true)->get(['name', 'slug']);
    $_navLogoUrl = $_globalLogo;
@endphp

<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-sm transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 md:h-20">
            <a href="/" class="flex items-center space-x-2 shrink-0">
                @if ($_navLogoUrl)
                    <img src="{{ $_navLogoUrl }}" alt="{{ $_globalSiteName }}" class="h-8 md:h-10 w-auto">
                @else
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-cafe-500 rounded-lg flex items-center justify-center text-white font-bold text-lg md:text-xl">P</div>
                @endif
                <span class="text-xl md:text-2xl font-bold text-cafe-700">{{ $_globalSiteName }}</span>
            </a>

            <div class="hidden lg:flex items-center space-x-6">
                <a href="/" class="text-gray-700 hover:text-cafe-500 font-medium transition-colors duration-200 text-sm {{ request()->is('/') ? 'text-cafe-500' : '' }}">Beranda</a>

                <div class="relative" x-data="{ dropdownOpen: false }" @mouseenter="dropdownOpen = true" @mouseleave="dropdownOpen = false">
                    <div class="flex items-center gap-0.5">
                        <a href="/kategori" class="text-gray-700 hover:text-cafe-500 font-medium transition-colors duration-200 text-sm {{ request()->is('kategori') ? 'text-cafe-500' : '' }}">
                            Kategori
                        </a>
                        <button @click.stop="dropdownOpen = !dropdownOpen" class="text-gray-700 hover:text-cafe-500 transition-colors duration-200 p-0.5">
                            <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                    </div>
                    <div x-show="dropdownOpen" x-cloak class="absolute top-full left-0 pt-2" @click.away="dropdownOpen = false">
                        <div class="bg-white rounded-xl shadow-xl border border-gray-100 py-2 min-w-[200px]">
                            @foreach ($navCategories as $cat)
                                <a href="/kategori/{{ $cat['slug'] }}" class="block px-4 py-2.5 text-sm text-gray-600 hover:text-cafe-500 hover:bg-cream-100 transition-colors duration-200">{{ $cat['name'] }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <a href="/tentang" class="text-gray-700 hover:text-cafe-500 font-medium transition-colors duration-200 text-sm {{ request()->is('tentang') ? 'text-cafe-500' : '' }}">Tentang</a>
                <a href="/kontak" class="text-gray-700 hover:text-cafe-500 font-medium transition-colors duration-200 text-sm {{ request()->is('kontak') ? 'text-cafe-500' : '' }}">Kontak</a>
                <button @click="searchOpen = !searchOpen; setTimeout(() => { if(searchOpen) $refs.searchInput.focus() }, 100)" class="text-gray-600 hover:text-cafe-500 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
            </div>

            <div class="flex items-center space-x-3 lg:hidden">
                <button @click="searchOpen = !searchOpen" class="text-gray-600 hover:text-cafe-500 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
                <button @click="mobileOpen = !mobileOpen" class="text-gray-700 hover:text-cafe-500 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <div x-show="searchOpen" x-cloak class="pb-3" @click.away="if(!$event.target.closest('form')) searchOpen = false">
            <form action="/search" method="GET" class="relative">
                <input x-ref="searchInput" type="text" name="q" placeholder="Cari produk atau artikel..." required class="w-full pl-10 pr-20 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cafe-300 focus:border-cafe-500 outline-none text-sm transition-all duration-200 bg-gray-50">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 px-3 py-1 bg-cafe-500 text-white text-xs rounded-md hover:bg-cafe-600 transition-all duration-200">Cari</button>
            </form>
        </div>
    </div>

    <div x-show="mobileOpen" x-cloak class="lg:hidden bg-white border-t border-gray-100 shadow-lg">
        <div class="px-4 py-3 space-y-1">
            <a href="/" class="block px-4 py-2.5 text-gray-700 hover:text-cafe-500 hover:bg-cream-100 rounded-lg font-medium text-sm transition-all duration-200">Beranda</a>

            <div x-data="{ open: false }">
                <div class="flex items-center justify-between w-full px-4 py-2.5 rounded-lg transition-all duration-200 hover:bg-cream-100">
                    <a href="/kategori" class="flex-1 text-gray-700 hover:text-cafe-500 font-medium text-sm">Kategori</a>
                    <button @click.stop="open = !open" class="text-gray-700 hover:text-cafe-500 transition-colors duration-200 p-1">
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                </div>
                <div x-show="open" x-cloak class="pl-4 space-y-0.5">
                    @foreach ($navCategories as $cat)
                        <a href="/kategori/{{ $cat['slug'] }}" class="block px-4 py-2 text-gray-500 hover:text-cafe-500 hover:bg-cream-100 rounded-lg text-sm transition-all duration-200">{{ $cat['name'] }}</a>
                    @endforeach
                </div>
            </div>

            <a href="/tentang" class="block px-4 py-2.5 text-gray-700 hover:text-cafe-500 hover:bg-cream-100 rounded-lg font-medium text-sm transition-all duration-200">Tentang</a>
            <a href="/kontak" class="block px-4 py-2.5 text-gray-700 hover:text-cafe-500 hover:bg-cream-100 rounded-lg font-medium text-sm transition-all duration-200">Kontak</a>
        </div>
    </div>
</nav>

<style>
    [x-cloak] { display: none !important; }
</style>
