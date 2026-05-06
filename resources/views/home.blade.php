@extends('layout.layout')

@section('content')

{{-- HERO --}}
<section class="px-10 py-16 flex items-center justify-between bg-[#f0e6dd]">
    <div>
        <h1 class="text-4xl font-bold mb-4">
            Find Your <br> Dream Home
        </h1>

        <p class="text-gray-600 mb-6">
            Explore curated selection of exquisite properties
        </p>

        <button class="bg-black text-white px-6 py-2 rounded">
            Sign up
        </button>
    </div>

    <img src="/images/house.png" class="w-[400px]">
</section>


{{-- WHY CHOOSE US --}}
<section class="text-center py-16">
    <h2 class="text-2xl font-bold mb-2">Why Choose Us</h2>
    <p class="text-gray-500 mb-10">Best service for your home</p>

    <div class="grid grid-cols-4 gap-6 px-10">
        <div class="bg-white p-6 rounded shadow">Expert Guidance</div>
        <div class="bg-white p-6 rounded shadow">Personalized</div>
        <div class="bg-white p-6 rounded shadow">Transparent</div>
        <div class="bg-white p-6 rounded shadow">Support</div>
    </div>
</section>


{{-- PROPERTY LIST --}}
<section class="bg-[#efe6c8] py-16 px-10">
    <h2 class="text-2xl font-bold mb-10 text-center">
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
</section>


{{-- CONTACT --}}
<section class="text-center py-16">
    <h2 class="text-2xl font-bold mb-4">
        Do You Have Any Questions?
    </h2>

    <input type="text"
        placeholder="Enter your email..."
        class="border px-4 py-2 rounded w-80">

    <button class="bg-black text-white px-4 py-2 rounded ml-2">
        Submit
    </button>
</section>

@endsection