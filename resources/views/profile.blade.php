{{-- resources/views/profile.blade.php --}}

@extends('layout.layout')

@section('content')

<div class="flex bg-[#f5f3f1] min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-[260px] bg-white border-r min-h-screen">

        {{-- LOGO --}}
        <div class="p-6 border-b">
            <h1 class="text-3xl font-bold text-[#4b372d]">
                PropCentral
            </h1>
        </div>

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
                    ❤️
                    <span class="font-medium">Favorit</span>
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

                <a href="#"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#eee] transition">
                    ⚙️
                    <span class="font-medium">Pengaturan Akun</span>
                </a>

            </div>

            {{-- LOGOUT --}}
            <a href="#"
                class="flex items-center gap-3 p-3 text-red-500 font-semibold hover:bg-red-50 rounded-lg">
                ↩
                Logout
            </a>

        </div>

    </aside>


    {{-- MAIN CONTENT --}}
    <main class="flex-1">

        {{-- TOPBAR --}}
        <div class="bg-white border-b px-10 py-5 flex justify-between items-center">

            {{-- SEARCH --}}
            <div class="w-[400px] relative">
                <input type="text"
                    placeholder="Cari rumah"
                    class="w-full bg-[#f3f1ef] rounded-full px-5 py-3 outline-none">

                <span class="absolute right-5 top-3">
                    🔍
                </span>
            </div>

            {{-- USER --}}
            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-full bg-gray-300"></div>

                <div>
                    <h3 class="font-bold">Adikta Hermawan</h3>
                    <p class="text-sm text-gray-500">Pembeli</p>
                </div>

            </div>

        </div>


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

                    <div class="w-28 h-28 rounded-full bg-gray-300"></div>

                    <div>
                        <h2 class="text-3xl font-bold text-[#4b372d]">
                            Adikta Hermawan
                        </h2>

                        <span class="bg-[#ead9ca] text-[#7b5d4a] px-4 py-1 rounded-full text-sm inline-block mt-2">
                            Pembeli
                        </span>

                        <p class="mt-4 text-[#9d8876]">
                            📅 Bergabung sejak Mei 2026
                        </p>
                    </div>

                </div>

                <button
                    class="border border-[#b79a85] px-5 py-2 rounded-lg hover:bg-[#f5f0eb]">
                    Edit Profil ✏️
                </button>

            </div>


            {{-- INFORMASI --}}
            <div class="bg-white rounded-2xl shadow p-8 mb-8">

                <div class="flex justify-between items-center mb-8">

                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full bg-[#b68f70]"></div>

                        <h2 class="text-3xl font-bold text-[#4b372d]">
                            Informasi Pribadi
                        </h2>
                    </div>

                    <button
                        class="border border-[#b79a85] px-5 py-2 rounded-lg">
                        Edit Informasi ✏️
                    </button>

                </div>


                {{-- TABLE --}}
                <div class="space-y-6">

                    <div class="grid grid-cols-2 border-b pb-4">
                        <span class="font-semibold text-[#4b372d]">
                            Nama Lengkap
                        </span>

                        <span>Adikta Hermawan</span>
                    </div>

                    <div class="grid grid-cols-2 border-b pb-4">
                        <span class="font-semibold text-[#4b372d]">
                            Email
                        </span>

                        <span>adikta@gmail.com</span>
                    </div>

                    <div class="grid grid-cols-2 items-center">
                        <span class="font-semibold text-[#4b372d]">
                            Password
                        </span>

                        <div class="flex justify-between items-center">
                            <span>***********</span>

                            <button
                                class="border border-[#b79a85] px-4 py-2 rounded-lg">
                                Ubah Password
                            </button>
                        </div>
                    </div>

                </div>

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

@endsection