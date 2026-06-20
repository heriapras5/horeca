@extends('admin.layouts.app')

@section('title', 'Manajemen Admin - Admin Pusat Furniture')
@section('header', 'Manajemen Admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Manajemen Admin</h2>
            <p class="text-sm text-gray-500 mt-0.5">Kelola akun administrator</p>
        </div>
        <a href="{{ route('admin.admins.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-cafe-500 text-white font-medium rounded-xl hover:bg-cafe-600 transition-colors shadow-sm">
            <i class="fas fa-plus"></i> Tambah Admin
        </a>
    </div>

    <form method="GET" action="{{ route('admin.admins.index') }}" class="mb-6">
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari admin..."
                       class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-cafe-500 focus:border-cafe-500 outline-none transition-colors">
            </div>
            <button type="submit" class="px-5 py-2.5 bg-cafe-500 text-white font-medium rounded-xl hover:bg-cafe-600 transition-colors shadow-sm">
                <i class="fas fa-search mr-1"></i> Cari
            </button>
            @if(request()->filled('search'))
                <a href="{{ route('admin.admins.index') }}" class="inline-flex items-center px-4 py-2.5 border border-gray-300 text-gray-600 font-medium rounded-xl hover:bg-gray-50 transition-colors">
                    <i class="fas fa-times mr-1"></i> Reset filter
                </a>
            @endif
        </div>
    </form>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if ($admins->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/50">
                            <th class="text-left px-5 py-3.5 font-medium text-gray-500 text-xs uppercase tracking-wider">#</th>
                            <th class="text-left px-5 py-3.5 font-medium text-gray-500 text-xs uppercase tracking-wider">Nama</th>
                            <th class="text-left px-5 py-3.5 font-medium text-gray-500 text-xs uppercase tracking-wider hidden sm:table-cell">Email</th>
                            <th class="text-left px-5 py-3.5 font-medium text-gray-500 text-xs uppercase tracking-wider hidden md:table-cell">Bergabung</th>
                            <th class="text-right px-5 py-3.5 font-medium text-gray-500 text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($admins as $admin)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-5 py-4 text-gray-400 text-sm">{{ $admins->firstItem() + $loop->index }}</td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($admin->avatar_url)
                                            <img src="{{ $admin->avatar_url }}" alt="{{ $admin->name }}" class="w-8 h-8 rounded-full object-cover cursor-pointer" @click="imgPopup = '{{ $admin->avatar_url }}'">
                                        @else
                                            <div class="w-8 h-8 rounded-full bg-cafe-500 flex items-center justify-center text-white text-xs font-bold shrink-0">
                                                {{ strtoupper(substr($admin->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <span class="font-medium text-gray-800">{{ $admin->name }}</span>
                                            @if ($admin->id === auth()->id())
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-blue-50 text-blue-600 ml-1">Anda</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-gray-500 hidden sm:table-cell">{{ $admin->email }}</td>
                                <td class="px-5 py-4 text-gray-400 text-xs hidden md:table-cell">{{ $admin->created_at?->format('d M Y') ?? '-' }}</td>
                                <td class="px-5 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.admins.edit', $admin) }}"
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-blue-500 hover:bg-blue-50 hover:text-blue-600 transition-colors"
                                           title="Edit">
                                            <i class="far fa-pen-to-square"></i>
                                        </a>
                                        @if ($admin->id !== auth()->id())
                                            <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" id="delete-admin-{{ $admin->id }}">
                                                @csrf @method('DELETE')
                                                <button type="button" onclick="confirmDelete('delete-admin-{{ $admin->id }}')"
                                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-red-500 hover:bg-red-50 hover:text-red-600 transition-colors"
                                                        title="Hapus">
                                                    <i class="far fa-trash-can"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-5 py-4 border-t border-gray-100">
                {{ $admins->links() }}
            </div>
        @else
            <div class="text-center py-12 text-gray-400">
                @if(request()->filled('search'))
                    <i class="fas fa-search text-3xl mb-3 block"></i>
                    <p class="text-sm">Data tidak ditemukan</p>
                    <p class="text-xs text-gray-400 mt-1">Pencarian tidak sesuai dengan data yang tersedia</p>
                    <a href="{{ route('admin.admins.index') }}" class="text-cafe-500 hover:text-cafe-600 text-sm font-medium mt-3 inline-block">Reset filter</a>
                @else
                    <i class="fas fa-users text-3xl mb-3 block"></i>
                    <p class="text-sm">Belum ada admin</p>
                    <a href="{{ route('admin.admins.create') }}" class="text-cafe-500 hover:text-cafe-600 text-sm font-medium mt-2 inline-block">Tambah admin pertama</a>
                @endif
            </div>
        @endif
    </div>
@endsection