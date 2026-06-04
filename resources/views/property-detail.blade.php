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
    
    .gallery-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1rem;
        margin-bottom: 2rem;
        height: 480px;
    }
    
    .gallery-main {
        height: 100%;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .gallery-side {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        height: 100%;
    }
    
    .gallery-side-img {
        flex: 1;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
    }
    
    .gallery-main img, .gallery-side-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .see-more-btn {
        position: absolute;
        bottom: 1rem;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(61, 43, 31, 0.85); /* Dark brown with opacity */
        color: white;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.5rem 1.5rem;
        border-radius: 6px;
        backdrop-filter: blur(4px);
        transition: background-color 0.2s;
    }

    .see-more-btn:hover {
        background-color: rgba(42, 29, 20, 0.95);
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
    <div class="gallery-grid">
        {{-- Main Image --}}
        <div class="gallery-main">
            <img src="{{ asset('assets/images/property_obsidian.png') }}" alt="Main View">
        </div>
        
        {{-- Side Images --}}
        <div class="gallery-side">
            <div class="gallery-side-img">
                <img src="{{ asset('assets/images/property_penthouse.png') }}" alt="Side View 1">
            </div>
            <div class="gallery-side-img">
                <img src="{{ asset('assets/images/property_azure.png') }}" alt="Side View 2">
                <button class="see-more-btn">see more</button>
            </div>
        </div>
    </div>
    
    {{-- Title and Price Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 mt-4">
        <div>
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Taman Heulang, Bogor</h1>
            <p class="text-gray-500 text-sm">Jl. Heulang, RT.06/RW.04, Tanah Sareal, Kota Bogor, Jawa Barat 16161</p>
        </div>
        <div class="mt-4 md:mt-0 text-3xl font-bold text-gray-900">
            Rp 1.000.000.000
        </div>
    </div>
    
    {{-- Profile and Chat Button Row --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-10">
        {{-- Profile --}}
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-[#e5e5e5] rounded-full flex items-center justify-center overflow-hidden">
                <div class="w-full h-full bg-[#d6d6d6] flex items-center justify-center text-gray-600 font-bold text-xl">
                    {{-- Placeholder Avatar matching gray circle --}}
                </div>
            </div>
            <div>
                <div class="font-bold text-gray-900 text-[15px]">Nama_User</div>
                <div class="text-xs text-gray-500">Penjual</div>
            </div>
        </div>
        
        {{-- Chat Button --}}
        <div class="mt-4 md:mt-0">
            <button class="btn-chat px-6 py-2 text-sm rounded-md shadow-sm">
                Chat Penjual
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 ml-1">
                  <path fill-rule="evenodd" d="M4.804 21.644A6.707 6.707 0 006 21.75a6.721 6.721 0 003.583-1.029c.774.182 1.584.279 2.417.279 5.322 0 9.75-3.97 9.75-9 0-5.03-4.428-9-9.75-9s-9.75 3.97-9.75 9c0 2.409 1.022 4.573 2.706 6.092.393.354.906.518 1.431.572.241.025.485.013.72-.036z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
    
    {{-- Detail Content --}}
    <div class="flex flex-col gap-5 mb-12 max-w-4xl">
        
        {{-- Type --}}
        <div>
            <h3 class="section-title">Type</h3>
            <p class="section-content">Rumah</p>
        </div>
        
        {{-- Deskripsi --}}
        <div>
            <h3 class="section-title">Deskripsi</h3>
            <p class="section-content">
                Hunian siap huni dengan kondisi bangunan yang masih terawat dan terjaga dengan baik, sehingga memberikan kenyamanan bagi penghuni<br>
                tanpa memerlukan perbaikan besar di awal. Rumah ini berada di lingkungan yang tenang, aman, dan nyaman, sangat cocok untuk tempat tinggal bersama keluarga.<br>
                Selain itu, lokasinya strategis dengan akses yang mudah ke berbagai fasilitas umum seperti sekolah, pusat perbelanjaan, tempat ibadah, serta sarana transportasi,<br>
                sehingga mendukung aktivitas sehari-hari menjadi lebih praktis dan efisien.
            </p>
        </div>
        
        {{-- Fasilitas --}}
        <div>
            <h3 class="section-title">Fasilitas</h3>
            <p class="section-content">4 Bed</p>
        </div>
        
        {{-- Luas Tanah --}}
        <div>
            <h3 class="section-title">Luas Tanah</h3>
            <p class="section-content">70 m2</p>
        </div>
        
        {{-- Luas Bangunan --}}
        <div>
            <h3 class="section-title">Luas Bangunan</h3>
            <p class="section-content">50 m2</p>
        </div>
        
        {{-- Lokasi Map --}}
        <div class="mt-2">
            <h3 class="section-title mb-4">Lokasi</h3>
            <div class="w-full md:w-1/2 h-72 bg-[#e5e5e5] rounded-sm flex items-center justify-center text-gray-400">
                {{-- Map Placeholder matching the gray box in design --}}
            </div>
        </div>
            
    </div>
    
</div>

@endsection
