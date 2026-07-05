@extends('admin.layout')
@section('title', 'Manajemen Properti')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

    {{-- Header + Search --}}
    <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="font-semibold text-gray-800">Daftar Properti</h2>
            <p class="text-xs text-gray-400 mt-0.5">Total: {{ $properties->total() }} properti</p>
        </div>
        <form action="{{ route('admin.properties') }}" method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari judul / kota..."
                   class="border border-gray-200 rounded-lg px-4 py-2 text-sm outline-none focus:border-amber-400 w-64">
            <button type="submit" class="bg-[#1e1410] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-black transition-colors">
                Cari
            </button>
            @if(request('search'))
            <a href="{{ route('admin.properties') }}" class="border border-gray-200 text-gray-600 px-4 py-2 rounded-lg text-sm hover:bg-gray-50 transition-colors">Reset</a>
            @endif
        </form>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-3 text-left">Properti</th>
                    <th class="px-6 py-3 text-left">Pemilik</th>
                    <th class="px-6 py-3 text-left">Kota</th>
                    <th class="px-6 py-3 text-left">Harga</th>
                    <th class="px-6 py-3 text-center">Tipe</th>
                    <th class="px-6 py-3 text-left">Diupload</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($properties as $prop)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl shrink-0 overflow-hidden bg-gray-100">
                                @if($prop->images->count() > 0)
                                    <img src="{{ asset('storage/' . $prop->images->first()->image_path) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300 text-lg">🏠</div>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="font-medium text-gray-800 truncate max-w-[200px]">{{ $prop->title }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $prop->bedroom }} KT · {{ $prop->bathroom }} KM · {{ $prop->building_area }} m²</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-gray-800 font-medium">{{ $prop->user->nama ?? '-' }}</p>
                        <p class="text-xs text-gray-400">{{ $prop->user->email ?? '' }}</p>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $prop->city ?? '-' }}</td>
                    <td class="px-6 py-4 font-semibold text-gray-800 whitespace-nowrap">Rp {{ number_format($prop->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-block bg-amber-50 text-amber-700 text-xs font-medium px-2.5 py-1 rounded-full">{{ $prop->type }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-500 text-xs">{{ $prop->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-center">
                        <button type="button" 
                                onclick="openDeleteModal('{{ route('admin.properties.destroy', $prop->id) }}', 'Hapus properti \'{{ addslashes($prop->title) }}\'? Tindakan ini tidak dapat dibatalkan.')"
                                class="text-xs text-red-500 hover:text-red-700 font-medium hover:underline transition-colors">
                            Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                        Tidak ada properti ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($properties->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $properties->links() }}
    </div>
    @endif

</div>

@endsection
