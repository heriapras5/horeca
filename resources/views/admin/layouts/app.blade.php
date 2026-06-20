@php
    $_admFavicon = $_globalFavicon ?? asset('favicon.png');
    $_admLogoUrl = $_globalLogo;
@endphp
<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: true, imgPopup: null }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin - ' . ($_globalSiteName ?? 'Pusat Furniture Cafe dan Resto'))</title>
    <link rel="icon" type="image/x-icon" href="{{ $_admFavicon }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { cafe: { 50: '#faf6f3', 100: '#f0e6dd', 200: '#e0ccbc', 300: '#d0b29b', 400: '#a87d5e', 500: '#8B5A3A', 600: '#6B3A2A', 700: '#5a2e22', 800: '#4a251b', 900: '#3a1d14' }, terracotta: { 50: '#fdf6f3', 100: '#f9e8df', 200: '#f2d0be', 300: '#e8b89d', 400: '#d89a7a', 500: '#C77D5E', 600: '#b0684a', 700: '#8a533c', 800: '#6b3f2e', 900: '#4c2d20' } } } }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
    <style>
        [x-cloak] { display: none !important; }
        .admin-content { animation: fadeInContent 0.35s ease-out both; }
        @keyframes fadeInContent { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
        .sidebar-link { position: relative; overflow: hidden; }
        .sidebar-link::after { content: ''; position: absolute; inset: 0; background: rgba(139,90,58,0.08); transform: scaleX(0); transform-origin: left; transition: transform 0.3s ease; }
        .sidebar-link:hover::after { transform: scaleX(1); }
        .sidebar-link span, .sidebar-link i { position: relative; z-index: 1; }
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 99px; }
        .sidebar-nav::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.15); }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <div class="flex min-h-screen">

        {{-- Overlay mobile --}}
        <div x-show="sidebarOpen" x-transition.opacity
             class="fixed inset-0 z-30 bg-black/50 lg:hidden"
             @@click="sidebarOpen = false">
        </div>

        {{-- Sidebar --}}
        <aside x-show="sidebarOpen"
               x-transition:enter="transition duration-300 ease-out"
               x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
               x-transition:leave="transition duration-200 ease-in"
               x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
               class="fixed inset-y-0 left-0 z-40 w-[260px] flex flex-col bg-gradient-to-b from-gray-900 to-gray-950 text-white will-change-transform shadow-xl">

            <div class="flex items-center h-16 px-4 border-b border-gray-700/50">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 min-w-0 flex-1">
                    @if ($_admLogoUrl)
                        <img src="{{ $_admLogoUrl }}" alt="{{ $_globalSiteName }}" class="h-7 w-auto shrink-0">
                    @else
                        <i class="fas fa-store text-cafe-500 text-lg shrink-0"></i>
                    @endif
                    <span class="text-[15px] font-bold tracking-wide truncate">{{ $_globalSiteName }}</span>
                </a>
            </div>

            <nav class="sidebar-nav flex-1 overflow-y-auto py-4 px-3 space-y-0.5">
                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-cafe-500/15 text-white font-medium border-l-[3px] border-cafe-400 shadow-[inset_0_0_16px_-8px_rgba(139,90,58,0.3)]' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }}">
                    <i class="fas fa-chart-pie w-5 text-center text-base"></i><span class="text-sm">Dashboard</span>
                </a>
                <a href="{{ route('admin.slides.index') }}"
                   class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.slides.*') ? 'bg-cafe-500/15 text-white font-medium border-l-[3px] border-cafe-400 shadow-[inset_0_0_16px_-8px_rgba(139,90,58,0.3)]' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }}">
                    <i class="fas fa-images w-5 text-center text-base"></i><span class="text-sm">Slider</span>
                </a>
                <a href="{{ route('admin.product-categories.index') }}"
                   class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.product-categories.*') ? 'bg-cafe-500/15 text-white font-medium border-l-[3px] border-cafe-400 shadow-[inset_0_0_16px_-8px_rgba(139,90,58,0.3)]' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }}">
                    <i class="fas fa-tags w-5 text-center text-base"></i><span class="text-sm">Kategori Produk</span>
                </a>
                <a href="{{ route('admin.products.index') }}"
                   class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.products.*') ? 'bg-cafe-500/15 text-white font-medium border-l-[3px] border-cafe-400 shadow-[inset_0_0_16px_-8px_rgba(139,90,58,0.3)]' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }}">
                    <i class="fas fa-box w-5 text-center text-base"></i><span class="text-sm">Produk</span>
                </a>
                <a href="{{ route('admin.messages.index') }}"
                   class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.messages.*') ? 'bg-cafe-500/15 text-white font-medium border-l-[3px] border-cafe-400 shadow-[inset_0_0_16px_-8px_rgba(139,90,58,0.3)]' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }}">
                    <i class="fas fa-envelope w-5 text-center text-base"></i><span class="text-sm">Pesan Masuk</span>
                </a>
                <a href="{{ route('admin.about-settings.edit') }}"
                   class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.about-settings.*') ? 'bg-cafe-500/15 text-white font-medium border-l-[3px] border-cafe-400 shadow-[inset_0_0_16px_-8px_rgba(139,90,58,0.3)]' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }}">
                    <i class="fas fa-address-card w-5 text-center text-base"></i><span class="text-sm">Tentang</span>
                </a>

                <a href="{{ route('admin.settings.index') }}"
                   class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.settings.*') ? 'bg-cafe-500/15 text-white font-medium border-l-[3px] border-cafe-400 shadow-[inset_0_0_16px_-8px_rgba(139,90,58,0.3)]' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }}">
                    <i class="fas fa-cog w-5 text-center text-base"></i><span class="text-sm">Pengaturan</span>
                </a>
            </nav>

            <div class="px-5 py-3 border-t border-gray-700/50 text-xs text-gray-500">
                &copy; {{ date('Y') }} {{ $_globalSiteName }}
            </div>
        </aside>

        {{-- Main --}}
        <div class="flex-1 flex flex-col min-w-0 will-change-contents"
             :class="sidebarOpen ? 'lg:ml-[260px]' : 'lg:ml-0'">

            {{-- Top Bar --}}
            <header class="h-16 bg-white/95 backdrop-blur-sm border-b border-gray-100 flex items-center justify-between px-6 lg:px-8 sticky top-0 z-10 shadow-sm">
                <div class="flex items-center gap-4">
                    <button type="button" @@click="sidebarOpen = !sidebarOpen"
                            class="w-8 h-8 flex flex-col items-center justify-center gap-[3px] text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg focus:outline-none transition-all duration-200"
                            title="Toggle Sidebar">
                        <span class="block w-5 h-[2px] bg-current rounded"></span>
                        <span class="block w-5 h-[2px] bg-current rounded"></span>
                        <span class="block w-5 h-[2px] bg-current rounded"></span>
                    </button>
                    <h1 class="text-lg font-semibold text-gray-800">@yield('header', 'Dashboard')</h1>
                </div>

                <div class="relative" x-data="{ open: false }">
                    <button type="button" @@click="open = !open" @@click.outside="open = false"
                            class="flex items-center gap-2 text-gray-600 hover:text-gray-800 focus:outline-none transition-colors">
                        <span class="hidden sm:inline text-sm font-medium">{{ Auth::user()->name ?? 'Admin' }}</span>
                        @if (Auth::user()->avatar_url)
                            <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover">
                        @else
                            <div class="w-8 h-8 rounded-full bg-cafe-500 flex items-center justify-center text-white text-sm font-bold">
                                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                            </div>
                        @endif
                        <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                    </button>
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-2"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50">
                        <a href="{{ route('admin.admins.index') }}"
                           class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 hover:text-cafe-600 transition-colors">
                            <i class="fas fa-user-shield"></i><span>Manajemen Admin</span>
                        </a>
                        <div class="border-t border-gray-100 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <button type="button" onclick="confirmLogout()"
                                    class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 hover:text-red-600 transition-colors">
                                <i class="fas fa-sign-out-alt"></i><span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 overflow-y-auto bg-gray-50/80 min-h-screen p-5 lg:p-8 pb-12 lg:pb-16 admin-content">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                         class="mb-6 flex items-center gap-3 bg-green-50 border border-green-100 text-green-700 px-5 py-4 rounded-2xl shadow-sm">
                        <i class="fas fa-check-circle text-green-500 text-lg"></i>
                        <span class="flex-1 text-sm font-medium">{{ session('success') }}</span>
                        <button @@click="show = false" class="text-green-400 hover:text-green-600 transition-colors"><i class="fas fa-times"></i></button>
                    </div>
                @endif
                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                         class="mb-6 flex items-center gap-3 bg-red-50 border border-red-100 text-red-700 px-5 py-4 rounded-2xl shadow-sm">
                        <i class="fas fa-exclamation-circle text-red-500 text-lg"></i>
                        <span class="flex-1 text-sm font-medium">{{ session('error') }}</span>
                        <button @@click="show = false" class="text-red-400 hover:text-red-600 transition-colors"><i class="fas fa-times"></i></button>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>function loadSummernote(){$.getScript('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js');$('head').append('<link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css\">');}</script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('confirm', {
                show: false,
                title: 'Konfirmasi',
                message: '',
                btnText: 'Ya',
                isDanger: false,
                formId: null,
                open(title, message, btnText, formId, isDanger = true) {
                    this.title = title;
                    this.message = message;
                    this.btnText = btnText;
                    this.formId = formId;
                    this.isDanger = isDanger;
                    this.show = true;
                },
                confirm() {
                    if (this.formId) document.getElementById(this.formId).submit();
                    this.show = false;
                },
                cancel() {
                    this.show = false;
                }
            });
        });

        function confirmDelete(formId) {
            Alpine.store('confirm').open('Yakin ingin menghapus?', 'Data yang dihapus tidak dapat dikembalikan!', 'Ya, Hapus!', formId);
        }

        function confirmLogout() {
            Alpine.store('confirm').open('Yakin ingin logout?', '', 'Ya, Logout', 'logout-form', false);
        }
    </script>
    @stack('scripts')

    {{-- Confirm Modal --}}
    <div x-show="$store.confirm.show" x-cloak
         x-transition.opacity.duration.200ms
         class="fixed inset-0 z-[200] flex items-center justify-center p-4 bg-black/50"
         @click.self="$store.confirm.cancel()">
        <div x-show="$store.confirm.show" x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="bg-white rounded-2xl shadow-2xl max-w-sm w-full p-6">
            <div class="text-center">
                <div class="w-12 h-12 mx-auto mb-4 rounded-full flex items-center justify-center"
                     :class="$store.confirm.isDanger ? 'bg-red-100' : 'bg-cafe-100'">
                    <i class="fas fa-exclamation-triangle text-xl"
                       :class="$store.confirm.isDanger ? 'text-red-500' : 'text-cafe-500'"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2" x-text="$store.confirm.title"></h3>
                <p class="text-sm text-gray-500 mb-6" x-text="$store.confirm.message" x-show="$store.confirm.message"></p>
                <div class="flex gap-3 justify-center">
                    <button @click="$store.confirm.cancel()"
                            class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-colors font-medium text-sm">Batal</button>
                    <button @click="$store.confirm.confirm()"
                            class="px-5 py-2.5 text-white rounded-xl hover:opacity-90 transition-colors font-medium text-sm"
                            :class="$store.confirm.isDanger ? 'bg-red-500' : 'bg-cafe-500'"
                            x-text="$store.confirm.btnText"></button>
                </div>
            </div>
        </div>
    </div>

    {{-- Image Popup --}}
    <div x-show="imgPopup" x-transition.opacity.duration.200ms
         class="fixed inset-0 z-[100] bg-black/80 flex items-center justify-center p-4"
         @click.self="imgPopup = null"
         @keydown.window.escape="imgPopup = null">
        <img :src="imgPopup" class="max-w-full max-h-[90vh] rounded-lg shadow-2xl object-contain">
        <button @click="imgPopup = null"
                class="absolute top-4 right-4 w-10 h-10 bg-white/20 backdrop-blur rounded-full flex items-center justify-center text-white hover:bg-white/30 transition-colors shadow-lg">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>
</body>
</html>
