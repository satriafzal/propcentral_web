
<nav id="mainNavbar" class="flex justify-between items-center px-10 py-5 bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50 transition-all duration-300">

    <a href="{{ url('/') }}" class="flex items-center gap-2 group cursor-pointer">
    <img src="{{ asset('assets/images/logoprop.png') }}" class="w-10 group-hover:scale-110 transition-transform duration-300">
    <h1 class="font-bold text-xl group-hover:text-amber-700 transition-colors duration-300">PropCentral</h1>
    </a>

    <ul class="flex gap-8">
        <li><a href="{{ url('/') }}" class="font-medium text-gray-600 hover:text-amber-600 hover:-translate-y-0.5 inline-block transition-all duration-300">Home</a></li>
        <li><a href="{{ url('/property') }}" class="font-medium text-gray-600 hover:text-amber-600 hover:-translate-y-0.5 inline-block transition-all duration-300">Property</a></li>
        <li><a href="{{ url('/panduan') }}" class="font-medium text-gray-600 hover:text-amber-600 hover:-translate-y-0.5 inline-block transition-all duration-300">Panduan</a></li>
        <li><a href="#" onclick="openContact()" class="font-medium text-gray-600 hover:text-amber-600 hover:-translate-y-0.5 inline-block transition-all duration-300">Contact</a></li>
    </ul>

    <button onclick="openLogin()" class="bg-[#3d2b1f] text-white px-5 py-2 rounded-lg hover:bg-[#2a1d14] hover:shadow-lg hover:-translate-y-1 transition-all duration-300 active:scale-95">Login</button>
</nav>