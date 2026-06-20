@extends('admin.layouts.app')

@section('title', isset($admin) ? 'Edit Admin - Admin Pusat Furniture' : 'Tambah Admin - Admin Pusat Furniture')
@section('header', isset($admin) ? 'Edit Admin' : 'Tambah Admin')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <form action="{{ isset($admin) ? route('admin.admins.update', $admin) : route('admin.admins.store') }}"
                  method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @if (isset($admin)) @method('PUT') @endif

                <div class="flex flex-col sm:flex-row gap-5">
                    <div class="flex-1 space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $admin->name ?? '') }}" required maxlength="255"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cafe-500/20 focus:border-cafe-500 outline-none transition-colors"
                                   placeholder="Masukkan nama admin">
                            <p class="text-xs text-gray-400 mt-1">Maksimal 255 karakter.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email', $admin->email ?? '') }}" required maxlength="255"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cafe-500/20 focus:border-cafe-500 outline-none transition-colors"
                                   placeholder="admin@example.com">
                            <p class="text-xs text-gray-400 mt-1">Email harus unik. Digunakan untuk login.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Password <span class="text-red-500">*</span>
                                @if(isset($admin))
                                    <span class="text-gray-400 font-normal">(kosongkan jika tidak diubah)</span>
                                @endif
                            </label>
                            <input type="password" name="password" {{ !isset($admin) ? 'required' : '' }} minlength="6"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cafe-500/20 focus:border-cafe-500 outline-none transition-colors"
                                   placeholder="Minimal 6 karakter">
                            <p class="text-xs text-gray-400 mt-1">Minimal 6 karakter. Gunakan kombinasi huruf dan angka untuk keamanan.</p>
                        </div>
                    </div>

                    @php $_existingAva = (isset($admin) && $admin->avatar) ? $admin->avatar_url : null; @endphp
                    <div class="w-full sm:w-48 flex flex-col items-center" x-data="{ preview: null, existing: '{{ $_existingAva }}' }">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5 self-start">Foto Profil</label>
                        <div class="relative w-36 h-36 rounded-full overflow-hidden border-2 border-dashed border-gray-300 bg-gray-50 flex items-center justify-center">
                            <img x-show="preview" :src="preview" class="w-full h-full object-cover">
                            <img x-show="!preview && existing" :src="existing" class="w-full h-full object-cover">
                            <i x-show="!preview && !existing" class="fas fa-user text-4xl text-gray-300"></i>
                        </div>
                        <input type="file" name="avatar" accept="image/png,image/jpeg,image/jpg,image/webp"
                               @change="preview = URL.createObjectURL($event.target.files[0]); existing = ''"
                               x-ref="fileInput"
                               class="mt-2 w-full text-xs file:mr-2 file:py-1 file:px-2 file:rounded-lg file:border-0 file:bg-cafe-500 file:text-white file:text-xs file:font-medium hover:file:bg-cafe-600 transition-colors @error('avatar') border-red-300 @enderror">
                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WebP. Maksimal 2MB.</p>
                        <button type="button" x-show="preview" @click="preview = null; existing = '{{ $_existingAva }}'; $refs.fileInput.value = ''"
                                class="mt-1 text-xs text-red-500 hover:text-red-600">Hapus</button>
                        @error('avatar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-cafe-500 text-white font-medium rounded-xl hover:bg-cafe-600 transition-colors shadow-sm">
                        <i class="far fa-floppy-disk"></i> {{ isset($admin) ? 'Perbarui' : 'Simpan' }}
                    </button>
                    <a href="{{ route('admin.admins.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
