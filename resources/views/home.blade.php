@extends('layout.layout')

@section('content')

@include('auth.login')

@include('auth.register')

{{-- HERO --}}
<section class="px-10 py-16 flex items-center justify-between bg-gradient-to-br from-[#f0e6dd] to-white overflow-hidden fade-in-section">
    <div class="max-w-xl">
        <h1 class="text-5xl font-extrabold mb-6 leading-tight text-gray-900">
            Find Your <br> <span class="text-amber-700">Dream Home</span>
        </h1>
        
        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
            Explore our curated selection of exquisite properties designed to match your lifestyle and aspirations.
        </p>
        
        <button onclick="openLogin()" class="bg-gray-900 text-white px-8 py-3 rounded-xl font-medium hover:bg-amber-600 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 active:scale-95">
            Get Started
        </button>
    </div>
    
    <div class="relative group">
        <div class="absolute inset-0 bg-amber-600 rounded-3xl blur-3xl opacity-20 group-hover:opacity-40 transition-opacity duration-700"></div>
        <img src="{{asset('assets/images/imagehome.png')}}" class="w-[600px] block relative z-10 group-hover:scale-105 transition-transform duration-700 drop-shadow-2xl">
    </div>
</section>


{{-- WHY CHOOSE US --}}
<section class="text-center py-20 bg-white fade-in-section">
    <h2 class="text-3xl font-extrabold mb-3 text-gray-900">Why Choose Us</h2>
    <p class="text-gray-500 mb-12 text-lg">Best service for your future home</p>
    
    <div class="grid grid-cols-4 gap-8 px-10">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group cursor-default">
            <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" /></svg>
            </div>
            <h3 class="font-bold text-lg mb-2 text-gray-900 group-hover:text-amber-600 transition-colors">Expert Guidance</h3>
            <p class="text-sm text-gray-500">Professional agents to help you.</p>
        </div>
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group cursor-default">
            <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
            </div>
            <h3 class="font-bold text-lg mb-2 text-gray-900 group-hover:text-amber-600 transition-colors">Personalized</h3>
            <p class="text-sm text-gray-500">Tailored to your specific needs.</p>
        </div>
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group cursor-default">
            <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" /></svg>
            </div>
            <h3 class="font-bold text-lg mb-2 text-gray-900 group-hover:text-amber-600 transition-colors">Transparent</h3>
            <p class="text-sm text-gray-500">No hidden fees or surprises.</p>
        </div>
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group cursor-default">
            <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" /></svg>
            </div>
            <h3 class="font-bold text-lg mb-2 text-gray-900 group-hover:text-amber-600 transition-colors">Support</h3>
            <p class="text-sm text-gray-500">24/7 customer service available.</p>
        </div>
    </div>
</section>


{{-- PROPERTY LIST --}}
<section class="relative py-20 px-10 fade-in-section overflow-hidden">
    {{-- Background Image --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('assets/images/bg-residences.png') }}" alt="" class="w-full h-full object-cover">
    </div>
    {{-- Overlay --}}
    <div class="absolute inset-0 z-0 bg-black/30 backdrop-blur-[2px]"></div>

    {{-- Content --}}
    <div class="relative z-10">
        <h2 class="text-3xl font-extrabold mb-12 text-center text-white drop-shadow-lg">
            Our Popular Residences
        </h2>
        
        <div class="grid grid-cols-3 gap-6">
            
            @for ($i = 0; $i < 6; $i++)
            @component('component.properti-card', [
            'image' => '/images/house.png',
            'location' => 'San Francisco, California',
            'rooms' => 4,
            'size' => '3,500',
                    'price' => '$2,500,000'
                    ])
                @endcomponent
            @endfor

        </div>
    </div>
</section>

@endsection
