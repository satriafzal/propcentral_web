@include('auth.login')
<footer class="bg-[#d2b8a3] mt-20 p-10">
    <div class="grid grid-cols-4 gap-10">

        <div>
            <h1 class="font-bold text-lg mb-2">PropCentral</h1>
            <p>Bringing you closer to your dream home.</p>
        </div>

        <div>
            <h2 class="font-semibold">About</h2>
            <ul class="text-sm mt-2 space-y-1">
                <li>Our Story</li>
                <li>Careers</li>
                <li>Team</li>
            </ul>
        </div>

        <div>
            <h2 class="font-semibold">Support</h2>
            <ul class="text-sm mt-2 space-y-1">
                <li>FAQ</li>
                <li>Contact</li>
                <li>Help Center</li>
            </ul>
        </div>

        <div>
            <h2 class="font-semibold">Social</h2>
            <ul class="text-sm mt-2 space-y-1">
                <li>Instagram</li>
                <li>Facebook</li>
                <li>Twitter</li>
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
                    <div class="w-10 h-10 rounded-full bg-[#b68f70] flex items-center justify-center text-white text-lg">🤖</div>
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
                        Halo aku PropBot. Ada yang mau ditanyain soal investasi rumah atau fitur web ini?
                    </div>
                </div>
            </div>

            <div class="p-3 bg-[#2a2a2a] border-t border-gray-700">
                <form id="chat-form" onsubmit="sendMessage(event)" class="flex gap-2">
                    <input type="text" id="user-input" required autocomplete="off"
                        class="flex-1 bg-[#121212] border border-gray-600 text-gray-200 text-sm rounded-full px-4 py-2 focus:outline-none focus:border-[#b68f70] transition" 
                        placeholder="Tanya sesuatu...">
                    <button type="submit" id="btn-send"
                        class="bg-[#b68f70] text-white p-2 rounded-full hover:bg-[#967459] transition flex items-center justify-center w-10 h-10 shadow-md">
                        <svg class="w-4 h-4 ml-[-2px]" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                    </button>
                </form>
            </div>
        </div>

        <button onclick="toggleChat()" class="w-14 h-14 bg-[#b68f70] hover:bg-[#967459] rounded-full shadow-2xl flex items-center justify-center text-white transition transform hover:scale-105 active:scale-95 ml-auto border-2 border-[#121212]">
            <svg id="chat-icon" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        </button>
    </div>

    <script>
        // Fungsi buka tutup kotak chat
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
            const message = userInput.value;
            if (!message) return;

            // Tampilin chat user
            appendMessage(message, 'user');
            userInput.value = '';
            
            // Tampilin titik tiga loading si bot
            const loadingId = appendMessage('Mengetik...', 'bot');
            btnSend.disabled = true;

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
                
                // Hapus loading, masukin jawaban Gemini
                document.getElementById(loadingId).remove();
                appendMessage(data.reply, 'bot');
            } catch (error) {
                document.getElementById(loadingId).remove();
                appendMessage('Aduh, gagal nyambung ke satelit AI nih cok.', 'bot');
            }

            btnSend.disabled = false;
            userInput.focus();
        }

        function appendMessage(text, sender) {
            const msgDiv = document.createElement('div');
            msgDiv.className = `flex ${sender === 'user' ? 'justify-end' : 'justify-start'}`;
            
            const msgBubble = document.createElement('div');
            // Kalo user warnanya coklat, kalo bot warnanya abu gelap
            msgBubble.className = sender === 'user' 
                ? 'bg-[#b68f70] text-white px-4 py-2.5 rounded-2xl rounded-tr-none max-w-[85%] text-sm shadow-sm leading-relaxed' 
                : 'bg-[#333333] text-gray-200 px-4 py-2.5 rounded-2xl rounded-tl-none max-w-[85%] text-sm shadow-sm leading-relaxed';
            
            msgBubble.innerHTML = text.replace(/\n/g, '<br>'); 
            
            const id = 'msg-' + Date.now();
            msgDiv.id = id;
            msgDiv.appendChild(msgBubble);
            chatBox.appendChild(msgDiv);
            
            // Auto scroll ke pesan paling baru
            chatBox.scrollTop = chatBox.scrollHeight;
            
            return id;
        }
    </script>
</footer>

<style>
    .swal2-container {
        z-index: 999999 !important;
    }
</style>