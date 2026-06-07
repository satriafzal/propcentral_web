@extends('layout.layout')

@section('content')

<style>
    body {
        background-color: #f4f4f5; /* Light gray background like mockup */
    }
</style>

<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    
    {{-- Top Profile Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 mb-6 flex flex-col md:flex-row justify-between items-center md:items-start">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
            {{-- Profile Image --}}
            <div class="w-24 h-24 rounded-full overflow-hidden border border-gray-200 shrink-0">
                @if($user->foto_profil)
                    <img src="{{ asset('storage/' . $user->foto_profil) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-[#ead9ca] flex items-center justify-center text-[#7b5d4a] font-bold text-3xl uppercase">
                        {{ substr($user->nama, 0, 1) }}
                    </div>
                @endif
            </div>
            
            {{-- User Info --}}
            <div class="text-center md:text-left">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $user->nama }}</h1>
                <div class="inline-block bg-[#ead9ca] text-[#7b5d4a] text-xs font-bold px-3 py-1 rounded-full mb-3">
                    Penjual
                </div>
                <div class="flex flex-col gap-1 text-sm text-gray-500 font-medium">
                    <div class="flex items-center justify-center md:justify-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        Bergabung sejak {{ $user->created_at->translatedFormat('F Y') }}
                    </div>
                    <div class="flex items-center justify-center md:justify-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        Pengguna Terverifikasi
                    </div>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex gap-4 mt-6 md:mt-0">
            {{-- Chat Button --}}
            <a href="{{ route('chat.show', $user->id) }}" class="w-12 h-12 rounded-full border-2 border-[#5c4a3d] flex items-center justify-center text-[#5c4a3d] hover:bg-[#5c4a3d] hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                  <path fill-rule="evenodd" d="M4.804 21.644A6.707 6.707 0 006 21.75a6.721 6.721 0 003.583-1.029c.774.182 1.584.279 2.417.279 5.322 0 9.75-3.97 9.75-9 0-5.03-4.428-9-9.75-9s-9.75 3.97-9.75 9c0 2.409 1.022 4.573 2.706 6.092.393.354.906.518 1.431.572.241.025.485.013.72-.036z" clip-rule="evenodd" />
                </svg>
            </a>
            
            {{-- WhatsApp Button --}}
            @if($user->no_telp)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->no_telp) }}" target="_blank" class="w-12 h-12 rounded-full border-2 border-[#5c4a3d] flex items-center justify-center text-[#5c4a3d] hover:bg-[#5c4a3d] hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.888-.788-1.487-1.761-1.663-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12.004 2c-5.514 0-10 4.486-10 10 0 1.95.556 3.771 1.517 5.308L2 22l4.821-1.485c1.473.864 3.183 1.353 5.02 1.353 5.514 0 10-4.486 10-10s-4.486-10-10-10zm0 18c-1.674 0-3.238-.434-4.596-1.189l-3.25 1.002 1.026-3.111A7.95 7.95 0 014.004 12c0-4.411 3.589-8 8-8s8 3.589 8 8-3.589 8-8 8z"/>
                </svg>
            </a>
            @endif
        </div>
    </div>

    {{-- Main Content Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        {{-- Tabs --}}
        <div class="flex gap-8 border-b border-gray-200 mb-8" id="tabs">
            <button onclick="switchTab('iklan')" id="tab-iklan" class="text-lg font-bold text-gray-900 border-b-2 border-gray-900 pb-3 px-1 transition-colors">
                Iklan({{ $user->properties->count() }})
            </button>
            <button onclick="switchTab('ulasan')" id="tab-ulasan" class="text-lg font-medium text-gray-500 border-b-2 border-transparent pb-3 px-1 hover:text-gray-900 transition-colors">
                Ulasan
            </button>
        </div>

        {{-- Iklan Content --}}
        <div id="content-iklan">
            @if($user->properties->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($user->properties as $prop)
                    <div class="bg-[#e6dcd3] rounded-xl overflow-hidden border border-[#d5c5b5] relative group flex flex-col">
                        {{-- Image --}}
                        <div class="h-48 relative">
                            @if($prop->images->count() > 0)
                                <img src="{{ asset('storage/' . $prop->images->first()->image_path) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-300 flex items-center justify-center text-gray-500">No Image</div>
                            @endif
                            <div class="absolute top-3 right-3 bg-black/30 backdrop-blur p-2 rounded-full text-white cursor-pointer hover:bg-black/50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </div>
                        </div>
                        
                        {{-- Details --}}
                        <div class="p-4 flex flex-col flex-1">
                            <div class="flex items-center gap-1 text-gray-900 font-bold mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" /></svg>
                                {{ Str::limit($prop->address, 30) }}
                            </div>
                            <div class="text-[#5c4a3d] font-extrabold text-xl mb-3">
                                Rp {{ number_format($prop->price, 0, ',', '.') }}
                            </div>
                            <div class="flex justify-between items-end mt-auto">
                                <div class="text-[10px] font-bold text-gray-700 uppercase tracking-wide">
                                    {{ $prop->created_at->diffForHumans() }}
                                </div>
                                <a href="{{ route('property.show', $prop->id) }}" class="bg-[#3d2b1f] text-white text-[10px] font-bold px-4 py-1.5 rounded-md hover:bg-[#2a1d14] transition-colors tracking-wide">
                                    CHECK
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-gray-500 py-10">
                    Penjual ini belum memiliki iklan properti.
                </div>
            @endif
        </div>

        {{-- Ulasan Content --}}
        <div id="content-ulasan" class="hidden">
            @auth
                @if(Auth::id() !== $user->id)
                    <div class="mb-8 bg-gray-50 p-6 rounded-xl border border-gray-100">
                        <h3 class="font-bold text-gray-900 mb-4">Tulis Ulasan</h3>
                        @if(session('success'))
                            <div class="bg-green-100 text-green-700 p-3 rounded-lg text-sm mb-4">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="bg-red-100 text-red-700 p-3 rounded-lg text-sm mb-4">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('profile.reviews.store', $user->id) }}" method="POST">
                            @csrf
                            <textarea name="comment" rows="3" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:border-amber-600 outline-none mb-3 resize-none" placeholder="Bagaimana pengalaman Anda dengan penjual ini?..." required></textarea>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-[#3d2b1f] text-white font-bold py-2 px-6 rounded-lg text-sm hover:bg-[#2a1d14] transition-colors">
                                    Kirim Ulasan
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            @else
                <div class="mb-8 bg-gray-50 p-6 rounded-xl border border-gray-100 text-center">
                    <p class="text-gray-600 text-sm mb-3">Silakan masuk untuk memberikan ulasan.</p>
                    <button onclick="openLogin()" class="bg-[#3d2b1f] text-white font-bold py-2 px-6 rounded-lg text-sm hover:bg-[#2a1d14]">Masuk</button>
                </div>
            @endauth

            <div>
                @if($user->reviews->count() > 0)
                    <div class="flex flex-col gap-4">
                        @foreach($user->reviews()->latest()->get() as $review)
                        <div class="border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 rounded-full bg-gray-200 overflow-hidden">
                                    @if($review->reviewer && $review->reviewer->foto_profil)
                                        <img src="{{ asset('storage/' . $review->reviewer->foto_profil) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-[#ead9ca] flex items-center justify-center text-[#7b5d4a] font-bold text-xs uppercase">
                                            {{ $review->reviewer ? substr($review->reviewer->nama, 0, 1) : 'U' }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-gray-900">{{ $review->reviewer ? $review->reviewer->nama : 'Unknown User' }}</div>
                                    <div class="text-[10px] text-gray-500">{{ $review->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            <p class="text-sm text-gray-700 pl-11">{{ $review->comment }}</p>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-gray-500 py-10">
                        Belum ada ulasan untuk penjual ini.
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

<script>
    function switchTab(tabId) {
        // Reset tabs
        document.getElementById('tab-iklan').className = "text-lg font-medium text-gray-500 border-b-2 border-transparent pb-3 px-1 hover:text-gray-900 transition-colors";
        document.getElementById('tab-ulasan').className = "text-lg font-medium text-gray-500 border-b-2 border-transparent pb-3 px-1 hover:text-gray-900 transition-colors";
        
        // Hide contents
        document.getElementById('content-iklan').classList.add('hidden');
        document.getElementById('content-ulasan').classList.add('hidden');
        
        // Activate selected tab
        document.getElementById('tab-' + tabId).className = "text-lg font-bold text-gray-900 border-b-2 border-gray-900 pb-3 px-1 transition-colors";
        document.getElementById('content-' + tabId).classList.remove('hidden');
    }
</script>

@endsection
