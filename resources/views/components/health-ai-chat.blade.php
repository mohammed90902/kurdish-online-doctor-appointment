<!-- Health AI Chat -->
<div x-data="{ 
    open: false, 
    messages: [], 
    input: '', 
    loading: false,
    addMessage(role, content) {
        this.messages.push({ role, content });
        this.$nextTick(() => {
            const chatArea = document.getElementById('chat-messages');
            if (chatArea) chatArea.scrollTop = chatArea.scrollHeight;
        });
    },
    async sendMessage() {
        if (!this.input.trim() || this.loading) return;
        const text = this.input.trim();
        this.addMessage('user', text);
        this.input = '';
        this.loading = true;

        try {
            const response = await fetch('{{ route('ai.chat') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: text })
            });

            const data = await response.json();
            
            if (data.success) {
                this.addMessage('assistant', data.reply);
            } else {
                this.addMessage('assistant', data.message || 'ببورە، هەڵەیەک ڕوویدا لە پەیوەندی کردن بە ژیری دەستکرد.');
            }
        } catch (error) {
            console.error('Chat Error:', error);
            this.addMessage('assistant', 'ببورە، کێشەیەک لە سێرڤەر هەیە. تکایە دڵنیابەرەوە لە هێڵی ئینتەرنێتەکەت.');
        } finally {
            this.loading = false;
        }
    },
    init() {
        if(this.messages.length === 0) {
            this.addMessage('assistant', '{{ __("AI Chat Greeting") }}');
        }
    }
}" dir="rtl">
    <!-- Chat Toggle Button -->
    <div class="fixed bottom-6 right-6 z-[10000] flex items-center gap-4 ltr:flex-row rtl:flex-row-reverse group">
        
        <!-- Tooltip -->
        <div class="bg-slate-900 text-white text-sm px-4 py-2 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity font-normal pointer-events-none shadow-lg text-center whitespace-nowrap">
            {{ __('Health AI Assistant Tooltip') }}
        </div>

        <button @click="open = !open" 
            class="w-16 h-16 bg-gradient-to-br from-blue-600 to-teal-500 rounded-full shadow-glow flex items-center justify-center text-white hover:scale-110 transition-transform duration-300 relative z-10">
            <svg x-show="!open" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
            <svg x-show="open" class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Chat Window -->
    <div x-show="open" 
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-10"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        class="fixed bottom-24 right-6 w-[calc(100vw-3rem)] sm:w-80 md:w-96 h-[500px] max-h-[calc(100vh-10rem)] bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col border border-gray-100 z-[10000]">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-teal-600 p-6 text-white shrink-0">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/30 shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg leading-tight">{{ __('AI Assistant') }}</h3>
                </div>
            </div>
        </div>

        <!-- Messages Area -->
        <div id="chat-messages" class="flex-1 overflow-y-auto p-6 space-y-4 bg-slate-50/50 leading-relaxed scroll-smooth text-right">
            <template x-for="(msg, index) in messages" :key="index">
                <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="msg.role === 'user' 
                        ? 'bg-blue-600 text-white rounded-2xl rounded-tr-none px-4 py-3 shadow-lg max-w-[85%]' 
                        : 'bg-white text-gray-800 rounded-2xl rounded-tl-none px-4 py-3 shadow-md border border-gray-100 max-w-[85%]'"
                        class="animate-scaleIn">
                        <p class="text-sm font-medium whitespace-pre-wrap" x-text="msg.content"></p>
                    </div>
                </div>
            </template>
            <div x-show="loading" class="flex justify-start">
                <div class="bg-white rounded-2xl p-3 shadow-md border border-gray-100 flex gap-1">
                    <div class="w-1.5 h-1.5 bg-blue-600 rounded-full animate-bounce"></div>
                    <div class="w-1.5 h-1.5 bg-blue-600 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    <div class="w-1.5 h-1.5 bg-blue-600 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-4 bg-white border-t border-gray-100 shrink-0">
            <div class="relative flex items-center bg-gray-50 rounded-2xl px-4 py-2 border border-gray-200 focus-within:border-blue-400 focus-within:ring-2 focus-within:ring-blue-100 transition-all">
                <textarea 
                    x-model="input" 
                    @keydown.enter.prevent="sendMessage()"
                    placeholder="{{ __('Describe symptoms prompt') }}" 
                    class="w-full bg-transparent border-none focus:ring-0 text-sm py-2 resize-none max-h-32 text-gray-700 text-right"
                    rows="1"></textarea>
                <button @click="sendMessage()" class="p-2 text-blue-600 hover:text-teal-600 transition-colors">
                    <svg class="w-6 h-6 transform" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                    </svg>
                </button>
            </div>
            <p class="text-[10px] text-gray-400 text-center mt-2 font-medium">{{ __('AI Disclaimer') }}</p>
        </div>
    </div>
</div>
