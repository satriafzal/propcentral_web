@extends('admin.layout')
@section('title', 'Manajemen Penawaran')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

    {{-- Header + Search --}}
    <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="font-semibold text-gray-800">Daftar Penawaran</h2>
            <p class="text-xs text-gray-400 mt-0.5">Total: {{ $offers->total() }} penawaran</p>
        </div>
        <form action="{{ route('admin.offers') }}" method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari properti / pembeli..."
                   class="border border-gray-200 rounded-lg px-4 py-2 text-sm outline-none focus:border-amber-400 w-64">
            <button type="submit" class="bg-[#1e1410] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-black transition-colors">
                Cari
            </button>
            @if(request('search'))
            <a href="{{ route('admin.offers') }}" class="border border-gray-200 text-gray-600 px-4 py-2 rounded-lg text-sm hover:bg-gray-50 transition-colors">Reset</a>
            @endif
        </form>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-3 text-left">Properti</th>
                    <th class="px-6 py-3 text-left">Pembeli</th>
                    <th class="px-6 py-3 text-left">Penjual</th>
                    <th class="px-6 py-3 text-right">Harga Asli</th>
                    <th class="px-6 py-3 text-right">Harga Ditawar</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3 text-left">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($offers as $offer)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <p class="font-medium text-gray-800 max-w-[160px] truncate">{{ $offer->property->title ?? '(Dihapus)' }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $offer->property->city ?? '' }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-gray-800 font-medium">{{ $offer->buyer->nama ?? '-' }}</p>
                        <p class="text-xs text-gray-400">{{ $offer->buyer->email ?? '' }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-gray-800">{{ $offer->seller->nama ?? '-' }}</p>
                        <p class="text-xs text-gray-400">{{ $offer->seller->email ?? '' }}</p>
                    </td>
                    <td class="px-6 py-4 text-right text-gray-500 text-xs whitespace-nowrap">
                        Rp {{ number_format($offer->original_price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-right font-semibold text-gray-800 whitespace-nowrap">
                        Rp {{ number_format($offer->offered_price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @php
                            $statusStyle = match($offer->status) {
                                'pending'   => 'bg-yellow-50 text-yellow-700',
                                'accepted'  => 'bg-green-50 text-green-700',
                                'rejected'  => 'bg-red-50 text-red-600',
                                'countered' => 'bg-blue-50 text-blue-700',
                                default     => 'bg-gray-100 text-gray-600',
                            };
                            $statusLabel = match($offer->status) {
                                'pending'   => 'Menunggu',
                                'accepted'  => 'Diterima',
                                'rejected'  => 'Ditolak',
                                'countered' => 'Kontra',
                                default     => $offer->status,
                            };
                        @endphp
                        <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-full {{ $statusStyle }}">
                            {{ $statusLabel }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500 text-xs whitespace-nowrap">{{ $offer->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                        Tidak ada penawaran ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($offers->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $offers->links() }}
    </div>
    @endif

</div>

@endsection
