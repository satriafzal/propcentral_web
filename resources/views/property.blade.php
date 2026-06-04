@extends('layout.layout')

@section('content')

{{-- Inject auth state for JS --}}
<script>
    const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

    /* ───── Saved Properties (localStorage) ───── */
    const SAVE_KEY = 'propcentral_saved';

    function getSaved() {
        return JSON.parse(localStorage.getItem(SAVE_KEY) || '[]');
    }

    function isSaved(id) {
        return getSaved().some(p => p.id === id);
    }

    function toggleSave(e, id) {
        e.stopPropagation(); // jangan trigger requireLogin dari card
        if (!isLoggedIn) { openLogin(); return; }

        const props = allProperties();
        const prop  = props.find(p => p.id === id);
        if (!prop) return;

        let saved = getSaved();
        if (isSaved(id)) {
            saved = saved.filter(p => p.id !== id);
        } else {
            saved.push(prop);
        }
        localStorage.setItem(SAVE_KEY, JSON.stringify(saved));
        refreshHearts();
        updateBadge();
    }

    function allProperties() {
        return {!! $properties->map(function($prop) {
            return [
                'id' => (string) $prop->id,
                'img' => $prop->images->count() > 0 ? asset('storage/' . $prop->images->first()->image_path) : null,
                'badge' => 'Dijual',
                'price' => 'Rp ' . number_format($prop->price, 0, ',', '.'),
                'title' => $prop->title,
                'loc' => $prop->address,
                'specs' => $prop->bedroom . ' K. Tidur, ' . $prop->bathroom . ' K. Mandi, ' . $prop->building_area . ' m²'
            ];
        })->toJson() !!};
    }

    function refreshHearts() {
        document.querySelectorAll('[data-prop-id]').forEach(btn => {
            const id     = btn.dataset.propId;
            const filled = isSaved(id);
            btn.classList.toggle('text-pink-500', filled);
            btn.classList.toggle('text-gray-500', !filled);
            const path = btn.querySelector('svg path');
            if (path) {
                if (filled) {
                    btn.querySelector('svg').setAttribute('fill', 'currentColor');
                } else {
                    btn.querySelector('svg').setAttribute('fill', 'none');
                }
            }
        });
    }

    function updateBadge() {
        const badge = document.getElementById('savedBadge');
        if (!badge) return;
        const count = getSaved().length;
        badge.textContent = count;
        badge.classList.toggle('hidden', count === 0);
    }

    function requireLogin(e) {
        if (!isLoggedIn) {
            e.preventDefault();
            e.stopPropagation();
            openLogin();
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        refreshHearts();
        updateBadge();
    });
</script>

{{-- Header --}}
<section class="bg-[#faf9f8] pt-12 pb-6 px-10 fade-in-section">
    <div class="max-w-6xl mx-auto">
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <h1 class="text-4xl font-bold text-gray-900 mb-8">Temukan Rumah Impianmu</h1>
    </div>
</section>

{{-- Properties List --}}
<section class="bg-[#faf9f8] pb-20 px-10 fade-in-section">
    <div class="max-w-6xl mx-auto">

        {{-- List Header --}}
        <div class="flex justify-between items-center mb-8">
            <div class="text-sm text-gray-500">
                Menampilkan <span class="font-bold text-gray-900">24 Properti</span>
            </div>
            <div class="flex items-center gap-2 text-sm">
                <span class="text-gray-500">Urutkan:</span>
                <select class="bg-white border border-gray-200 rounded-md px-3 py-1.5 text-gray-700 outline-none cursor-pointer hover:border-gray-300">
                    <option>Terbaru</option>
                    <option>Harga (Rendah - Tinggi)</option>
                    <option>Harga (Tinggi - Rendah)</option>
                </select>
            </div>
        </div>

        {{-- Cards --}}
        <div class="flex flex-col gap-6 mb-12">

            @forelse($properties as $prop)
            <div onclick="window.location.href='/property/{{ $prop->id }}'"
                 class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row overflow-hidden group cursor-pointer hover:shadow-xl transition-all duration-300">

                {{-- Image --}}
                <div class="w-full md:w-[40%] relative overflow-hidden h-64 md:h-auto">
                    @if($prop->images->count() > 0)
                        <img src="{{ asset('storage/' . $prop->images->first()->image_path) }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                    @endif

                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-semibold px-3 py-1.5 rounded-full shadow-sm">
                            Dijual
                        </span>
                    </div>

                    {{-- Love / Save button --}}
                    <div class="absolute top-4 right-4">
                        <button data-prop-id="{{ $prop->id }}"
                                onclick="toggleSave(event, '{{ $prop->id }}')"
                                class="bg-white/90 backdrop-blur-sm p-2 rounded-full text-gray-500 hover:scale-110 transition-all duration-200 shadow-sm active:scale-90">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312
                                         2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0
                                         7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Details --}}
                <div class="w-full md:w-[60%] p-8 flex flex-col justify-center">
                    <h2 class="text-2xl font-bold text-gray-900 mb-1 group-hover:text-amber-700 transition-colors">
                        Rp {{ number_format($prop->price, 0, ',', '.') }}
                    </h2>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $prop->title }}</h3>

                    <div class="flex items-center gap-1.5 text-gray-500 text-sm mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        {{ $prop->address }}
                    </div>

                    <hr class="border-gray-100 mb-4">

                    <div class="text-gray-600 text-sm font-medium">{{ $prop->bedroom }} K. Tidur, {{ $prop->bathroom }} K. Mandi, {{ $prop->building_area }} m²</div>
                </div>
            </div>
            @empty
                <div class="text-center py-10 text-gray-500">
                    Belum ada properti yang diunggah.
                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        <div class="flex justify-center items-center gap-2 mt-8">
            <button onclick="requireLogin(event)" class="w-9 h-9 flex items-center justify-center rounded-md border border-gray-200 text-gray-400 hover:bg-gray-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
            </button>
            <button class="w-9 h-9 flex items-center justify-center rounded-md bg-[#2a1d14] text-white text-sm font-medium">1</button>
            <button onclick="requireLogin(event)" class="w-9 h-9 flex items-center justify-center rounded-md border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium transition-colors">2</button>
            <button onclick="requireLogin(event)" class="w-9 h-9 flex items-center justify-center rounded-md border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium transition-colors">3</button>
            <span class="text-gray-400 mx-1">...</span>
            <button onclick="requireLogin(event)" class="w-9 h-9 flex items-center justify-center rounded-md border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium transition-colors">12</button>
            <button onclick="requireLogin(event)" class="w-9 h-9 flex items-center justify-center rounded-md border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
            </button>
        </div>

    </div>
</section>

@endsection
