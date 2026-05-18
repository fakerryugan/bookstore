<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ryuu Book</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@300,0..1&display=swap" rel="stylesheet" />
</head>
<body class="font-sans text-slate-800 bg-slate-50 antialiased selection:bg-primary-500 selection:text-white">
    
    @include('partials.customer.navbar')

    @yield('content')

    @include('partials.customer.footer')

    <script>
        const navbar = document.getElementById('navbar');
        window.onscroll = () => {
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-md');
            } else {
                navbar.classList.remove('shadow-md');
            }
        };
    </script>
    @stack('scripts')
    <!-- Live Real-Time Chat Widget with Laravel Reverb -->
    <div x-data="customerChat()" x-init="initChat()" class="fixed bottom-5 right-5 z-50">
        <!-- Chat Toggle Button -->
        <button @click="toggleChat()" 
                class="w-14 h-14 bg-blue-600 text-white rounded-full shadow-lg flex items-center justify-center hover:bg-blue-700 transition-all active:scale-95 relative">
            <span class="material-symbols-outlined transition-transform duration-200" :class="open ? 'rotate-90' : ''" x-text="open ? 'close' : 'chat'"></span>
            <!-- Notification badge -->
            <span x-show="unreadCount > 0 && !open" x-text="unreadCount" class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center animate-bounce"></span>
        </button>

        <!-- Chat Window -->
        <div x-show="open" 
             x-transition
             class="absolute bottom-16 right-0 w-80 sm:w-[350px] bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden flex flex-col" 
             style="display: none;">
            
            <!-- Header -->
            <div class="bg-blue-600 p-4 text-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-700 flex items-center justify-center">
                        <span class="material-symbols-outlined">support_agent</span>
                    </div>
                    <div>
                        <h4 class="font-semibold text-sm">Customer Service</h4>
                        <div class="flex items-center gap-1 text-xs text-blue-200">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            Online (Real-time)
                        </div>
                    </div>
                </div>
            </div>

            <!-- Messages Body -->
            <div x-ref="messageContainer" class="h-72 overflow-y-auto p-4 bg-gray-50 space-y-3">
                

                <template x-if="authCheck && messages.length === 0">
                    <div class="text-center py-8 text-gray-400 text-xs">
                        <span class="material-symbols-outlined text-3xl mb-1">chat_bubble_outline</span>
                        <p>Belum ada obrolan. Tulis pesan di bawah untuk memulai!</p>
                    </div>
                </template>

                <template x-if="authCheck">
                    <div class="space-y-3">
                        <template x-for="msg in messages" :key="msg.id">
                            <div class="flex flex-col gap-1 max-w-[85%]" :class="msg.sender_id === authUserId ? 'ml-auto items-end' : 'mr-auto items-start'">
                                <div class="p-3 rounded-xl shadow-sm text-sm border" 
                                     :class="msg.sender_id === authUserId ? 'bg-blue-600 text-white border-blue-700 rounded-tr-none' : 'bg-white text-gray-800 border-gray-100 rounded-tl-none'">
                                    <span x-text="msg.message"></span>
                                </div>
                                <span class="text-[9px] text-gray-400 px-1" x-text="new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})"></span>
                            </div>
                        </template>
                    </div>
                </template>
            </div>

            <!-- Input Footer -->
            <template x-if="authCheck">
                <form @submit.prevent="sendMessage()" class="p-3 bg-white border-t border-gray-100">
                    <div class="flex items-center gap-2">
                        <input type="text" 
                               x-model="newMessage"
                               placeholder="Ketik pesan..." 
                               class="flex-grow bg-gray-50 rounded-xl px-3 py-2 text-sm border border-gray-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
                        
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-xl flex items-center justify-center transition-transform active:scale-95">
                            <span class="material-symbols-outlined text-sm">send</span>
                        </button>
                    </div>
                </form>
            </template>
        </div>
    </div>

    <script>
        function customerChat() {
            return {
                open: false,
                messages: [],
                newMessage: '',
                authCheck: {{ auth()->check() ? 'true' : 'false' }},
                authUserId: {{ auth()->check() ? auth()->id() : 'null' }},
                unreadCount: 0,
                initChat() {
                    if (this.authCheck) {
                        this.fetchMessages();

                        // Robust Echo registration that handles Vite load race conditions
                        const registerEcho = () => {
                            if (window.Echo) {
                                window.Echo.private('chat.' + this.authUserId)
                                    .listen('MessageSent', (e) => {
                                        if (e.message.sender_id === this.authUserId) {
                                            return;
                                        }
                                        this.messages.push(e.message);
                                        if (!this.open) {
                                            this.unreadCount++;
                                        }
                                        this.scrollToBottom();
                                    });
                                return true;
                            }
                            return false;
                        };

                        if (!registerEcho()) {
                            const interval = setInterval(() => {
                                if (registerEcho()) {
                                    clearInterval(interval);
                                }
                            }, 100);
                            setTimeout(() => clearInterval(interval), 5000);
                        }
                    }
                },
                fetchMessages() {
                    fetch('{{ route('chat.messages') }}')
                        .then(res => res.json())
                        .then(data => {
                            this.messages = data;
                            this.scrollToBottom();
                        });
                },
                sendMessage() {
                    if (!this.newMessage.trim()) return;

                    const text = this.newMessage;
                    this.newMessage = '';

                    fetch('{{ route('chat.send') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ message: text })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            this.messages.push(data.message);
                            this.scrollToBottom();
                        }
                    });
                },
                toggleChat() {
                    this.open = !this.open;
                    if (this.open) {
                        this.unreadCount = 0;
                        this.scrollToBottom();
                    }
                },
                scrollToBottom() {
                    this.$nextTick(() => {
                        const container = this.$refs.messageContainer;
                        if (container) {
                            container.scrollTop = container.scrollHeight;
                        }
                    });
                }
            }
        }
    </script>
</body>
</html>
