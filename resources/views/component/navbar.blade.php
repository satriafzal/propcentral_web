@include('auth.login')
@include('auth.register')

<nav id="mainNavbar" class="flex justify-between items-center px-10 py-5 bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50 transition-all duration-300">

    <a href="{{ url('/') }}" class="flex items-center gap-2 group cursor-pointer">
    <img src="{{ asset('assets/images/logoprop.png') }}" class="w-10 group-hover:scale-110 transition-transform duration-300">
    <h1 class="font-bold text-xl group-hover:text-amber-700 transition-colors duration-300">PropCentral</h1>
    </a>

    <ul class="flex gap-8">
        <li><a href="{{ url('/') }}" class="font-medium text-gray-600 hover:text-amber-600 hover:-translate-y-0.5 inline-block transition-all duration-300">Beranda</a></li>
        @guest
        <li><a href="{{ url('/property') }}" class="font-medium text-gray-600 hover:text-amber-600 hover:-translate-y-0.5 inline-block transition-all duration-300">Properti</a></li>
        @endguest
        <li><a href="{{ url('/jual') }}" class="font-medium text-gray-600 hover:text-amber-600 hover:-translate-y-0.5 inline-block transition-all duration-300">Jual Properti</a></li>
        <li><a href="{{ url('/panduan') }}" class="font-medium text-gray-600 hover:text-amber-600 hover:-translate-y-0.5 inline-block transition-all duration-300">Panduan</a></li>
        <li><a href="#" onclick="openContact()" class="font-medium text-gray-600 hover:text-amber-600 hover:-translate-y-0.5 inline-block transition-all duration-300">Kontak</a></li>
    </ul>

    <div>
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
                    <span id="savedBadge"
                          class="absolute -top-1 -right-1 bg-amber-600 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center hidden">
                        0
                    </span>
                </a>

                {{-- Profile --}}
                <a href="/profile" class="bg-[#3d2b1f] text-white px-5 py-2 rounded-lg hover:bg-[#2a1d14] hover:shadow-lg hover:-translate-y-1 transition-all duration-300 active:scale-95 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    {{ Auth::user()->username }}
                </a>
            </div>
        @endauth

        @guest
            <button onclick="openLogin()" class="bg-[#3d2b1f] text-white px-5 py-2 rounded-lg hover:bg-[#2a1d14] hover:shadow-lg hover:-translate-y-1 transition-all duration-300 active:scale-95">
                Masuk
            </button>
        @endguest
    </div>
</nav>