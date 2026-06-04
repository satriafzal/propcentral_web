@extends('layout.layout')

@php $hideSearchFilter = true; @endphp

@section('content')

<style>
    /* Custom styling to match design */
    body {
        background-color: #f5f5f5; /* Light grey background */
    }
    
    .profile-card {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    
    .btn-brown {
        background-color: #433327;
        color: white;
        transition: background-color 0.2s;
    }
    .btn-brown:hover {
        background-color: #2a1d14;
    }
    
    .btn-outline-brown {
        border: 2px solid #6b5647;
        color: #433327;
        transition: all 0.2s;
    }
    .btn-outline-brown:hover {
        background-color: #f5f0eb;
    }

    .tab-active {
        color: #111827;
        font-weight: 700;
    }
    
    .tab-active::before {
        content: '';
        display: inline-block;
        width: 24px;
        height: 24px;
        background-color: #b08d72;
        border-radius: 50%;
        margin-right: 12px;
        vertical-align: middle;
    }
    
    .tab-inactive {
        color: #9ca3af;
        font-weight: 500;
        font-style: italic;
    }

    .property-card-body {
        background-color: #dfcdbf; /* Light beige matching design */
    }
</style>

<div class="max-w-6xl mx-auto px-6 pt-12 pb-24">
    
    {{-- Profile Card --}}
    <div class="profile-card p-8 mb-8 flex flex-col md:flex-row justify-between items-start md:items-center">
        
        {{-- Left side info --}}
        <div class="flex gap-6 items-center">
            {{-- Avatar --}}
            <div class="w-28 h-28 rounded-full overflow-hidden shrink-0 border border-gray-200">
                <img src="{{ asset('assets/images/property_obsidian.png') }}" alt="Profile" class="w-full h-full object-cover">
            </div>
            
            {{-- Info --}}
            <div class="flex flex-col gap-2">
                <h1 class="text-2xl font-bold text-gray-900">Muhammad Rusdi</h1>
                
                <div class="flex items-center gap-3">
                    <span class="bg-[#ebd9cb] text-[#5e4b3c] px-4 py-0.5 rounded-full text-xs font-semibold">
                        Penjual
                    </span>
                </div>
                
                <div class="text-xs text-gray-500 flex flex-col gap-1.5 mt-1 font-medium">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        Bergabung sejak Mei 2026
                    </div>
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        Pengguna Terverifikasi
                    </div>
                </div>
                
                {{-- Action Buttons --}}
                <div class="flex gap-3 mt-3">
                    <button class="btn-brown px-8 py-2 rounded-lg font-semibold text-sm">
                        Follow
                    </button>
                    <button class="btn-outline-brown w-10 h-10 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                        </svg>
                    </button>
                    <button class="btn-outline-brown w-10 h-10 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.069-3.769-6.664-6.664l1.292-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Right side buttons --}}
        <div class="flex flex-col gap-3 mt-6 md:mt-0">
            <button class="btn-brown px-5 py-2.5 rounded-lg flex items-center gap-2 text-sm font-semibold justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                Laporkan Pengguna
            </button>
            <button class="btn-brown px-5 py-2.5 rounded-lg flex items-center gap-2 text-sm font-semibold justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                </svg>
                Bagikan Profile
            </button>
        </div>
    </div>
    
    {{-- Main Content Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        
        {{-- Tabs --}}
        <div class="flex gap-8 mb-6 border-b border-gray-200 pb-4 items-center">
            <div class="tab-active text-lg flex items-center">
                Iklan(107)
            </div>
        </div>

        <h2 class="text-2xl font-bold text-gray-900 mb-8">Iklan(107)</h2>

        {{-- Grid of properties --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            @php
            $properties = [
                ['img'=>'property_obsidian.png', 'loc'=>'Dago, Bandung', 'price'=>'Rp 10.000.000.000', 'time'=>'2 HARI YANG LALU'],
                ['img'=>'property_penthouse.png', 'loc'=>'BSD City, Tangerang', 'price'=>'Rp 10.000.000.000', 'time'=>'6 HARI YANG LALU'],
                ['img'=>'property_azure.png', 'loc'=>'Heulang Bogor', 'price'=>'Rp 10.000.000.000', 'time'=>'1 MINGGU YANG LALU'],
                ['img'=>'property_obsidian.png', 'loc'=>'BSD City, Tangerang', 'price'=>'Rp 10.000.000.000', 'time'=>'HARI INI'],
                ['img'=>'property_penthouse.png', 'loc'=>'Malioboro, Jogja', 'price'=>'Rp 10.000.000.000', 'time'=>'3 HARI YANG LALU'],
                ['img'=>'property_azure.png', 'loc'=>'Ubud, Bali', 'price'=>'Rp 10.000.000.000', 'time'=>'4 HARI YANG LALU'],
            ];
            @endphp

            @foreach($properties as $prop)
            <div class="flex flex-col shadow-sm rounded-lg overflow-hidden border border-gray-200">
                {{-- Image container --}}
                <div class="relative h-64 w-full">
                    <img src="{{ asset('assets/images/' . $prop['img']) }}" alt="Property" class="w-full h-full object-cover">
                    
                    {{-- Heart Button --}}
                    <button class="absolute top-4 right-4 bg-white/30 backdrop-blur-sm p-2 rounded-full border border-white/50 text-white hover:text-pink-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </button>
                </div>
                
                {{-- Details container --}}
                <div class="property-card-body p-6 flex justify-between relative">
                    <div class="flex flex-col justify-center">
                        <div class="flex items-center gap-1 font-bold text-gray-900 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            {{ $prop['loc'] }}
                        </div>
                        <div class="text-xl font-bold text-gray-900">
                            {{ $prop['price'] }}
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <button class="bg-[#433327] text-white text-xs font-bold px-6 py-2 rounded">
                            CHECK
                        </button>
                    </div>

                    {{-- Time badge --}}
                    <div class="absolute bottom-2 right-4 text-[10px] font-bold text-gray-700 tracking-wider">
                        {{ $prop['time'] }}
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>

@endsection
