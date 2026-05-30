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
            
            <input type="text" name="username" placeholder="Nama Pengguna" required
                class="bg-white rounded-full px-5 py-3 text-base outline-none w-full shadow-sm border border-gray-200 text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-gray-300 transition">

            <input type="email" name="email" placeholder="Email" required
                class="bg-white rounded-full px-5 py-3 text-base outline-none w-full shadow-sm border border-gray-200 text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-gray-300 transition">

            <input type="password" id="regPassword" name="password" placeholder="Kata Sandi" required
                class="bg-white rounded-full px-5 py-3 text-base outline-none w-full shadow-sm border border-gray-200 text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-gray-300 transition">

            <p id="passwordWarning" class="text-xs text-red-500 px-5 mt-1 hidden">
                Password harus minimal 6 karakter!
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

    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('regPassword');
        const warningText = document.getElementById('passwordWarning');
        const submitBtn = document.getElementById('regSubmitBtn');

        passwordInput.addEventListener('input', function () {
            const passwordLength = passwordInput.value.length;

            if (passwordLength > 0 && passwordLength < 6) {
                warningText.classList.remove('hidden');
                
                submitBtn.disabled = true;
                submitBtn.classList.remove('bg-gray-800', 'hover:bg-gray-700', 'cursor-pointer');
                submitBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
            } else {
                warningText.classList.add('hidden');
                
                if (passwordLength >= 6) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                    submitBtn.classList.add('bg-gray-800', 'hover:bg-gray-700', 'cursor-pointer');
                } else {
                    submitBtn.disabled = true;
                    submitBtn.classList.remove('bg-gray-800', 'hover:bg-gray-700', 'cursor-pointer');
                    submitBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                }
            }
        });
    });
</script>