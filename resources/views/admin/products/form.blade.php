@extends('admin.layouts.app')

@section('title', isset($product) ? 'Edit Produk - Admin Pusat Furniture' : 'Tambah Produk - Admin Pusat Furniture')

@section('header', isset($product) ? 'Edit Produk' : 'Tambah Produk')

@section('content')
    <div class="max-w-3xl">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}"
                  method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @if (isset($product)) @method('PUT') @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                        <select name="product_category_id" required
                                class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cafe-500/20 focus:border-cafe-500 outline-none transition-colors">
                            <option value="">Pilih kategori</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('product_category_id', $product->product_category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Produk <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required maxlength="255"
                               class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cafe-500/20 focus:border-cafe-500 outline-none transition-colors">
                        <p class="text-xs text-gray-400 mt-1">Maksimal 255 karakter. Slug akan dibuat otomatis dari nama.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Kode Produk <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="code" value="{{ old('code', $product->code ?? '') }}" placeholder="Contoh: PRD-001"
                               class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cafe-500/20 focus:border-cafe-500 outline-none transition-colors">
                        <p class="text-xs text-gray-400 mt-1">Kode unik produk. Harus berbeda tiap produk.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Material <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="material" value="{{ old('material', $product->material ?? '') }}" maxlength="255"
                               class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cafe-500/20 focus:border-cafe-500 outline-none transition-colors">
                        <p class="text-xs text-gray-400 mt-1">Contoh: Kayu Mahoni, Kayu Jati</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Dimensi <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="dimensions" value="{{ old('dimensions', $product->dimensions ?? '') }}" placeholder="120 x 60 x 75 cm"
                               class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cafe-500/20 focus:border-cafe-500 outline-none transition-colors">
                        <p class="text-xs text-gray-400 mt-1">Format: Panjang x Lebar x Tinggi (cm)</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Finishing <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="finishing" value="{{ old('finishing', $product->finishing ?? '') }}" placeholder="Melamine, Duco, Natural"
                               class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cafe-500/20 focus:border-cafe-500 outline-none transition-colors">
                        <p class="text-xs text-gray-400 mt-1">Contoh: Melamine, Duco, Cat Natural, HPL</p>
                    </div>

                    <div x-data="{ visible: true, num: @json(old('price', $product->price ?? '')) }">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            <span>Harga Jual <span class="text-gray-400 font-normal">(opsional)</span></span>
                            <button @click="visible = !visible" type="button"
                                    :class="visible ? 'text-cafe-500' : 'text-gray-300'"
                                    class="ml-2 text-xs align-middle transition-colors duration-200">
                                <i class="far" :class="visible ? 'fa-eye' : 'fa-eye-slash'"></i>
                            </button>
                        </label>
                        <input type="hidden" name="price" :value="num">
                        <input type="text" inputmode="numeric" x-ref="display"
                               x-init="$el.value = num ? (parseInt(num) || 0).toLocaleString('id-ID') : ''"
                                @input="num = $event.target.value.replace(/[^0-9]/g, ''); $el.value = num ? (parseInt(num) || 0).toLocaleString('id-ID') : ''"
                                :disabled="!visible"
                                :class="!visible ? 'opacity-50 cursor-not-allowed' : ''"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cafe-500/20 focus:border-cafe-500 outline-none transition-colors">
                        <p class="text-xs text-gray-400 mt-1">Harga jual ke konsumen dalam Rupiah (Rp). Kosongkan jika belum ada.</p>
                    </div>

                    <div x-data="{ visible: true, num: @json(old('hpp', $product->hpp ?? '')) }">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            <span>HPP <span class="text-gray-400 font-normal">(opsional)</span></span>
                            <button @click="visible = !visible" type="button"
                                    :class="visible ? 'text-cafe-500' : 'text-gray-300'"
                                    class="ml-2 text-xs align-middle transition-colors duration-200">
                                <i class="far" :class="visible ? 'fa-eye' : 'fa-eye-slash'"></i>
                            </button>
                        </label>
                        <input type="hidden" name="hpp" :value="num">
                        <input type="text" inputmode="numeric" x-ref="display"
                               x-init="$el.value = num ? (parseInt(num) || 0).toLocaleString('id-ID') : ''"
                               @input="num = $event.target.value.replace(/[^0-9]/g, ''); $el.value = num ? (parseInt(num) || 0).toLocaleString('id-ID') : ''"
                               :disabled="!visible"
                               :class="!visible ? 'opacity-50 cursor-not-allowed' : ''"
                               class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cafe-500/20 focus:border-cafe-500 outline-none transition-colors">
                        <p class="text-xs text-gray-400 mt-1">Harga Pokok Penjualan (modal) dalam Rupiah. Hanya untuk internal.</p>
                    </div>

                    <div x-data="{ visible: true }">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            <span>Berat <span class="text-gray-400 font-normal">(opsional)</span></span>
                            <button @click="visible = !visible" type="button"
                                    :class="visible ? 'text-cafe-500' : 'text-gray-300'"
                                    class="ml-2 text-xs align-middle transition-colors duration-200">
                                <i class="far" :class="visible ? 'fa-eye' : 'fa-eye-slash'"></i>
                            </button>
                        </label>
                        <input type="text" name="weight" value="{{ old('weight', $product->weight ?? '') }}" placeholder="Contoh: 5 kg"
                               :disabled="!visible"
                               :class="!visible ? 'opacity-50 cursor-not-allowed' : ''"
                               class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-cafe-500/20 focus:border-cafe-500 outline-none transition-colors">
                        <p class="text-xs text-gray-400 mt-1">Berat produk. Kosongkan jika belum ada.</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="description" id="summernote-desc" rows="5" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm">{{ old('description', $product->description ?? '') }}</textarea>
                </div>

                <div x-data="{ previews: [] }">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Gambar <span class="text-red-500">*</span></label>
                    <input type="file" name="images[]" multiple accept="image/png,image/jpeg,image/jpg,image/webp"
                           @change="previews = Array.from($event.target.files).map(f => URL.createObjectURL(f))"
                           x-ref="fileInput"
                           class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-cafe-500 file:text-white file:text-sm file:font-medium hover:file:bg-cafe-600 transition-colors">
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WebP. Maksimal 2MB per gambar. Bisa pilih banyak file sekaligus.</p>
                    <div x-show="previews.length" class="flex flex-wrap gap-2 mt-3">
                        <template x-for="(pr, idx) in previews" :key="idx">
                            <div class="relative">
                                <img :src="pr" class="w-16 h-16 rounded-lg object-cover border border-gray-200 shadow-sm cursor-pointer" @click="imgPopup = pr">
                                <button type="button" @@click="previews = previews.filter((_, i) => i !== idx)"
                                        class="absolute -top-2 -right-2 w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600 transition-colors shadow-sm">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                    @if (isset($product) && $product->images && count($product->images) > 0)
                        <input type="hidden" name="remove_all_images" value="0" x-ref="removeInput">
                        <div x-data="{ existingImgs: true }" x-show="existingImgs" class="mt-3">
                            <div class="flex flex-wrap gap-2">
                                @foreach ($product->images as $img)
                                    @php $pImg = Str::startsWith($img->image, 'http') ? $img->image : asset('storage/' . $img->image); @endphp
                                    <div class="relative">
                                        <img src="{{ $pImg }}" alt="Preview" class="w-16 h-16 rounded-lg object-cover border border-gray-200 shadow-sm cursor-pointer" @click="imgPopup = '{{ $pImg }}'">
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" @click="existingImgs = false; $refs.removeInput.value = '1'"
                                    class="mt-2 text-xs text-red-500 hover:text-red-600 transition-colors">
                                <i class="fas fa-times"></i> Hapus semua gambar saat ini
                            </button>
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                        {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-gray-300 text-cafe-500 focus:ring-cafe-500/20">
                    <label for="is_active" class="text-sm text-gray-600">Aktif</label>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-cafe-500 text-white font-medium rounded-xl hover:bg-cafe-600 transition-colors shadow-sm">
                        <i class="far fa-floppy-disk"></i> {{ isset($product) ? 'Perbarui' : 'Simpan' }}
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        if (typeof $.fn.summernote === 'undefined') { loadSummernote(); }
        const _initSn = setInterval(function() {
            if (typeof $.fn.summernote !== 'undefined') {
                clearInterval(_initSn);
                $('#summernote-desc').summernote({
                    height: 200,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link']],
                        ['view', ['codeview']]
                    ]
                });
            }
        }, 200);
    });
</script>
@endpush
