<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel — @yield('title', 'Dashboard') | PropCentral</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link { transition: all 0.2s; }
        .sidebar-link:hover, .sidebar-link.active {
            background: rgba(255,255,255,0.12);
            padding-left: 1.25rem;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="w-60 min-h-screen bg-[#1e1410] text-white flex flex-col fixed left-0 top-0 z-30 shadow-2xl">
        {{-- Logo --}}
        <div class="px-6 py-6 border-b border-white/10">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <img src="{{ asset('assets/images/logoprop.png') }}" alt="PropCentral" class="h-7 brightness-0 invert">
            </a>
            <span class="text-[10px] text-amber-400 font-bold tracking-widest uppercase mt-1 block">Admin Panel</span>
        </div>

        {{-- Nav Links --}}
        <nav class="flex-1 px-4 py-6 space-y-1">
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-gray-300 {{ request()->routeIs('admin.dashboard') ? 'active text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
                Dashboard
            </a>

            <a href="{{ route('admin.users') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-gray-300 {{ request()->routeIs('admin.users') ? 'active text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                Manajemen User
            </a>

            <a href="{{ route('admin.properties') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-gray-300 {{ request()->routeIs('admin.properties') ? 'active text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Manajemen Properti
            </a>

            <a href="{{ route('admin.offers') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-gray-300 {{ request()->routeIs('admin.offers') ? 'active text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                Manajemen Penawaran
            </a>
        </nav>

        {{-- Bottom: back to site --}}
        <div class="px-4 pb-6 border-t border-white/10 pt-4">
            <a href="/" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-gray-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali ke Website
            </a>
        </div>
    </aside>

    {{-- Main Area --}}
    <div class="ml-60 flex-1 flex flex-col min-h-screen">

        {{-- Topbar --}}
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between sticky top-0 z-20 shadow-sm">
            <h1 class="text-lg font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->nama }}</p>
                    <p class="text-xs text-amber-600 font-medium">Administrator</p>
                </div>
                <div class="w-9 h-9 rounded-full bg-[#1e1410] flex items-center justify-center text-white font-bold text-sm">
                    {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                </div>
            </div>
        </header>

        {{-- Flash Messages --}}
        <div class="px-8 pt-4">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 text-sm px-4 py-3 rounded-xl mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 shrink-0 text-green-600"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-800 text-sm px-4 py-3 rounded-xl mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 shrink-0 text-red-600"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                    {{ session('error') }}
                </div>
            @endif
        </div>

        {{-- Page Content --}}
        <main class="flex-1 px-8 py-6">
            @yield('content')
        </main>

        <footer class="px-8 py-4 text-xs text-gray-400 border-t border-gray-200">
            © {{ date('Y') }} PropCentral Admin Panel
        </footer>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 transform scale-95 transition-transform duration-300" id="deleteModalBox">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Konfirmasi Hapus</h3>
            <p class="text-sm text-gray-500 mb-6" id="deleteModalMessage">Apakah Anda yakin ingin menghapus data ini?</p>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">Batal</button>
                <form id="deleteModalForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-colors">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(actionUrl, message) {
            document.getElementById('deleteModalForm').action = actionUrl;
            document.getElementById('deleteModalMessage').innerText = message;
            const modal = document.getElementById('deleteModal');
            const box = document.getElementById('deleteModalBox');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                box.classList.remove('scale-95');
            }, 10);
        }
        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            const box = document.getElementById('deleteModalBox');
            modal.classList.add('opacity-0');
            box.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    </script>
</body>
</html>
