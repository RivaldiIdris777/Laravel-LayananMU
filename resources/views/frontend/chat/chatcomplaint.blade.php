@extends('layouts.app')

@section('title', 'Konsultasi Keluhan - LayananMU')

@section('styles')
<style>
    /* Custom scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Typing animation */
    .typing-indicator span {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #64748b;
        animation: typing 1.4s infinite;
    }

    .typing-indicator span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-indicator span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes typing {

        0%,
        60%,
        100% {
            transform: translateY(0);
        }

        30% {
            transform: translateY(-10px);
        }
    }

    /* Message animation */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message-animation {
        animation: slideIn 0.3s ease-out;
    }

    /* Pulse animation for online status */
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(34, 197, 94, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
        }
    }

    .pulse {
        animation: pulse 2s infinite;
    }

    /* Hover effects */
    .message-bubble {
        transition: all 0.2s ease;
    }

    .message-bubble:hover {
        transform: scale(1.02);
    }

    /* Gradient background */
    .gradient-bg {
        background: linear-gradient(135deg, rgba(239, 13, 13, 1) 0%, #810404ff 100%);
    }

    /* Glass effect */
    .glass {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }

</style>

@endsection

@section('content')
<div class="relative min-h-screen overflow-hidden">
    <!-- Animated Background -->
    <!-- Main Content -->
    <div class="relative z-10">
        <!-- Main Container -->
        <div class="flex h-full">
            <!-- Chat Area -->
            <div class="flex-1 flex flex-col">
                <!-- Header -->
                <header class="bg-white shadow-sm border-b border-slate-300">
                    <div class="px-4 lg:px-6 py-4 flex items-center justify-between">
                        <div class="flex items-center space-x-3 lg:space-x-4">
                            <button class="lg:hidden text-slate-600 hover:text-slate-800" onclick="toggleMobileSidebar()">
                                <i class="fas fa-bars text-xl"></i>
                            </button>
                            <div class="relative">
                                <img src="https://picsum.photos/seed/user2/50/50" alt="Contact"
                                    class="w-10 h-10 lg:w-12 lg:h-12 rounded-full">
                                <span
                                    class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border-2 border-white"></span>
                            </div>
                            <div>
                                <h1 class="text-lg lg:text-xl font-semibold text-slate-800">Customer Service</h1>
                                <p class="text-sm text-slate-500 flex items-center">
                                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>
                                    Online
                                </p>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Messages Area -->
                <div id="messagesContainer" class="flex-1 overflow-y-auto custom-scrollbar p-4 lg:p-6 bg-slate-50">
                    <!-- Date Separator -->
                    <div class="flex items-center justify-center my-4">
                        <span class="bg-gradient-to-r from-red-500 to-red-600 px-4 py-2 rounded-full text-sm shadow-sm">Hari ini</span>
                    </div>

                    <!-- Messages -->
                    <div id="messagesList" class="space-y-4">
                        <!-- Received Message -->
                        <div class="flex items-end space-x-2 message-animation">
                            <img src="https://picsum.photos/seed/user2/40/40" alt="Contact"
                                class="w-8 h-8 rounded-full">
                            <div class="max-w-xs lg:max-w-md">
                                <div class="bg-white rounded-2xl rounded-bl-none px-4 py-3 shadow-sm message-bubble">
                                    <p class="text-slate-800">Hai! Apa kabar? 😊</p>
                                </div>
                                <span class="text-xs text-slate-500 mt-1 ml-2 block">10:30</span>
                            </div>
                        </div>

                        <!-- Sent Message -->
                        <div class="flex items-end justify-end space-x-2 message-animation">
                            <div class="max-w-xs lg:max-w-md">
                                <div
                                    class="bg-gradient-to-r from-red-500 to-red-800 text-white rounded-2xl rounded-br-none px-4 py-3 shadow-md message-bubble">
                                    <p>Kabar baik! Kamu gimana?</p>
                                </div>
                                <span class="text-xs text-slate-500 mt-1 mr-2 block text-right">10:32 ✓✓</span>
                            </div>
                        </div>

                        <!-- Received Message with Image -->
                        <div class="flex items-end space-x-2 message-animation">
                            <img src="https://picsum.photos/seed/user2/40/40" alt="Contact"
                                class="w-8 h-8 rounded-full">
                            <div class="max-w-xs lg:max-w-md">
                                <div class="bg-white rounded-2xl rounded-bl-none p-2 shadow-sm message-bubble">
                                    <img src="https://picsum.photos/seed/chat1/300/200" alt="Shared Image"
                                        class="rounded-xl mb-2 cursor-pointer hover:opacity-90 transition">
                                    <p class="px-2 pb-1 text-slate-800">Lihat ini! Bagus kan?</p>
                                </div>
                                <span class="text-xs text-slate-500 mt-1 ml-2 block">10:35</span>
                            </div>
                        </div>

                        <!-- Sent Message -->
                        <div class="flex items-end justify-end space-x-2 message-animation">
                            <div class="max-w-xs lg:max-w-md">
                                <div
                                    class="bg-gradient-to-r from-red-500 to-red-800 text-white rounded-2xl rounded-br-none px-4 py-3 shadow-md message-bubble">
                                    <p>Wah, keren banget! 🎨</p>
                                </div>
                                <span class="text-xs text-slate-500 mt-1 mr-2 block text-right">10:36 ✓✓</span>
                            </div>
                        </div>

                        <!-- Typing Indicator -->
                        <div id="typingIndicator" class="flex items-end space-x-2 hidden">
                            <img src="https://picsum.photos/seed/user2/40/40" alt="Contact"
                                class="w-8 h-8 rounded-full">
                            <div class="bg-white rounded-2xl rounded-bl-none px-4 py-3 shadow-sm">
                                <div class="typing-indicator flex space-x-1">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="bg-white border-t border-slate-200 px-4 pt-4 pb-2">
                    <div class="flex items-end space-x-2">                        
                        <div class="flex-1 relative">
                            <textarea id="messageInput" placeholder="Ketik pesan..."
                                class="w-full px-4 py-3 rounded-2xl resize-none focus:outline-none focus:ring-2 focus:ring-purple-500 transition"
                                style="background-color: #e2e8f0 !important; color: #1e293b !important;"
                                rows="1" onkeypress="handleKeyPress(event)"
                                oninput="autoResize(this); handleTyping()"></textarea>                            
                        </div>
                        <button id="sendButton" onclick="sendMessage()"
                            class="p-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-full hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Sidebar (Hidden by default) -->
        <div id="mobileSidebar" class="fixed inset-0 z-50 hidden">
            <div class="absolute inset-0 bg-black bg-opacity-50" onclick="toggleMobileSidebar()"></div>
            <div
                class="absolute left-0 top-0 h-full w-80 bg-white shadow-xl transform transition-transform duration-300">
                <!-- Same content as desktop sidebar -->
                <div class="gradient-bg p-6 text-white">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold">Profil</h2>
                        <button onclick="toggleMobileSidebar()"
                            class="text-white hover:bg-white hover:bg-opacity-20 rounded-lg p-2">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="flex items-center space-x-4">
                        <img src="https://picsum.photos/seed/user1/100/100" alt="My Profile"
                            class="w-16 h-16 rounded-full border-3 border-white shadow-lg">
                        <div>
                            <h3 class="text-lg font-bold">Anda</h3>
                            <p class="text-sm opacity-90">Online</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="bg-slate-50 rounded-xl p-4">
                        <h3 class="font-semibold text-slate-800 mb-2">Info Chat</h3>
                        <div class="flex items-center space-x-3">
                            <img src="https://picsum.photos/seed/user2/50/50" alt="Contact"
                                class="w-12 h-12 rounded-full">
                            <div>
                                <p class="font-medium text-slate-800">Sarah Johnson</p>
                                <p class="text-sm text-slate-500">Aktif 2 menit yang lalu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
// ============================================================
//  DATA FROM SERVER
// ============================================================
const currentUserId      = {{ auth()->id() }};
const activeConvId       = {{ $conversation ? $conversation->id : 'null' }};
const csrfToken          = document.querySelector('meta[name="csrf-token"]') 
                           ? document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                           : '{{ csrf_token() }}';
const sendUrl            = '{{ route("chat-complaint.send") }}';

// ============================================================
//  RENDER INITIAL MESSAGES FROM SERVER
// ============================================================
document.addEventListener('DOMContentLoaded', () => {
    const list = document.getElementById('messagesList');

    @if ($conversation && $messages->count())
        // Hapus placeholder dummy dalam HTML
        list.innerHTML = '';

        @foreach ($messages as $msg)
        appendMessage({
            sender_id:  {{ $msg->sender_id }},
            body:       {{ Js::from($msg->body) }},
            created_at: {{ Js::from($msg->created_at->toISOString()) }},
            sender:     { name: {{ Js::from($msg->sender->name ?? 'CS') }} },
        });
        @endforeach

    @elseif (!$conversation)
        // Tidak ada CS terdaftar
        list.innerHTML = '';
        appendSystemMessage('Maaf, layanan customer service saat ini belum tersedia.');
    @else
        // Conversation ada tapi belum ada pesan
        list.innerHTML = '';
        appendSystemMessage('Belum ada pesan. Silakan mulai percakapan dengan Customer Service!');
    @endif

    scrollToBottom();
    document.getElementById('messageInput').focus();

    // Subscribe ke channel Reverb jika conversation ada
    if (activeConvId) {
        subscribeToChannel(activeConvId);
    }
});

// ============================================================
//  SUBSCRIBE REVERB CHANNEL
// ============================================================
function subscribeToChannel(conversationId) {
    if (typeof window.Echo === 'undefined') {
        console.warn('[Reverb] window.Echo tidak tersedia!');
        return;
    }

    window.Echo.private(`conversation.${conversationId}`)
        .listen('.message.sent', (event) => {
            console.log('[Reverb] Pesan diterima:', event);
            const msg = event.message;
            if (!msg) { console.error('[Reverb] Payload tidak memiliki key "message"', event); return; }
            // Hanya tampilkan pesan yang bukan dari diri sendiri
            if (msg.sender_id !== currentUserId) {
                appendMessage(msg);
                scrollToBottom();
            }
        })
        .subscribed(() => {
            console.log('[Reverb] Subscribe berhasil ke conversation.' + conversationId);
        })
        .error((err) => {
            console.error('[Reverb] Channel error:', err);
        });
}

// ============================================================
//  SEND MESSAGE
// ============================================================
function sendMessage() {
    if (!activeConvId) {
        alert('Layanan chat belum tersedia. Coba lagi nanti.');
        return;
    }

    const input   = document.getElementById('messageInput');
    const bodyTxt = input.value.trim();
    if (!bodyTxt) return;

    const btn = document.getElementById('sendButton');
    btn.disabled = true;

    // Optimistic UI — tampilkan bubble langsung
    appendMessage({
        sender_id:  currentUserId,
        body:       bodyTxt,
        created_at: new Date().toISOString(),
        sender:     { name: 'Saya' },
    });
    scrollToBottom();

    input.value = '';
    input.style.height = 'auto';

    // Kirim ke server via AJAX
    fetch(sendUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept':       'application/json',
        },
        body: JSON.stringify({
            conversation_id: activeConvId,
            body:            bodyTxt,
        }),
    })
    .then(r => r.json())
    .then(() => { btn.disabled = false; })
    .catch(err => {
        console.error('Gagal mengirim pesan:', err);
        btn.disabled = false;
        appendSystemMessage('Pesan gagal terkirim. Coba lagi.');
    });
}

// ============================================================
//  APPEND MESSAGE BUBBLE
// ============================================================
function appendMessage(msg) {
    const list       = document.getElementById('messagesList');
    const isSent     = msg.sender_id === currentUserId;
    const time       = formatTime(msg.created_at);
    const senderName = msg.sender ? msg.sender.name : 'CS';

    const div = document.createElement('div');

    if (isSent) {
        div.className = 'flex items-end justify-end space-x-2 message-animation';
        div.innerHTML = `
            <div class="max-w-xs lg:max-w-md">
                <div class="bg-gradient-to-r from-red-500 to-red-800 text-white rounded-2xl rounded-br-none px-4 py-3 shadow-md message-bubble">
                    <p>${escapeHtml(msg.body)}</p>
                </div>
                <span class="text-xs text-slate-500 mt-1 mr-2 block text-right">${time} ✓✓</span>
            </div>`;
    } else {
        const avatarUrl = `https://ui-avatars.com/api/?name=${encodeURIComponent(senderName)}&background=ef4444&color=fff`;
        div.className = 'flex items-end space-x-2 message-animation';
        div.innerHTML = `
            <img src="${avatarUrl}" alt="${escapeHtml(senderName)}" class="w-8 h-8 rounded-full">
            <div class="max-w-xs lg:max-w-md">
                <div class="bg-white rounded-2xl rounded-bl-none px-4 py-3 shadow-sm message-bubble">
                    <p class="text-slate-800">${escapeHtml(msg.body)}</p>
                </div>
                <span class="text-xs text-slate-500 mt-1 ml-2 block">${time}</span>
            </div>`;
    }

    list.appendChild(div);
}

// ============================================================
//  HELPERS
// ============================================================
function appendSystemMessage(text) {
    const list = document.getElementById('messagesList');
    const div  = document.createElement('div');
    div.className = 'flex justify-center my-4';
    div.innerHTML = `<span class="bg-gradient-to-r from-red-500 to-red-600 px-4 py-2 rounded-full text-sm text-black shadow-sm">${escapeHtml(text)}</span>`;
    list.appendChild(div);
}

function formatTime(isoString) {
    if (!isoString) return '';
    return new Date(isoString).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
}

function autoResize(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = Math.min(textarea.scrollHeight, 120) + 'px';
}

function handleKeyPress(event) {
    if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault();
        sendMessage();
    }
}

// Keep handleTyping so the existing oninput binding doesn't break
function handleTyping() {}

function escapeHtml(text) {
    const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
    return String(text).replace(/[&<>"']/g, m => map[m]);
}

function scrollToBottom() {
    const container = document.getElementById('messagesContainer');
    if (container) setTimeout(() => { container.scrollTop = container.scrollHeight; }, 50);
}

function toggleMobileSidebar() {
    document.getElementById('mobileSidebar').classList.toggle('hidden');
}

window.addEventListener('resize', () => {
    if (window.innerWidth >= 1024) {
        document.getElementById('mobileSidebar').classList.add('hidden');
    }
});
</script>
@endsection

