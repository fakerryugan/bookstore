@extends('layouts.admin')

@section('content')
<div class="h-[calc(100vh-140px)] flex rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900 overflow-hidden" x-data="adminChat()" x-init="initAdmin()">
    <!-- Left Sidebar: Customer List -->
    <div class="w-80 md:w-96 border-r border-gray-200 dark:border-gray-800 flex flex-col h-full bg-gray-50/50 dark:bg-gray-900">
        <div class="p-4 border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-brand-500">chat</span>
                Obrolan Pelanggan
            </h2>
            <div class="relative mt-3">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">search</span>
                <input type="text" x-model="searchQuery" placeholder="Cari pelanggan..." class="w-full pl-9 pr-4 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:bg-gray-800 dark:border-gray-800 dark:text-white transition-all">
            </div>
        </div>

        <div class="flex-grow overflow-y-auto p-2 space-y-1 no-scrollbar">
            <template x-if="filteredUsers().length === 0">
                <div class="text-center py-12 text-gray-400 text-sm">
                    <span class="material-symbols-outlined text-4xl mb-2">contacts</span>
                    <p>Tidak ada percakapan aktif</p>
                </div>
            </template>

            <template x-for="usr in filteredUsers()" :key="usr.id">
                <div @click="selectUser(usr)" 
                     class="flex items-center gap-3 p-3 rounded-xl cursor-pointer transition-all"
                     :class="activeUser && activeUser.id === usr.id ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/20' : 'hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300'">
                    
                    <img :src="usr.photo ? '/storage/' + usr.photo : 'https://ui-avatars.com/api/?name=' + encodeURIComponent(usr.name)" 
                         alt="Avatar" 
                         class="w-11 h-11 rounded-full object-cover border-2"
                         :class="activeUser && activeUser.id === usr.id ? 'border-white/30' : 'border-gray-200 dark:border-gray-700'">
                    
                    <div class="flex-grow min-w-0">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-sm truncate" :class="activeUser && activeUser.id === usr.id ? 'text-white' : 'text-gray-900 dark:text-white'" x-text="usr.name"></span>
                        </div>
                        <span class="text-xs truncate block" :class="activeUser && activeUser.id === usr.id ? 'text-brand-100' : 'text-gray-500'" x-text="usr.email"></span>
                    </div>

                    <!-- Live Unread indicator -->
                    <span x-show="usr.unread_count > 0" x-text="usr.unread_count" class="bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full"></span>
                </div>
            </template>
        </div>
    </div>

    <!-- Right Content: Conversational Window -->
    <div class="flex-grow flex flex-col h-full bg-white dark:bg-gray-900">
        <!-- Selected User Header -->
        <template x-if="activeUser">
            <div class="p-4 border-b border-gray-200 dark:border-gray-800 flex items-center justify-between bg-white dark:bg-gray-900">
                <div class="flex items-center gap-3">
                    <img :src="activeUser.photo ? '/storage/' + activeUser.photo : 'https://ui-avatars.com/api/?name=' + encodeURIComponent(activeUser.name)" alt="Avatar" class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <h3 class="font-bold text-sm text-gray-900 dark:text-white" x-text="activeUser.name"></h3>
                        <span class="text-xs text-green-500 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                            Terhubung (Real-time)
                        </span>
                    </div>
                </div>
            </div>
        </template>

        <!-- Messages Area -->
        <div x-ref="messageBox" class="flex-grow overflow-y-auto p-6 bg-gray-50/50 dark:bg-gray-900/50 space-y-4">
            <template x-if="!activeUser">
                <div class="h-full flex flex-col items-center justify-center text-gray-400 dark:text-gray-600">
                    <span class="material-symbols-outlined text-6xl mb-3 animate-bounce">chat_bubble</span>
                    <h3 class="font-bold text-lg text-gray-800 dark:text-gray-300">Pilih Percakapan</h3>
                    <p class="text-sm">Klik salah satu pelanggan di sisi kiri untuk memulai dukungan langsung.</p>
                </div>
            </template>

            <template x-if="activeUser && messages.length === 0">
                <div class="h-full flex flex-col items-center justify-center text-gray-400">
                    <span class="material-symbols-outlined text-5xl mb-2">chat_bubble_outline</span>
                    <p class="text-sm">Belum ada obrolan dengan pelanggan ini.</p>
                </div>
            </template>

            <template x-if="activeUser">
                <div class="space-y-4">
                    <template x-for="msg in messages" :key="msg.id">
                        <div class="flex flex-col gap-1 max-w-[70%]" :class="msg.sender_id === adminId ? 'ml-auto items-end' : 'mr-auto items-start'">
                            <div class="p-3 rounded-2xl shadow-sm text-sm border" 
                                 :class="msg.sender_id === adminId ? 'bg-brand-500 text-white border-brand-600 rounded-tr-none' : 'bg-white text-gray-800 border-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:text-white rounded-tl-none'">
                                <span x-text="msg.message"></span>
                            </div>
                            <span class="text-[9px] text-gray-400 px-1" x-text="new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})"></span>
                        </div>
                    </template>
                </div>
            </template>
        </div>

        <!-- Message input bar -->
        <template x-if="activeUser">
            <form @submit.prevent="sendMessage()" class="p-4 border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
                <div class="flex items-center gap-3">
                    <input type="text" 
                           x-model="newMessage"
                           placeholder="Ketik balasan untuk pelanggan..." 
                           class="flex-grow bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:bg-gray-800 dark:border-gray-800 dark:text-white transition-all">
                    
                    <button type="submit" class="bg-brand-500 hover:bg-brand-600 text-white px-5 py-3 rounded-xl font-bold flex items-center justify-center gap-2 transition-transform active:scale-95 shadow-lg shadow-brand-500/20">
                        <span>Kirim</span>
                        <span class="material-symbols-outlined text-sm">send</span>
                    </button>
                </div>
            </form>
        </template>
    </div>
</div>

<script>
    function adminChat() {
        return {
            users: [],
            messages: [],
            newMessage: '',
            searchQuery: '',
            activeUser: null,
            adminId: {{ auth()->id() }},
            initAdmin() {
                this.fetchUsers();
            },
            fetchUsers() {
                fetch('{{ route('admin.chat.users') }}')
                    .then(res => res.json())
                    .then(data => {
                        this.users = data.map(u => ({ ...u, unread_count: 0 }));
                        this.subscribeToAllChannels();
                    });
            },
            subscribeToAllChannels() {
                const listenToChannel = (userId) => {
                    if (window.Echo) {
                        window.Echo.private('chat.' + userId)
                            .listen('MessageSent', (e) => {
                                if (e.message.sender_id === this.adminId) {
                                    return;
                                }
                                if (this.activeUser && this.activeUser.id === userId) {
                                    this.messages.push(e.message);
                                    this.scrollToBottom();
                                } else {
                                    const targetUser = this.users.find(u => u.id === userId);
                                    if (targetUser) {
                                        targetUser.unread_count++;
                                    }
                                }
                            });
                    }
                };

                const setupSubscriptions = () => {
                    if (window.Echo) {
                        this.users.forEach(u => {
                            listenToChannel(u.id);
                        });
                        return true;
                    }
                    return false;
                };

                if (!setupSubscriptions()) {
                    const interval = setInterval(() => {
                        if (setupSubscriptions()) {
                            clearInterval(interval);
                        }
                    }, 100);
                    setTimeout(() => clearInterval(interval), 5000);
                }
            },
            filteredUsers() {
                if (!this.searchQuery) return this.users;
                return this.users.filter(u => u.name.toLowerCase().includes(this.searchQuery.toLowerCase()) || u.email.toLowerCase().includes(this.searchQuery.toLowerCase()));
            },
            selectUser(user) {
                this.activeUser = user;
                user.unread_count = 0;
                this.fetchMessages(user.id);
            },
            fetchMessages(customerId) {
                fetch(`/admin/chat/messages/${customerId}`)
                    .then(res => res.json())
                    .then(data => {
                        this.messages = data;
                        this.scrollToBottom();
                    });
            },
            sendMessage() {
                if (!this.newMessage.trim() || !this.activeUser) return;

                const text = this.newMessage;
                this.newMessage = '';

                fetch(`/admin/chat/send/${this.activeUser.id}`, {
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
            scrollToBottom() {
                this.$nextTick(() => {
                    const container = this.$refs.messageBox;
                    if (container) {
                        container.scrollTop = container.scrollHeight;
                    }
                });
            }
        }
    }
</script>
@endsection
