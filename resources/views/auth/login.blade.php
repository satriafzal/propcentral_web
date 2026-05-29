<div id="loginModal"
    class="hidden fixed inset-0 w-full h-screen bg-black/50 flex items-center justify-center z-[99999] backdrop-blur-sm">

    <div class="relative bg-[#F3EEE9] w-full max-w-md rounded-[30px] p-8 flex flex-col mx-4 shadow-2xl">

        <button onclick="closeLogin()"
            class="absolute top-5 right-6 text-3xl font-bold text-gray-500 hover:text-gray-800 transition">
            &times;
        </button>

        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">
            Login
        </h1>

        <form action="{{ route('login.post') }}" method="POST" class="flex flex-col">
            @csrf
            
            <div class="bg-white rounded-full px-5 py-3 flex items-center gap-3 mb-4 shadow-sm border border-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.118a7.5 7.5 0 0115 0A17.933 17.933 0 0112 21.75a17.933 17.933 0 01-7.5-1.632z" />
                </svg>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required class="bg-transparent outline-none text-base w-full text-gray-700 placeholder-gray-400">
            </div>

            <div class="bg-white rounded-full px-5 py-3 flex items-center gap-3 shadow-sm border border-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0119.5 12.75v6A2.25 2.25 0 0117.25 21h-10.5A2.25 2.25 0 014.5 18.75v-6A2.25 2.25 0 016.75 10.5z" />
                </svg>
                <input type="password" name="password" placeholder="Password" required class="bg-transparent outline-none text-base w-full text-gray-700 placeholder-gray-400">
            </div>

            <button type="submit" class="bg-gray-800 text-white rounded-full py-3 mt-8 text-lg font-semibold hover:bg-gray-700 transition shadow-md">
                LOG IN
            </button>
        </form>

        <div class="mt-8 text-center text-sm text-gray-600 border-t border-gray-300 pt-5">
            <span>Don’t have an account?</span>
            <a href="#" onclick="closeLogin();openRegister();" class="text-blue-600 font-semibold hover:underline ml-1">
                Register
            </a>
        </div>
    </div>
</div>

<script>
    function openLogin() {
        document.getElementById('loginModal').classList.remove('hidden');
    }

    function closeLogin() {
        document.getElementById('loginModal').classList.add('hidden');
    }

    @if($errors->has('email'))
        document.addEventListener('DOMContentLoaded', function() {
            openLogin();
        });
    @endif
</script>