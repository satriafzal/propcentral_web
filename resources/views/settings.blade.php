<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - PropCentral</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }

        body { margin: 0; background: #f5f4f2; display: flex; flex-direction: column; min-height: 100vh; }

        /* TOPBAR */
        .topbar {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 0 2rem;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .topbar-logo { font-size: 1.25rem; font-weight: 800; color: #111827; text-decoration: none; }
        .topbar-nav { display: flex; align-items: center; gap: 2rem; }
        .topbar-nav a { font-size: 0.9rem; color: #4b5563; text-decoration: none; transition: color 0.2s; }
        .topbar-nav a:hover { color: #111827; }
        .topbar-right { display: flex; align-items: center; gap: 1rem; }
        .topbar-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: #ead9ca; color: #7b5d4a;
            font-weight: 700; font-size: 0.9rem;
            display: flex; align-items: center; justify-content: center;
        }
        .topbar-signout {
            font-size: 0.9rem; color: #4b5563; cursor: pointer;
            background: none; border: none; font-family: inherit;
        }
        .topbar-signout:hover { color: #111827; }

        /* LAYOUT */
        .page-body {
            display: flex;
            flex: 1;
        }

        /* SIDEBAR */
        .sidebar {
            width: 230px;
            min-height: calc(100vh - 60px);
            background: white;
            border-right: 1px solid #e5e7eb;
            padding: 2rem 1rem;
            flex-shrink: 0;
        }
        .sidebar-title { font-size: 1rem; font-weight: 700; color: #111827; margin-bottom: 0.2rem; }
        .sidebar-sub { font-size: 0.8rem; color: #9ca3af; margin-bottom: 1.5rem; }
        .sidebar-menu { list-style: none; padding: 0; margin: 0; }
        .sidebar-menu li { margin-bottom: 0.25rem; }
        .sidebar-menu a {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.65rem 0.85rem;
            border-radius: 0.5rem;
            font-size: 0.9rem;
            color: #374151;
            text-decoration: none;
            transition: all 0.15s;
        }
        .sidebar-menu a:hover { background: #f3f4f6; color: #111827; }
        .sidebar-menu a.active { background: #f3f4f6; font-weight: 600; color: #111827; }
        .sidebar-menu a.danger { color: #dc2626; }
        .sidebar-menu a.danger:hover { background: #fef2f2; }
        .sidebar-menu svg { width: 18px; height: 18px; flex-shrink: 0; }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            padding: 2.5rem 3rem;
            max-width: 900px;
        }

        .panel { display: none; }
        .panel.active { display: block; }

        /* PUSAT BANTUAN */
        .page-title { font-size: 1.75rem; font-weight: 700; color: #111827; margin-bottom: 0.5rem; }
        .page-desc { font-size: 0.95rem; color: #6b7280; margin-bottom: 1.75rem; line-height: 1.6; }

        .search-box {
            display: flex; align-items: center; gap: 0.75rem;
            border: 1px solid #e5e7eb; border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            background: white;
            margin-bottom: 2rem;
        }
        .search-box input {
            border: none; outline: none; font-size: 0.9rem;
            color: #374151; width: 100%; background: transparent;
        }
        .search-box svg { width: 18px; height: 18px; color: #9ca3af; flex-shrink: 0; }

        .section-label { font-size: 1rem; font-weight: 600; color: #374151; margin-bottom: 1rem; }

        .faq-item {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            margin-bottom: 0.75rem;
            overflow: hidden;
        }
        .faq-question {
            width: 100%; display: flex; justify-content: space-between; align-items: center;
            padding: 1.1rem 1.25rem;
            background: none; border: none; cursor: pointer;
            font-size: 0.95rem; font-weight: 500; color: #111827;
            text-align: left; font-family: inherit;
            transition: background 0.15s;
        }
        .faq-question:hover { background: #f9fafb; }
        .faq-question svg { width: 18px; height: 18px; color: #6b7280; transition: transform 0.2s; flex-shrink: 0; }
        .faq-question.open svg { transform: rotate(90deg); }
        .faq-answer {
            display: none;
            padding: 0 1.25rem 1.1rem 1.25rem;
            font-size: 0.9rem; color: #6b7280; line-height: 1.7;
        }
        .faq-answer.open { display: block; }

        .support-box {
            background: #fdf0e8;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-top: 2rem;
        }
        .support-box-title { font-size: 1rem; font-weight: 600; color: #b45309; margin-bottom: 1rem; }
        .support-cards { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .support-card {
            background: white; border-radius: 0.75rem;
            padding: 1rem 1.25rem;
            display: flex; align-items: center; gap: 0.85rem;
        }
        .support-card-icon {
            width: 36px; height: 36px; border-radius: 0.5rem;
            background: #fdf0e8; display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .support-card-icon svg { width: 18px; height: 18px; color: #b45309; }
        .support-card-label { font-size: 0.85rem; font-weight: 600; color: #111827; }
        .support-card-value { font-size: 0.82rem; color: #6b7280; }

        /* KEBIJAKAN PRIVASI & SYARAT */
        .legal-section { margin-bottom: 2rem; }
        .legal-section h2 { font-size: 1.05rem; font-weight: 700; color: #111827; margin-bottom: 0.5rem; }
        .legal-section p { font-size: 0.9rem; color: #4b5563; line-height: 1.8; margin-bottom: 0.5rem; }
        .legal-section ul { font-size: 0.9rem; color: #4b5563; line-height: 1.8; padding-left: 1.25rem; }
        .last-updated { font-size: 0.8rem; color: #9ca3af; margin-bottom: 1.75rem; }

        /* HAPUS AKUN */
        .danger-card {
            background: white; border: 1px solid #fecaca;
            border-radius: 1rem; padding: 2rem;
        }
        .danger-icon {
            width: 52px; height: 52px; border-radius: 50%;
            background: #fef2f2; display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.25rem;
        }
        .danger-icon svg { width: 24px; height: 24px; color: #dc2626; }
        .danger-title { font-size: 1.15rem; font-weight: 700; color: #111827; margin-bottom: 0.5rem; }
        .danger-desc { font-size: 0.9rem; color: #6b7280; line-height: 1.7; margin-bottom: 1.5rem; }
        .danger-list { font-size: 0.9rem; color: #6b7280; padding-left: 1.25rem; margin-bottom: 1.75rem; line-height: 1.9; }
        .danger-btn {
            background: #dc2626; color: white;
            padding: 0.75rem 1.75rem; border-radius: 0.5rem;
            border: none; cursor: pointer; font-size: 0.9rem; font-weight: 600;
            font-family: inherit; transition: background 0.2s;
            display: inline-flex; align-items: center; gap: 0.5rem;
        }
        .danger-btn:hover { background: #b91c1c; }
        .danger-btn svg { width: 16px; height: 16px; }

        /* FOOTER */
        .settings-footer {
            background: white;
            border-top: 1px solid #e5e7eb;
            padding: 1.25rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer-left { font-size: 0.8rem; color: #6b7280; }
        .footer-left strong { color: #111827; font-weight: 700; display: block; font-size: 0.95rem; margin-bottom: 0.1rem; }
        .footer-links { display: flex; gap: 1.5rem; }
        .footer-links a { font-size: 0.85rem; color: #6b7280; text-decoration: none; transition: color 0.2s; }
        .footer-links a:hover { color: #111827; }
    </style>
</head>
<body>

    {{-- TOPBAR --}}
    <div class="topbar">
        <a href="{{ url('/') }}" class="topbar-logo">PropCentral</a>
        <div class="topbar-right">
            <div class="topbar-avatar">
                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
            </div>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="topbar-signout">Keluar</button>
            </form>
        </div>
    </div>

    <div class="page-body">

        {{-- SIDEBAR --}}
        <aside class="sidebar">
            <div class="sidebar-title">Pengaturan Akun</div>
            <div class="sidebar-sub">Kelola preferensi Anda</div>

            <ul class="sidebar-menu">
                <li>
                    <a href="#" class="active" id="nav-bantuan" onclick="showPanel('bantuan', this)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/>
                        </svg>
                        Pusat Bantuan (FAQ)
                    </a>
                </li>
                <li>
                    <a href="#" id="nav-privasi" onclick="showPanel('privasi', this)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                        </svg>
                        Kebijakan Privasi
                    </a>
                </li>
                <li>
                    <a href="#" id="nav-syarat" onclick="showPanel('syarat', this)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                        Syarat & Ketentuan
                    </a>
                </li>
                <li style="margin-top: 0.5rem; border-top: 1px solid #f3f4f6; padding-top: 0.5rem;">
                    <a href="#" id="nav-hapus" onclick="showPanel('hapus', this)" class="danger">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/>
                        </svg>
                        Hapus Akun
                    </a>
                </li>
                <li style="margin-top: 0.5rem;">
                    <a href="#" onclick="confirmLogout()" class="danger">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </aside>

        {{-- MAIN CONTENT --}}
        <div class="main-content">

            {{-- ===== PUSAT BANTUAN ===== --}}
            <div id="panel-bantuan" class="panel active">
                <h1 class="page-title">Pusat Bantuan</h1>
                <p class="page-desc">Temukan jawaban atas pertanyaan Anda atau hubungi tim dukungan kami yang siap membantu.</p>



                <div class="section-label">Pertanyaan Umum</div>

                <div id="faq-list">
                    <div class="faq-item" data-question="Bagaimana cara memasang iklan properti?">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            Bagaimana cara memasang iklan properti?
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                        </button>
                        <div class="faq-answer">
                            Klik menu <strong>"Jual Properti"</strong> di navbar atas, lalu isi formulir detail properti Anda termasuk foto, lokasi, harga, dan spesifikasi. Setelah dikirim, iklan Anda akan segera tayang dan dapat dilihat oleh calon pembeli.
                        </div>
                    </div>

                    <div class="faq-item" data-question="Bagaimana cara menghubungi penjual?">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            Bagaimana cara menghubungi penjual?
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                        </button>
                        <div class="faq-answer">
                            Buka halaman detail properti yang Anda minati, lalu klik tombol <strong>"Hubungi Penjual"</strong>. Anda akan diarahkan untuk mengirim pesan langsung melalui fitur chat atau WhatsApp penjual yang tertera.
                        </div>
                    </div>

                    <div class="faq-item" data-question="Apakah transaksi di PropCentral aman?">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            Apakah transaksi di PropCentral aman?
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                        </button>
                        <div class="faq-answer">
                            PropCentral hanya menjadi platform perantara untuk mempertemukan penjual dan pembeli. Kami menyarankan Anda untuk selalu <strong>bertransaksi secara langsung</strong>, memverifikasi dokumen kepemilikan properti, dan menggunakan jasa notaris resmi.
                        </div>
                    </div>

                    <div class="faq-item" data-question="Bagaimana cara mengedit atau menghapus iklan saya?">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            Bagaimana cara mengedit atau menghapus iklan saya?
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                        </button>
                        <div class="faq-answer">
                            Masuk ke halaman <strong>Profil</strong> Anda, lalu buka menu <strong>"Properti Saya"</strong>. Di sana Anda dapat melihat semua iklan yang telah dipasang dan memilih untuk mengedit atau menghapusnya.
                        </div>
                    </div>

                    <div class="faq-item" data-question="Bagaimana cara mengubah kata sandi?">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            Bagaimana cara mengubah kata sandi?
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                        </button>
                        <div class="faq-answer">
                            Buka halaman <strong>Profil</strong>, lalu pada bagian <em>Informasi Pribadi</em>, klik tombol <strong>"Ubah Password"</strong>. Anda akan diminta untuk memverifikasi email terlebih dahulu sebelum membuat kata sandi baru.
                        </div>
                    </div>
                </div>

                <div class="support-box">
                    <div class="support-box-title">Masih butuh bantuan?</div>
                    <div class="support-cards">
                        <div class="support-card">
                            <div class="support-card-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                            </div>
                            <div>
                                <div class="support-card-label">Email Support</div>
                                <div class="support-card-value">support@propcentral.id</div>
                            </div>
                        </div>
                        <div class="support-card">
                            <div class="support-card-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/></svg>
                            </div>
                            <div>
                                <div class="support-card-label">WhatsApp Support</div>
                                <div class="support-card-value">+62 812-3456-7890</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== KEBIJAKAN PRIVASI ===== --}}
            <div id="panel-privasi" class="panel">
                <h1 class="page-title">Kebijakan Privasi</h1>
                <p class="last-updated">Terakhir diperbarui: 1 Januari 2024</p>

                <div class="legal-section">
                    <h2>1. Informasi yang Kami Kumpulkan</h2>
                    <p>PropCentral mengumpulkan informasi yang Anda berikan secara langsung kepada kami, termasuk:</p>
                    <ul>
                        <li>Nama lengkap dan nama pengguna (username)</li>
                        <li>Alamat email dan nomor telepon</li>
                        <li>Informasi properti yang Anda pasang iklannya</li>
                        <li>Data penggunaan platform (halaman yang dikunjungi, fitur yang digunakan)</li>
                    </ul>
                </div>

                <div class="legal-section">
                    <h2>2. Bagaimana Kami Menggunakan Informasi Anda</h2>
                    <p>Kami menggunakan informasi yang dikumpulkan untuk:</p>
                    <ul>
                        <li>Menyediakan, mengelola, dan meningkatkan layanan PropCentral</li>
                        <li>Memproses transaksi dan mengirimkan notifikasi terkait akun Anda</li>
                        <li>Menghubungkan Anda dengan penjual atau pembeli properti</li>
                        <li>Mengirimkan pembaruan, promosi, dan informasi layanan (jika Anda mengizinkan)</li>
                    </ul>
                </div>

                <div class="legal-section">
                    <h2>3. Keamanan Data</h2>
                    <p>Kami menerapkan langkah-langkah keamanan teknis dan organisasi yang sesuai untuk melindungi informasi pribadi Anda dari akses, pengungkapan, perubahan, atau penghancuran yang tidak sah. Namun, tidak ada metode transmisi melalui internet yang 100% aman.</p>
                </div>

                <div class="legal-section">
                    <h2>4. Berbagi Data dengan Pihak Ketiga</h2>
                    <p>PropCentral <strong>tidak menjual</strong> data pribadi Anda kepada pihak ketiga. Kami hanya dapat berbagi data dalam kondisi berikut:</p>
                    <ul>
                        <li>Dengan penyedia layanan yang membantu operasional platform kami</li>
                        <li>Jika diwajibkan oleh hukum atau perintah pengadilan yang berlaku</li>
                        <li>Untuk melindungi hak, properti, atau keamanan PropCentral dan penggunanya</li>
                    </ul>
                </div>

                <div class="legal-section">
                    <h2>5. Hak Anda</h2>
                    <p>Anda berhak untuk mengakses, memperbarui, atau menghapus informasi pribadi Anda kapan saja melalui halaman Profil. Untuk pertanyaan lebih lanjut, hubungi kami di <strong>support@propcentral.id</strong>.</p>
                </div>
            </div>

            {{-- ===== SYARAT & KETENTUAN ===== --}}
            <div id="panel-syarat" class="panel">
                <h1 class="page-title">Syarat & Ketentuan</h1>
                <p class="last-updated">Terakhir diperbarui: 1 Januari 2024</p>

                <div class="legal-section">
                    <h2>1. Penerimaan Syarat</h2>
                    <p>Dengan mengakses dan menggunakan layanan PropCentral, Anda menyetujui untuk terikat oleh syarat dan ketentuan ini. Jika Anda tidak menyetujui, harap tidak menggunakan layanan kami.</p>
                </div>

                <div class="legal-section">
                    <h2>2. Penggunaan Platform</h2>
                    <p>Anda setuju untuk menggunakan PropCentral hanya untuk tujuan yang sah. Dilarang keras untuk:</p>
                    <ul>
                        <li>Memposting iklan properti palsu atau menyesatkan</li>
                        <li>Menipu, memeras, atau merugikan pengguna lain</li>
                        <li>Menggunakan bot atau script otomatis tanpa izin tertulis kami</li>
                        <li>Melanggar hak kekayaan intelektual pihak manapun</li>
                    </ul>
                </div>

                <div class="legal-section">
                    <h2>3. Konten Pengguna</h2>
                    <p>Anda bertanggung jawab penuh atas konten (foto, deskripsi, harga) yang Anda unggah di PropCentral. Kami berhak menghapus konten yang melanggar ketentuan ini tanpa pemberitahuan terlebih dahulu.</p>
                </div>

                <div class="legal-section">
                    <h2>4. Penangguhan Akun</h2>
                    <p>PropCentral berhak menangguhkan atau menghapus akun Anda jika terbukti melakukan pelanggaran terhadap syarat dan ketentuan ini, termasuk namun tidak terbatas pada penipuan, pelecehan, atau aktivitas ilegal.</p>
                </div>

                <div class="legal-section">
                    <h2>5. Batasan Tanggung Jawab</h2>
                    <p>PropCentral hanya berfungsi sebagai platform perantara dan tidak bertanggung jawab atas kerugian yang timbul dari transaksi antara penjual dan pembeli. Setiap transaksi adalah tanggung jawab sepenuhnya antara kedua belah pihak.</p>
                </div>

                <div class="legal-section">
                    <h2>6. Perubahan Syarat</h2>
                    <p>Kami dapat memperbarui syarat dan ketentuan ini sewaktu-waktu. Perubahan akan diumumkan di halaman ini dan penggunaan berlanjut setelah perubahan dianggap sebagai persetujuan Anda.</p>
                </div>
            </div>

            {{-- ===== HAPUS AKUN ===== --}}
            <div id="panel-hapus" class="panel">
                <h1 class="page-title">Hapus Akun</h1>
                <p class="page-desc">Tindakan ini bersifat permanen dan tidak dapat dibatalkan.</p>

                <div class="danger-card">
                    <div class="danger-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                        </svg>
                    </div>
                    <div class="danger-title">Anda yakin ingin menghapus akun?</div>
                    <p class="danger-desc">Setelah akun dihapus, semua data Anda akan dihapus secara permanen dari sistem kami. Tindakan ini <strong>tidak dapat dibatalkan</strong>.</p>

                    <p style="font-size: 0.9rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Yang akan terhapus:</p>
                    <ul class="danger-list">
                        <li>Profil dan informasi pribadi Anda</li>
                        <li>Semua iklan properti yang telah Anda pasang</li>
                        <li>Riwayat percakapan (chat) dengan penjual/pembeli</li>
                        <li>Daftar properti favorit Anda</li>
                    </ul>

                    <button class="danger-btn" onclick="confirmDeleteAccount()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                        </svg>
                        Hapus Akun Saya
                    </button>
                </div>
            </div>

        </div>
    </div>

    {{-- FOOTER --}}
    <div class="settings-footer">
        <div class="footer-left">
            <strong>PropCentral</strong>
            &copy; 2024 PropCentral. All rights reserved.
        </div>
        <div class="footer-links">
            <a href="#" onclick="showPanel('bantuan', document.getElementById('nav-bantuan'))">Support</a>
            <a href="#" onclick="showPanel('privasi', document.getElementById('nav-privasi'))">Privacy</a>
            <a href="#" onclick="showPanel('syarat', document.getElementById('nav-syarat'))">Terms</a>
            <a href="{{ url('/') }}">Contact</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showPanel(name, clickedEl) {
            // hide all panels
            document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
            // remove active from all nav links
            document.querySelectorAll('.sidebar-menu a').forEach(a => a.classList.remove('active'));

            // show selected panel
            document.getElementById('panel-' + name).classList.add('active');
            // mark nav link active (don't add active class on danger links)
            if (clickedEl && !clickedEl.classList.contains('danger')) {
                clickedEl.classList.add('active');
            } else if (clickedEl) {
                clickedEl.style.background = '#fef2f2';
            }
            return false;
        }

        function toggleFaq(btn) {
            const answer = btn.nextElementSibling;
            const isOpen = answer.classList.contains('open');

            // Close all
            document.querySelectorAll('.faq-answer').forEach(a => a.classList.remove('open'));
            document.querySelectorAll('.faq-question').forEach(q => q.classList.remove('open'));

            if (!isOpen) {
                answer.classList.add('open');
                btn.classList.add('open');
            }
        }

        function filterFaq(query) {
            const items = document.querySelectorAll('#faq-list .faq-item');
            query = query.toLowerCase();
            items.forEach(item => {
                const q = item.getAttribute('data-question').toLowerCase();
                item.style.display = q.includes(query) ? 'block' : 'none';
            });
        }

        function confirmDeleteAccount() {
            Swal.fire({
                title: 'Hapus Akun?',
                text: 'Tindakan ini permanen dan tidak dapat dibatalkan. Semua data Anda akan dihapus.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus Akun',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // TODO: submit form hapus akun ke backend
                    Swal.fire('Akun Dihapus', 'Akun Anda telah berhasil dihapus.', 'success');
                }
            });
        }

        function confirmLogout() {
            Swal.fire({
                title: 'Ingin logout?',
                text: "Jika logout, Anda harus login kembali untuk masuk",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626', 
                cancelButtonColor: '#6b7280',     
                confirmButtonText: 'Yes, Logout!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>

</body>
</html>
