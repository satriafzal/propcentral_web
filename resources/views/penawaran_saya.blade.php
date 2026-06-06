@extends('layout.layout')

@php $hideSearchFilter = true; @endphp

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="container mx-auto px-4 max-w-7xl">
        
        <div class="mb-8">
            <a href="/profile" class="text-gray-500 hover:text-[#3b2a22] flex items-center text-sm font-medium mb-4 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Kembali ke Profil
            </a>
            
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900">Penawaran Saya</h1>
                </div>
                
                <a href="/jual" class="bg-[#3b2a22] text-white px-6 py-3 rounded-xl font-semibold hover:bg-opacity-90 transition-all shadow-md flex items-center gap-2 w-full sm:w-auto justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Pasang Iklan Baru
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-6">
            
            @forelse($properties as $item)
                <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col group">
                    
                    <div class="relative h-48 bg-gray-200 overflow-hidden">
                        <img src="{{ $item->images->first() ? asset('storage/' . $item->images->first()->image_path) : 'https://via.placeholder.com/400x300?text=Tanpa+Foto' }}" 
                            alt="{{ $item->title }}" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        <div class="absolute top-3 left-3 bg-white/95 backdrop-blur-sm px-3 py-1 text-xs font-bold text-gray-800 rounded-lg shadow-sm">
                            {{ $item->type ?? 'Properti' }}
                        </div>
                    </div>
                    
                    <div class="p-5 flex-grow flex flex-col">
                        <h3 class="font-bold text-gray-900 line-clamp-2 text-base mb-1">{{ $item->title }}</h3>
                        <p class="text-[#3b2a22] font-extrabold text-lg mb-3">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        
                        <div class="flex items-center text-gray-500 text-xs mb-4 mt-auto">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="truncate">{{ $item->address }}</span>
                        </div>

                        <div class="grid grid-cols-2 gap-2 pt-4 border-t border-gray-100 mt-auto">
                            <a href="{{ route('property.edit', $item->id) }}" class="flex justify-center items-center bg-white text-gray-700 border-2 border-gray-200 px-3 py-2 rounded-xl text-sm font-bold hover:border-[#3b2a22] hover:text-[#3b2a22] transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('property.destroy', $item->id) }}" method="POST" class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="confirmDelete(event,this)" class="w-full flex justify-center items-center bg-white text-red-600 border-2 border-red-100 px-3 py-2 rounded-xl text-sm font-bold hover:bg-red-50 hover:border-red-200 transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-16 bg-white border border-dashed border-gray-300 rounded-2xl">
                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <p class="text-gray-500 font-medium text-lg">Belum ada properti yang Anda tawarkan.</p>
                    <a href="/jual" class="mt-4 text-[#3b2a22] font-bold hover:underline">Mulai pasang iklan sekarang</a>
                </div>
            @endforelse

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(event, button) {
        event.preventDefault();
        Swal.fire({
            title: 'Hapus Iklan?',
            text: "Penjualan yang kamu posting akan dihapus secara permanen. Yakin mau hapus iklan ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#d1d5db', 
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            width: '320px',
            customClass: {
                title: 'text-lg font-bold',
                htmlContainer: 'text-sm text-gray-500'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        });
    }
</script>

@endsection