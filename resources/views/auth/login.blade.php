
<div id="loginModal"
    class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="relative bg-[#F3EEE9] w-[500px] min-h-[780px] rounded-[60px] px-12 py-14 flex flex-col">

        <button onclick="closeLogin()"
            class="absolute top-6 right-8 text-4xl font-bold">
            &times;
        </button>

        <!-- Title -->
        <h1 class="text-6xl font-bold text-center mb-20">
            Login
        </h1>

        <!-- Form -->
        <form class="flex flex-col">

            <!-- Email -->
            <div class="bg-[#F8F8F8] rounded-full px-8 py-6 flex items-center gap-5 mb-10">

                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" 
                     fill="none" 
                     viewBox="0 0 24 24" 
                     stroke-width="1.5" 
                     stroke="currentColor" 
                     class="w-10 h-10">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.118a7.5 7.5 0 0115 0A17.933 17.933 0 0112 21.75a17.933 17.933 0 01-7.5-1.632z" />
                </svg>

                <input 
                    type="email"
                    placeholder="Email"
                    class="bg-transparent outline-none text-3xl w-full"
                >

            </div>

            <!-- Password -->
            <div class="bg-[#F8F8F8] rounded-full px-8 py-6 flex items-center gap-5">

                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" 
                     fill="none" 
                     viewBox="0 0 24 24" 
                     stroke-width="1.5" 
                     stroke="currentColor" 
                     class="w-10 h-10">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0119.5 12.75v6A2.25 2.25 0 0117.25 21h-10.5A2.25 2.25 0 014.5 18.75v-6A2.25 2.25 0 016.75 10.5z" />
                </svg>

                <input 
                    type="password"
                    placeholder="Password"
                    class="bg-transparent outline-none text-3xl w-full"
                >

            </div>

            <!-- Remember Me -->
            <div class="flex items-center gap-4 mt-8 mb-20">

                <input 
                    type="checkbox"
                    class="w-7 h-7"
                >

                <label class="text-2xl">
                    Remember me?
                </label>

            </div>

            <!-- Button -->
            <button 
                type="submit"
                class="bg-[#F8F8F8] rounded-full py-7 text-5xl font-bold hover:bg-gray-200 transition"
            >
                LOG IN
            </button>

            <!-- Forgot Password -->
            <a href="#" class="text-center text-2xl mt-6">
                Forget Password
            </a>

        </form>

        <!-- Footer -->
        <div class="mt-auto text-center text-xl">

            <span>
                Don’t have an account ?
            </span>

            <a href="#" 
            onclick="closeLogin();openRegister();" 
            class="text-blue-500 font-medium">
                Register
            </a>

        </div>

    </div>

</div>

<script>
    function openLogin() {
        document.getElementById('loginModal')
            .classList.remove('hidden');
    }

    function closeLogin() {
        document.getElementById('loginModal')
            .classList.add('hidden');
    }
</script>