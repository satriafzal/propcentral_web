@extends('layout.layout')

@section('content')

<style>
    body {
        background-color: #ffffff; /* Override body background to white for this page */
    }
    
    .detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    
    .btn-chat {
        background-color: #3d2b1f;
        color: white;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: background-color 0.2s;
    }
    .btn-chat:hover {
        background-color: #2a1d14;
    }
    
    .section-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.25rem;
    }
    
    .section-content {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }
</style>

<div class="detail-container">
    
    {{-- Photo Gallery --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10 h-64 md:h-[360px]">
        {{-- Main Image --}}
        <div class="md:col-span-2 rounded-xl overflow-hidden min-h-0 h-full">
            @if($property->images->count() > 0)
                <img src="{{ asset('storage/' . $property->images[0]->image_path) }}" alt="Main View" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
            @endif
        </div>
        
        {{-- Side Images --}}
        <div class="flex flex-col gap-4 h-full min-h-0">
            <div class="flex-1 rounded-xl overflow-hidden min-h-0 relative">
                @if($property->images->count() > 1)
                    <img src="{{ asset('storage/' . $property->images[1]->image_path) }}" alt="Side View 1" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gray-200"></div>
                @endif
            </div>
            <div class="flex-1 rounded-xl overflow-hidden min-h-0 relative">
                @if($property->images->count() > 2)
                    <img src="{{ asset('storage/' . $property->images[2]->image_path) }}" alt="Side View 2" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gray-200"></div>
                @endif
                <button onclick="openGalleryModal()" class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-[#3d2b1f]/85 text-white text-sm font-semibold px-6 py-2 rounded-md backdrop-blur-sm hover:bg-[#2a1d14]/95 transition-colors shadow-sm">
                    see more
                </button>
            </div>
        </div>
    </div>
    
    {{-- Title and Price Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 mt-4">
        <div>
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">{{ $property->title }}</h1>
            <p class="text-gray-500 text-sm">{{ $property->address }}</p>
        </div>
        <div class="mt-4 md:mt-0 text-3xl font-bold text-gray-900">
            Rp {{ number_format($property->price, 0, ',', '.') }}
        </div>
    </div>
    
    {{-- Profile and Chat Button Row --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-10">
        {{-- Profile --}}
        <a href="{{ route('profile.show', $property->user_id) }}" class="flex items-center gap-4 hover:bg-gray-50 p-2 rounded-xl transition-colors cursor-pointer border border-transparent hover:border-gray-100">
            <div class="w-14 h-14 bg-[#e5e5e5] rounded-full flex items-center justify-center overflow-hidden shrink-0">
                @if($property->user && $property->user->foto_profil)
                    <img src="{{ asset('storage/' . $property->user->foto_profil) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-[#ead9ca] flex items-center justify-center text-[#7b5d4a] font-bold text-xl uppercase">
                        {{ $property->user ? substr($property->user->nama, 0, 1) : 'U' }}
                    </div>
                @endif
            </div>
            <div>
                <div class="font-bold text-gray-900 text-[15px] group-hover:text-amber-700 transition-colors">{{ $property->user ? $property->user->nama : 'User' }}</div>
                <div class="text-xs text-gray-500">Penjual</div>
            </div>
        </a>
        
        {{-- Action Buttons --}}
        <div class="mt-4 md:mt-0 flex gap-3">
            @auth
                @if(Auth::id() !== $property->user_id)
                {{-- Tombol Ajukan Penawaran --}}
                <button onclick="openOfferModal()"
                    class="flex items-center gap-2 px-5 py-2 text-sm rounded-md font-semibold border-2 border-[#3d2b1f] text-[#3d2b1f] hover:bg-[#3d2b1f] hover:text-white transition-all duration-200">
                    🏷️ Ajukan Penawaran
                </button>
                {{-- Tombol Chat --}}
                <a href="{{ route('chat.show', $property->user_id) }}" class="btn-chat px-6 py-2 text-sm rounded-md shadow-sm hover:no-underline">
                    Chat Penjual
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 ml-1">
                    <path fill-rule="evenodd" d="M4.804 21.644A6.707 6.707 0 006 21.75a6.721 6.721 0 003.583-1.029c.774.182 1.584.279 2.417.279 5.322 0 9.75-3.97 9.75-9 0-5.03-4.428-9-9.75-9s-9.75 3.97-9.75 9c0 2.409 1.022 4.573 2.706 6.092.393.354.906.518 1.431.572.241.025.485.013.72-.036z" clip-rule="evenodd" />
                    </svg>
                </a>
                @endif
            @else
                <button onclick="openLogin()" class="btn-chat px-6 py-2 text-sm rounded-md shadow-sm">
                    Chat Penjual
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 ml-1">
                    <path fill-rule="evenodd" d="M4.804 21.644A6.707 6.707 0 006 21.75a6.721 6.721 0 003.583-1.029c.774.182 1.584.279 2.417.279 5.322 0 9.75-3.97 9.75-9 0-5.03-4.428-9-9.75-9s-9.75 3.97-9.75 9c0 2.409 1.022 4.573 2.706 6.092.393.354.906.518 1.431.572.241.025.485.013.72-.036z" clip-rule="evenodd" />
                    </svg>
                </button>
            @endauth
        </div>
    </div>
    
    {{-- Detail Content --}}
    <div class="flex flex-col gap-5 mb-12 max-w-4xl">
        
        {{-- Type --}}
        <div>
            <h3 class="section-title">Type</h3>
            <p class="section-content">{{ $property->type }}</p>
        </div>
        
        {{-- Deskripsi --}}
        <div>
            <h3 class="section-title">Deskripsi</h3>
            <p class="section-content">
                {!! nl2br(e($property->description)) !!}
            </p>
        </div>
        
        {{-- Fasilitas --}}
        <div>
            <h3 class="section-title">Fasilitas</h3>
            <p class="section-content">{{ $property->bedroom }} Kamar Tidur, {{ $property->bathroom }} Kamar Mandi, {{ $property->garage }} Garasi</p>
        </div>
        
        {{-- Sertifikat --}}
        <div>
            <h3 class="section-title">Sertifikat</h3>
            <p class="section-content">{{ $property->certificate }}</p>
        </div>
        
        {{-- Luas Tanah --}}
        <div>
            <h3 class="section-title">Luas Tanah</h3>
            <p class="section-content">{{ $property->land_area }} m²</p>
        </div>
        
        {{-- Luas Bangunan --}}
        <div>
            <h3 class="section-title">Luas Bangunan</h3>
            <p class="section-content">{{ $property->building_area }} m²</p>
        </div>
        
        {{-- Lokasi Map --}}
        <div class="mt-2">
            <h3 class="section-title mb-4">Lokasi</h3>
            <div id="propertyMap" class="w-full md:w-1/2 h-72 rounded-sm border border-gray-200 z-10">
                {{-- Map will be injected here --}}
            </div>
        </div>
            
    </div>
    
</div>
{{-- ===== MODAL PENAWARAN ===== --}}
<div id="offerModal" class="fixed inset-0 z-[200] hidden">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeOfferModal()"></div>
    <div class="fixed inset-0 z-[201] flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 relative">

            <div class="flex justify-between items-center mb-5">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Ajukan Penawaran</h3>
                    <p class="text-xs text-gray-400 mt-1">{{ $property->title }}</p>
                </div>
                <button onclick="closeOfferModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Harga Listing --}}
            <div class="bg-gray-50 rounded-xl p-4 mb-5">
                <p class="text-xs text-gray-500 mb-1">Harga Listing</p>
                <p class="text-2xl font-extrabold text-gray-900">Rp {{ number_format($property->price, 0, ',', '.') }}</p>
            </div>

            {{-- Flash Messages --}}
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl mb-4">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('offers.store') }}" method="POST">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Harga Tawarmu <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center border-2 border-gray-200 rounded-xl px-4 focus-within:border-[#3d2b1f] transition-colors">
                        <span class="text-gray-500 font-medium mr-2 shrink-0">Rp</span>
                        <input type="number" name="offered_price" id="offeredPriceInput"
                            placeholder="0" min="1" required
                            class="flex-1 py-3 outline-none text-gray-900 font-bold text-lg bg-transparent">
                    </div>
                    <p id="priceComparison" class="text-xs mt-1.5 text-gray-400"></p>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Pesan untuk Penjual <span class="text-gray-400 font-normal">(opsional)</span>
                    </label>
                    <textarea name="message" rows="3" maxlength="500"
                        placeholder="Contoh: Saya tertarik, apakah harga bisa dinegosiasikan?"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 outline-none focus:border-[#3d2b1f] transition-colors resize-none"></textarea>
                </div>

                <button type="submit"
                    class="w-full bg-[#3d2b1f] text-white py-3 rounded-xl font-bold text-sm hover:bg-[#2a1d14] transition-colors active:scale-[0.98]">
                    Kirim Penawaran 🏷️
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const listingPrice = {{ $property->price }};

    function openOfferModal()  { document.getElementById('offerModal').classList.remove('hidden'); }
    function closeOfferModal() { document.getElementById('offerModal').classList.add('hidden'); }

    document.getElementById('offeredPriceInput')?.addEventListener('input', function() {
        const val  = parseInt(this.value) || 0;
        const diff = val - listingPrice;
        const pct  = listingPrice > 0 ? Math.abs((diff / listingPrice) * 100).toFixed(1) : 0;
        const el   = document.getElementById('priceComparison');
        if (val <= 0) { el.textContent = ''; return; }
        if (diff < 0) {
            el.textContent = `Lebih rendah ${pct}% dari harga listing`;
            el.className = 'text-xs mt-1.5 text-amber-600 font-medium';
        } else if (diff > 0) {
            el.textContent = `Lebih tinggi ${pct}% dari harga listing`;
            el.className = 'text-xs mt-1.5 text-green-600 font-medium';
        } else {
            el.textContent = 'Sama dengan harga listing';
            el.className = 'text-xs mt-1.5 text-gray-500';
        }
    });

    @if(session('error') || session('success'))
        openOfferModal();
    @endif
</script>

{{-- Gallery Modal --}}
<div id="galleryModal" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900 bg-opacity-75 backdrop-blur-sm transition-opacity" onclick="closeGalleryModal()"></div>
    <div class="fixed inset-0 z-[100] overflow-y-auto pointer-events-none">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl p-6 pointer-events-auto">
                
                {{-- Modal Header --}}
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Galeri Properti</h3>
                    <button onclick="closeGalleryModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Modal Content: Grid of 5 images --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($property->images as $index => $img)
                        @if($index == 0)
                            <div class="col-span-2 row-span-2 rounded-xl overflow-hidden h-[400px]">
                                <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Gallery {{ $index + 1 }}">
                            </div>
                        @else
                            <div class="col-span-1 rounded-xl overflow-hidden h-[192px]">
                                <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Gallery {{ $index + 1 }}">
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    function openGalleryModal() {
        document.getElementById('galleryModal').classList.remove('hidden');
    }

    function closeGalleryModal() {
        document.getElementById('galleryModal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        @if($property->latitude && $property->longitude)
            const lat = {{ $property->latitude }};
            const lng = {{ $property->longitude }};
            
            const map = L.map('propertyMap').setView([lat, lng], 15);
            L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
            
            L.marker([lat, lng]).addTo(map);
        @else
            document.getElementById('propertyMap').innerHTML = '<div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-500 text-sm">Koordinat peta tidak tersedia</div>';
        @endif
    });
</script>

@endsection
