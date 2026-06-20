@props(['currentPage' => 1, 'totalPages' => 1, 'baseUrl' => '', 'param' => 'page'])

@php
    $queryParams = request()->except([$param, 'page']);
    $buildUrl = function ($page) use ($baseUrl, $queryParams, $param) {
        $params = array_merge($queryParams, [$param => $page]);
        return $baseUrl . '?' . http_build_query($params);
    };
@endphp

@if ($totalPages > 1)
    <div class="flex items-center justify-center space-x-2 mt-12">
        @if ($currentPage > 1)
            <a href="{{ $buildUrl($currentPage - 1) }}" class="px-4 py-2 bg-white border border-gray-200 rounded-lg text-gray-600 hover:bg-cafe-50 hover:border-cafe-300 hover:text-cafe-600 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
        @endif

        @for ($i = 1; $i <= $totalPages; $i++)
            <a href="{{ $buildUrl($i) }}"
               class="px-4 py-2 rounded-lg font-medium transition-all duration-200
               {{ $i === $currentPage ? 'bg-cafe-500 text-white shadow-md' : 'bg-white border border-gray-200 text-gray-600 hover:bg-cafe-50 hover:border-cafe-300 hover:text-cafe-600' }}">
                {{ $i }}
            </a>
        @endfor

        @if ($currentPage < $totalPages)
            <a href="{{ $buildUrl($currentPage + 1) }}" class="px-4 py-2 bg-white border border-gray-200 rounded-lg text-gray-600 hover:bg-cafe-50 hover:border-cafe-300 hover:text-cafe-600 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        @endif
    </div>
@endif
