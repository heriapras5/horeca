@php
    $_footerSettings = $_globalSettings;
    $_footerLogoUrl = $_globalLogo;
    $_footerWa = $_footerSettings['whatsapp_number'] ?? '6281234567890';
    $_footerFb = $_footerSettings['facebook_url'] ?? '#';
    $_footerIg = $_footerSettings['instagram_url'] ?? '#';
@endphp
<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    @if ($_footerLogoUrl)
                        <img src="{{ $_footerLogoUrl }}" alt="{{ $_globalSiteName }}" class="h-10 w-auto">
                    @else
                        <div class="w-10 h-10 bg-cafe-500 rounded-lg flex items-center justify-center text-white font-bold text-xl">P</div>
                    @endif
                    <span class="text-2xl font-bold text-white">{{ $_globalSiteName }}</span>
                </div>
                <p class="text-gray-400 leading-relaxed">
                    {{ $_footerSettings['footer_description'] ?? 'Penyedia furnitur berkualitas untuk cafe, restoran, coffee shop, dan usaha kuliner.' }}
                </p>
                <p class="text-sm text-cafe-300 font-medium mt-4">{{ $_footerSettings['company_name'] ?? 'PT. Jati Inovasi Furnindo' }}</p>
                <div class="flex space-x-4 mt-6">
                    <a href="{{ $_footerFb }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-cafe-500 hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                    </a>
                    <a href="{{ $_footerIg }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-cafe-500 hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.11 2.525c.636-.247 1.363-.416 2.427-.465C8.83 2.013 9.165 2 11.992 2h.323zM12 5.753a6.247 6.247 0 100 12.494 6.247 6.247 0 000-12.494zM12 8a4 4 0 110 8 4 4 0 010-8zm6.198-.705a1.46 1.46 0 11-2.92 0 1.46 1.46 0 012.92 0z"/></svg>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                <ul class="space-y-3">
                    <li><a href="/" class="text-gray-400 hover:text-cafe-400 transition-colors duration-200">Beranda</a></li>
                    <li><a href="/produk" class="text-gray-400 hover:text-cafe-400 transition-colors duration-200">Kategori Produk</a></li>
                    <li><a href="/blog" class="text-gray-400 hover:text-cafe-400 transition-colors duration-200">Blog</a></li>
                    <li><a href="/tentang" class="text-gray-400 hover:text-cafe-400 transition-colors duration-200">Tentang Kami</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Hubungi Kami</h3>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start space-x-2">
                        <svg class="w-5 h-5 mt-0.5 text-cafe-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>{{ $_footerSettings['address'] ?? 'Jl. Kayu Indah No. 123, Jakarta' }}</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-cafe-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>{{ $_footerSettings['phone'] ?? '+62 812-3456-7890' }}</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-cafe-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>{{ $_footerSettings['email'] ?? 'hello@pusatfurniturecafe.com' }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-10 pt-8 text-center text-gray-500 text-sm">
            <p>&copy; {{ date('Y') }} {{ $_globalSiteName }}. All rights reserved.</p>
        </div>
    </div>
</footer>
