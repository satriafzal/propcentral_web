@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')

{{-- Stat Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-5">
        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6 text-blue-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900">{{ number_format($totalUsers) }}</p>
            <p class="text-sm text-gray-500 mt-0.5">Total User</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-5">
        <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6 text-amber-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900">{{ number_format($totalProperties) }}</p>
            <p class="text-sm text-gray-500 mt-0.5">Total Properti</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-5">
        <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6 text-green-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900">{{ number_format($totalOffers) }}</p>
            <p class="text-sm text-gray-500 mt-0.5">Total Penawaran</p>
        </div>
    </div>

</div>

{{-- Bottom Grids --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- Latest Properties --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-semibold text-gray-800">Properti Terbaru</h2>
            <a href="{{ route('admin.properties') }}" class="text-xs text-amber-700 font-medium hover:underline">Lihat semua →</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($latestProperties as $prop)
            <div class="px-6 py-4 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl overflow-hidden shrink-0 bg-gray-100">
                    @if($prop->images->count() > 0)
                        <img src="{{ asset('storage/' . $prop->images->first()->image_path) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">—</div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 truncate">{{ $prop->title }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $prop->city }} · {{ $prop->user->nama ?? '-' }}</p>
                </div>
                <span class="text-sm font-semibold text-gray-700 shrink-0">Rp {{ number_format($prop->price, 0, ',', '.') }}</span>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-sm text-gray-400">Belum ada properti</div>
            @endforelse
        </div>
    </div>

    {{-- Latest Users --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-semibold text-gray-800">User Terbaru</h2>
            <a href="{{ route('admin.users') }}" class="text-xs text-amber-700 font-medium hover:underline">Lihat semua →</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($latestUsers as $user)
            <div class="px-6 py-4 flex items-center gap-4">
                <div class="w-9 h-9 rounded-full shrink-0 overflow-hidden bg-[#1e1410] flex items-center justify-center text-white font-bold text-sm">
                    @if($user->foto_profil)
                        <img src="{{ asset('storage/' . $user->foto_profil) }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr($user->nama, 0, 1)) }}
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 truncate">{{ $user->nama }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $user->email }}</p>
                </div>
                <span class="text-xs px-2 py-1 rounded-full font-medium shrink-0 {{ $user->role === 'admin' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-600' }}">
                    {{ $user->role }}
                </span>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-sm text-gray-400">Belum ada user</div>
            @endforelse
        </div>
    </div>

</div>

@endsection
