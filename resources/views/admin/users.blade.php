@extends('admin.layout')
@section('title', 'Manajemen User')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

    {{-- Header + Search --}}
    <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="font-semibold text-gray-800">Daftar User</h2>
            <p class="text-xs text-gray-400 mt-0.5">Total: {{ $users->total() }} user terdaftar</p>
        </div>
        <form action="{{ route('admin.users') }}" method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama / email..."
                   class="border border-gray-200 rounded-lg px-4 py-2 text-sm outline-none focus:border-amber-400 w-64">
            <button type="submit" class="bg-[#1e1410] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-black transition-colors">
                Cari
            </button>
            @if(request('search'))
            <a href="{{ route('admin.users') }}" class="border border-gray-200 text-gray-600 px-4 py-2 rounded-lg text-sm hover:bg-gray-50 transition-colors">Reset</a>
            @endif
        </form>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-3 text-left">User</th>
                    <th class="px-6 py-3 text-left">No. Telepon</th>
                    <th class="px-6 py-3 text-center">Properti</th>
                    <th class="px-6 py-3 text-center">Role</th>
                    <th class="px-6 py-3 text-left">Bergabung</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full shrink-0 overflow-hidden bg-[#1e1410] flex items-center justify-center text-white font-bold text-sm">
                                @if($user->foto_profil)
                                    <img src="{{ asset('storage/' . $user->foto_profil) }}" class="w-full h-full object-cover">
                                @else
                                    {{ strtoupper(substr($user->nama, 0, 1)) }}
                                @endif
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $user->nama }}</p>
                                <p class="text-xs text-gray-400">{{ $user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $user->no_telp }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-block bg-blue-50 text-blue-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                            {{ $user->properties_count }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-full
                            {{ $user->role === 'admin' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-center">
                        @if($user->id !== auth()->id())
                        <button type="button"
                                onclick="openDeleteModal('{{ route('admin.users.destroy', $user->id) }}', 'Hapus user {{ addslashes($user->nama) }}? Semua properti miliknya akan ikut dihapus.')"
                                class="text-xs text-red-500 hover:text-red-700 font-medium hover:underline transition-colors">
                            Hapus
                        </button>
                        @else
                        <span class="text-xs text-gray-300">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                        Tidak ada user ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($users->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $users->links() }}
    </div>
    @endif

</div>

@endsection
