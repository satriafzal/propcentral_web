@extends('layout.layout')

@php $hideSearchFilter = true; @endphp

@section('content')

{{-- Leaflet CSS & JS for Interactive Map --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<section class="bg-[#faf9f8] pt-12 pb-24 px-10">
    <div class="max-w-6xl mx-auto flex flex-col lg:flex-row gap-12">
        
        {{-- Left Column: Title & Description --}}
        <div class="lg:w-1/3">
            <div class="sticky top-28">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-4 leading-tight">Jual Properti <br> Anda</h1>
                <p class="text-gray-600 leading-relaxed text-lg">
                    Jangkau ribuan calon pembeli dengan memberikan informasi yang jelas dan detail tentang aset premium Anda.
                </p>
            </div>
        </div>

        {{-- Right Column: Form Cards --}}
        <div class="lg:w-2/3">
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-xl">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada input:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('property.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-8">
                @csrf
                
                {{-- 1. Basic Information --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center gap-2 mb-6 text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                        <h2 class="text-xl font-bold">Informasi Dasar</h2>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm text-gray-600 mb-2">Judul Properti</label>
                            <input type="text" name="title" required placeholder="misal. Villa Modern Minimalis di Uluwatu" class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-2">Deskripsi</label>
                            <textarea rows="4" name="description" required placeholder="Jelaskan fitur unik dan nilai jual properti Anda..." class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600 transition-all resize-none"></textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm text-gray-600 mb-2">Harga (Rp)</label>
                                <input type="number" name="price" required placeholder="0" class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600 transition-all">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-2">Tipe Properti</label>
                                <select name="type" required class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600 transition-all bg-white">
                                    <option>Rumah</option>
                                    <option>Apartemen</option>
                                    <option>Vila</option>
                                    <option>Tanah</option>
                                    <option>Ruko</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. Detailed Specs --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center gap-2 mb-6 text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                        <h2 class="text-xl font-bold">Spesifikasi Detail</h2>
                    </div>

                    <div class="grid grid-cols-3 gap-5">
                        <div>
                            <label class="block text-sm text-gray-600 mb-2">Luas Tanah (m²)</label>
                            <input type="number" name="land_area" required placeholder="0" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-2">Luas Bangunan (m²)</label>
                            <input type="number" name="building_area" required placeholder="0" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-2">Kamar Tidur</label>
                            <input type="number" name="bedroom" required placeholder="0" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-2">Kamar Mandi</label>
                            <input type="number" name="bathroom" required placeholder="0" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-2">Kapasitas Garasi</label>
                            <input type="number" name="garage" required placeholder="0" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-2">Sertifikat</label>
                            <select name="certificate" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600 transition-all bg-white">
                                <option>SHM (Hak Milik)</option>
                                <option>HGB (Hak Guna Bangunan)</option>
                                <option>Strata Title</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- 3. Location --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center gap-2 mb-6 text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        <h2 class="text-xl font-bold">Lokasi</h2>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm text-gray-600 mb-2">Alamat Lengkap</label>
                            <input type="text" name="address" required placeholder="Masukkan alamat lengkap properti" class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600 transition-all">
                        </div>
                        
                        {{-- Map Container --}}
                        <div class="relative w-full h-64 bg-gray-200 rounded-xl overflow-hidden border border-gray-200">
                            <div id="propertyMap" class="w-full h-full z-10"></div>
                            <div class="absolute bottom-4 right-4 z-[20]">
                                <span class="bg-white/90 backdrop-blur text-gray-700 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                                    Geser pin untuk menentukan lokasi
                                </span>
                            </div>
                        </div>
                        <input type="hidden" name="latitude" id="latInput">
                        <input type="hidden" name="longitude" id="lngInput">
                    </div>
                </div>

                {{-- 4. Media Assets --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center gap-2 mb-6 text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <h2 class="text-xl font-bold">Aset Media</h2>
                    </div>

                    {{-- Upload Area --}}
                    <label for="images" class="border-2 border-dashed border-gray-300 rounded-2xl bg-gray-50/50 p-10 flex flex-col items-center justify-center text-center hover:bg-gray-50 transition-colors cursor-pointer mb-6 block w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-400 mb-3">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                        </svg>
                        <p class="text-gray-800 font-medium mb-1">Unggah Foto Properti</p>
                        <p class="text-gray-400 text-xs">Maksimal 5 foto, ukuran maks 2MB per foto. Disarankan orientasi lanskap.</p>
                        <input type="file" name="images[]" id="images" multiple accept="image/*" class="hidden" required>
                    </label>

                    {{-- Thumbnails --}}
                    <div class="grid grid-cols-5 gap-4" id="thumbnailContainer">
                        @for($i=0; $i<5; $i++)
                        <div class="aspect-square bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 border border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                            </svg>
                        </div>
                        @endfor
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end">
                    <button type="submit" class="bg-[#2a1d14] text-white px-8 py-3.5 rounded-xl font-bold hover:bg-black transition-all shadow-md active:scale-95">
                        Pasang Iklan Sekarang
                    </button>
                </div>

            </form>
        </div>
    </div>
</section>

{{-- Initialize Map --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Default koordinat (misal Jakarta)
        const defaultLat = -6.200000;
        const defaultLng = 106.816666;

        // Inisialisasi peta Leaflet
        const map = L.map('propertyMap').setView([defaultLat, defaultLng], 13);

        // Menambahkan tile layer (bisa diganti URL Google Maps jika punya API Key nanti)
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Menambahkan marker yang bisa didrag
        const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

        const latInput = document.getElementById('latInput');
        const lngInput = document.getElementById('lngInput');

        // Update input hidden ketika marker didrag
        marker.on('dragend', function(event) {
            const position = marker.getLatLng();
            latInput.value = position.lat;
            lngInput.value = position.lng;
        });

        // ================= Image Preview Logic =================
        const imageInput = document.getElementById('images');
        const thumbnailContainer = document.getElementById('thumbnailContainer');
        let dataTransfer = new DataTransfer();

        imageInput.addEventListener('change', function(e) {
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
        }
    });
</script>

@endsection
