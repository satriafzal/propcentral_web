@extends('layout.layout')

@section('content')
<style>
    /* CSS disederhanain karena udh di-handle sama Tailwind */
    .chat-layout {
        display: flex;
        height: calc(100vh - 80px);
        background-color: #f8f9fa;
        overflow: hidden;
    }
    .chat-list-col {
        background-color: #ffffff;
        border-right: 1px solid #eaeaea;
    }
    .chat-main {
        background-color: #f8f9fa;
        position: relative;
    }
    .scrollable::-webkit-scrollbar { width: 6px; }
    .scrollable::-webkit-scrollbar-thumb { background-color: #e5e7eb; border-radius: 10px; }
</style>

<div class="chat-layout">

    {{-- Middle: Message List --}}
    {{-- PERUBAHAN: Lebar full di HP, 380px di laptop --}}
    <section class="chat-list-col w-full md:w-[380px] flex flex-col shrink-0">
        <div class="p-5 border-b border-gray-100">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
                <input type="text" placeholder="Search messages..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-amber-600 transition-colors">
            </div>
        </div>
        
        <div class="flex-1 overflow-y-auto scrollable">
            @if($conversations->count() > 0)
                @foreach($conversations as $conv)
                    @php
                        $otherUser = $conv->getOtherUser(Auth::id());
                        $lastMessage = $conv->messages()->orderByDesc('created_at')->first();
                        $unreadCount = $conv->messages()->where('sender_id', $otherUser->id)->where('is_read', false)->count();
                    @endphp
                    <a href="{{ route('chat.show', $otherUser->id) }}" class="flex items-start p-4 hover:bg-gray-50 border-b border-gray-50 transition-colors">
                        <div class="relative">
                            <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200 flex-shrink-0">
                                @if($otherUser->foto_profil)
                                    <img src="{{ asset('storage/' . $otherUser->foto_profil) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-[#ead9ca] flex items-center justify-center text-[#7b5d4a] font-bold text-xl uppercase">
                                        {{ substr($otherUser->nama, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                        </div>
                        
                        <div class="ml-4 flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <h3 class="text-[15px] font-semibold text-gray-900 truncate">{{ $otherUser->nama }}</h3>
                                <span class="text-[11px] text-gray-400">{{ $lastMessage ? $lastMessage->created_at->format('H:i') : '' }}</span>
                            </div>
                            <div class="flex items-center justify-between mt-0.5">
                                <p class="text-[13px] text-gray-500 truncate {{ $unreadCount > 0 ? 'font-medium text-gray-900' : '' }}">
                                    @if($lastMessage)
                                        @if($lastMessage->image)
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 inline-block mr-0.5 relative -top-0.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                                            {{ $lastMessage->body ? $lastMessage->body : 'Lampiran' }}
                                        @else
                                            {{ $lastMessage->body }}
                                        @endif
                                    @else
                                        Belum ada pesan
                                    @endif
                                </p>
                                @if($unreadCount > 0)
                                    <span class="flex items-center justify-center w-5 h-5 ml-2 text-[10px] font-bold text-white bg-black rounded-full flex-shrink-0">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <div class="p-8 text-center text-gray-400 text-sm">
                    Belum ada percakapan.
                </div>
            @endif
        </div>
    </section>

    {{-- Right: Empty State --}}
    {{-- PERUBAHAN: Sembunyiin di HP, baru muncul pas di layar laptop (md:flex) --}}
    <main class="chat-main hidden md:flex flex-1 items-center justify-center flex-col">
        <div class="absolute inset-0 pointer-events-none" style="background-image: linear-gradient(to right, #f0f0f0 1px, transparent 1px), linear-gradient(to bottom, #f0f0f0 1px, transparent 1px); background-size: 40px 40px;"></div>
        
        <div class="text-center max-w-sm relative z-10">
            <div class="relative w-40 h-40 mx-auto mb-8">
                <div class="absolute inset-0 bg-[#f5ebe4] rounded-full opacity-50 blur-2xl"></div>
                <div class="relative w-32 h-32 bg-white rounded-full shadow-sm mx-auto flex items-center justify-center border border-gray-100 z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-gray-800">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                    </svg>
                </div>
                <div class="absolute -top-2 right-2 bg-white p-2.5 rounded-lg shadow-sm border border-gray-100 rotate-12 z-20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-800">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                    </svg>
                </div>
                <div class="absolute bottom-0 -left-2 bg-[#8c7462] p-2.5 rounded-full shadow-sm text-white -rotate-12 z-20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                    </svg>
                </div>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Mulai Percakapan Anda</h2>
            <p class="text-gray-500 mb-8 leading-relaxed px-4">Hubungi penjual properti untuk mulai bernegosiasi atau menanyakan detail unit.</p>
            
            <a href="{{ url('/property') }}" class="inline-flex items-center gap-2 bg-[#3d2b1f] hover:bg-[#2a1d14] text-white px-8 py-3.5 rounded-xl font-medium transition-colors shadow-md text-sm">
                Jelajahi Properti
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 ml-1">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                </svg>
            </a>

            <div class="flex items-center justify-center gap-12 mt-12 pt-8 border-t border-gray-200">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto mb-2 text-[#9a887a]">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-xs text-gray-500 font-medium">Aman & Terverifikasi</span>
                </div>
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto mb-2 text-[#9a887a]">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-xs text-gray-500 font-medium">Respon Cepat 24/7</span>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection