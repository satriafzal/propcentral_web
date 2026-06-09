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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap Properti</label>
                        <input type="text" name="address" value="{{ old('address', $property->address) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#3b2a22] focus:border-[#3b2a22] outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kota</label>
                        <input type="text" name="city" list="daftar-kota-jual" value="{{ old('city', $property->city) }}" required placeholder="Contoh: Jakarta Selatan, Depok, dll..."
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#3b2a22] focus:border-[#3b2a22] outline-none transition-all">
                        
                        {{-- Datalist Autocomplete --}}
                        @if(isset($cities))
                        <datalist id="daftar-kota-jual">
                            @foreach($cities as $c)
                                <option value="{{ $c }}">
                            @endforeach
                        </datalist>
                        @endif
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Ganti Foto Properti</label>
                    
                    {{-- Upload Area --}}
                    <label for="images" class="border-2 border-dashed border-gray-300 rounded-2xl bg-gray-50/50 p-10 flex flex-col items-center justify-center text-center hover:bg-gray-50 transition-colors cursor-pointer mb-6 mt-2 block w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-400 mb-3 mx-auto">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                        </svg>
                        <p class="text-gray-800 font-medium mb-1">Unggah Foto Properti Baru (Timpa Foto Lama)</p>
                        <p class="text-gray-400 text-xs">Maksimal 5 foto, ukuran maks 2MB per foto. Biarkan kosong jika tidak ingin mengubah foto lama.</p>
                        <input type="file" name="images[]" id="images" multiple accept="image/*" class="hidden">
                    </label>

                    {{-- Thumbnails Container for New Images --}}
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 hidden" id="thumbnailContainer">
                        @for($i=0; $i<5; $i++)
                        <div class="aspect-square bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 border border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                            </svg>
                        </div>
                        @endfor
                    </div>

                    <div id="oldImagesContainer">
                        <label class="block text-sm font-bold text-gray-700 mt-4 mb-2">Foto Saat Ini</label>
                        <div class="flex gap-2 overflow-x-auto py-2">
                            @foreach($property->images as $img)
                                <div class="relative w-20 h-20 border rounded-lg overflow-hidden shrink-0">
                                    <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ================= Image Preview Logic =================
        const imageInput = document.getElementById('images');
        const thumbnailContainer = document.getElementById('thumbnailContainer');
        const oldImagesContainer = document.getElementById('oldImagesContainer');
        let dataTransfer = new DataTransfer();

        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                // Hide old images if new ones are selected
                if(this.files.length > 0) {
                    oldImagesContainer.classList.add('hidden');
                    thumbnailContainer.classList.remove('hidden');
                } else {
                    oldImagesContainer.classList.remove('hidden');
                    thumbnailContainer.classList.add('hidden');
                }

                // Add new files to dataTransfer up to 5 max
                for (let i = 0; i < this.files.length; i++) {
                    if (dataTransfer.items.length < 5) {
                        dataTransfer.items.add(this.files[i]);
                    } else {
                        alert("Maksimal 5 foto yang bisa diunggah.");
                        break;
                    }
                }
                // Update input files with our managed list
                this.files = dataTransfer.files;
                renderThumbnails();
            });
        }

        function renderThumbnails() {
            thumbnailContainer.innerHTML = '';
            const files = imageInput.files;
            
            for (let i = 0; i < 5; i++) {
                if (i < files.length) {
                    const file = files[i];
                    const reader = new FileReader();
                    
                    const box = document.createElement('div');
                    box.className = "aspect-square rounded-xl overflow-hidden relative group border border-gray-200 shadow-sm";
                    
                    const img = document.createElement('img');
                    img.className = "w-full h-full object-cover";
                    
                    reader.onload = function(e) {
                        img.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                    
                    const overlay = document.createElement('div');
                    overlay.className = "absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center";
                    
                    const deleteBtn = document.createElement('button');
                    deleteBtn.type = "button";
                    deleteBtn.className = "bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors shadow-lg scale-90 group-hover:scale-100";
                    deleteBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>';
                    deleteBtn.onclick = function(e) {
                        e.preventDefault();
                        removeImage(i);
                    };
                    
                    overlay.appendChild(deleteBtn);
                    box.appendChild(img);
                    box.appendChild(overlay);
                    
                    thumbnailContainer.appendChild(box);
                } else {
                    const box = document.createElement('div');
                    box.className = "aspect-square bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 border border-gray-200";
                    box.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" /></svg>';
                    thumbnailContainer.appendChild(box);
                }
            }
        }

        function removeImage(index) {
            const newDataTransfer = new DataTransfer();
            const files = imageInput.files;
            
            for (let i = 0; i < files.length; i++) {
                if (i !== index) {
                    newDataTransfer.items.add(files[i]);
                }
            }
            
            imageInput.files = newDataTransfer.files;
            dataTransfer = newDataTransfer; // sync state
            renderThumbnails();
            
            // If all files removed, show old images again
            if(imageInput.files.length === 0) {
                oldImagesContainer.classList.remove('hidden');
                thumbnailContainer.classList.add('hidden');
            }
        }
    });
</script>
@endsection