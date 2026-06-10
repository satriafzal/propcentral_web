{{-- resources/views/profile.blade.php --}}

@extends('layout.layout')

@section('content')

<div class="flex flex-col md:flex-row bg-[#f5f3f1] min-h-screen relative">

    {{-- SIDEBAR --}}
    <aside class="w-full md:w-[260px] bg-white border-b md:border-b-0 md:border-r md:min-h-screen shrink-0 sticky top-[72px] md:top-0 z-30">

        {{-- MENU --}}
        <div class="p-4 md:p-5 flex flex-col justify-between h-auto md:h-[90%]">

            <div class="flex flex-row md:flex-col gap-2 md:gap-0 md:space-y-3 overflow-x-auto md:overflow-visible pb-2 md:pb-0 scrollbar-hide">

                <a href="#"
                    class="flex items-center gap-2 md:gap-3 p-2.5 md:p-3 rounded-lg hover:bg-[#eee] transition whitespace-nowrap">
                    <span class="font-medium text-sm md:text-base">Dashboard</span>
                </a>

                <a href="{{ url('/penawaran-saya') }}"
                    class="flex items-center gap-2 md:gap-3 p-2.5 md:p-3 rounded-lg hover:bg-[#eee] transition whitespace-nowrap">
                    <span class="font-medium text-sm md:text-base">Iklan Saya</span>
                </a>

                <a href="{{ route('offers.mine') }}"
                    class="flex items-center gap-2 md:gap-3 p-2.5 md:p-3 rounded-lg hover:bg-[#eee] transition whitespace-nowrap">
                    <span class="font-medium text-sm md:text-base">Penawaran Diajukan</span>
                </a>

                <hr class="hidden md:block my-4">

                <a href="{{ url('/settings') }}"
                    class="flex items-center gap-2 md:gap-3 p-2.5 md:p-3 rounded-lg hover:bg-[#eee] transition whitespace-nowrap">
                    <span>⚙️</span>
                    <span class="font-medium text-sm md:text-base">Pengaturan Akun</span>
                </a>

            </div>

        </div>

    </aside>


    {{-- MAIN CONTENT --}}
    <main class="flex-1 w-full max-w-[100vw] md:max-w-none overflow-hidden">

        {{-- Bungkusan max-w buat nahan konten di tengah kalau monitornya lebar banget --}}
        <div class="p-5 md:p-10 max-w-5xl mx-auto">

            {{-- TITLE --}}
            <div class="mb-6 md:mb-8 text-center md:text-left">
                <h1 class="text-3xl md:text-5xl font-bold text-[#4b372d] mb-2 md:mb-3">
                    Profil Saya
                </h1>

                <p class="text-lg md:text-2xl text-[#6b5647]">
                    Kelola informasi akun dan preferensi Anda
                </p>
            </div>


            {{-- PROFILE CARD --}}
            <div class="bg-white rounded-2xl shadow p-6 md:p-8 flex flex-col md:flex-row justify-between items-center md:items-center mb-6 md:mb-8 gap-6 md:gap-0 text-center md:text-left">

                <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-center">

                    @if(Auth::user()->foto_profil)
                        <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}" alt="Foto Profil" 
                            class="w-24 h-24 md:w-28 md:h-28 rounded-full object-cover shadow-inner border-4 border-[#ead9ca] shrink-0">
                    @else
                        <div class="w-24 h-24 md:w-28 md:h-28 rounded-full bg-[#ead9ca] flex items-center justify-center text-[#7b5d4a] text-4xl md:text-5xl font-bold overflow-hidden shadow-inner border-4 border-[#ead9ca] uppercase shrink-0">
                            {{ substr(Auth::user()->username, 0, 1) }}
                        </div>
                    @endif

                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-[#4b372d] capitalize">
                            {{ Auth::user()->username }}
                        </h2>
                        <p class="mt-2 md:mt-3 text-[#9d8876] font-medium text-sm md:text-base">
                            Bergabung sejak {{ Auth::user()->created_at->format('F Y') }}
                        </p>
                    </div>

                </div>

                <form id="form-photo" action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data" class="w-full md:w-auto">
                    @csrf
                    @method('PUT')
                    
                    <input type="file" name="foto" id="input-foto" class="hidden" accept="image/*" 
                        onchange="document.getElementById('form-photo').submit()">
                    
                    <button type="button" onclick="document.getElementById('input-foto').click()" 
                        class="w-full md:w-auto border border-[#b79a85] text-[#7b5d4a] font-semibold px-6 py-2.5 md:py-2.5 rounded-lg hover:bg-[#f5f0eb] hover:shadow-sm transition active:scale-95 text-sm md:text-base">
                        Edit Photo Profile
                    </button>
                </form>

            </div>


            {{-- INFORMASI --}}
            <div class="bg-white rounded-2xl shadow p-6 md:p-8 mb-6 md:mb-8 relative">
                
                <form id="form-update-profile" action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 md:mb-8 gap-4 md:gap-0">
                        <h2 class="text-2xl md:text-3xl font-bold text-[#4b372d]">
                            Informasi Pribadi
                        </h2>

                        <div id="action-buttons" class="w-full md:w-auto">
                            <button type="button" id="btn-edit" onclick="toggleEditMode()"
                                class="w-full md:w-auto border border-[#b79a85] text-[#7b5d4a] hover:bg-[#b79a85] hover:text-white transition px-5 py-2.5 md:py-2 rounded-lg font-medium shadow-sm text-sm md:text-base">
                                Edit Informasi Pribadi
                            </button>

                            <div id="btn-save-cancel" class="hidden flex gap-2 w-full md:w-auto">
                                <button type="button" onclick="cancelEditMode()"
                                    class="flex-1 md:flex-none bg-gray-200 text-gray-700 px-5 py-2.5 md:py-2 rounded-lg font-medium hover:bg-gray-300 transition text-sm md:text-base">
                                    Batal
                                </button>
                                <button type="submit" id="btn-save"
                                    class="flex-1 md:flex-none bg-[#3d2b1f] text-white px-5 py-2.5 md:py-2 rounded-lg font-medium hover:bg-[#2a1d14] transition shadow-md text-sm md:text-base">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- TABLE / FORM --}}
                    <div class="space-y-4 md:space-y-6">

                        {{-- Nama Lengkap --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 border-b pb-3 md:pb-4 items-start md:items-center gap-1 md:gap-0">
                            <span class="font-semibold text-[#4b372d] text-sm md:text-base">Nama Lengkap</span>
                            <div class="w-full">
                                <span id="view-nama" class="font-medium text-gray-800 text-sm md:text-base">{{ Auth::user()->username }}</span>
                                <input type="text" id="input-nama" name="username" value="{{ Auth::user()->username }}" 
                                    class="hidden w-full border-b-2 border-[#b79a85] outline-none py-1 bg-transparent focus:border-[#3d2b1f] transition text-sm md:text-base">
                            </div>
                        </div>

                        {{-- Email (Read-only) --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 border-b pb-3 md:pb-4 items-start md:items-center gap-1 md:gap-0">
                            <span class="font-semibold text-[#4b372d] text-sm md:text-base">Email</span>
                            <div class="w-full overflow-hidden text-ellipsis">
                                <span class="font-medium text-gray-800 text-sm md:text-base break-all">{{ Auth::user()->email }}</span>
                            </div>
                        </div>

                        {{-- Nomor Telepon --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 border-b pb-3 md:pb-4 items-start md:items-center gap-1 md:gap-0">
                            <span class="font-semibold text-[#4b372d] text-sm md:text-base">Nomor Telepon</span>
                            <div class="w-full">
                                <span id="view-notelp" class="font-medium text-sm md:text-base {{ (empty(Auth::user()->no_telp) || Auth::user()->no_telp == '-') ? 'text-gray-400 italic' : 'text-gray-800' }}">
                                    {{ (empty(Auth::user()->no_telp) || Auth::user()->no_telp == '-') ? 'Lengkapi No Telepon' : Auth::user()->no_telp }}
                                </span>
                                
                                <input type="text" id="input-notelp" name="no_telp" 
                                    value="{{ (Auth::user()->no_telp == '-') ? '' : Auth::user()->no_telp }}" 
                                    placeholder="628xxxxxxxxxx" 
                                    class="hidden w-full border-b-2 border-[#b79a85] outline-none py-1 bg-transparent focus:border-[#3d2b1f] transition text-sm md:text-base">
                                <p id="error-notelp" class="text-xs text-red-500 mt-1 hidden">Format nomor telepon tidak valid.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 items-start md:items-center gap-2 md:gap-0">
                            <span class="font-semibold text-[#4b372d] text-sm md:text-base mt-2 md:mt-0">Password</span>
                            <div class="flex justify-between items-center w-full">
                                <span class="text-sm md:text-base tracking-widest mt-1">********</span>
                                <button type="submit" form="form-ubah-password" class="border border-[#b79a85] text-[#7b5d4a] hover:bg-[#b79a85] hover:text-white transition px-4 py-1.5 md:py-2 rounded-lg font-medium inline-block text-center text-xs md:text-sm">
                                    Ubah Password
                                </button>
                            </div>
                        </div>

                    </div>
                </form>

                <form id="form-ubah-password" action="{{ route('password.email') }}" method="POST" class="hidden">
                    @csrf
                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                </form>
            </div>


            {{-- ACTIVITY --}}
            <div class="bg-white rounded-2xl shadow p-6 md:p-8">

                <h2 class="text-2xl md:text-3xl font-bold text-[#4b372d] mb-6 md:mb-8 text-center md:text-left">
                    Aktivitas Saya
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">

                    {{-- CARD 1 --}}
                    <div class="border rounded-2xl p-5 md:p-6 flex flex-col justify-between h-full hover:shadow-md transition-shadow">
                        <div>
                            <div class="flex justify-between items-start mb-4">
                                {{-- PERBAIKAN: items-start biar kotaknya ga ikut melar, w-14 h-14 biar ukurannya pas --}}
                                <div class="flex gap-3 md:gap-4 items-start">
                                    <div class="bg-[#ead9ca] w-14 h-14 md:w-16 md:h-16 rounded-xl flex items-center justify-center text-xl md:text-2xl shrink-0">
                                        ❤️
                                    </div>
                                    <div class="pt-0.5">
                                        <h3 class="font-bold text-lg md:text-xl text-gray-800 leading-tight mb-1">Rumah Favorit</h3>
                                        <p id="saved-count" class="text-3xl md:text-4xl font-bold text-[#4b372d] leading-none">0</p>
                                    </div>
                                </div>
                                <span class="text-xl text-gray-400">›</span>
                            </div>
                            <p class="text-[#9d8876] text-sm md:text-base mb-5 md:mb-6">
                                Properti yang Anda simpan di favorit.
                            </p>
                        </div>
                        <a href="{{ url('/saved') }}"
                            class="w-full block text-center bg-[#8b6c56] text-white py-2.5 md:py-3 rounded-xl text-sm md:text-base font-medium hover:bg-[#7a5d48] transition">
                            Lihat Semua
                        </a>
                    </div>

                    {{-- CARD 2 --}}
                    <div class="border rounded-2xl p-5 md:p-6 flex flex-col justify-between h-full hover:shadow-md transition-shadow">
                        <div>
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex gap-3 md:gap-4 items-start">
                                    <div class="bg-[#ead9ca] w-14 h-14 md:w-16 md:h-16 rounded-xl flex items-center justify-center text-xl md:text-2xl shrink-0">
                                        🏷️
                                    </div>
                                    <div class="pt-0.5">
                                        <h3 class="font-bold text-lg md:text-xl text-gray-800 leading-tight mb-1">Iklan Saya</h3>
                                        <p class="text-3xl md:text-4xl font-bold text-[#4b372d] leading-none">{{ \App\Models\Property::where('user_id', Auth::id())->count() }}</p>
                                    </div>
                                </div>
                                <span class="text-xl text-gray-400">›</span>
                            </div>
                            <p class="text-[#9d8876] text-sm md:text-base mb-5 md:mb-6">
                                Iklan properti yang Anda pasang.
                            </p>
                        </div>
                        <a href="{{ url('/penawaran-saya') }}"
                            class="w-full block text-center bg-[#c29d7f] text-white py-2.5 md:py-3 rounded-xl text-sm md:text-base font-medium hover:bg-[#b08b6d] transition">
                            Lihat Iklan
                        </a>
                    </div>

                    {{-- CARD 3 --}}
                    <div class="border rounded-2xl p-5 md:p-6 flex flex-col justify-between h-full hover:shadow-md transition-shadow">
                        <div>
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex gap-3 md:gap-4 items-start">
                                    <div class="bg-[#ead9ca] w-14 h-14 md:w-16 md:h-16 rounded-xl flex items-center justify-center text-xl md:text-2xl shrink-0">
                                        🤝
                                    </div>
                                    <div class="pt-0.5">
                                        <h3 class="font-bold text-lg md:text-xl text-gray-800 leading-tight mb-1">Penawaran</h3>
                                        <p class="text-3xl md:text-4xl font-bold text-[#4b372d] leading-none">{{ \App\Models\Offer::where('buyer_id', Auth::id())->count() }}</p>
                                    </div>
                                </div>
                                <span class="text-xl text-gray-400">›</span>
                            </div>
                            <p class="text-[#9d8876] text-sm md:text-base mb-5 md:mb-6">
                                Riwayat harga yang diajukan.
                            </p>
                        </div>
                        <a href="{{ route('offers.mine') }}"
                            class="w-full block text-center bg-[#3d2b1f] text-white py-2.5 md:py-3 rounded-xl hover:bg-[#2a1d14] transition text-sm md:text-base font-medium">
                            Lihat Penawaran
                        </a>
                    </div>

                </div>
            </div>

        </div>

    </main>

</div>

{{-- SCRIPT INLINE EDIT --}}
<script>
    function toggleEditMode() {
        // Sembunyiin teks biasa
        document.getElementById('view-nama').classList.add('hidden');
        document.getElementById('view-notelp').classList.add('hidden');
        
        // Munculin inputan
        document.getElementById('input-nama').classList.remove('hidden');
        document.getElementById('input-notelp').classList.remove('hidden');
        
        // Ganti tombol Edit jadi Simpan & Batal
        document.getElementById('btn-edit').classList.add('hidden');
        document.getElementById('btn-save-cancel').classList.remove('hidden');
    }

    function cancelEditMode() {
        // Sembunyiin inputan
        document.getElementById('input-nama').classList.add('hidden');
        document.getElementById('input-notelp').classList.add('hidden');
        
        // Munculin teks biasa lagi
        document.getElementById('view-nama').classList.remove('hidden');
        document.getElementById('view-notelp').classList.remove('hidden');
        
        // Balikin tombol Edit
        document.getElementById('btn-save-cancel').classList.add('hidden');
        document.getElementById('btn-edit').classList.remove('hidden');
    }

    // Validasi nomor telepon sebelum disubmit
    document.getElementById('form-update-profile').addEventListener('submit', function(e) {
        let val = document.getElementById('input-notelp').value;
        const errorElem = document.getElementById('error-notelp');
        
        // Cek jika kosong maka biarkan (karena nullable)
        if (val === '') {
            errorElem.classList.add('hidden');
            return;
        }

        // Cek format awal 628 dan panjang karakter min 11 maks 15 (termasuk 628)
        const regex = /^628[0-9]{8,12}$/;
        
        if (!regex.test(val)) {
            e.preventDefault(); // cegah submit
            errorElem.textContent = "Nomor harus diawali 628 dan panjang 11-15 digit.";
            errorElem.classList.remove('hidden');
            document.getElementById('input-notelp').classList.add('border-red-500');
        } else {
            errorElem.classList.add('hidden');
            document.getElementById('input-notelp').classList.remove('border-red-500');
        }
    });

    // Format nomor telepon otomatis jadi 62...
    document.getElementById('input-notelp').addEventListener('input', function(e) {
        let val = this.value;
        
        // Hapus tanda + atau karakter selain angka
        val = val.replace(/[^0-9]/g, '');
        
        // Jika dimulai dengan 0, ubah jadi 62
        if (val.startsWith('0')) {
            val = '62' + val.substring(1);
        }
        
        this.value = val;
        
        // Sembunyikan error saat sedang mengetik
        document.getElementById('error-notelp').classList.add('hidden');
        document.getElementById('input-notelp').classList.remove('border-red-500');
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
        const userId = {{ auth()->check() ? auth()->id() : 'null' }};
        const SAVE_KEY = isLoggedIn ? 'propcentral_saved_' + userId : 'propcentral_saved';

        const saved = JSON.parse(localStorage.getItem(SAVE_KEY) || '[]');
        const countElem = document.getElementById('saved-count');

        if (countElem) countElem.textContent = saved.length;
    });
</script>

<style>
    /* Utility untuk nyembunyiin scrollbar tapi tetep bisa discroll (buat menu sidebar di HP) */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

@endsection