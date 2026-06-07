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
            <h1 class="text-3xl font-extrabold text-gray-900">Penawaran yang Saya Ajukan</h1>
            <p class="text-gray-500 mt-1 text-sm">Riwayat semua penawaran yang kamu kirimkan ke penjual</p>
        </div>

        {{-- List --}}
        @forelse($offers as $offer)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-5 overflow-hidden">
            <div class="flex flex-col md:flex-row">

                {{-- Foto --}}
                <div class="md:w-48 h-40 md:h-auto shrink-0 bg-gray-200 overflow-hidden">
                    @if($offer->property->images->count() > 0)
                        <img src="{{ asset('storage/' . $offer->property->images->first()->image_path) }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No Image</div>
                    @endif
                </div>

                <div class="flex-1 p-6">
                    <div class="flex flex-wrap justify-between items-start gap-3 mb-4">
                        <div>
                            <a href="{{ route('property.show', $offer->property->id) }}"
                               class="font-bold text-gray-900 text-lg hover:text-amber-700 transition">
                                {{ $offer->property->title }}
                            </a>
                            <p class="text-sm text-gray-500 mt-0.5">
                                Penjual: <span class="font-semibold text-gray-700">{{ $offer->seller->nama ?? $offer->seller->username }}</span>
                            </p>
                        </div>

                        {{-- Badge Status --}}
                        @php
                            $statusConfig = [
                                'pending'   => ['🟡 Menunggu Respons',  'bg-yellow-50 text-yellow-700 border-yellow-200'],
                                'accepted'  => ['🟢 Diterima!',         'bg-green-50 text-green-700 border-green-200'],
                                'rejected'  => ['🔴 Ditolak',           'bg-red-50 text-red-700 border-red-200'],
                                'countered' => ['🔵 Ada Counter Offer', 'bg-blue-50 text-blue-700 border-blue-200'],
                            ];
                            [$label, $cls] = $statusConfig[$offer->status] ?? ['⚪ Unknown', 'bg-gray-100 text-gray-500 border-gray-200'];
                        @endphp
                        <span class="px-3 py-1.5 rounded-full text-xs font-bold border {{ $cls }}">{{ $label }}</span>
                    </div>

                    {{-- Harga --}}
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4 p-4 bg-gray-50 rounded-xl">
                        <div>
                            <p class="text-xs text-gray-400 mb-0.5">Harga Listing</p>
                            <p class="font-bold text-gray-900">Rp {{ number_format($offer->original_price, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-0.5">Tawaranmu</p>
                            <p class="font-bold text-amber-700 text-lg">Rp {{ number_format($offer->offered_price, 0, ',', '.') }}</p>
                        </div>
                        @if($offer->counter_price)
                        <div>
                            <p class="text-xs text-gray-400 mb-0.5">Counter Penjual</p>
                            <p class="font-bold text-blue-700">Rp {{ number_format($offer->counter_price, 0, ',', '.') }}</p>
                        </div>
                        @endif
                    </div>

                    {{-- Pesan counter dari penjual --}}
                    @if($offer->counter_message)
                    <div class="bg-blue-50 border border-blue-100 rounded-xl px-4 py-3 mb-4 text-sm text-gray-700">
                        <span class="font-semibold text-blue-700">Pesan Penjual: </span>
                        "{{ $offer->counter_message }}"
                    </div>
                    @endif

                    {{-- Pesanku --}}
                    @if($offer->message)
                    <div class="bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 mb-4 text-sm text-gray-500 italic">
                        Pesanmu: "{{ $offer->message }}"
                    </div>
                    @endif

                    <p class="text-xs text-gray-400 mb-4">
                        Dikirim {{ $offer->created_at->diffForHumans() }}
                        @if($offer->responded_at)
                            · Direspons {{ $offer->responded_at->diffForHumans() }}
                        @endif
                    </p>

                    {{-- Tombol Aksi (jika ada counter dari penjual) --}}
                    @if($offer->status === 'countered')
                    <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-gray-100">
                        {{-- Setuju Counter --}}
                        <form action="{{ route('offers.respond', $offer->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="accept">
                            <button type="submit"
                                class="bg-green-600 text-white px-5 py-2 rounded-xl text-sm font-bold hover:bg-green-700 transition active:scale-95">
                                ✅ Setuju Harga Counter
                            </button>
                        </form>

                        {{-- Ajukan Harga Baru --}}
                        <button type="button" onclick="openReOfferModal({{ $offer->id }})"
                            class="bg-blue-50 text-blue-700 border border-blue-200 px-5 py-2 rounded-xl text-sm font-bold hover:bg-blue-100 transition active:scale-95">
                            🔄 Ajukan Harga Baru
                        </button>

                        {{-- Selesaikan Penawaran --}}
                        <form action="{{ route('offers.respond', $offer->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="reject">
                            <button type="submit"
                                class="bg-gray-100 text-gray-600 border border-gray-200 px-5 py-2 rounded-xl text-sm font-bold hover:bg-gray-200 transition active:scale-95">
                                ❌ Selesaikan Penawaran
                            </button>
                        </form>
                    </div>
                    @endif

                    {{-- Tombol Ajukan Lagi jika DITOLAK oleh penjual --}}
                    @if($offer->status === 'rejected')
                    <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-gray-100">
                        <div class="w-full mb-2 text-xs text-red-500 font-medium">
                            Penawaran ini ditolak penjual. Kamu masih bisa mencoba kembali!
                        </div>
                        <button type="button" onclick="openReOfferModal({{ $offer->id }})"
                            class="bg-amber-50 text-amber-700 border border-amber-200 px-5 py-2 rounded-xl text-sm font-bold hover:bg-amber-100 transition active:scale-95">
                            🔄 Coba Ajukan Lagi
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-20 bg-white rounded-2xl border border-dashed border-gray-200">
            <div class="text-5xl mb-4">🏷️</div>
            <h3 class="text-lg font-bold text-gray-700">Belum ada penawaran yang diajukan</h3>
            <p class="text-gray-400 text-sm mt-1">Temukan properti impianmu dan ajukan penawaran!</p>
            <a href="{{ url('/property') }}"
               class="inline-block mt-5 bg-[#3d2b1f] text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-[#2a1d14] transition">
                Jelajahi Properti
            </a>
        </div>
        @endforelse

    </div>
</div>

{{-- Modal Ajukan Lagi --}}
<div id="reOfferModal" class="fixed inset-0 z-[200] hidden">
    <div class="fixed inset-0 bg-black/50" onclick="closeReOfferModal()"></div>
    <div class="fixed inset-0 flex items-center justify-center p-4 z-[201]">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-1">Ajukan Harga Baru</h3>
            <p class="text-sm text-gray-400 mb-5">Berikan penawaran harga baru kepada penjual</p>

            <form id="reOfferForm" action="" method="POST">
                @csrf
                <input type="hidden" name="action" value="re_offer">

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Harga Baru <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center border-2 border-gray-200 rounded-xl px-4 focus-within:border-[#3d2b1f] transition-colors">
                        <span class="text-gray-500 mr-2 shrink-0">Rp</span>
                        <input type="number" name="new_price" required min="1"
                            placeholder="0"
                            class="flex-1 py-3 outline-none text-gray-900 font-bold text-lg bg-transparent">
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Pesan (opsional)
                    </label>
                    <textarea name="message" rows="3"
                        placeholder="Jelaskan penawaran barumu..."
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:border-[#3d2b1f] transition-colors resize-none"></textarea>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="closeReOfferModal()"
                        class="flex-1 bg-gray-100 text-gray-700 py-3 rounded-xl font-bold text-sm hover:bg-gray-200 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 bg-[#3d2b1f] text-white py-3 rounded-xl font-bold text-sm hover:bg-[#2a1d14] transition">
                        Kirim Penawaran 🚀
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openReOfferModal(offerId) {
        document.getElementById('reOfferForm').action = `/offers/${offerId}/respond`;
        document.getElementById('reOfferModal').classList.remove('hidden');
    }
    function closeReOfferModal() {
        document.getElementById('reOfferModal').classList.add('hidden');
    }
</script>

@endsection
