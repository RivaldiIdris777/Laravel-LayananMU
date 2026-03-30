<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Chat - Customer Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .typing-indicator span {
            display: inline-block; width: 8px; height: 8px;
            border-radius: 50%; background-color: #64748b;
            animation: typing 1.4s infinite;
        }
        .typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
        .typing-indicator span:nth-child(3) { animation-delay: 0.4s; }

        @keyframes typing {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-10px); }
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .message-animation { animation: slideIn 0.3s ease-out; }

        @keyframes pulse {
            0%   { box-shadow: 0 0 0 0 rgba(34,197,94,0.7); }
            70%  { box-shadow: 0 0 0 10px rgba(34,197,94,0); }
            100% { box-shadow: 0 0 0 0 rgba(34,197,94,0); }
        }

        .pulse { animation: pulse 2s infinite; }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }

        .client-item { transition: all 0.2s ease; cursor: pointer; }
        .client-item:hover { background: #e2e8f0; }
        .client-item.active { background: #e0e7ff; border-left: 3px solid #6366f1; }

        #chatPlaceholder { display: flex; }
        #chatContent { display: none; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 h-screen overflow-hidden">
<div class="flex h-full">

    {{-- ========== SIDEBAR DESKTOP ========== --}}
    <div class="hidden lg:flex lg:w-80 bg-white shadow-xl flex-col">

        {{-- Admin profile header --}}
        <div class="gradient-bg p-5 text-white flex-shrink-0">
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=ffffff&color=6366f1"
                         alt="Admin" class="w-12 h-12 rounded-full border-2 border-white shadow">
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border-2 border-white pulse"></span>
                </div>
                <div>
                    <p class="font-bold text-sm">{{ auth()->user()->name }}</p>
                    <p class="text-xs opacity-80">Customer Service · Online</p>
                </div>
            </div>
            <div class="mt-4 relative">
                <input id="searchInput" type="text" placeholder="Cari client..."
                       class="w-full bg-white bg-opacity-20 text-white placeholder-white placeholder-opacity-70 rounded-xl px-4 py-2 text-sm focus:outline-none focus:bg-opacity-30"
                       oninput="filterClients(this.value)">
                <i class="fas fa-search absolute right-3 top-2.5 text-white opacity-70 text-sm"></i>
            </div>
        </div>

        {{-- Client list --}}
        <div class="flex-1 overflow-y-auto custom-scrollbar">
            <p class="text-xs font-semibold text-slate-400 uppercase px-4 pt-4 pb-2 tracking-wider">
                Daftar Client ({{ count($clients) }})
            </p>
            <div id="clientList">
                @forelse ($clients as $client)
                    <div class="client-item px-4 py-3 flex items-center space-x-3"
                         id="client-{{ $client->id }}"
                         data-name="{{ $client->name }}"
                         onclick="selectClient({{ $client->id }}, '{{ addslashes($client->name) }}', '{{ $client->email }}')">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($client->name) }}&background=6366f1&color=fff"
                             alt="{{ $client->name }}" class="w-10 h-10 rounded-full flex-shrink-0">
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-slate-800 text-sm truncate">{{ $client->name }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ $client->email }}</p>
                        </div>
                        <span class="unread-badge-{{ $client->id }} hidden bg-indigo-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center"></span>
                    </div>
                @empty
                    <div class="px-4 py-8 text-center text-slate-400 text-sm">
                        <i class="fas fa-users text-3xl mb-2 block opacity-40"></i>
                        Belum ada user client
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- ========== MAIN CHAT AREA ========== --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- Header --}}
        <header class="bg-white shadow-sm border-b border-slate-200 flex-shrink-0">
            <div class="px-4 lg:px-6 py-3 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <button class="lg:hidden text-slate-600 hover:text-slate-800" onclick="toggleMobileSidebar()">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div id="headerAvatar" class="relative hidden">
                        <img id="headerImg" src="" alt="" class="w-10 h-10 rounded-full">
                        <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-400 rounded-full border-2 border-white"></span>
                    </div>
                    <div>
                        <h1 id="headerName" class="text-base font-semibold text-slate-800">Customer Service</h1>
                        <p id="headerStatus" class="text-xs text-slate-500">Pilih client untuk mulai chat</p>
                    </div>
                </div>                
            </div>
        </header>

        {{-- PLACEHOLDER (belum pilih client) --}}
        <div id="chatPlaceholder" class="flex-1 flex-col items-center justify-center text-center p-8 bg-slate-50">
            <div class="gradient-bg w-20 h-20 rounded-full flex items-center justify-center mb-4 mx-auto opacity-80">
                <i class="fas fa-comments text-white text-3xl"></i>
            </div>
            <h2 class="text-xl font-semibold text-slate-700 mb-2">Selamat Datang, CS!</h2>
            <p class="text-slate-500 text-sm max-w-xs">Pilih salah satu client di sidebar kiri untuk melihat atau memulai percakapan.</p>
        </div>

        {{-- CHAT CONTENT (setelah pilih client) --}}
        <div id="chatContent" class="flex-1 flex flex-col min-h-0">
            {{-- Messages --}}
            <div id="messagesContainer" class="flex-1 overflow-y-auto custom-scrollbar p-4 lg:p-6 bg-slate-50">
                <div id="messagesList" class="space-y-4">
                    {{-- Pesan akan diisi via JS --}}
                </div>
                <div id="typingIndicator" class="hidden flex items-end space-x-2 mt-4">
                    <img id="typingAvatar" src="" alt="" class="w-8 h-8 rounded-full">
                    <div class="bg-white rounded-2xl rounded-bl-none px-4 py-3 shadow-sm">
                        <div class="typing-indicator flex space-x-1">
                            <span></span><span></span><span></span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Input --}}
            <div class="bg-white border-t border-slate-200 px-4 lg:px-6 py-3 flex-shrink-0">
                <div class="flex items-end space-x-2">
                    <div class="flex-1 relative">
                        <textarea id="messageInput" placeholder="Ketik pesan kepada client..."
                                  class="w-full px-4 py-3 bg-slate-100 text-slate-800 rounded-2xl resize-none focus:outline-none focus:ring-2 focus:ring-indigo-400 transition text-sm"
                                  rows="1"
                                  onkeypress="handleKeyPress(event)"
                                  oninput="autoResize(this)"></textarea>
                    </div>
                    <button id="sendButton" onclick="sendMessage()"
                            class="p-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-full hover:shadow-lg transform hover:scale-105 transition-all duration-200 disabled:opacity-50"
                            title="Kirim pesan">
                        <i class="fas fa-paper-plane text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ========== MOBILE SIDEBAR ========== --}}
<div id="mobileSidebar" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black bg-opacity-50" onclick="toggleMobileSidebar()"></div>
    <div class="absolute left-0 top-0 h-full w-72 bg-white shadow-xl flex flex-col">
        <div class="gradient-bg p-5 text-white flex-shrink-0">
            <div class="flex items-center justify-between mb-3">
                <h2 class="font-bold">Daftar Client</h2>
                <button onclick="toggleMobileSidebar()" class="text-white hover:bg-white hover:bg-opacity-20 rounded-lg p-1.5">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <p class="text-xs opacity-80">{{ count($clients) }} client terdaftar</p>
        </div>
        <div class="flex-1 overflow-y-auto custom-scrollbar">
            @forelse ($clients as $client)
                <div class="client-item px-4 py-3 flex items-center space-x-3"
                     onclick="selectClient({{ $client->id }}, '{{ addslashes($client->name) }}', '{{ $client->email }}'); toggleMobileSidebar();">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($client->name) }}&background=6366f1&color=fff"
                         alt="{{ $client->name }}" class="w-10 h-10 rounded-full flex-shrink-0">
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-slate-800 text-sm truncate">{{ $client->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ $client->email }}</p>
                    </div>
                </div>
            @empty
                <div class="px-4 py-8 text-center text-slate-400 text-sm">Belum ada client</div>
            @endforelse
        </div>
    </div>
</div>

<script>
// ============================================================
//  STATE
// ============================================================
let activeConversationId = null;
let activeClientName     = '';
let activeClientId       = null;
let echoChannel          = null;  // Reverb channel saat ini
const adminId            = {{ auth()->id() }};
const csrfToken          = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// ============================================================
//  SELECT CLIENT → get/create conversation → load messages
// ============================================================
function selectClient(clientId, clientName, clientEmail) {
    activeClientId   = clientId;
    activeClientName = clientName;

    // Update UI header
    const avatarUrl = `https://ui-avatars.com/api/?name=${encodeURIComponent(clientName)}&background=6366f1&color=fff`;
    document.getElementById('headerImg').src = avatarUrl;
    document.getElementById('headerImg').alt = clientName;
    document.getElementById('headerAvatar').classList.remove('hidden');
    document.getElementById('headerName').textContent   = clientName;
    document.getElementById('headerStatus').textContent = clientEmail;

    // Tandai client aktif di sidebar
    document.querySelectorAll('.client-item').forEach(el => el.classList.remove('active'));
    const activeEl = document.getElementById(`client-${clientId}`);
    if (activeEl) activeEl.classList.add('active');

    // Tampilkan area chat
    document.getElementById('chatPlaceholder').style.display = 'none';
    document.getElementById('chatContent').style.display     = 'flex';

    // Kosongkan pesan lama
    document.getElementById('messagesList').innerHTML = '';
    showLoadingSpinner();

    // Minta / buat conversation
    fetch(`{{ url('/admin2/chat-complain/conversation') }}/${clientId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
        },
    })
    .then(r => r.json())
    .then(data => {
        activeConversationId = data.conversation_id;
        loadMessages(activeConversationId);
        subscribeToChannel(activeConversationId, avatarUrl);
    })
    .catch(err => {
        console.error('Gagal membuat/mengambil conversation:', err);
        hideLoadingSpinner();
        appendSystemMessage('Gagal menghubungkan; coba lagi.');
    });
}

// ============================================================
//  LOAD MESSAGES
// ============================================================
function loadMessages(conversationId) {
    fetch(`{{ url('/admin2/chat-complain') }}/${conversationId}/messages`, {
        headers: { 'Accept': 'application/json' },
    })
    .then(r => r.json())
    .then(data => {
        hideLoadingSpinner();
        const msgs = data.messages || [];
        if (msgs.length === 0) {
            appendSystemMessage('Belum ada pesan. Mulai percakapan!');
        } else {
            msgs.forEach(msg => appendMessage(msg));
        }
        scrollToBottom();
    })
    .catch(err => {
        console.error('Gagal memuat pesan:', err);
        hideLoadingSpinner();
        appendSystemMessage('Gagal memuat pesan.');
    });
}

// ============================================================
//  SEND MESSAGE
// ============================================================
function sendMessage() {
    const input = document.getElementById('messageInput');
    const body  = input.value.trim();
    if (!body || !activeConversationId) return;

    // Optimistic UI — tampilkan bubble langsung tanpa tunggu server
    const optimMsg = {
        sender_id:  adminId,
        body:       body,
        created_at: new Date().toISOString(),
        sender:     { name: 'Anda' },
    };
    appendMessage(optimMsg);
    scrollToBottom();

    input.value = '';
    autoResize(input);

    fetch(`{{ url('/admin2/chat-complain/send') }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
        },
        body: JSON.stringify({ conversation_id: activeConversationId, body }),
    })
    .then(r => r.json())
    .catch(err => {
        console.error('Gagal mengirim pesan:', err);
        input.value = body;
    });
}

// ============================================================
//  SUBSCRIBE REVERB / ECHO CHANNEL
// ============================================================
function subscribeToChannel(conversationId, clientAvatarUrl) {
    // Hentikan channel lama jika ada
    if (echoChannel) {
        window.Echo.leave(`conversation.${echoChannel}`);
    }
    echoChannel = conversationId;

    if (typeof window.Echo === 'undefined') {
        document.getElementById('reverbStatus').innerHTML =
            '<i class="fas fa-circle text-xs mr-1 text-red-400"></i>Reverb N/A';
        console.warn('[Reverb] window.Echo tidak tersedia!');
        return;
    }

    window.Echo.private(`conversation.${conversationId}`)
        .listen('.message.sent', (e) => {
            console.log('[Reverb Admin] Pesan diterima:', e);
            const msg = e.message;
            if (!msg) { console.error('[Reverb Admin] Payload tidak ada key "message"', e); return; }
            // Hanya tampilkan pesan dari client (bukan dari admin itu sendiri)
            if (msg.sender_id !== adminId) {
                appendMessage(msg);
                scrollToBottom();
            }
        })
        .subscribed(() => {
            console.log('[Reverb Admin] Subscribe berhasil ke conversation.' + conversationId);
            document.getElementById('reverbStatus').innerHTML =
                '<i class="fas fa-circle text-xs mr-1 text-green-400"></i>Connected';
        })
        .error((err) => {
            console.error('[Reverb Admin] Channel error:', err);
            document.getElementById('reverbStatus').innerHTML =
                '<i class="fas fa-circle text-xs mr-1 text-red-400"></i>Error';
        });
}

// ============================================================
//  HELPERS
// ============================================================
function appendMessage(msg) {
    const list      = document.getElementById('messagesList');
    const isAdmin   = msg.sender_id === adminId;
    const senderName = msg.sender ? msg.sender.name : (isAdmin ? 'Anda' : activeClientName);
    const time      = new Date(msg.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

    const wrapper = document.createElement('div');
    wrapper.className = `flex ${isAdmin ? 'justify-end' : 'justify-start'} message-animation`;

    if (isAdmin) {
        wrapper.innerHTML = `
            <div class="max-w-xs lg:max-w-md">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-2xl rounded-br-none px-4 py-3 shadow-sm">
                    <p class="text-sm">${escapeHtml(msg.body)}</p>
                </div>
                <p class="text-xs text-slate-400 text-right mt-1">${time}</p>
            </div>`;
    } else {
        const avatarUrl = `https://ui-avatars.com/api/?name=${encodeURIComponent(senderName)}&background=6366f1&color=fff`;
        wrapper.innerHTML = `
            <div class="flex items-end space-x-2 max-w-xs lg:max-w-md">
                <img src="${avatarUrl}" class="w-8 h-8 rounded-full flex-shrink-0" alt="${escapeHtml(senderName)}">
                <div>
                    <p class="text-xs text-slate-500 mb-1">${escapeHtml(senderName)}</p>
                    <div class="bg-white rounded-2xl rounded-bl-none px-4 py-3 shadow-sm">
                        <p class="text-slate-800 text-sm">${escapeHtml(msg.body)}</p>
                    </div>
                    <p class="text-xs text-slate-400 mt-1">${time}</p>
                </div>
            </div>`;
    }

    list.appendChild(wrapper);
}

function appendSystemMessage(text) {
    const list = document.getElementById('messagesList');
    const div  = document.createElement('div');
    div.className = 'text-center text-slate-400 text-xs py-4';
    div.textContent = text;
    list.appendChild(div);
}

function showLoadingSpinner() {
    const list = document.getElementById('messagesList');
    list.innerHTML = `
        <div id="loadingSpinner" class="flex justify-center py-8">
            <div class="w-8 h-8 border-4 border-indigo-200 border-t-indigo-500 rounded-full animate-spin"></div>
        </div>`;
}

function hideLoadingSpinner() {
    const el = document.getElementById('loadingSpinner');
    if (el) el.parentElement.innerHTML = '';
}

function scrollToBottom() {
    const container = document.getElementById('messagesContainer');
    container.scrollTop = container.scrollHeight;
}

function escapeHtml(text) {
    return String(text)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function filterClients(query) {
    const q = query.toLowerCase();
    document.querySelectorAll('#clientList .client-item').forEach(item => {
        const name = (item.dataset.name || '').toLowerCase();
        item.style.display = name.includes(q) ? '' : 'none';
    });
}

function handleKeyPress(event) {
    if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault();
        sendMessage();
    }
}

function autoResize(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = Math.min(textarea.scrollHeight, 120) + 'px';
}

function toggleMobileSidebar() {
    const sidebar = document.getElementById('mobileSidebar');
    sidebar.classList.toggle('hidden');
}
</script>

</body>
</html>
