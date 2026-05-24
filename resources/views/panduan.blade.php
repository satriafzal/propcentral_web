@extends('layout.layout')

@php
    $hideSearchFilter = true;
@endphp

@section('content')

{{-- Header Section --}}
<section class="bg-[#faf9f8] py-16 px-10 text-center fade-in-section">
    <div class="max-w-3xl mx-auto">
        <span class="inline-block bg-[#e8d5c4] text-[#5a3e2b] text-xs font-bold px-3 py-1 rounded-full tracking-wider mb-6">
            RESOURCE CENTER
        </span>
        <h1 class="text-4xl font-bold text-gray-900 mb-6 leading-tight">
            Pusat Panduan & Artikel<br>PropCentral
        </h1>
        <p class="text-gray-500 mb-10 text-sm">
            Temukan wawasan mendalam mengenai pasar properti, strategi investasi, dan panduan langkah-demi-langkah untuk transaksi properti Anda.
        </p>
        
        <div class="flex flex-wrap justify-center gap-3">
            <button class="bg-[#2a1d14] text-white px-5 py-2 rounded-full text-sm font-medium transition-transform hover:-translate-y-0.5">Semua Artikel</button>
            <button class="bg-gray-200 text-gray-600 px-5 py-2 rounded-full text-sm font-medium hover:bg-gray-300 transition-colors">Tips Membeli</button>
            <button class="bg-gray-200 text-gray-600 px-5 py-2 rounded-full text-sm font-medium hover:bg-gray-300 transition-colors">Tips Menjual</button>
            <button class="bg-gray-200 text-gray-600 px-5 py-2 rounded-full text-sm font-medium hover:bg-gray-300 transition-colors">Seputar KPR</button>
            <button class="bg-gray-200 text-gray-600 px-5 py-2 rounded-full text-sm font-medium hover:bg-gray-300 transition-colors">Berita Properti</button>
        </div>
    </div>
</section>

{{-- Main Content --}}
<section class="px-10 py-12 max-w-7xl mx-auto">
    
    {{-- Top Row: Featured & Newsletter --}}
    <div class="flex flex-col lg:flex-row gap-8 mb-8 fade-in-section">
        
        {{-- Featured Article --}}
        <div class="lg:w-2/3 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group cursor-pointer hover:shadow-xl transition-all duration-300">
            <div class="h-80 overflow-hidden">
                <img src="{{ asset('assets/images/article_featured.png') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            </div>
            <div class="p-8">
                <div class="flex items-center gap-4 mb-4 text-xs font-medium">
                    <span class="bg-[#f5ede6] text-[#8b6f5a] px-3 py-1 rounded-md">Seputar KPR</span>
                    <span class="text-gray-400">12 OKT 2023</span>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-amber-700 transition-colors">Panduan Lengkap Memilih Suku Bunga KPR yang Tepat di Tahun 2024</h2>
                <p class="text-gray-500 mb-6 text-sm leading-relaxed">
                    Menjelajahi dinamika pasar keuangan global dan pengaruhnya terhadap suku bunga properti lokal untuk membantu Anda mengamankan penawaran terbaik.
                </p>
                <div class="flex items-center text-sm font-semibold text-gray-900 group-hover:text-amber-700 transition-colors">
                    Baca Selengkapnya 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </div>
            </div>
        </div>
        
        {{-- Newsletter --}}
        <div class="lg:w-1/3 bg-[#3d2b1f] rounded-2xl p-8 text-white flex flex-col justify-center relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="text-xl font-bold mb-3">Dapatkan Berita Terupdate</h3>
                <p class="text-gray-300 text-sm mb-8 leading-relaxed">
                    Daftarkan email Anda untuk menerima kurasi artikel dan tren properti mingguan langsung ke kotak masuk Anda.
                </p>
                <form class="flex flex-col gap-4">
                    <input type="email" placeholder="Email Anda" class="bg-white/10 border border-white/20 text-white placeholder-gray-400 px-4 py-3 rounded-lg text-sm focus:outline-none focus:border-white/50 transition-colors">
                    <button type="button" class="bg-[#e8d5c4] text-[#3d2b1f] font-bold py-3 rounded-lg hover:bg-white transition-colors text-sm">
                        Berlangganan
                    </button>
                </form>
            </div>
        </div>
        
    </div>
    
    {{-- Articles Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        
        @php
        $articles = [
            ['img' => 'article_survey.png', 'date' => '08 OKT 2023', 'cat' => 'Tips Membeli', 'title' => '5 Hal Penting yang Wajib Diperiksa Saat Survey Lokasi Properti', 'desc' => 'Pastikan investasi masa depan Anda aman dengan melakukan pengecekan mendalam ...'],
            ['img' => 'article_renovasi.png', 'date' => '05 OKT 2023', 'cat' => 'Tips Menjual', 'title' => 'Cara Meningkatkan Nilai Jual Rumah Hingga 20% Dengan Renovasi...', 'desc' => 'Strategi renovasi cerdas yang fokus pada estetika dan fungsi tanpa harus mengeluarka...'],
            ['img' => 'article_pasar.png', 'date' => '01 OKT 2023', 'cat' => 'Berita Properti', 'title' => 'Update Pasar Properti Q4 2023: Wilayah Mana yang Paling...', 'desc' => 'Analisis mendalam mengenai pergerakan harga properti di wilayah penyangga ibu kota...'],
            ['img' => 'article_syariah.png', 'date' => '28 SEP 2023', 'cat' => 'Seputar KPR', 'title' => 'Pahami Perbedaan Akad KPR Syariah vs Konvensional', 'desc' => 'Perbandingan mendalam mengenai skema pembiayaan rumah agar Anda bisa...'],
            ['img' => 'article_sertifikat.png', 'date' => '25 SEP 2023', 'cat' => 'Tips Membeli', 'title' => 'Mengenal Sertifikat HGB dan Cara Mengubahnya Menjadi SHM', 'desc' => 'Langkah legalitas krusial bagi pemilik properti untuk meningkatkan kekuatan hukum...'],
            ['img' => 'article_investasi.png', 'date' => '20 SEP 2023', 'cat' => 'Berita Properti', 'title' => 'Investasi Apartemen vs Rumah Tapak: Mana yang Lebih...', 'desc' => 'Analisis ROI dan potensi capital gain jangka panjang antara dua instrumen properti...'],
        ];
        @endphp

        @foreach($articles as $article)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group cursor-pointer hover:shadow-xl hover:-translate-y-1 transition-all duration-300 fade-in-section flex flex-col">
            <div class="h-48 overflow-hidden">
                <img src="{{ asset('assets/images/' . $article['img']) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            </div>
            <div class="p-6 flex flex-col flex-1">
                <div class="flex justify-between items-center mb-3 text-[11px] font-medium text-gray-400">
                    <span>{{ $article['date'] }}</span>
                    <span>{{ $article['cat'] }}</span>
                </div>
                <h3 class="font-bold text-gray-900 mb-2 group-hover:text-amber-700 transition-colors line-clamp-2">{{ $article['title'] }}</h3>
                <p class="text-gray-500 text-xs leading-relaxed mb-4 flex-1">{{ $article['desc'] }}</p>
                
                <div class="flex justify-between items-center mt-auto pt-4 border-t border-gray-100">
                    <span class="text-xs font-semibold text-gray-900 group-hover:text-amber-700 transition-colors flex items-center">
                        Baca Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 ml-1">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400 hover:text-amber-600 transition-colors">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                    </svg>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    {{-- Pagination --}}
    <div class="flex justify-center items-center gap-2 fade-in-section">
        <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-200 text-gray-400 hover:bg-gray-50 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
        </button>
        <button class="w-8 h-8 flex items-center justify-center rounded-full bg-[#2a1d14] text-white text-sm font-medium">1</button>
        <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium transition-colors">2</button>
        <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium transition-colors">3</button>
        <span class="text-gray-400 mx-1">...</span>
        <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium transition-colors">12</button>
        <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
        </button>
    </div>

</section>

{{-- CTA Section --}}
<section class="bg-[#ead9ce] py-16 px-10 fade-in-section">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="md:w-2/3">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Siap Menemukan Properti Impian Anda?</h2>
            <p class="text-gray-700 text-sm md:text-base">Konsultasikan kebutuhan investasi atau hunian Anda bersama pakar properti dari PropCentral.</p>
        </div>
        <div class="md:w-1/3 flex gap-4 shrink-0">
            <button class="bg-[#2a1d14] text-white px-6 py-3 rounded-xl font-medium text-sm hover:bg-black transition-colors shadow-md hover:shadow-lg active:scale-95">Cari Properti</button>
            <button onclick="openContact()" class="border border-[#2a1d14] text-[#2a1d14] px-6 py-3 rounded-xl font-medium text-sm hover:bg-[#2a1d14] hover:text-white transition-colors active:scale-95">Hubungi Agen</button>
        </div>
    </div>
</section>

@endsection
