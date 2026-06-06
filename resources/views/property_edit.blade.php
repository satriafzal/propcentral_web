@extends('layout.layout')

@php $hideSearchFilter = true; @endphp

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        
        <div class="mb-6">
            <a href="/penawaran-saya" class="text-gray-500 hover:text-[#3b2a22] flex items-center text-sm font-medium transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Kembali ke Penawaran Saya
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-[#3b2a22] p-6 text-white">
                <h1 class="text-2xl font-bold">Edit Iklan Properti</h1>
                <p class="text-gray-300 text-sm mt-1">Perbarui informasi data properti Anda dengan valid.</p>
            </div>

            <form action="/property/{{ $property->id }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf
                @method('PUT') {{-- WAJIB: Untuk memberi tahu Laravel ini proses UPDATE --}}

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Iklan</label>
                    <input type="text" name="title" value="{{ old('title', $property->title) }}" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#3b2a22] focus:border-[#3b2a22] outline-none transition-all">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tipe Properti</label>
                        <select name="type" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#3b2a22] focus:border-[#3b2a22] outline-none transition-all">
                            <option value="Rumah" {{ $property->type == 'Rumah' ? 'selected' : '' }}>Rumah</option>
                            <option value="Apartemen" {{ $property->type == 'Apartemen' ? 'selected' : '' }}>Apartemen</option>
                            <option value="Ruko" {{ $property->type == 'Ruko' ? 'selected' : '' }}>Ruko</option>
                            <option value="Tanah" {{ $property->type == 'Tanah' ? 'selected' : '' }}>Tanah</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Harga (Rp)</label>
                        <input type="number" name="price" value="{{ old('price', $property->price) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#3b2a22] focus:border-[#3b2a22] outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Properti</label>
                    <textarea name="description" rows="5" required
                              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#3b2a22] focus:border-[#3b2a22] outline-none transition-all">{{ old('description', $property->description) }}</textarea>
                </div>

                <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100 grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1">Luas Tanah (m²)</label>
                        <input type="number" name="land_area" value="{{ old('land_area', $property->land_area) }}" required class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1">Luas Bangunan (m²)</label>
                        <input type="number" name="building_area" value="{{ old('building_area', $property->building_area) }}" required class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1">Sertifikat</label>
                        <select name="certificate" required class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm">
                            <option value="SHM" {{ $property->certificate == 'SHM' ? 'selected' : '' }}>SHM</option>
                            <option value="HGB" {{ $property->certificate == 'HGB' ? 'selected' : '' }}>HGB</option>
                            <option value="Lainnya" {{ $property->certificate == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1">Kamar Tidur</label>
                        <input type="number" name="bedroom" value="{{ old('bedroom', $property->bedroom) }}" required class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1">Kamar Mandi</label>
                        <input type="number" name="bathroom" value="{{ old('bathroom', $property->bathroom) }}" required class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1">Garasi / Carport</label>
                        <input type="number" name="garage" value="{{ old('garage', $property->garage) }}" required class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap Properti</label>
                    <input type="text" name="address" value="{{ old('address', $property->address) }}" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#3b2a22] focus:border-[#3b2a22] outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Ganti Foto Properti (Maksimal 5 Foto)</label>
                    <p class="text-xs text-amber-600 mb-3">*Biarkan kosong jika tidak ingin mengubah foto lama.</p>
                    <input type="file" name="images[]" multiple accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 file:cursor-pointer">
                    
                    <div class="flex gap-2 mt-4 overflow-x-auto py-2">
                        @foreach($property->images as $img)
                            <div class="relative w-20 h-20 border rounded-lg overflow-hidden shrink-0">
                                <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                    <a href="/penawaran-saya" class="px-6 py-3 rounded-xl font-bold bg-gray-100 hover:bg-gray-200 text-gray-700 transition-colors">Batal</a>
                    <button type="submit" class="px-6 py-3 rounded-xl font-bold bg-[#3b2a22] hover:bg-opacity-90 text-white shadow-md transition-colors">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection