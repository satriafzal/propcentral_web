<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Password Baru - PropCentral</title>
    {{-- Custom pure CSS styling --}}
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, sans-serif;
            background-color: #faf9f8;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .reset-page {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .reset-container {
            max-width: 1200px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr;
            gap: 4rem;
            align-items: center;
        }

        @media (min-width: 960px) {
            .reset-container {
                grid-template-columns: 1fr 1fr;
            }
        }

        /* LEFT SIDE */
        .reset-left {
            display: flex;
            flex-direction: column;
        }

        .reset-logo {
            font-size: 3rem;
            font-weight: 800;
            color: #111827;
            margin-bottom: 2rem;
            letter-spacing: -0.05em;
        }

        .reset-image-box {
            position: relative;
            width: 100%;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            aspect-ratio: 4/3;
        }

        .reset-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .reset-image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 3rem 2rem 2rem 2rem;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
            color: white;
        }

        .reset-image-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .reset-image-subtitle {
            font-size: 1rem;
            color: #e5e7eb;
            opacity: 0.9;
        }

        /* RIGHT SIDE */
        .reset-card {
            background-color: #ffffff;
            border-radius: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border: 1px solid #e5e7eb;
            padding: 3rem;
            width: 100%;
            max-width: 500px;
            justify-self: center;
        }

        .reset-title {
            font-size: 2rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 1rem;
        }

        .reset-subtitle {
            font-size: 0.95rem;
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .reset-form-group {
            margin-bottom: 1.5rem;
        }

        .reset-label {
            display: block;
            font-size: 0.875rem;
            color: #374151;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .reset-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .reset-input {
            width: 100%;
            padding: 0.875rem 1rem;
            padding-right: 2.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
            color: #111827;
            outline: none;
            transition: all 0.2s;
        }

        .reset-input:focus {
            border-color: #3d2b1f;
            box-shadow: 0 0 0 1px #3d2b1f;
        }

        .reset-icon-btn {
            position: absolute;
            right: 0.75rem;
            background: none;
            border: none;
            cursor: pointer;
            color: #6b7280;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .reset-icon-btn:hover {
            color: #111827;
        }

        .validation-list {
            list-style: none;
            padding: 0;
            margin: 0.5rem 0 1.5rem 0;
            font-size: 0.85rem;
            color: #4b5563;
        }

        .validation-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.35rem;
        }

        .validation-circle {
            width: 12px;
            height: 12px;
            border: 1.5px solid #9ca3af;
            border-radius: 50%;
            display: inline-block;
        }

        .validation-item.valid .validation-circle {
            background-color: #10b981;
            border-color: #10b981;
        }

        .reset-button {
            width: 100%;
            background-color: #2a1d14;
            color: #ffffff;
            padding: 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .reset-button:hover {
            background-color: #1a120c;
        }

        .reset-back {
            text-align: center;
            margin-top: 1.5rem;
        }

        .reset-back a {
            font-size: 0.875rem;
            color: #4b5563;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            transition: color 0.2s;
        }

        .reset-back a:hover {
            color: #111827;
        }

        /* FOOTER */
        .reset-footer {
            border-top: 1px solid #e5e7eb;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .reset-footer-links {
            display: flex;
            gap: 1.5rem;
        }

        .reset-footer-links a {
            color: #6b7280;
            text-decoration: none;
            transition: color 0.2s;
        }

        .reset-footer-links a:hover {
            color: #111827;
        }

        @media (max-width: 640px) {
            .reset-footer {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <div class="reset-page">
        <div class="reset-container">
            
            {{-- LEFT SIDE --}}
            <div class="reset-left">
                <div class="reset-logo">PropCentral</div>
                
                <div class="reset-image-box">
                    <img src="{{ asset('assets/images/reset_password_bg.png') }}" alt="Modern House" class="reset-image">
                    <div class="reset-image-overlay">
                        <div class="reset-image-title">Keamanan Akun Prioritas Kami</div>
                        <div class="reset-image-subtitle">Lindungi aset properti Anda dengan keamanan password berlapis.</div>
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="reset-card">
                <h1 class="reset-title">Buat Password Baru</h1>
                <p class="reset-subtitle">
                    Silakan masukkan password baru Anda. Pastikan password kuat dan mudah diingat.
                </p>

                <form action="{{ url('/profile') }}" method="GET">
                    
                    {{-- Password Baru --}}
                    <div class="reset-form-group">
                        <label class="reset-label">Password Baru</label>
                        <div class="reset-input-wrapper">
                            <input type="password" class="reset-input" id="password" placeholder="••••••••" required>
                            <button type="button" class="reset-icon-btn" onclick="togglePassword('password', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 1.25rem; height: 1.25rem;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Validation Checkmarks --}}
                    <ul class="validation-list">
                        <li class="validation-item" id="req-length">
                            <span class="validation-circle"></span> Minimal 8 karakter
                        </li>
                        <li class="validation-item" id="req-number">
                            <span class="validation-circle"></span> Termasuk angka (0-9)
                        </li>
                        <li class="validation-item" id="req-special">
                            <span class="validation-circle"></span> Termasuk karakter spesial (!@#)
                        </li>
                    </ul>

                    {{-- Konfirmasi Password --}}
                    <div class="reset-form-group">
                        <label class="reset-label">Konfirmasi Password Baru</label>
                        <div class="reset-input-wrapper">
                            <input type="password" class="reset-input" id="password_confirmation" placeholder="••••••••" required>
                            <button type="button" class="reset-icon-btn" onclick="togglePassword('password_confirmation', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 1.25rem; height: 1.25rem;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="reset-button">
                        Simpan Password 
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 1.25rem; height: 1.25rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </form>



            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="reset-footer">
        <div>&copy; 2024 PropCentral. All rights reserved.</div>
        <div class="reset-footer-links">
            <a href="#">Bantuan</a>
            <a href="#">Privasi</a>
        </div>
    </div>

    <script>
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const iconSvg = btn.querySelector('svg');
            
            if (input.type === 'password') {
                input.type = 'text';
                // Ubah menjadi icon mata dicoret (eye-slash)
                iconSvg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />';
            } else {
                input.type = 'password';
                // Kembali ke icon mata biasa
                iconSvg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const reqLength = document.getElementById('req-length');
            const reqNumber = document.getElementById('req-number');
            const reqSpecial = document.getElementById('req-special');

            if (passwordInput) {
                passwordInput.addEventListener('input', function(e) {
                    const val = e.target.value;
                    
                    // 1. Cek panjang >= 8
                    if (val.length >= 8) {
                        reqLength.classList.add('valid');
                    } else {
                        reqLength.classList.remove('valid');
                    }

                    // 2. Cek apakah ada angka
                    if (/\d/.test(val)) {
                        reqNumber.classList.add('valid');
                    } else {
                        reqNumber.classList.remove('valid');
                    }

                    // 3. Cek karakter spesial
                    if (/[!@#\$%\^\&*\)\(+=._-]/.test(val)) {
                        reqSpecial.classList.add('valid');
                    } else {
                        reqSpecial.classList.remove('valid');
                    }
                });
            }
        });
    </script>
</body>
</html>
