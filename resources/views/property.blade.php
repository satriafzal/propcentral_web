@extends('layout.layout')

@section('content')

{{-- Header Section --}}
<section class="bg-[#faf9f8] pt-12 pb-6 px-10 fade-in-section">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">Discover Your Future Home</h1>
    </div>
</section>

{{-- Properties List --}}
<section class="bg-[#faf9f8] pb-20 px-10 fade-in-section">
    <div class="max-w-6xl mx-auto">
        
        {{-- List Header --}}
        <div class="flex justify-between items-center mb-8">
            <div class="text-sm text-gray-500">
                Showing <span class="font-bold text-gray-900">24 Properties</span>
            </div>
            <div class="flex items-center gap-2 text-sm">
                <span class="text-gray-500">Sort by:</span>
                <select class="bg-white border border-gray-200 rounded-md px-3 py-1.5 text-gray-700 outline-none cursor-pointer hover:border-gray-300">
                    <option>Newest Listed</option>
                    <option>Price (Low to High)</option>
                    <option>Price (High to Low)</option>
                </select>
            </div>
        </div>

        {{-- Property Cards Container --}}
        <div class="flex flex-col gap-6 mb-12">

            @php
            $properties = [
                [
                    'img' => 'property_obsidian.png', 
                    'badge' => 'For Sale', 
                    'price' => '$2,450,000', 
                    'title' => 'The Obsidian Retreat', 
                    'loc' => 'Beverly Hills, CA', 
                    'specs' => '5 Beds, 4 Baths, 4,200 sqft'
                ],
                [
                    'img' => 'property_penthouse.png', 
                    'badge' => 'Hot Deal', 
                    'price' => '$890,000', 
                    'title' => 'Skyline Penthouse', 
                    'loc' => 'Upper West Side, NY', 
                    'specs' => '2 Beds, 2 Baths, 1,850 sqft'
                ],
                [
                    'img' => 'property_azure.png', 
                    'badge' => 'New Arrival', 
                    'price' => '$1,720,000', 
                    'title' => 'Azure Waters Residence', 
                    'loc' => 'Malibu, CA', 
                    'specs' => '4 Beds, 3 Baths, 3,100 sqft'
                ],
            ];
            @endphp

            @foreach($properties as $prop)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row overflow-hidden group cursor-pointer hover:shadow-xl transition-all duration-300">
                
                {{-- Left: Image --}}
                <div class="w-full md:w-[40%] relative overflow-hidden h-64 md:h-auto">
                    <img src="{{ asset('assets/images/' . $prop['img']) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    
                    {{-- Badges --}}
                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-semibold px-3 py-1.5 rounded-full shadow-sm">{{ $prop['badge'] }}</span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <button class="bg-white/90 backdrop-blur-sm p-2 rounded-full text-gray-600 hover:text-red-500 hover:bg-white transition-colors shadow-sm active:scale-90">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Right: Details --}}
                <div class="w-full md:w-[60%] p-8 flex flex-col justify-center">
                    <h2 class="text-2xl font-bold text-gray-900 mb-1 group-hover:text-amber-700 transition-colors">{{ $prop['price'] }}</h2>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $prop['title'] }}</h3>
                    
                    <div class="flex items-center gap-1.5 text-gray-500 text-sm mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        {{ $prop['loc'] }}
                    </div>

                    <hr class="border-gray-100 mb-4">

                    <div class="text-gray-600 text-sm font-medium">
                        {{ $prop['specs'] }}
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        {{-- Pagination --}}
        <div class="flex justify-center items-center gap-2 mt-8 fade-in-section">
            <button class="w-9 h-9 flex items-center justify-center rounded-md border border-gray-200 text-gray-400 hover:bg-gray-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
            </button>
            <button class="w-9 h-9 flex items-center justify-center rounded-md bg-[#2a1d14] text-white text-sm font-medium">1</button>
            <button class="w-9 h-9 flex items-center justify-center rounded-md border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium transition-colors">2</button>
            <button class="w-9 h-9 flex items-center justify-center rounded-md border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium transition-colors">3</button>
            <span class="text-gray-400 mx-1">...</span>
            <button class="w-9 h-9 flex items-center justify-center rounded-md border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium transition-colors">12</button>
            <button class="w-9 h-9 flex items-center justify-center rounded-md border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
            </button>
        </div>

    </div>
</section>

@endsection
