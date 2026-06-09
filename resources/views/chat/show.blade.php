@extends('layout.layout')

@section('content')
@php
    $firstProp = App\Models\Property::where('user_id', $otherUser->id)->first();
@endphp
<style>
    /* CSS disederhanain juga */
    .chat-layout {
        display: flex;
        height: calc(100vh - 80px);
        background-color: #f8f9fa;
        overflow: hidden;
    }
    .chat-list-col {
        background-color: #ffffff;
        border-right: 1px solid #eaeaea;
    }
    .chat-main {
        background-color: #ffffff;
        position: relative;
    }
    .scrollable::-webkit-scrollbar { width: 6px; }
    .scrollable::-webkit-scrollbar-thumb { background-color: #e5e7eb; border-radius: 10px; }
    
    .bubble-left {
        background-color: #ffffff;
        color: #111827;
        border: 1px solid #e5e7eb;
        border-radius: 16px 16px 16px 0;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }
    .bubble-right {
        background-color: #3d2b1f;
        color: #d1c1b3;
        border-radius: 16px 16px 0 16px;
    }
</style>

<div class="chat-layout">

    {{-- Middle: Message List --}}
    {{-- PERUBAHAN: Sembunyiin daftar pesan di HP pas lagi buka chat --}}
    <section class="chat-list-col hidden md:flex w-[380px] flex-col shrink-0">
        <div class="p-5 border-b border-gray-100">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
                <input type="text" placeholder="Search messages..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-amber-600 transition-colors">
            </div>
        </div>
        
        <div class="flex-1 overflow-y-auto scrollable">
            @php
                $allConversations = Auth::user()->conversations()->orderByDesc('last_message_at')->get();
            @endphp
            @if($allConversations->count() > 0)
                @foreach($allConversations as $conv)
                    @php
                        $userItem = $conv->getOtherUser(Auth::id());
                        $lastMessage = $conv->messages()->orderByDesc('created_at')->first();
                        $unreadCount = $conv->messages()->where('sender_id', $userItem->id)->where('is_read', false)->count();
                        $isActive = isset($conversation) && $conversation->id == $conv->id;
                    @endphp
                    <a href="{{ route('chat.show', $userItem->id) }}" class="flex items-start p-4 hover:bg-gray-50 border-b border-gray-50 transition-colors {{ $isActive ? 'bg-gray-50' : '' }}">
                        <div class="relative">
                            <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200 flex-shrink-0">
                                @if($userItem->foto_profil)
                                    <img src="{{ asset('storage/' . $userItem->foto_profil) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-[#ead9ca] flex items-center justify-center text-[#7b5d4a] font-bold text-xl uppercase">
                                        {{ substr($userItem->nama, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                        </div>
                        
                        <div class="ml-4 flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <h3 class="text-[15px] font-semibold text-gray-900 truncate">{{ $userItem->nama }}</h3>
                                <span class="text-[11px] text-gray-400">{{ $lastMessage ? $lastMessage->created_at->format('H:i') : '' }}</span>
                            </div>
                            <div class="flex items-center justify-between mt-0.5">
                                <p class="text-[13px] text-gray-500 truncate {{ $unreadCount > 0 ? 'font-medium text-gray-900' : '' }}">
                                    {{ $lastMessage ? $lastMessage->body : 'Belum ada pesan' }}
                                </p>
                                @if($unreadCount > 0)
                                    <span class="flex items-center justify-center w-5 h-5 ml-2 text-[10px] font-bold text-white bg-black rounded-full flex-shrink-0">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </section>

    {{-- Right: Active Chat --}}
    {{-- PERUBAHAN: Lebar full di HP --}}
    <main class="chat-main flex flex-col flex-1 w-full">
        
        @if($firstProp)
        <div class="p-4 border-b border-gray-100">
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 bg-white rounded-xl shadow-sm border border-gray-100 p-3">
                
                {{-- PERUBAHAN: Tombol Back Khusus HP --}}
                <div class="flex items-center gap-3">
                    <a href="{{ url('/chat') }}" class="md:hidden p-2 -ml-2 text-gray-600 hover:bg-gray-100 rounded-full transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </a>
                    <div class="w-16 h-12 rounded-lg overflow-hidden bg-gray-200 shrink-0">
                        @if($firstProp->images && $firstProp->images->count() > 0)
                            <img src="{{ asset('storage/' . $firstProp->images[0]->image_path) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200"></div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-sm text-gray-900 truncate">{{ $firstProp->title }}</h3>
                        <p class="text-xs font-semibold text-gray-800">Rp {{ number_format($firstProp->price, 0, ',', '.') }}</p>
                    </div>
                </div>

                <a href="{{ route('property.show', $firstProp->id) }}" class="bg-black hover:bg-gray-800 text-white text-xs font-medium px-4 py-2 rounded-lg transition-colors flex items-center justify-center gap-2 mt-2 sm:mt-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    View Detail
                </a>
            </div>
        </div>
        @else
        <div class="p-4 border-b border-gray-100 flex items-center gap-3">
            {{-- PERUBAHAN: Tombol Back Khusus HP --}}
            <a href="{{ url('/chat') }}" class="md:hidden p-2 -ml-2 text-gray-600 hover:bg-gray-100 rounded-full transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
            
            <div class="w-10 h-10 rounded-full bg-gray-200 flex-shrink-0 overflow-hidden">
                @if($otherUser->foto_profil)
                    <img src="{{ asset('storage/' . $otherUser->foto_profil) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-[#ead9ca] flex items-center justify-center text-[#7b5d4a] font-bold text-lg uppercase">
                        {{ substr($otherUser->nama, 0, 1) }}
                    </div>
                @endif
            </div>
            <div>
                <h3 class="font-bold text-sm text-gray-900">{{ $otherUser->nama }}</h3>
            </div>
        </div>
        @endif

        <div id="chat-container" class="flex-1 overflow-y-auto scrollable p-4 md:p-6 space-y-6">
            <div id="messages-wrapper" class="flex flex-col min-h-full space-y-4">
                @php
                    $currentDate = null;
                @endphp

                @foreach($messages as $msg)
                    @php
                        $msgDate = $msg->created_at->format('Y-m-d');
                        $displayDate = '';
                        if ($msgDate == now()->format('Y-m-d')) {
                            $displayDate = 'HARI INI';
                        } elseif ($msgDate == now()->subDay()->format('Y-m-d')) {
                            $displayDate = 'KEMARIN';
                        } else {
                            $displayDate = strtoupper($msg->created_at->format('d M Y'));
                        }
                    @endphp

                    @if($currentDate != $msgDate)
                        <div class="flex justify-center my-6">
                            <span class="bg-[#faebe0] text-[#7a6a5a] text-[10px] font-bold px-4 py-1.5 rounded-full tracking-wider">
                                {{ $displayDate }}
                            </span>
                        </div>
                        @php $currentDate = $msgDate; @endphp
                    @endif

                    @if($msg->sender_id == Auth::id())
                        <div class="flex justify-end w-full group message-item" data-id="{{ $msg->id }}">
                            <div class="max-w-[85%] md:max-w-[75%] bubble-right px-4 py-3 md:px-6 md:py-4 relative">
                                @if($msg->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $msg->image) }}" class="rounded-xl max-w-full w-64 object-cover shadow-sm border border-black/5" alt="Uploaded Image">
                                    </div>
                                @endif
                                @if($msg->body)
                                    <p class="text-[13px] md:text-[14px] leading-relaxed break-words">{{ $msg->body }}</p>
                                @endif
                                <div class="flex justify-end items-center mt-2 gap-1 text-[10px] text-[#9a887a]">
                                    <span>{{ $msg->created_at->format('H:i') }}</span>
                                    @if($msg->is_read)
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 text-[#9a887a]">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 text-[#9a887a]">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6" />
                                    </svg>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex w-full group message-item" data-id="{{ $msg->id }}">
                            <div class="flex-shrink-0 mr-2 md:mr-3 mt-auto mb-1">
                                <div class="w-6 h-6 md:w-8 md:h-8 rounded-full overflow-hidden bg-gray-200">
                                    @if($otherUser->foto_profil)
                                        <img src="{{ asset('storage/' . $otherUser->foto_profil) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-[#ead9ca] flex items-center justify-center text-[#7b5d4a] font-bold text-xs md:text-sm uppercase">
                                            {{ substr($otherUser->nama, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="max-w-[80%] md:max-w-[75%] bubble-left px-4 py-3 md:px-6 md:py-4 relative">
                                @if($msg->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $msg->image) }}" class="rounded-xl max-w-full w-64 object-cover shadow-sm border border-black/5" alt="Uploaded Image">
                                    </div>
                                @endif
                                @if($msg->body)
                                    <p class="text-[13px] md:text-[14px] leading-relaxed break-words">{{ $msg->body }}</p>
                                @endif
                                <div class="flex justify-start items-center mt-2 text-[10px] text-gray-400">
                                    <span>{{ $msg->created_at->format('H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="p-3 md:p-4 bg-white border-t border-gray-100 flex flex-col">
            <div id="image-preview-container" class="hidden mb-3 relative self-start group">
                <img id="image-preview" src="" class="h-20 md:h-24 w-auto rounded-lg border border-gray-200 shadow-sm object-cover">
                <button onclick="removeImage()" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-md hover:bg-red-600 transition-colors opacity-100 md:opacity-0 md:group-hover:opacity-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="flex items-center gap-2 md:gap-3 bg-white border border-gray-200 rounded-2xl px-2 py-2 shadow-sm focus-within:ring-1 focus-within:ring-gray-300 focus-within:border-gray-300 transition-all">
                <input type="file" id="image-input" accept="image/*" class="hidden" onchange="previewImage(this)">
                <label for="image-input" class="cursor-pointer flex-shrink-0 w-9 h-9 md:w-10 md:h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors ml-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </label>
                
                <div class="flex-1 relative">
                    <input type="text" id="message-input" placeholder="Ketik pesan..." 
                        class="w-full bg-transparent px-2 md:px-4 py-2 md:py-3 text-[13px] md:text-[14px] focus:outline-none placeholder-gray-400">
                </div>
                
                <button id="btn-send" class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 rounded-xl bg-black hover:bg-gray-800 flex items-center justify-center text-white transition-colors mr-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 md:w-5 md:h-5 ml-0.5">
                      <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
                    </svg>
                </button>
            </div>
        </div>
    </main>
</div>

<script>
    // SCRIPT JAVASCRIPT LU TETEP AMAN (Sama persis)
    const chatContainer = document.getElementById('chat-container');
    const messageInput = document.getElementById('message-input');
    const btnSend = document.getElementById('btn-send');
    const messagesWrapper = document.getElementById('messages-wrapper');
    const otherUserId = {{ $otherUser->id }};
    const currentUserId = {{ Auth::id() }};
    const otherUserFoto = "{{ $otherUser->foto_profil ? asset('storage/' . $otherUser->foto_profil) : '' }}";
    
    function scrollToBottom() {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }
    
    scrollToBottom();

    function previewImage(input) {
        const label = input.nextElementSibling;
        const previewContainer = document.getElementById('image-preview-container');
        const previewImg = document.getElementById('image-preview');

        if (input.files && input.files[0]) {
            label.classList.add('bg-amber-100', 'border-amber-300', 'text-amber-600');
            label.classList.remove('text-gray-500', 'border-gray-200');
            
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            removeImage();
        }
    }

    function removeImage() {
        const input = document.getElementById('image-input');
        const label = input.nextElementSibling;
        const previewContainer = document.getElementById('image-preview-container');
        const previewImg = document.getElementById('image-preview');

        input.value = '';
        previewImg.src = '';
        previewContainer.classList.add('hidden');

        label.classList.remove('bg-amber-100', 'border-amber-300', 'text-amber-600');
        label.classList.add('text-gray-500', 'border-gray-200');
    }

    function formatTime(date) {
        let hours = date.getHours();
        let minutes = date.getMinutes();
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        return hours + ':' + minutes;
    }

    function appendMyMessage(text, id, imagePath) {
        const timeStr = formatTime(new Date());
        let imageHtml = '';
        if (imagePath) {
            imageHtml = `
                <div class="mb-2">
                    <img src="/storage/${imagePath}" class="rounded-xl max-w-full w-64 object-cover shadow-sm border border-black/5" alt="Uploaded Image">
                </div>
            `;
        }
        const textHtml = text ? `<p class="text-[13px] md:text-[14px] leading-relaxed break-words">${text}</p>` : '';
        const html = `
            <div class="flex justify-end w-full group message-item" data-id="${id}">
                <div class="max-w-[85%] md:max-w-[75%] bubble-right px-4 py-3 md:px-6 md:py-4 relative">
                    ${imageHtml}
                    ${textHtml}
                    <div class="flex justify-end items-center mt-2 gap-1 text-[10px] text-[#9a887a]">
                        <span>${timeStr}</span>
                    </div>
                </div>
            </div>
        `;
        messagesWrapper.insertAdjacentHTML('beforeend', html);
        scrollToBottom();
    }

    function appendOtherMessage(text, id, timestamp, imagePath) {
        const date = new Date(timestamp);
        const timeStr = formatTime(date);
        
        let avatarHtml = `<div class="w-full h-full bg-[#ead9ca] flex items-center justify-center text-[#7b5d4a] font-bold text-xs md:text-sm uppercase">{{ substr($otherUser->nama, 0, 1) }}</div>`;
        if(otherUserFoto) {
            avatarHtml = `<img src="${otherUserFoto}" class="w-full h-full object-cover">`;
        }

        let imageHtml = '';
        if (imagePath) {
            imageHtml = `
                <div class="mb-2">
                    <img src="/storage/${imagePath}" class="rounded-xl max-w-full w-64 object-cover shadow-sm border border-black/5" alt="Uploaded Image">
                </div>
            `;
        }
        const textHtml = text ? `<p class="text-[13px] md:text-[14px] leading-relaxed break-words">${text}</p>` : '';

        const html = `
            <div class="flex w-full group message-item" data-id="${id}">
                <div class="flex-shrink-0 mr-2 md:mr-3 mt-auto mb-1">
                    <div class="w-6 h-6 md:w-8 md:h-8 rounded-full overflow-hidden bg-gray-200">
                        ${avatarHtml}
                    </div>
                </div>
                <div class="max-w-[80%] md:max-w-[75%] bubble-left px-4 py-3 md:px-6 md:py-4 relative">
                    ${imageHtml}
                    ${textHtml}
                    <div class="flex justify-start items-center mt-2 text-[10px] text-gray-400">
                        <span>${timeStr}</span>
                    </div>
                </div>
            </div>
        `;
        messagesWrapper.insertAdjacentHTML('beforeend', html);
        scrollToBottom();
    }

    async function sendMessage() {
        const text = messageInput.value.trim();
        const imageInput = document.getElementById('image-input');
        const imageFile = imageInput.files[0];
        
        if (!text && !imageFile) return;

        const formData = new FormData();
        if (text) formData.append('body', text);
        if (imageFile) formData.append('image', imageFile);

        messageInput.disabled = true;
        btnSend.disabled = true;

        try {
            const response = await fetch(`/chat/${otherUserId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            });
            const data = await response.json();
            
            if (data.success) {
                messageInput.value = '';
                removeImage();
                appendMyMessage(data.message.body, data.message.id, data.message.image);
            } else if (data.errors) {
                let errorMsg = '';
                for (let key in data.errors) {
                    errorMsg += data.errors[key].join('\n') + '\n';
                }
                alert("Gagal mengirim pesan:\n" + errorMsg);
            } else if (data.message) {
                alert("Gagal: " + data.message);
            }
        } catch (error) {
            console.error('Error sending message:', error);
            alert("Gagal mengirim pesan. Silakan coba lagi.");
        } finally {
            messageInput.disabled = false;
            btnSend.disabled = false;
            messageInput.focus();
        }
    }

    btnSend.addEventListener('click', sendMessage);
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    async function pollMessages() {
        const messageItems = document.querySelectorAll('.message-item');
        let lastId = 0;
        if (messageItems.length > 0) {
            lastId = messageItems[messageItems.length - 1].getAttribute('data-id');
        }

        try {
            const response = await fetch(`/chat/${otherUserId}/messages?last_id=${lastId}`, {
                headers: {
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            
            if (data.messages && data.messages.length > 0) {
                let hasNewOtherMsg = false;
                data.messages.forEach(msg => {
                    if (msg.sender_id != currentUserId) {
                        appendOtherMessage(msg.body, msg.id, msg.created_at, msg.image);
                        hasNewOtherMsg = true;
                    }
                });
                if (hasNewOtherMsg) {
                    scrollToBottom();
                }
            }
        } catch (error) {
            console.error('Error polling messages:', error);
        }
    }

    setInterval(pollMessages, 3000);

</script>
@endsection