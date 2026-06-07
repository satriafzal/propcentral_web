@extends('layout.layout')
@php $hideSearchFilter = true; @endphp

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="container mx-auto px-4 max-w-5xl">

        {{-- Header --}}
        <div class="mb-8">
            <a href="/profile" class="text-gray-500 hover:text-[#3b2a22] flex items-center text-sm font-medium mb-4 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Profil
            </a>
            <h1 class="text-3xl font-extrabold text-gray-900">Penawaran Masuk</h1>
            <p class="text-gray-500 mt-1 text-sm">Daftar penawaran dari calon pembeli untuk propertimu</p>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm font-medium">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- List Penawaran --}}
        @forelse($offers as $offer)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-5 overflow-hidden">
            <div class="flex flex-col md:flex-row">

                {{-- Foto Properti --}}
                <div class="md:w-48 h-40 md:h-auto shrink-0 bg-gray-200 overflow-hidden">
                    @if($offer->property->images->count() > 0)
                        <img src="{{ asset('storage/' . $offer->property->images->first()->image_path) }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No Image</div>
                    @endif
                </div>

                {{-- Detail --}}
                <div class="flex-1 p-6">
                    <div class="flex flex-wrap justify-between items-start gap-3 mb-4">
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">{{ $offer->property->title }}</h3>
                            <p class="text-sm text-gray-500 mt-0.5">
                                Dari: <span class="font-semibold text-gray-700">{{ $offer->buyer->nama ?? $offer->buyer->username }}</span>
                            </p>
                        </div>

                        {{-- Badge Status --}}
                        @php
                            $statusConfig = [
                                'pending'   => ['🟡 Menunggu', 'bg-yellow-50 text-yellow-700 border-yellow-200'],
                                'accepted'  => ['🟢 Diterima', 'bg-green-50 text-green-700 border-green-200'],
                                'rejected'  => ['🔴 Ditolak',  'bg-red-50 text-red-700 border-red-200'],
                                'countered' => ['🔵 Counter',  'bg-blue-50 text-blue-700 border-blue-200'],
                            ];
                            [$label, $cls] = $statusConfig[$offer->status] ?? ['⚪ Unknown', 'bg-gray-100 text-gray-500 border-gray-200'];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $cls }}">{{ $label }}</span>
                    </div>

                    {{-- Perbandingan Harga --}}
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4 p-4 bg-gray-50 rounded-xl">
                        <div>
                            <p class="text-xs text-gray-400 mb-0.5">Harga Listing</p>
                            <p class="font-bold text-gray-900">Rp {{ number_format($offer->original_price, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-0.5">Harga Ditawar</p>
                            <p class="font-bold text-amber-700 text-lg">Rp {{ number_format($offer->offered_price, 0, ',', '.') }}</p>
                        </div>
                        @if($offer->counter_price)
                        <div>
                            <p class="text-xs text-gray-400 mb-0.5">Counter Kamu</p>
                            <p class="font-bold text-blue-700">Rp {{ number_format($offer->counter_price, 0, ',', '.') }}</p>
                        </div>
                        @endif
                    </div>

                    {{-- Pesan dari Pembeli --}}
                    @if($offer->message)
                    <div class="bg-amber-50 border border-amber-100 rounded-xl px-4 py-3 mb-4 text-sm text-gray-700 italic">
                        "{{ $offer->message }}"
                    </div>
                    @endif

                    <p class="text-xs text-gray-400 mb-4">Dikirim {{ $offer->created_at->diffForHumans() }}</p>

                    {{-- Tombol Aksi (hanya jika masih pending) --}}
                    @if($offer->status === 'pending')
                    <div class="flex flex-wrap gap-2">
                        {{-- Terima --}}
                        <form action="{{ route('offers.respond', $offer->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="accept">
                            <button type="submit"
                                class="bg-green-600 text-white px-5 py-2 rounded-xl text-sm font-bold hover:bg-green-700 transition active:scale-95">
                                ✅ Terima
                            </button>
                        </form>

                        {{-- Tolak --}}
                        <form action="{{ route('offers.respond', $offer->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="reject">
                            <button type="submit"
                                class="bg-red-50 text-red-600 border border-red-200 px-5 py-2 rounded-xl text-sm font-bold hover:bg-red-100 transition active:scale-95">
                                ❌ Tolak
                            </button>
                        </form>

                        {{-- Counter --}}
                        <button onclick="openCounterModal({{ $offer->id }})"
                            class="bg-blue-50 text-blue-700 border border-blue-200 px-5 py-2 rounded-xl text-sm font-bold hover:bg-blue-100 transition active:scale-95">
                            🔄 Counter
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-20 bg-white rounded-2xl border border-dashed border-gray-200">
            <div class="text-5xl mb-4">📭</div>
            <h3 class="text-lg font-bold text-gray-700">Belum ada penawaran masuk</h3>
            <p class="text-gray-400 text-sm mt-1">Penawaran dari calon pembeli akan muncul di sini</p>
        </div>
        @endforelse

    </div>
</div>

{{-- Modal Counter Offer --}}
<div id="counterModal" class="fixed inset-0 z-[200] hidden">
    <div class="fixed inset-0 bg-black/50" onclick="closeCounterModal()"></div>
    <div class="fixed inset-0 flex items-center justify-center p-4 z-[201]">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-1">Counter Penawaran</h3>
            <p class="text-sm text-gray-400 mb-5">Ajukan harga balik kepada pembeli</p>

            <form id="counterForm" action="" method="POST">
                @csrf
                <input type="hidden" name="action" value="counter">

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Harga Counter <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center border-2 border-gray-200 rounded-xl px-4 focus-within:border-[#3d2b1f] transition-colors">
                        <span class="text-gray-500 mr-2 shrink-0">Rp</span>
                        <input type="number" name="counter_price" required min="1"
                            placeholder="0"
                            class="flex-1 py-3 outline-none text-gray-900 font-bold text-lg bg-transparent">
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Pesan (opsional)
                    </label>
                    <textarea name="counter_message" rows="3"
                        placeholder="Jelaskan alasan counter hargamu..."
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:border-[#3d2b1f] transition-colors resize-none"></textarea>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="closeCounterModal()"
                        class="flex-1 bg-gray-100 text-gray-700 py-3 rounded-xl font-bold text-sm hover:bg-gray-200 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 bg-[#3d2b1f] text-white py-3 rounded-xl font-bold text-sm hover:bg-[#2a1d14] transition">
                        Kirim Counter 🔄
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openCounterModal(offerId) {
        document.getElementById('counterForm').action = `/offers/${offerId}/respond`;
        document.getElementById('counterModal').classList.remove('hidden');
    }
    function closeCounterModal() {
        document.getElementById('counterModal').classList.add('hidden');
    }
</script>

@endsection
