@extends('layout.layout')

@php
    $hideSearchFilter = true;
@endphp

@section('content')

{{-- Header Section --}}
<section class="bg-[#ead9ce] pt-12 pb-8 px-10 border-b border-[#d8c5b6] text-center fade-in-section">
    <div class="max-w-3xl mx-auto mt-4">
        <h1 class="text-4xl font-bold text-[#2a1d14] mb-4">
            Panduan & Artikel
        </h1>
        <p class="text-[#5a3e2b] mb-8 text-sm">
            Kumpulan panduan, tips, dan berita terkini seputar properti.
        </p>
        
        <div class="flex flex-wrap justify-center gap-2">
            <button class="bg-[#2a1d14] text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:bg-black">Semua Artikel</button>
            <button class="bg-white text-gray-700 px-4 py-2 rounded-lg text-sm border border-gray-200 font-medium hover:bg-gray-50 transition-colors">Tips Membeli</button>
            <button class="bg-white text-gray-700 px-4 py-2 rounded-lg text-sm border border-gray-200 font-medium hover:bg-gray-50 transition-colors">Tips Menjual</button>
            <button class="bg-white text-gray-700 px-4 py-2 rounded-lg text-sm border border-gray-200 font-medium hover:bg-gray-50 transition-colors">Seputar KPR</button>
        </div>
    </div>
</section>

{{-- Main Content --}}
<section class="bg-[#faf9f8] px-10 py-12">
    <div class="max-w-6xl mx-auto">
    
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
