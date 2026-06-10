@extends('layout.layout')

@php $hideSearchFilter = true; @endphp

@section('content')
<style>
    .verify-page {
        min-height: 100vh;
        background-color: #faf9f8;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 3rem 1rem;
    }
    
    .verify-card {
        max-width: 28rem;
        width: 100%;
        background-color: #ffffff;
        border-radius: 1.5rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        border: 1px solid #f3f4f6;
        padding: 2.5rem;
        position: relative;
    }

    .verify-icon-container {
        display: flex;
        justify-content: center;
        margin-bottom: 1.5rem;
    }

    .verify-icon {
        width: 3.5rem;
        height: 3.5rem;
        background-color: #f5e6e1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3d2b1f;
    }

    .verify-icon svg {
        width: 1.5rem;
        height: 1.5rem;
    }

    .verify-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .verify-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.75rem;
    }

    .verify-subtitle {
        font-size: 0.875rem;
        color: #6b7280;
        line-height: 1.625;
    }

    .verify-form {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .verify-inputs {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    .verify-input {
        width: 3rem;
        height: 3.5rem;
        text-align: center;
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        background-color: #ffffff;
        border: 1px solid #d1d5db;
        border-radius: 0.75rem;
        outline: none;
        transition: all 0.2s;
    }

    @media (min-width: 640px) {
        .verify-inputs {
            gap: 0.75rem;
        }
    }

    .verify-input:focus {
        border-color: #3d2b1f;
        box-shadow: 0 0 0 1px #3d2b1f;
    }

    .verify-button {
        width: 100%;
        background-color: #3d2b1f;
        color: #ffffff;
        padding: 0.875rem;
        border-radius: 0.75rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .verify-button:hover {
        background-color: #2a1d14;
    }

    .verify-button:active {
        transform: scale(0.95);
    }

    .verify-resend {
        margin-top: 1.5rem;
        text-align: center;
        font-size: 0.875rem;
    }

    .verify-resend span {
        color: #6b7280;
    }

    .verify-resend a {
        font-weight: 700;
        color: #3d2b1f;
        text-decoration: none;
        margin-left: 0.25rem;
    }

    .verify-resend a:hover {
        text-decoration: underline;
    }

    .verify-divider {
        border: 0;
        border-top: 1px solid #f3f4f6;
        margin: 2rem 0;
    }

    .verify-back {
        text-align: center;
    }

    .verify-back a {
        font-size: 0.875rem;
        color: #6b7280;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: color 0.2s;
    }

    .verify-back a:hover {
        color: #111827;
    }

    .verify-back svg {
        width: 1rem;
        height: 1rem;
    }
</style>

<div class="verify-page">
    <div class="verify-card">
        
        {{-- Icon --}}
        <div class="verify-icon-container">
            <div class="verify-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
            </div>
        </div>

        {{-- Title & Subtitle --}}
        <div class="verify-header">
            <h2 class="verify-title">Verifikasi Email Anda</h2>
            <p class="verify-subtitle">
                Kami telah mengirimkan kode verifikasi 6-digit ke email anda. Silakan masukkan kode tersebut di bawah ini untuk melanjutkan.
            </p>
        </div>

        @if (session('success'))
            <div style="background-color: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; font-size: 0.875rem;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="background-color: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; font-size: 0.875rem;">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form --}}
        <form class="verify-form" action="{{ route('password.verify') }}" method="POST" id="verifyForm">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') ?? old('email') }}">
            <input type="hidden" name="token" id="tokenInput">
            
            {{-- 6-Digit Code Input --}}
            <div class="verify-inputs">
                @for ($i = 1; $i <= 6; $i++)
                    <input type="text" maxlength="1" class="verify-input" required>
                @endfor
            </div>

            @error('token')
                <p style="color: #ef4444; font-size: 0.75rem; text-align: center;">{{ $message }}</p>
            @enderror

            {{-- Submit Button --}}
            <button type="submit" class="verify-button">
                Verifikasi
            </button>
        </form>

        {{-- Resend Link --}}
        <div class="verify-resend">
            <span>Tidak menerima kode?</span>
            <form action="{{ route('password.email') }}" method="POST" class="inline-block m-0 p-0" id="resendForm">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') ?? old('email') }}">
                <button type="submit" id="resendBtn" class="bg-transparent border-none p-0 m-0 cursor-pointer font-bold text-[#3d2b1f] ml-1 hover:underline disabled:text-gray-400 disabled:cursor-not-allowed disabled:no-underline">Kirim ulang kode</button>
            </form>
        </div>

        {{-- Divider --}}
        <hr class="verify-divider">

        {{-- Back Link --}}
        <div class="verify-back">
            <a href="{{ url('/profile') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali ke Profil
            </a>
        </div>

    </div>
</div>

<script>
    // Auto-focus next input logic for verification code
    document.addEventListener('DOMContentLoaded', () => {
        const inputs = document.querySelectorAll('.verify-input');
        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && input.value.length === 0 && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        // Combine inputs into hidden token field before submit
        const form = document.getElementById('verifyForm');
        if (form) {
            form.addEventListener('submit', function() {
                let token = '';
                inputs.forEach(input => token += input.value);
                document.getElementById('tokenInput').value = token;
            });
        }

        // Timer Logic
        const resendBtn = document.getElementById('resendBtn');
        const resendForm = document.getElementById('resendForm');
        
        if (resendBtn && resendForm) {
            const COOLDOWN_SECONDS = 300; // 5 minutes
            const STORAGE_KEY = 'propcentral_resend_timer_forgot';
            let timerInterval;

            function updateTimerDisplay(remaining) {
                if (remaining <= 0) {
                    resendBtn.disabled = false;
                    resendBtn.innerText = 'Kirim ulang kode';
                    clearInterval(timerInterval);
                    localStorage.removeItem(STORAGE_KEY);
                    return;
                }
                resendBtn.disabled = true;
                const minutes = Math.floor(remaining / 60);
                const seconds = remaining % 60;
                resendBtn.innerText = `Kirim ulang dalam ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }

            function startTimer() {
                const now = Math.floor(Date.now() / 1000);
                let expiry = localStorage.getItem(STORAGE_KEY);
                
                // Jika tidak ada expiry atau sudah lewat, mulai dari awal
                if (!expiry || (expiry - now) <= 0) {
                    expiry = now + COOLDOWN_SECONDS;
                    localStorage.setItem(STORAGE_KEY, expiry);
                }

                clearInterval(timerInterval);
                updateTimerDisplay(expiry - Math.floor(Date.now() / 1000));
                
                timerInterval = setInterval(() => {
                    const remaining = expiry - Math.floor(Date.now() / 1000);
                    updateTimerDisplay(remaining);
                }, 1000);
            }

            // Mulai timer otomatis saat halaman dimuat
            startTimer();

            // Saat disubmit, reset timer untuk halaman berikutnya
            resendForm.addEventListener('submit', function() {
                localStorage.setItem(STORAGE_KEY, Math.floor(Date.now() / 1000) + COOLDOWN_SECONDS);
            });
        }
    });
</script>
@endsection
