<!-- Register Modal -->
<div id="registerModal"
    class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-[#f4ede8] w-[500px] rounded-[60px] px-10 py-14 relative">

        <!-- Close Button -->
        <button onclick="closeRegister()"
            class="absolute top-6 right-8 text-3xl font-bold">
            &times;
        </button>

        <!-- Title -->
        <h1 class="text-5xl font-bold text-center mb-14">
            Register
        </h1>

        <!-- Form -->
        <form class="flex flex-col gap-8">

            <input type="text"
                placeholder="Username"
                class="bg-[#f8f8f8] rounded-full px-10 py-5 text-2xl outline-none">

            <input type="email"
                placeholder="Email"
                class="bg-[#f8f8f8] rounded-full px-10 py-5 text-2xl outline-none">

            <input type="password"
                placeholder="Password"
                class="bg-[#f8f8f8] rounded-full px-10 py-5 text-2xl outline-none">

            <!-- Button -->
            <button
                class="bg-[#f8f8f8] rounded-full py-5 text-4xl font-bold hover:bg-gray-200 transition">
                Register
            </button>

        </form>

        <!-- Login Link -->
        <p class="text-center mt-16 text-xl">
            Already have an account?
            <a href="#"
            onclick="closeRegister(); openLogin();"
            class="text-blue-500 font-medium">
                Login
            </a>
        </p>

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
</script>