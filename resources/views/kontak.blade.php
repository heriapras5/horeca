@extends('layouts.app')

@section('title', 'Hubungi Kami - Pusat Furniture Cafe dan Resto')
@section('meta_description', 'Hubungi Pusat Furniture Cafe dan Resto untuk konsultasi, pertanyaan, atau pemesanan furnitur cafe dan resto.')

@section('content')
    <section class="py-16 bg-gradient-to-br from-cafe-800 to-cafe-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold">Hubungi Kami</h1>
            <p class="text-white/80 mt-2 max-w-2xl mx-auto">Kami siap membantu Anda. Silakan hubungi kami melalui form di bawah atau langsung via WhatsApp.</p>
        </div>
    </section>

    <section class="py-12 bg-white" data-aos="slide-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <div data-aos="slide-right">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>

                    @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                             class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="flex-1 text-sm font-medium">{{ session('success') }}</span>
                            <button @@click="show = false" class="text-green-400 hover:text-green-600"><i class="fas fa-times"></i></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                             class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl">
                            <i class="fas fa-exclamation-circle text-red-500"></i>
                            <span class="flex-1 text-sm font-medium">{{ session('error') }}</span>
                            <button @@click="show = false" class="text-red-400 hover:text-red-600"><i class="fas fa-times"></i></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama Anda"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-cafe-300 focus:border-cafe-500 outline-none transition-all duration-200 @error('name') border-red-300 @enderror">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-cafe-300 focus:border-cafe-500 outline-none transition-all duration-200 @error('email') border-red-300 @enderror">
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Nomor telepon (opsional)"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-cafe-300 focus:border-cafe-500 outline-none transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Subjek pesan"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-cafe-300 focus:border-cafe-500 outline-none transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pesan <span class="text-red-500">*</span></label>
                            <textarea name="message" rows="5" placeholder="Tulis pesan Anda di sini..."
                                      class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-cafe-300 focus:border-cafe-500 outline-none transition-all duration-200 resize-none @error('message') border-red-300 @enderror">{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" class="btn-primary w-full">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Kirim Pesan
                        </button>
                    </form>
                </div>

                @php $_kontakSettings = $_globalSettings ?? []; @endphp
                <div data-aos="slide-left">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Kontak</h2>
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4 p-4 bg-white rounded-xl shadow-sm">
                            <div class="w-12 h-12 bg-cafe-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-cafe-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Alamat</h3>
                                <p class="text-gray-500">{{ $_kontakSettings['address'] ?? 'Jl. Kayu Indah No. 123, Kelapa Gading, Jakarta Utara 14240' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 p-4 bg-white rounded-xl shadow-sm">
                            <div class="w-12 h-12 bg-cafe-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-cafe-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Telepon / WhatsApp</h3>
                                <p class="text-gray-500">{{ $_kontakSettings['phone'] ?? '+62 812-3456-7890' }}</p>
                                @php $_waKontak = $_kontakSettings['whatsapp_number'] ?? '6281234567890'; @endphp
                                <a href="https://wa.me/{{ $_waKontak }}" target="_blank" class="text-cafe-500 hover:text-cafe-600 text-sm font-medium transition-colors duration-200">Chat via WhatsApp &rarr;</a>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 p-4 bg-white rounded-xl shadow-sm">
                            <div class="w-12 h-12 bg-cafe-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-cafe-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Email</h3>
                                <p class="text-gray-500">{{ $_kontakSettings['email'] ?? 'hello@pusatfurniturecafe.com' }}</p>
                                <a href="mailto:{{ $_kontakSettings['email'] ?? 'hello@pusatfurniturecafe.com' }}" class="text-cafe-500 hover:text-cafe-600 text-sm font-medium transition-colors duration-200">Kirim Email &rarr;</a>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 p-4 bg-white rounded-xl shadow-sm">
                            <div class="w-12 h-12 bg-cafe-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-cafe-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Jam Operasional</h3>
                                    @php $_hours = explode("\n", $_kontakSettings['operational_hours'] ?? "Senin - Jumat: 08:00 - 17:00\nSabtu: 08:00 - 14:00"); @endphp
                                    @foreach ($_hours as $_h)
                                        @if (trim($_h))
                                            <p class="text-gray-500">{{ trim($_h) }}</p>
                                        @endif
                                    @endforeach
                                </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Lokasi Kami</h3>
                        <div class="rounded-xl overflow-hidden shadow-md">
                            <iframe src="{{ $_kontakSettings['maps_embed'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.294198707424!2d106.865035!3d-6.179518!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f4f5f5b5b5b5%3A0x0!2zNsKwMTAnNDYuMiJTIDEwNsKwNTEnNTQuMSJF!5e0!3m2!1sid!2sid!4v1' }}" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-cafe-500 text-white text-center">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-4">Lebih Nyaman Chat via WhatsApp?</h2>
            <p class="text-white/80 mb-8">Kami siap merespon pertanyaan Anda dengan cepat</p>
            @php $_waKontak2 = ($_globalSettings['whatsapp_number'] ?? null) ?: '6281234567890'; @endphp
            <a href="https://wa.me/{{ $_waKontak2 }}?text=Halo%2C%20saya%20ingin%20bertanya%20tentang%20produk%20{{ urlencode($_globalSiteName) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-8 py-4 bg-white text-cafe-600 font-semibold rounded-xl shadow-lg hover:bg-gray-100 transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                Hubungi via WhatsApp
            </a>
        </div>
    </section>
@endsection
