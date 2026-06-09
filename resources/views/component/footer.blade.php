@include('auth.login')

{{-- Perubahan: px-6 py-10 di HP biar ga terlalu lebar, p-10 di laptop --}}
<footer class="bg-[#d2b8a3] mt-20 px-6 py-10 md:p-10">
    
    {{-- Perubahan: grid-cols-1 untuk HP, sm:2 untuk tablet, md:4 untuk laptop --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 md:gap-10">

        <div class="mb-4 md:mb-0">
            <h1 class="font-bold text-lg mb-2">PropCentral</h1>
            <p class="text-sm md:text-base">Bringing you closer to your dream home.</p>
        </div>

        <div>
            <h2 class="font-semibold">About</h2>
            <ul class="text-sm mt-2 space-y-2 md:space-y-1">
                <li><a href="#" class="hover:text-amber-800 transition-colors">Our Story</a></li>
                <li><a href="#" class="hover:text-amber-800 transition-colors">Careers</a></li>
                <li><a href="#" class="hover:text-amber-800 transition-colors">Team</a></li>
            </ul>
        </div>

        <div>
            <h2 class="font-semibold">Support</h2>
            <ul class="text-sm mt-2 space-y-2 md:space-y-1">
                <li><a href="#" class="hover:text-amber-800 transition-colors">FAQ</a></li>
                <li><a href="#" class="hover:text-amber-800 transition-colors">Contact</a></li>
                <li><a href="#" class="hover:text-amber-800 transition-colors">Help Center</a></li>
            </ul>
        </div>

        <div>
            <h2 class="font-semibold">Social</h2>
            <ul class="text-sm mt-2 space-y-2 md:space-y-1">
                <li><a href="#" class="hover:text-amber-800 transition-colors">Instagram</a></li>
                <li><a href="#" class="hover:text-amber-800 transition-colors">Facebook</a></li>
                <li><a href="#" class="hover:text-amber-800 transition-colors">Twitter</a></li>
            </ul>
        </div>

    </div>

    {{-- for notification succes and error--}}
    @if(session('success') || session('error') || $errors->any() )
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top', 
                    showConfirmButton: false,
                    timer: 3000, 
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                @if(session('success'))
                    Toast.fire({
                        icon: 'success',
                        title: '{!! session("success") !!}' 
                    });
                @endif

                @if(session('error'))
                    Toast.fire({
                        icon: 'error',
                        title: '{!! session("error") !!}' 
                    });
                @endif

                @if($errors->any())
                    Toast.fire({
                        icon: 'error',
                        title: '{!! $errors->first() !!}' 
                    });
                @endif
            });
        </script>
    @endif

    @if(session('auto_open_login'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    if (typeof openLogin === "function") {
                        openLogin();
                    }
                }, 500);
            });
        </script>
    @endif

    {{-- for ai assistant button --}}
    <div id="chatbot-container" class="fixed bottom-6 right-6 z-[9999]">
    <div id="chat-window" class="hidden flex-col w-[350px] h-[450px] bg-[#1e1e1e] rounded-2xl shadow-2xl border border-gray-700 mb-4 overflow-hidden transition-all duration-300 transform origin-bottom-right">
        
        <div class="bg-[#2a2a2a] p-4 flex justify-between items-center border-b border-gray-700 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-[#121212] flex items-center justify-center text-blue-400 border border-gray-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a1 1 0 011 1v1h3a1 1 0 011 1v4a3 3 0 01-3 3H8a3 3 0 01-3-3V5a1 1 0 011-1h3V3a1 1 0 011-1zm1 4H9V5h2v1zM6 8a1 1 0 011-1h6a1 1 0 011 1v2H6V8zm0 5a1 1 0 001 1h6a1 1 0 001-1v-1H6v1z"/>
                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-8a1 1 0 112 0 1 1 0 01-2 0z" opacity=".2"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-white font-bold text-sm">PropBot AI</h3>
                    <p class="text-[10px] text-green-400 flex items-center gap-1 font-medium">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span> Online
                    </p>
                </div>
            </div>
            <button onclick="toggleChat()" class="text-gray-400 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <div id="chat-box" class="flex-1 overflow-y-auto p-4 space-y-4 bg-[#121212]">
            <div class="flex justify-start">
                <div class="bg-[#333333] text-gray-200 px-4 py-2.5 rounded-2xl rounded-tl-none max-w-[85%] text-sm shadow-sm leading-relaxed">
                    Halo {{ Auth::check() ? Auth::user()->username : 'Kak' }}! Aku PropBot. Ada yang mau ditanyain soal investasi rumah atau fitur web ini?
                </div>
            </div>
        </div>

        <div class="p-3 bg-[#2a2a2a] border-t border-gray-700">
            <form id="chat-form" onsubmit="sendMessage(event)" class="flex gap-2">
                <input type="text" id="user-input" required autocomplete="off"
                    class="flex-1 bg-[#121212] border border-gray-600 text-gray-200 text-sm rounded-full px-4 py-2 focus:outline-none focus:border-blue-500 transition" 
                    placeholder="Tanya sesuatu...">
                <button type="submit" id="btn-send"
                    class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-500 transition flex items-center justify-center w-10 h-10 shadow-md">
                    <svg class="w-5 h-5 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <button onclick="toggleChat()" class="w-14 h-14 bg-[#121212] hover:bg-[#1a1a1a] rounded-full shadow-2xl flex items-center justify-center text-blue-400 transition transform hover:scale-105 active:scale-95 ml-auto border-2 border-gray-600">
        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19.96 7.14l-1.34-3.18a1.001 1.001 0 00-.54-.54l-3.18-1.34a1 1 0 00-.76 0l-3.18 1.34a1.001 1.001 0 00-.54.54L9.08 7.14a1 1 0 000 .76l1.34 3.18c.11.26.31.46.54.54l3.18 1.34a1 1 0 00.76 0l3.18-1.34c.26-.11.46-.31.54-.54l1.34-3.18a1 1 0 000-.76zm-5.46 2.5l-2-2 2-2 2 2-2 2zM9 14l-2.7-6.3a1 1 0 00-.76 0L2.86 9.04a1.001 1.001 0 00-.54.54L.98 12.76a1 1 0 000 .76l1.34 3.18c.11.26.31.46.54.54l2.68 1.13 1.13 2.68c.11.26.31.46.54.54l3.18 1.34a1 1 0 00.76 0l1.34-3.18c.26-.11.46-.31.54-.54l3.18-1.34a1 1 0 000-.76l-3.18-1.34a1.001 1.001 0 00-.54-.54L9 14z"/>
        </svg>
    </button>
</div>

    <script>
    function toggleChat() {
        const chatWindow = document.getElementById('chat-window');
        if (chatWindow.classList.contains('hidden')) {
            chatWindow.classList.remove('hidden');
            chatWindow.classList.add('flex');
        } else {
            chatWindow.classList.add('hidden');
            chatWindow.classList.remove('flex');
        }
    }

    const chatBox = document.getElementById('chat-box');
    const userInput = document.getElementById('user-input');
    const btnSend = document.getElementById('btn-send');

    async function sendMessage(e) {
        e.preventDefault(); 
        
        const message = userInput.value.trim();
        if (!message) return;

        // Tampilin chat user
        appendMessage(message, 'user');
        userInput.value = '';
        
        // BIKIN ANIMASI LOADING 3 TITIK (TYPING INDICATOR)
        const loadingId = 'loading-' + Date.now() + Math.floor(Math.random() * 1000);
        const loadingAnim = '<div class="flex space-x-1.5 h-5 items-center px-1"><div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0s"></div><div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.15s"></div><div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.3s"></div></div>';
        
        // Panggil bubble chat tapi isinya animasi HTML di atas
        appendMessage(loadingAnim, 'bot', loadingId);
        
        btnSend.disabled = true;
        userInput.disabled = true;

        try {
            const response = await fetch("{{ route('assistant.chat') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}" 
                },
                body: JSON.stringify({ message: message })
            });

            const data = await response.json();
            
            // Hapus animasi loading, masukin jawaban asli
            const loadingEl = document.getElementById(loadingId);
            if(loadingEl) loadingEl.remove();
            
            appendMessage(data.reply, 'bot');
        } catch (error) {
            const loadingEl = document.getElementById(loadingId);
            if(loadingEl) loadingEl.remove();
            
            appendMessage('Aduh, gagal nyambung ke satelit AI nih.', 'bot');
        }

        btnSend.disabled = false;
        userInput.disabled = false;
        userInput.focus();
    }

    // Fungsi bikin bubble chat
    function appendMessage(text, sender, customId = null) {
        const msgDiv = document.createElement('div');
        msgDiv.className = `flex ${sender === 'user' ? 'justify-end' : 'justify-start'}`;
        
        const msgBubble = document.createElement('div');
        msgBubble.className = sender === 'user' 
            ? 'bg-blue-600 text-white px-4 py-2.5 rounded-2xl rounded-tr-none max-w-[85%] text-sm shadow-sm leading-relaxed' 
            : 'bg-[#333333] text-gray-200 px-4 py-2.5 rounded-2xl rounded-tl-none max-w-[85%] text-sm shadow-sm leading-relaxed';
        
        msgBubble.innerHTML = text.replace(/\n/g, '<br>'); 
        
        msgDiv.id = customId || ('msg-' + Date.now() + Math.floor(Math.random() * 1000));
        msgDiv.appendChild(msgBubble);
        chatBox.appendChild(msgDiv);
        
        // Auto scroll ke bawah
        chatBox.scrollTop = chatBox.scrollHeight;
        
        return msgDiv.id;
    }
</script>
</footer>

<style>
    .swal2-container {
        z-index: 999999 !important;
    }
</style>