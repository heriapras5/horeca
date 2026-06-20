@extends('admin.layouts.app')

@section('title', 'Dashboard - Admin Pusat Furniture')
@section('header', 'Dashboard')

@push('styles')
<style>
    .stat-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .stat-card:hover { transform: translateY(-4px); box-shadow: 0 20px 40px -12px rgba(0,0,0,0.15); }
    .stat-icon { transition: transform 0.3s ease; }
    .stat-card:hover .stat-icon { transform: scale(1.08); }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
@endpush

@section('content')
    @php
        $hour = now()->hour;
        if ($hour >= 5 && $hour < 12) $greeting = 'Selamat Pagi';
        elseif ($hour >= 12 && $hour < 15) $greeting = 'Selamat Siang';
        elseif ($hour >= 15 && $hour < 18) $greeting = 'Selamat Sore';
        else $greeting = 'Selamat Malam';
        $userName = Auth::user()->name ?? 'Admin';
    @endphp

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">{{ $greeting }}, {{ $userName }}</h2>
        @if ($_globalSiteName)
        <p class="text-sm text-gray-400 mt-1">Ringkasan kunjungan {{ $_globalSiteName }}.</p>
        @endif
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-5 mb-8">
        <div class="stat-card bg-white rounded-2xl shadow-sm ring-1 ring-gray-100/50 border border-gray-100 p-5 md:p-6 flex items-center gap-4 cursor-default">
            <div class="stat-icon w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100/80 flex items-center justify-center text-blue-600 text-xl shrink-0">
                <i class="fas fa-calendar-day"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] text-gray-400 font-medium tracking-wider uppercase">Hari Ini</p>
                <p class="text-3xl font-bold text-gray-800 mt-0.5">{{ $stats['visitors_today'] ?? 0 }}</p>
            </div>
        </div>
        <div class="stat-card bg-white rounded-2xl shadow-sm ring-1 ring-gray-100/50 border border-gray-100 p-5 md:p-6 flex items-center gap-4 cursor-default">
            <div class="stat-icon w-12 h-12 rounded-2xl bg-gradient-to-br from-green-50 to-green-100/80 flex items-center justify-center text-green-600 text-xl shrink-0">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] text-gray-400 font-medium tracking-wider uppercase">7 Hari</p>
                <p class="text-3xl font-bold text-gray-800 mt-0.5">{{ $stats['visitors_week'] ?? 0 }}</p>
            </div>
        </div>
        <div class="stat-card bg-white rounded-2xl shadow-sm ring-1 ring-gray-100/50 border border-gray-100 p-5 md:p-6 flex items-center gap-4 cursor-default">
            <div class="stat-icon w-12 h-12 rounded-2xl bg-gradient-to-br from-purple-50 to-purple-100/80 flex items-center justify-center text-purple-600 text-xl shrink-0">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] text-gray-400 font-medium tracking-wider uppercase">Bulan Ini</p>
                <p class="text-3xl font-bold text-gray-800 mt-0.5">{{ $stats['visitors_month'] ?? 0 }}</p>
            </div>
        </div>
        <div class="stat-card bg-white rounded-2xl shadow-sm ring-1 ring-gray-100/50 border border-gray-100 p-5 md:p-6 flex items-center gap-4 cursor-default">
            <div class="stat-icon w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-50 to-amber-100/80 flex items-center justify-center text-amber-600 text-xl shrink-0">
                <i class="fas fa-calendar"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] text-gray-400 font-medium tracking-wider uppercase">Tahun Ini</p>
                <p class="text-3xl font-bold text-gray-800 mt-0.5">{{ $stats['visitors_year'] ?? 0 }}</p>
            </div>
        </div>
        <div class="stat-card bg-white rounded-2xl shadow-sm ring-1 ring-gray-100/50 border border-gray-100 p-5 md:p-6 flex items-center gap-4 cursor-default">
            <div class="stat-icon w-12 h-12 rounded-2xl bg-gradient-to-br from-orange-50 to-orange-100/80 flex items-center justify-center text-orange-600 text-xl shrink-0">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] text-gray-400 font-medium tracking-wider uppercase">Pesan Baru</p>
                <p class="text-3xl font-bold text-gray-800 mt-0.5">{{ $stats['messages'] ?? 0 }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 md:gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-100/50 border border-gray-100 p-5 md:p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-sm font-semibold text-gray-800 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-cafe-500"></span>
                    Kunjungan 7 Hari Terakhir
                </h3>
            </div>
            <div class="relative">
                <canvas id="visitorChart" height="240"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-sm font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-fire text-cafe-500"></i>
                    Produk Paling Sering Dilihat
                </h3>
                <span class="text-xs text-gray-400 bg-gray-50 px-2.5 py-1 rounded-lg font-medium">Top 5</span>
            </div>
            @if(isset($topProducts) && count($topProducts))
                <div class="space-y-2">
                    @foreach($topProducts as $i => $item)
                        @php
                            $rankColors = ['text-yellow-500', 'text-gray-400', 'text-amber-600', 'text-gray-300', 'text-gray-300'];
                            $rankIcons = ['fa-trophy', 'fa-medal', 'fa-medal', 'fa-circle', 'fa-circle'];
                        @endphp
                        <div class="flex items-center justify-between py-2.5 px-3 rounded-xl {{ !$loop->last ? 'border-b border-gray-50' : '' }} hover:bg-gray-50/50 transition-colors">
                            <div class="flex items-center gap-3 min-w-0 flex-1">
                                <span class="text-sm {{ $rankColors[$i] ?? 'text-gray-300' }} w-5 shrink-0 text-center">
                                    <i class="fas {{ $rankIcons[$i] ?? 'fa-circle' }}"></i>
                                </span>
                                @if ($item->image)
                                    <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-9 h-9 rounded-lg object-cover shrink-0">
                                @else
                                    <div class="w-9 h-9 rounded-lg bg-gray-50 flex items-center justify-center text-gray-300 shrink-0 border border-gray-100">
                                        <i class="fas fa-box text-sm"></i>
                                    </div>
                                @endif
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-medium text-gray-700 truncate">{{ $item->name }}</p>
                                    <div class="flex items-center gap-1.5 mt-1">
                                        <div class="flex-1 h-1.5 bg-gray-100 rounded-full overflow-hidden max-w-[100px]">
                                            <div class="h-full rounded-full bg-cafe-500/60" style="width: {{ min(100, ($item->total / max($topProducts[0]->total, 1)) * 100) }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-cafe-50 text-cafe-600 shrink-0 ml-3">
                                <i class="fas fa-eye text-[10px]"></i>
                                {{ $item->total }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-12 text-gray-300">
                    <i class="fas fa-chart-line text-3xl mb-3"></i>
                    <p class="text-sm text-gray-400">Belum ada data kunjungan produk</p>
                </div>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-sm font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-envelope text-cafe-500"></i>
                Pesan Masuk Terbaru
            </h3>
            <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-cafe-500 hover:text-cafe-600 transition-colors">
                Lihat Semua
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
        @if(isset($recentMessages) && $recentMessages->count())
            <div class="space-y-1">
                @foreach($recentMessages->take(5) as $message)
                    <a href="{{ route('admin.messages.show', $message) }}"
                       class="flex items-center gap-4 py-3 px-4 rounded-xl {{ !$loop->last ? 'border-b border-gray-50' : '' }} hover:bg-gray-50/70 transition-colors group">
                        <div class="w-9 h-9 rounded-full {{ $message->is_read ? 'bg-gray-100' : 'bg-cafe-100' }} flex items-center justify-center shrink-0">
                            <i class="fas fa-user text-sm {{ $message->is_read ? 'text-gray-400' : 'text-cafe-600' }}"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-medium text-gray-800">{{ $message->name }}</span>
                                @if(!$message->is_read)
                                    <span class="w-1.5 h-1.5 rounded-full bg-cafe-500 shrink-0"></span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-400 truncate mt-0.5">{{ $message->subject ?? 'Tidak ada subjek' }}</p>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-xs text-gray-400">{{ $message->created_at ? $message->created_at->diffForHumans() : '-' }}</p>
                            <span class="text-cafe-500 opacity-0 group-hover:opacity-100 transition-opacity text-xs inline-flex items-center gap-1 mt-0.5">
                                Baca <i class="fas fa-arrow-right text-[10px]"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-12 text-gray-300">
                <i class="fas fa-inbox text-3xl mb-3"></i>
                <p class="text-sm text-gray-400">Belum ada pesan masuk</p>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var labels = {!! json_encode(($visitorChart ?? collect())->keys()->toArray()) !!};
        var data = {!! json_encode(($visitorChart ?? collect())->values()->toArray()) !!};

        var ctx = document.getElementById('visitorChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Kunjungan',
                    data: data,
                    backgroundColor: '#8B5A3A',
                    borderRadius: 6,
                    borderSkipped: false,
                    barPercentage: 0.55,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleFont: { size: 12 },
                        bodyFont: { size: 13, weight: 'bold' },
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.parsed.y + ' kunjungan';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: '#9ca3af',
                            font: { size: 11 }
                        },
                        grid: { color: '#f3f4f6', drawBorder: false }
                    },
                    x: {
                        ticks: {
                            color: '#9ca3af',
                            font: { size: 11 },
                            maxTicksLimit: 7
                        },
                        grid: { display: false }
                    }
                },
                animation: {
                    duration: 800,
                    easing: 'easeOutQuart',
                }
            }
        });
    });
</script>
@endpush
