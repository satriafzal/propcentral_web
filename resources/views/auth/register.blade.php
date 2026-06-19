<!-- Register Modal -->
<div id="registerModal"
    class="hidden fixed inset-0 h-screen w-screen bg-black/50 flex items-center justify-center z-[100] backdrop-blur-sm">

    <div class="relative bg-[#F3EEE9] w-full max-w-md rounded-[30px] p-8 flex flex-col mx-4 shadow-2xl">

        <button onclick="closeRegister()"
            class="absolute top-5 right-6 text-3xl font-bold text-gray-500 hover:text-gray-800 transition">
            &times;
        </button>

        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">
            Daftar
        </h1>

        <form action="{{ route('register.post') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            
            <div>
                <input type="text" name="username" value="{{ old('username') }}" placeholder="Nama Pengguna" required
                    class="bg-white rounded-full px-5 py-3 text-base outline-none w-full shadow-sm border @error('username') border-red-500 @else border-gray-200 @enderror text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-gray-300 transition">
                @error('username')
                    <p class="text-xs text-red-500 px-5 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required
                    class="bg-white rounded-full px-5 py-3 text-base outline-none w-full shadow-sm border @error('email') border-red-500 @else border-gray-200 @enderror text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-gray-300 transition">
                @error('email')
                    <p class="text-xs text-red-500 px-5 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input type="password" id="regPassword" name="password" placeholder="Kata Sandi" required
                    class="bg-white rounded-full px-5 py-3 text-base outline-none w-full shadow-sm border @error('password') border-red-500 @else border-gray-200 @enderror text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-gray-300 transition">
                @error('password')
                    <p class="text-xs text-red-500 px-5 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <input type="password" id="regPasswordConfirm" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required
                class="bg-white rounded-full px-5 py-3 text-base outline-none w-full shadow-sm border border-gray-200 text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-gray-300 transition">

            <p id="passwordWarning" class="text-xs text-red-500 px-5 mt-1 hidden">
                Password minimal 6 karakter dan harus sama!
            </p>

            <button type="submit" id="regSubmitBtn" disabled
                class="bg-gray-400 text-white rounded-full py-3 mt-4 text-lg font-semibold shadow-md cursor-not-allowed transition-all duration-300">
                Daftar
            </button>
        </form>

        <div class="mt-8 text-center text-sm text-gray-600 border-t border-gray-300 pt-5">
            <span>
                Sudah punya akun?
            </span>
            <a href="#"
            onclick="closeRegister(); openLogin();"
            class="text-blue-600 font-semibold hover:underline ml-1">
                Masuk
            </a>
        </div>

    </div>

</div>

<!-- Register Verify Modal -->
<div id="registerVerifyModal"
    class="hidden fixed inset-0 h-screen w-screen bg-black/50 flex items-center justify-center z-[100] backdrop-blur-sm">

    <div class="relative bg-[#F3EEE9] w-full max-w-md rounded-[30px] p-8 flex flex-col mx-4 shadow-2xl">

        <button onclick="closeRegisterVerify()"
            class="absolute top-5 right-6 text-3xl font-bold text-gray-500 hover:text-gray-800 transition">
            &times;
        </button>

        <h1 class="text-3xl font-bold text-center mb-4 text-gray-800">
            Verifikasi Email
        </h1>
        <p class="text-center text-gray-600 mb-2 text-sm">
            Masukkan 6 digit kode OTP yang telah kami kirimkan ke email Anda.
        </p>
        {{-- Expiry countdown --}}
        <div class="text-center mb-5">
            <span class="inline-flex items-center gap-1.5 bg-amber-50 border border-amber-200 text-amber-700 text-xs font-semibold px-3 py-1.5 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
                </svg>
                Kode kadaluarsa dalam: <span id="otpCountdown" class="font-bold">10:00</span>
            </span>
        </div>

        <form action="{{ route('register.verify.post') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            
            <div>
                <input type="text" name="token" placeholder="Kode 6 Digit" required maxlength="6"
                    class="bg-white rounded-full px-5 py-3 text-base outline-none w-full shadow-sm border @error('token') border-red-500 @else border-gray-200 @enderror text-center tracking-[0.5em] font-bold text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-gray-300 transition">
                @error('token')
                    <p class="text-xs text-red-500 text-center mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="bg-gray-800 hover:bg-gray-700 text-white rounded-full py-3 mt-4 text-lg font-semibold shadow-md cursor-pointer transition-all duration-300">
                Verifikasi & Masuk
            </button>
        </form>

        <div class="mt-4 text-center text-sm text-gray-600">
            <span>Tidak menerima kode?</span>
            <form action="{{ route('register.resend') }}" method="POST" class="inline-block m-0 p-0" id="regResendForm">
                @csrf
                <button type="submit" id="regResendBtn" class="bg-transparent border-none p-0 m-0 cursor-pointer font-semibold text-blue-600 ml-1 hover:underline disabled:text-gray-400 disabled:cursor-not-allowed disabled:no-underline">Kirim ulang kode</button>
            </form>
        </div>

    </div>

</div>

<!-- Script -->
<script>
    function openRegister() {
        document.getElementById('registerModal')
            .classList.remove('hidden');
    }

    function closeRegister() {
        document.getElementById('registerModal')
            .classList.add('hidden');
    }

    function openRegisterVerify() {
        document.getElementById('registerVerifyModal').classList.remove('hidden');
        document.getElementById('registerModal').classList.add('hidden');
    }

    function closeRegisterVerify() {
        document.getElementById('registerVerifyModal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('regPassword');
        const passwordConfirmInput = document.getElementById('regPasswordConfirm');
        const warningText = document.getElementById('passwordWarning');
        const submitBtn = document.getElementById('regSubmitBtn');

        function validatePassword() {
            const passwordValue = passwordInput.value;
            const confirmValue = passwordConfirmInput.value;
            const passwordLength = passwordValue.length;

            const hasUpperCase = /[A-Z]/.test(passwordValue);
            const hasSpecialChar = /[^a-zA-Z0-9]/.test(passwordValue);

            let isValid = true;
            let warningMsg = [];

            if (passwordLength > 0) {
                if (passwordLength < 6) warningMsg.push("minimal 6 karakter");
                if (!hasUpperCase) warningMsg.push("1 huruf besar");
                if (!hasSpecialChar) warningMsg.push("1 karakter spesial");
                if (passwordValue !== confirmValue && confirmValue.length > 0) warningMsg.push("password harus sama");
            }

            if (warningMsg.length > 0) {
                warningText.innerText = "Password harus " + warningMsg.join(', ') + "!";
                warningText.classList.remove('hidden');
                isValid = false;
            } else {
                warningText.classList.add('hidden');
                if (passwordLength >= 6 && hasUpperCase && hasSpecialChar && passwordValue === confirmValue) {
                    isValid = true;
                } else {
                    isValid = false;
                }
            }

            if (isValid) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                submitBtn.classList.add('bg-gray-800', 'hover:bg-gray-700', 'cursor-pointer');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.remove('bg-gray-800', 'hover:bg-gray-700', 'cursor-pointer');
                submitBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
            }
        }

        passwordInput.addEventListener('input', validatePassword);
        passwordConfirmInput.addEventListener('input', validatePassword);

        @if(session('show_register_verify_modal'))
            openRegisterVerify();
            startRegResendTimer();
        @elseif ($errors->has('username') || $errors->has('email') || $errors->has('password'))
            openRegister();
        @endif

        // Timer Logic for Register Resend
        const regResendBtn = document.getElementById('regResendBtn');
        const regResendForm = document.getElementById('regResendForm');
        let regTimerInterval;

        const COOLDOWN_SECONDS   = 300; // 5 menit untuk tombol resend
        const OTP_EXPIRES_SECONDS = 600; // 10 menit untuk OTP
        const RESEND_KEY = 'propcentral_resend_timer_register';
        const OTP_KEY    = 'propcentral_otp_expiry_register';

        // ── Countdown kadaluarsa OTP (10 menit) ──
        function startOtpExpiryCountdown() {
            const countdownEl = document.getElementById('otpCountdown');
            if (!countdownEl) return;

            const now = Math.floor(Date.now() / 1000);
            let otpExpiry = parseInt(localStorage.getItem(OTP_KEY));

            if (!otpExpiry || (otpExpiry - now) <= 0) {
                otpExpiry = now + OTP_EXPIRES_SECONDS;
                localStorage.setItem(OTP_KEY, otpExpiry);
            }

            const otpInterval = setInterval(() => {
                const remaining = Math.max(0, otpExpiry - Math.floor(Date.now() / 1000));
                const m = Math.floor(remaining / 60).toString().padStart(2, '0');
                const s = (remaining % 60).toString().padStart(2, '0');
                countdownEl.textContent = `${m}:${s}`;

                const badge = countdownEl.closest('span');
                if (remaining <= 120 && badge) {
                    badge.className = 'inline-flex items-center gap-1.5 bg-red-50 border border-red-200 text-red-600 text-xs font-semibold px-3 py-1.5 rounded-full';
                }

                if (remaining <= 0) {
                    clearInterval(otpInterval);
                    countdownEl.textContent = 'KADALUARSA';
                    localStorage.removeItem(OTP_KEY);
                }
            }, 1000);
        }

        // ── Timer resend kode (5 menit cooldown) ──
        function startRegResendTimer() {
            if (!regResendBtn || !regResendForm) return;

            function updateTimerDisplay(remaining) {
                if (remaining <= 0) {
                    regResendBtn.disabled = false;
                    regResendBtn.innerText = 'Kirim ulang kode';
                    clearInterval(regTimerInterval);
                    localStorage.removeItem(RESEND_KEY);
                    return;
                }
                regResendBtn.disabled = true;
                const minutes = Math.floor(remaining / 60);
                const seconds = remaining % 60;
                regResendBtn.innerText = `Kirim ulang dalam ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }

            const now = Math.floor(Date.now() / 1000);
            let expiry = parseInt(localStorage.getItem(RESEND_KEY));

            if (!expiry || (expiry - now) <= 0) {
                expiry = now + COOLDOWN_SECONDS;
                localStorage.setItem(RESEND_KEY, expiry);
            }

            clearInterval(regTimerInterval);
            updateTimerDisplay(expiry - Math.floor(Date.now() / 1000));

            regTimerInterval = setInterval(() => {
                const remaining = expiry - Math.floor(Date.now() / 1000);
                updateTimerDisplay(remaining);
            }, 1000);

            regResendForm.addEventListener('submit', function() {
                localStorage.setItem(RESEND_KEY, Math.floor(Date.now() / 1000) + COOLDOWN_SECONDS);
                localStorage.setItem(OTP_KEY, Math.floor(Date.now() / 1000) + OTP_EXPIRES_SECONDS);
            });
        }

        @if(session('show_register_verify_modal'))
            openRegisterVerify();
            startOtpExpiryCountdown();
            startRegResendTimer();
        @elseif ($errors->has('token'))
            openRegisterVerify();
            startOtpExpiryCountdown();
            startRegResendTimer();
        @elseif ($errors->has('username') || $errors->has('email') || $errors->has('password'))
            openRegister();
        @endif
    });
</script>