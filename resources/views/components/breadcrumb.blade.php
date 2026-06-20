@props(['items' => [], 'hideHome' => false])

<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <ol class="flex items-center space-x-2 text-sm" itemscope itemtype="https://schema.org/BreadcrumbList">
            @unless ($hideHome)
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="/" itemprop="item" class="text-gray-500 hover:text-cafe-500 transition-colors duration-200">
                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span itemprop="name" class="ml-1">Beranda</span>
                </a>
                <meta itemprop="position" content="1">
            </li>
            @endunless

            @foreach ($items as $index => $item)
                <li class="text-gray-400">
                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    @if ($item['url'] ?? false)
                        <a href="{{ $item['url'] }}" itemprop="item" class="text-gray-500 hover:text-cafe-500 transition-colors duration-200">
                            <span itemprop="name">{{ $item['label'] }}</span>
                        </a>
                    @else
                        <span itemprop="name" class="text-cafe-600 font-medium">{{ $item['label'] }}</span>
                    @endif
                    <meta itemprop="position" content="{{ $index + ($hideHome ? 1 : 2) }}">
                </li>
            @endforeach
        </ol>
    </div>
</nav>
