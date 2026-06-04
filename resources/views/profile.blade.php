{{-- resources/views/profile.blade.php --}}

@extends('layout.layout')

@section('content')

<div class="flex bg-[#f5f3f1] min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-[260px] bg-white border-r min-h-screen">

        {{-- MENU --}}
        <div class="p-5 flex flex-col justify-between h-[90%]">

            <div class="space-y-3">

                <a href="#"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#eee] transition">
                    🏠
                    <span class="font-medium">Dashboard</span>
                </a>



                <a href="#"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#eee] transition">
                    💬
                    <span class="font-medium">Chat</span>
                </a>

                <a href="#"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#eee] transition">
                    🏷️
                    <span class="font-medium">Penawaran Saya</span>
                </a>

                <hr class="my-4">

                <a href="{{ url('/settings') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#eee] transition">
                    ⚙️
                    <span class="font-medium">Pengaturan Akun</span>
                </a>

            </div>

            {{-- LOGOUT --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="button" onclick="confirmLogout()" 
                    class="w-full flex items-center gap-3 p-3 text-red-500 font-semibold hover:bg-red-50 rounded-lg text-left transition">
                    ↩
                    Logout
                </button>
            </form>

        </div>

    </aside>


    {{-- MAIN CONTENT --}}
    <main class="flex-1">




        {{-- CONTENT --}}
        <div class="p-10">

            {{-- TITLE --}}
            <div class="mb-8">
                <h1 class="text-5xl font-bold text-[#4b372d] mb-2">
                    Profil Saya
                </h1>

                <p class="text-2xl text-[#6b5647]">
                    Kelola informasi akun dan preferensi Anda
                </p>
            </div>


            {{-- PROFILE CARD --}}
            <div class="bg-white rounded-2xl shadow p-8 flex justify-between items-start mb-8">

                <div class="flex gap-6">
                    <div class="w-28 h-28 rounded-full bg-[#ead9ca] flex items-center justify-center text-[#7b5d4a] text-5xl font-bold overflow-hidden shadow-inner">
                        {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                    </div>

                    <div>
                        <h2 class="text-3xl font-bold text-[#4b372d] capitalize">
                            {{ Auth::user()->username }}
                        </h2>

                        <p class="mt-4 text-[#9d8876] font-medium">
                            📅 Bergabung sejak {{ Auth::user()->created_at->format('F Y') }}
                        </p>
                    </div>

                </div>

                <button
                    class="border border-[#b79a85] px-5 py-2 rounded-lg hover:bg-[#f5f0eb]">
                    Edit Profil ✏️
                </button>

            </div>


            {{-- INFORMASI --}}
            <div class="bg-white rounded-2xl shadow p-8 mb-8 relative">
                
                <form id="form-update-profile" action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="flex justify-between items-center mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-full bg-[#b68f70] flex items-center justify-center text-white text-2xl font-bold shadow-inner">
                                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                            </div>
                            <h2 class="text-3xl font-bold text-[#4b372d]">
                                Informasi Pribadi
                            </h2>
                        </div>

                        <div id="action-buttons">
                            <button type="button" id="btn-edit" onclick="toggleEditMode()"
                                class="border border-[#b79a85] text-[#7b5d4a] hover:bg-[#b79a85] hover:text-white transition px-5 py-2 rounded-lg font-medium shadow-sm">
                                Edit Informasi ✏️
                            </button>

                            <div id="btn-save-cancel" class="hidden flex gap-2">
                                <button type="button" onclick="cancelEditMode()"
                                    class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg font-medium hover:bg-gray-300 transition">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="bg-[#3d2b1f] text-white px-5 py-2 rounded-lg font-medium hover:bg-[#2a1d14] transition shadow-md">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- TABLE / FORM --}}
                    <div class="space-y-6">

                        {{-- Nama Lengkap --}}
                        <div class="grid grid-cols-2 border-b pb-4 items-center">
                            <span class="font-semibold text-[#4b372d]">Nama Lengkap</span>
                            <div>
                                <span id="view-nama" class="font-medium text-gray-800">{{ Auth::user()->username }}</span>
                                <input type="text" id="input-nama" name="username" value="{{ Auth::user()->username }}" 
                                    class="hidden w-full border-b-2 border-[#b79a85] outline-none py-1 bg-transparent focus:border-[#3d2b1f] transition">
                            </div>
                        </div>

                        {{-- Email (Read-only) --}}
                        <div class="grid grid-cols-2 border-b pb-4 items-center">
                            <span class="font-semibold text-[#4b372d]">Email</span>
                            <div>
                                <span class="font-medium text-gray-800">{{ Auth::user()->email }}</span>
                            </div>
                        </div>

                        {{-- Nomor Telepon --}}
                        <div class="grid grid-cols-2 border-b pb-4 items-center">
                            <span class="font-semibold text-[#4b372d]">Nomor Telepon</span>
                            <div>
                                <span id="view-notelp" class="font-medium {{ (empty(Auth::user()->no_telp) || Auth::user()->no_telp == '-') ? 'text-gray-400 italic' : 'text-gray-800' }}">
                                    {{ (empty(Auth::user()->no_telp) || Auth::user()->no_telp == '-') ? 'Lengkapi No Telepon' : Auth::user()->no_telp }}
                                </span>
                                
                                <input type="text" id="input-notelp" name="no_telp" 
                                    value="{{ (Auth::user()->no_telp == '-') ? '' : Auth::user()->no_telp }}" 
                                    placeholder="08xxxxxxxxxx" 
                                    class="hidden w-full border-b-2 border-[#b79a85] outline-none py-1 bg-transparent focus:border-[#3d2b1f] transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 items-center">
                            <span class="font-semibold text-[#4b372d]">Password</span>
                            <div class="flex justify-between items-center">
                                <span>***********</span>
                                <a href="{{ url('/verify-email') }}" class="border border-[#b79a85] text-[#7b5d4a] hover:bg-[#b79a85] hover:text-white transition px-4 py-2 rounded-lg font-medium inline-block text-center">
                                    Ubah Password
                                </a>
                            </div>
                        </div>

                    </div>
                </form>
            </div>


            {{-- ACTIVITY --}}
            <div class="bg-white rounded-2xl shadow p-8">

                <h2 class="text-3xl font-bold text-[#4b372d] mb-8">
                    Aktivitas Saya
                </h2>

                <div class="grid grid-cols-3 gap-6">

                    {{-- CARD --}}
                    <div class="border rounded-2xl p-6">

                        <div class="flex justify-between items-start mb-4">

                            <div class="flex gap-4">
                                <div class="bg-[#ead9ca] p-4 rounded-xl">
                                    ❤️
                                </div>

                                <div>
                                    <h3 class="font-bold text-xl">
                                        Rumah Favorit
                                    </h3>

                                    <p class="text-4xl font-bold">12</p>
                                </div>
                            </div>

                            <span>›</span>

                        </div>

                        <p class="text-[#9d8876] mb-6">
                            Properti yang Anda simpan di favorit
                        </p>

                        <button
                            class="w-full bg-[#8b6c56] text-white py-3 rounded-xl">
                            Lihat Semua
                        </button>

                    </div>


                    {{-- CARD --}}
                    <div class="border rounded-2xl p-6">

                        <div class="flex justify-between items-start mb-4">

                            <div class="flex gap-4">
                                <div class="bg-[#ead9ca] p-4 rounded-xl">
                                    💬
                                </div>

                                <div>
                                    <h3 class="font-bold text-xl">
                                        Riwayat Chat
                                    </h3>

                                    <p class="text-4xl font-bold">12</p>
                                </div>
                            </div>

                            <span>›</span>

                        </div>

                        <p class="text-[#9d8876] mb-6">
                            Percakapan aktif dengan penjual rumah
                        </p>

                        <button
                            class="w-full bg-[#6f5644] text-white py-3 rounded-xl">
                            Lihat Chat
                        </button>

                    </div>


                    {{-- CARD --}}
                    <div class="border rounded-2xl p-6">

                        <div class="flex justify-between items-start mb-4">

                            <div class="flex gap-4">
                                <div class="bg-[#ead9ca] p-4 rounded-xl">
                                    🏷️
                                </div>

                                <div>
                                    <h3 class="font-bold text-xl">
                                        Penawaran Saya
                                    </h3>

                                    <p class="text-4xl font-bold">12</p>
                                </div>
                            </div>

                            <span>›</span>

                        </div>

                        <p class="text-[#9d8876] mb-6">
                            Penawaran harga yang sedang berjalan
                        </p>

                        <button
                            class="w-full bg-[#c29d7f] text-white py-3 rounded-xl">
                            Lihat Penawaran
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

{{-- for confirmation logout --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Ingin logout?',
            text: "Jika logout, silahkan login ulang untuk akses kelola profile",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3d2b1f', 
            cancelButtonColor: '#d33',     
            confirmButtonText: 'Yes, Logout!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>

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
</script>

@endsection