<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - PropCentral</title>
    {{-- Custom pure CSS styling --}}
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, sans-serif;
            background-color: #faf9f8;
            height: 100%;
        }

        .forgot-page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
        }

        .forgot-logo {
            font-size: 2.25rem;
            font-weight: 800;
            color: #111827;
            margin-bottom: 2rem;
            text-align: center;
        }

        .forgot-card {
            max-width: 28rem;
            width: 100%;
            background-color: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border: 1px solid #e5e7eb;
            padding: 2.5rem;
        }

        .forgot-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.75rem;
        }

        .forgot-subtitle {
            font-size: 0.875rem;
            color: #6b7280;
            line-height: 1.5;
            margin-bottom: 2rem;
        }

        .forgot-form-group {
            margin-bottom: 1.5rem;
        }

        .forgot-label {
            display: block;
            font-size: 0.875rem;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .forgot-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .forgot-input {
            width: 100%;
            padding: 0.75rem 1rem;
            padding-right: 2.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            color: #111827;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .forgot-input:focus {
            border-color: #3d2b1f;
            box-shadow: 0 0 0 1px #3d2b1f;
        }

        .forgot-input::placeholder {
            color: #9ca3af;
        }

        .forgot-icon {
            position: absolute;
            right: 0.75rem;
            color: #9ca3af;
            width: 1.25rem;
            height: 1.25rem;
        }

        .forgot-button {
            width: 100%;
            background-color: #3d2b1f;
            color: #ffffff;
            padding: 0.875rem;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .forgot-button:hover {
            background-color: #2a1d14;
        }

        .forgot-divider {
            border: 0;
            border-top: 1px solid #f3f4f6;
            margin: 2rem 0;
        }

        .forgot-back {
            text-align: center;
        }

        .forgot-back a {
            font-size: 0.875rem;
            color: #4b5563;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            transition: color 0.2s;
        }

        .forgot-back a:hover {
            color: #111827;
        }

        .forgot-footer {
            margin-top: 3rem;
            text-align: center;
            font-size: 0.75rem;
            color: #9ca3af;
        }
    </style>
</head>
<body>

    <div class="forgot-page">
        
        {{-- Logo --}}
        <div class="forgot-logo">
            PropCentral
        </div>

        {{-- Card --}}
        <div class="forgot-card">
            
            <h1 class="forgot-title">Lupa Password?</h1>
            <p class="forgot-subtitle">
                Masukkan email yang terdaftar pada akun Anda. Kami akan mengirimkan kode verifikasi untuk mengatur ulang password Anda.
            </p>

            @if (session('error'))
                <div style="background-color: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; font-size: 0.875rem;">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="forgot-form-group">
                    <label class="forgot-label">Alamat Email</label>
                    <div class="forgot-input-wrapper">
                        <input type="email" name="email" value="{{ old('email') }}" class="forgot-input" placeholder="contoh@email.com" required>
                        <svg class="forgot-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    @error('email')
                        <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="forgot-button">
                    Kirim Kode Verifikasi 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 1rem; height: 1rem;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </button>
            </form>

            <hr class="forgot-divider">

            <div class="forgot-back">
                <a href="{{ url('/') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 1rem; height: 1rem;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Kembali ke Login
                </a>
            </div>

        </div>

        {{-- Footer text --}}
        <div class="forgot-footer">
            &copy; 2024 PropCentral. All rights reserved.
        </div>

    </div>

</body>
</html>
