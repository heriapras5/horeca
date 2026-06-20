@extends('admin.layouts.app')

@section('title', 'Produk - Admin Pusat Furniture')

@section('header', 'Produk')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Produk</h2>
            <p class="text-sm text-gray-500 mt-0.5">Kelola katalog produk furnitur</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-cafe-500 text-white font-medium rounded-xl hover:bg-cafe-600 transition-colors shadow-sm">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>

    <form method="GET" action="{{ route('admin.products.index') }}" class="mb-6">
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari produk..."
                       class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-cafe-500 focus:border-cafe-500 outline-none transition-colors">
            </div>
            <select name="category" class="px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-cafe-500 focus:border-cafe-500 outline-none transition-colors bg-white">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <select name="status" class="px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-cafe-500 focus:border-cafe-500 outline-none transition-colors bg-white">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
            <button type="submit" class="px-5 py-2.5 bg-cafe-500 text-white font-medium rounded-xl hover:bg-cafe-600 transition-colors shadow-sm">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
            @if(request()->anyFilled(['search', 'category', 'status']))
                <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2.5 border border-gray-300 text-gray-600 font-medium rounded-xl hover:bg-gray-50 transition-colors">
                    <i class="fas fa-times mr-1"></i> Reset
                </a>
            @endif
        </div>
    </form>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if ($products->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/50">
                            <th class="text-left px-5 py-3.5 font-medium text-gray-500 text-xs uppercase tracking-wider whitespace-nowrap">#</th>
                            <th class="text-left px-5 py-3.5 font-medium text-gray-500 text-xs uppercase tracking-wider whitespace-nowrap">Gambar</th>
                            <th class="text-left px-5 py-3.5 font-medium text-gray-500 text-xs uppercase tracking-wider whitespace-nowrap">Nama</th>
                            <th class="text-left px-5 py-3.5 font-medium text-gray-500 text-xs uppercase tracking-wider whitespace-nowrap hidden md:table-cell">Kategori</th>
                            <th class="text-left px-5 py-3.5 font-medium text-gray-500 text-xs uppercase tracking-wider whitespace-nowrap hidden xl:table-cell">Kode</th>
                            <th class="text-left px-5 py-3.5 font-medium text-gray-500 text-xs uppercase tracking-wider whitespace-nowrap hidden xl:table-cell">Material</th>
                            <th class="text-right px-5 py-3.5 font-medium text-gray-500 text-xs uppercase tracking-wider whitespace-nowrap hidden md:table-cell">HPP</th>
                            <th class="text-right px-5 py-3.5 font-medium text-gray-500 text-xs uppercase tracking-wider whitespace-nowrap hidden md:table-cell">Harga</th>
                            <th class="text-center px-5 py-3.5 font-medium text-gray-500 text-xs uppercase tracking-wider whitespace-nowrap hidden sm:table-cell">Status</th>
                            <th class="text-right px-5 py-3.5 font-medium text-gray-500 text-xs uppercase tracking-wider whitespace-nowrap sticky right-0 bg-gray-50/50 z-10">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($products as $product)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-5 py-4 text-gray-400 text-sm">{{ $products->firstItem() + $loop->index }}</td>
                                <td class="px-5 py-4">
                                    @if ($product->images && count($product->images) > 0)
                                        @php $_pImg = $product->images[0]->image ?? ''; $_pImg = Str::startsWith($_pImg, 'http') ? $_pImg : asset('storage/' . $_pImg); @endphp
                                        <img src="{{ $_pImg }}" alt="{{ $product->name }}" class="w-14 h-14 rounded-lg object-cover cursor-pointer" @click="imgPopup = '{{ $_pImg }}'">
                                    @else
                                        <div class="w-14 h-14 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 cursor-default">
                                            <i class="fas fa-box text-lg"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-5 py-4 max-w-[250px] truncate" title="{{ $product->name }}">
                                    <p class="font-medium text-gray-800">{{ $product->name }}</p>
                                </td>
                                <td class="px-5 py-4 text-gray-500 hidden md:table-cell max-w-[150px] truncate" title="{{ $product->category?->name ?? '-' }}">{{ $product->category?->name ?? '-' }}</td>
                                <td class="px-5 py-4 text-gray-500 font-mono text-xs hidden xl:table-cell max-w-[100px] truncate" title="{{ $product->code ?? '-' }}">{{ $product->code ?? '-' }}</td>
                                <td class="px-5 py-4 text-gray-400 hidden xl:table-cell max-w-[150px] truncate" title="{{ $product->material ?? '-' }}">{{ $product->material ?? '-' }}</td>
                                <td class="px-5 py-4 text-right text-gray-400 hidden md:table-cell whitespace-nowrap">
                                    {{ $product->hpp ? 'Rp ' . number_format($product->hpp, 0, ',', '.') : '-' }}
                                </td>
                                <td class="px-5 py-4 text-right text-gray-600 hidden md:table-cell whitespace-nowrap">
                                    {{ $product->price ? 'Rp ' . number_format($product->price, 0, ',', '.') : '-' }}
                                </td>
                                <td class="px-5 py-4 text-center hidden sm:table-cell">
                                    @if ($product->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-right sticky right-0 bg-white z-10 shadow-[-4px_0_8px_-4px_rgba(0,0,0,0.05)]">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-blue-500 hover:bg-blue-50 hover:text-blue-600 transition-colors"
                                           title="Edit">
                                            <i class="far fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                              id="delete-form-{{ $product->id }}">
                                            @csrf @method('DELETE')
                                            <button type="button" onclick="confirmDelete('delete-form-{{ $product->id }}')"
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-red-500 hover:bg-red-50 hover:text-red-600 transition-colors"
                                                    title="Hapus">
                                                <i class="far fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-5 py-4 border-t border-gray-100">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-12 text-gray-400">
                @if(request()->anyFilled(['search', 'category', 'status']))
                    <i class="fas fa-search text-3xl mb-3 block"></i>
                    <p class="text-sm">Data tidak ditemukan</p>
                    <p class="text-xs text-gray-400 mt-1">Pencarian tidak sesuai dengan data yang tersedia</p>
                    <a href="{{ route('admin.products.index') }}" class="text-cafe-500 hover:text-cafe-600 text-sm font-medium mt-3 inline-block">Reset filter</a>
                @else
                    <i class="fas fa-box text-3xl mb-3 block"></i>
                    <p class="text-sm">Belum ada produk</p>
                    <a href="{{ route('admin.products.create') }}" class="text-cafe-500 hover:text-cafe-600 text-sm font-medium mt-2 inline-block">Tambah produk pertama</a>
                @endif
            </div>
        @endif
    </div>
@endsection