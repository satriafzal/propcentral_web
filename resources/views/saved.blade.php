@extends('layout.layout')

@php $hideSearchFilter = true; @endphp

@section('content')

<script>
    const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    const userId = {{ auth()->check() ? auth()->id() : 'null' }};
    const SAVE_KEY = isLoggedIn ? 'propcentral_saved_' + userId : 'propcentral_saved';

    function getSaved() {
        return JSON.parse(localStorage.getItem(SAVE_KEY) || '[]');
    }

    function removeSaved(id) {
        let saved = getSaved().filter(p => p.id !== id);
        localStorage.setItem(SAVE_KEY, JSON.stringify(saved));
        renderSaved();
        updateBadge();
    }

    function updateBadge() {
        const badge = document.getElementById('savedBadge');
        if (!badge) return;
        const count = getSaved().length;
        badge.textContent = count;
        badge.classList.toggle('hidden', count === 0);
    }

    function renderSaved() {
        const saved   = getSaved();
        const list    = document.getElementById('savedList');
        const empty   = document.getElementById('emptyState');
        const counter = document.getElementById('savedCount');

        if (counter) counter.textContent = saved.length;

        if (saved.length === 0) {
            list.innerHTML  = '';
            empty.classList.remove('hidden');
            return;
        }

        empty.classList.add('hidden');
        list.innerHTML = saved.map(prop => `
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row overflow-hidden group hover:shadow-xl transition-all duration-300">

                <div class="w-full md:w-[38%] relative overflow-hidden h-56 md:h-auto">
                    <img src="${prop.img}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-semibold px-3 py-1.5 rounded-full shadow-sm">${prop.badge}</span>
                    </div>
                </div>

                <div class="w-full md:w-[62%] p-8 flex flex-col justify-center">
                    <h2 class="text-2xl font-bold text-gray-900 mb-1 group-hover:text-amber-700 transition-colors">${prop.price}</h2>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">${prop.title}</h3>

                    <div class="flex items-center gap-1.5 text-gray-500 text-sm mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                        </svg>
                        ${prop.loc}
                    </div>

                    <hr class="border-gray-100 mb-4">

                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 text-sm font-medium">${prop.specs}</span>
                        <button onclick="removeSaved('${prop.id}')"
                                class="flex items-center gap-1.5 text-red-400 hover:text-red-600 text-xs font-semibold transition-colors px-3 py-1.5 rounded-lg hover:bg-red-50 active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-4 h-4">
                                <path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                            </svg>
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        `).join('');
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderSaved();
        updateBadge();
    });
</script>

{{-- Header --}}
<section class="bg-[#faf9f8] pt-12 pb-6 px-10">
    <div class="max-w-6xl mx-auto flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">Properti Tersimpan</h1>
            <p class="text-gray-500 mt-2 text-sm">
                <span id="savedCount">0</span> properti yang kamu simpan
            </p>
        </div>
        <a href="{{ url('/property') }}"
           class="flex items-center gap-2 text-sm font-semibold text-[#3d2b1f] border border-[#3d2b1f] px-5 py-2.5 rounded-xl hover:bg-[#3d2b1f] hover:text-white transition-all duration-200 active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Cari Properti
        </a>
    </div>
</section>

{{-- List --}}
<section class="bg-[#faf9f8] pb-24 px-10">
    <div class="max-w-6xl mx-auto">

        {{-- Empty state --}}
        <div id="emptyState" class="hidden text-center py-28">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-100 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada properti tersimpan</h3>
            <p class="text-gray-500 text-sm mb-8">Klik ikon ❤️ di card properti untuk menyimpannya di sini.</p>
            <a href="{{ url('/property') }}"
               class="inline-block bg-[#2a1d14] text-white px-8 py-3 rounded-xl font-medium hover:bg-black transition-colors shadow-md">
                Jelajahi Properti
            </a>
        </div>

        {{-- Saved cards (rendered by JS) --}}
        <div id="savedList" class="flex flex-col gap-6"></div>

    </div>
</section>

@endsection
