@include('auth.login')
@include('auth.register')

<nav id="mainNavbar" class="relative flex flex-wrap justify-between items-center px-5 md:px-10 py-4 md:py-5 bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50 transition-all duration-300">

    {{-- 1. Logo Area --}}
    <a href="{{ url('/') }}" class="flex items-center gap-2 group cursor-pointer relative z-10">
        <img src="{{ asset('assets/images/logoprop.png') }}" class="w-8 md:w-10 group-hover:scale-110 transition-transform duration-300">
        <h1 class="font-bold text-lg md:text-xl group-hover:text-amber-700 transition-colors duration-300">PropCentral</h1>
    </a>

    {{-- 2. Hamburger Button (HANYA MUNCUL DI HP) --}}
    <button id="hamburgerBtn" class="md:hidden p-2 text-gray-600 hover:text-amber-600 focus:outline-none transition-colors relative z-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    {{-- 3. Wadah Menu & Auth --}}
    <div id="navMenu" class="hidden md:flex flex-col md:flex-row w-full md:w-auto md:flex-1 items-center md:justify-end mt-4 md:mt-0 pt-4 md:pt-0 border-t md:border-none border-gray-100 transition-all duration-300">
        
        {{-- Menu Links (DIPAKSA KE TENGAH LAYAR SAAT DESKTOP) --}}
        <ul class="flex flex-col md:flex-row items-center gap-4 md:gap-8 w-full md:w-auto text-center md:absolute md:left-1/2 md:-translate-x-1/2 mb-4 md:mb-0">
            <li><a href="{{ url('/') }}" class="font-medium text-gray-600 hover:text-amber-600 hover:-translate-y-0.5 inline-block transition-all duration-300">Beranda</a></li>
            @guest
            <li><a href="{{ url('/property') }}" class="font-medium text-gray-600 hover:text-amber-600 hover:-translate-y-0.5 inline-block transition-all duration-300">Properti</a></li>
            @endguest
            <li><a href="{{ url('/jual') }}" class="font-medium text-gray-600 hover:text-amber-600 hover:-translate-y-0.5 inline-block transition-all duration-300">Jual Properti</a></li>
            <li><a href="{{ url('/panduan') }}" class="font-medium text-gray-600 hover:text-amber-600 hover:-translate-y-0.5 inline-block transition-all duration-300">Panduan</a></li>
            <li><a href="#" onclick="openContact()" class="font-medium text-gray-600 hover:text-amber-600 hover:-translate-y-0.5 inline-block transition-all duration-300">Kontak</a></li>
            @if(auth()->check() && auth()->user()->role === 'admin')
            <li><a href="{{ route('admin.dashboard') }}" class="font-bold text-amber-600 hover:text-amber-700 hover:-translate-y-0.5 inline-block transition-all duration-300">Admin Panel</a></li>
            @endif
        </ul>

        {{-- Auth & Icons (TETAP MENTOK DI KANAN SAAT DESKTOP) --}}
        <div class="flex flex-col md:flex-row items-center gap-4 w-full md:w-auto pb-2 md:pb-0 relative z-10">
            @auth
                <div class="flex items-center gap-3">
                    {{-- Saved icon with badge --}}
                    <a href="{{ url('/saved') }}" id="savedNavBtn"
                       class="relative p-2 rounded-lg text-gray-600 hover:text-amber-700 hover:bg-amber-50 transition-all duration-200"
                       title="Properti Tersimpan">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                        <span id="savedBadge" class="absolute -top-1 -right-1 bg-amber-600 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center hidden">
                            0
                        </span>
                    </a>
                    
                    {{-- Penawaran icon dengan badge --}}
                    @php
                        $unreadOffersCount = \App\Models\Offer::where('seller_id', Auth::id())
                            ->where('is_read_by_seller', false)
                            ->count();
                    @endphp
                    <a href="{{ route('offers.incoming') }}"
                    class="relative p-2 rounded-lg text-gray-600 hover:text-amber-700 hover:bg-amber-50 transition-all duration-200"
                    title="Penawaran Masuk">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185z" />
                        </svg>
                        @if($unreadOffersCount > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold min-w-[16px] h-4 px-0.5 rounded-full flex items-center justify-center">
                            {{ $unreadOffersCount > 9 ? '9+' : $unreadOffersCount }}
                        </span>
                        @endif
                    </a>

                    {{-- Chat icon with badge --}}
                    @php
                        $unreadChatsCount = \App\Models\Message::whereHas('conversation', function($q) { 
                            $q->where('user_one_id', Auth::id())->orWhere('user_two_id', Auth::id()); 
                        })->where('sender_id', '!=', Auth::id())->where('is_read', false)->count();
                    @endphp
                    <a href="{{ url('/chat') }}"
                       class="relative p-2 rounded-lg text-gray-600 hover:text-amber-700 hover:bg-amber-50 transition-all duration-200"
                       title="Pesan">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                        </svg>
                        @if($unreadChatsCount > 0)
                        <span class="absolute top-1.5 right-1 w-2.5 h-2.5 bg-green-500 border border-white rounded-full"></span>
                        @endif
                    </a>
                </div>

                {{-- Profile Button --}}
                <a href="/profile" class="w-full md:w-auto justify-center bg-[#3d2b1f] text-white px-5 py-2 rounded-lg hover:bg-[#2a1d14] hover:shadow-lg hover:-translate-y-1 transition-all duration-300 active:scale-95 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    {{ Auth::user()->username }}
                </a>
            @endauth

            @guest
                <button onclick="openLogin()" class="w-full md:w-auto bg-[#3d2b1f] text-white px-5 py-2 rounded-lg hover:bg-[#2a1d14] hover:shadow-lg hover:-translate-y-1 transition-all duration-300 active:scale-95">
                    Masuk
                </button>
            @endguest
        </div>
    </div>
</nav>

{{-- Script Mungil buat Buka-Tutup Menu Hamburger --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('hamburgerBtn');
        const menu = document.getElementById('navMenu');
        
        btn.addEventListener('click', function() {
            menu.classList.toggle('hidden');
            menu.classList.toggle('flex');
        });
    });
</script>