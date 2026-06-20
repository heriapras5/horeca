@extends('admin.layouts.app')

@section('title', isset($category) ? 'Edit Kategori Blog - Admin Pusat Furniture' : 'Tambah Kategori Blog - Admin Pusat Furniture')

@section('header', isset($category) ? 'Edit Kategori Blog' : 'Tambah Kategori Blog')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <form action="{{ isset($category) ? route('admin.blog-categories.update', $category) : route('admin.blog-categories.store') }}"
                  method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @if (isset($category)) @method('PUT') @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Kategori <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" required maxlength="255"
                           class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cafe-500/20 focus:border-cafe-500 outline-none transition-colors">
                    <p class="text-xs text-gray-400 mt-1">Maksimal 255 karakter. Slug akan dibuat otomatis dari nama.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cafe-500/20 focus:border-cafe-500 outline-none transition-colors">{{ old('description', $category->description ?? '') }}</textarea>
                </div>

                <div x-data="{ preview: null }">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Gambar <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <input type="file" name="image" accept="image/png,image/jpeg,image/jpg,image/webp"
                           @change="preview = URL.createObjectURL($event.target.files[0])"
                           x-ref="fileInput"
                           class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-cafe-500 file:text-white file:text-sm file:font-medium hover:file:bg-cafe-600 transition-colors">
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WebP. Maksimal 2MB.</p>
                    <div x-show="preview" class="relative mt-3 inline-block">
                        <img :src="preview" class="w-24 h-24 rounded-lg object-cover border border-gray-200 shadow-sm cursor-pointer" @click="imgPopup = preview">
                        <button type="button" @click="preview = null; $refs.fileInput.value = ''"
                                class="absolute -top-2.5 -right-2.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600 transition-colors shadow-sm">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    @if (isset($category) && $category->image)
                        @php $catImg = Str::startsWith($category->image, 'http') ? $category->image : asset('storage/' . $category->image); @endphp
                        <input type="hidden" name="remove_image" value="0" x-ref="removeInput">
                        <div x-data="{ showExisting: true }" x-show="showExisting" class="relative mt-3 inline-block">
                            <img src="{{ $catImg }}" alt="Preview" class="w-24 h-24 rounded-lg object-cover border border-gray-200 shadow-sm cursor-pointer" @click="imgPopup = '{{ $catImg }}'">
                            <button type="button" @click="showExisting = false; $refs.removeInput.value = '1'"
                                    class="absolute -top-2.5 -right-2.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600 transition-colors shadow-sm">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <span x-data="{ showExisting: true }" x-show="showExisting" class="text-xs text-gray-400 block mt-1">Gambar saat ini</span>
                    @endif
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                        {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-gray-300 text-cafe-500 focus:ring-cafe-500/20">
                    <label for="is_active" class="text-sm text-gray-600">Aktif</label>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-cafe-500 text-white font-medium rounded-xl hover:bg-cafe-600 transition-colors shadow-sm">
                        <i class="far fa-floppy-disk"></i> {{ isset($category) ? 'Perbarui' : 'Simpan' }}
                    </button>
                    <a href="{{ route('admin.blog-categories.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
