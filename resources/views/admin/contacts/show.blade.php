
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            وردەکاری پەیام
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="glass-card bg-green-100/80 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl mb-6 flex items-center shadow-lg animate-slideDown">
                    <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6">
                <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 font-bold transition-colors">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                    گەڕانەوە بۆ لیستی پەیامەکان
                </a>
            </div>

            <!-- Contact Message -->
            <div class="glass-card overflow-hidden shadow-xl rounded-2xl animate-fade-in-up">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="p-2 bg-purple-100 text-purple-600 rounded-lg ml-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </span>
                        <h3 class="text-xl font-bold text-gray-800">زانیاری پەیام</h3>
                    </div>
                    <div>
                        @if($contact->status == 'new')
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-lg text-sm font-bold shadow-sm animate-pulse">نوێ</span>
                        @elseif($contact->status == 'read')
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-lg text-sm font-bold shadow-sm">خوێنراوە</span>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-lg text-sm font-bold shadow-sm">وەڵامدراوە</span>
                        @endif
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">ناوی ناردەر</p>
                                <p class="text-lg font-bold text-gray-900 mt-1">{{ $contact->name }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">ئیمەیڵ</p>
                                <p class="text-lg font-mono text-gray-700 mt-1">{{ $contact->email }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">بابەت</p>
                                <p class="text-lg font-bold text-gray-900 mt-1">{{ $contact->subject }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">کاتی ناردن</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <p class="text-lg text-gray-700 font-mono">{{ $contact->created_at->format('Y-m-d H:i') }}</p>
                                    <span class="text-sm text-gray-500 bg-gray-100 px-2 py-0.5 rounded-md">{{ $contact->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 mb-8 relative">
                        <div class="absolute -top-3 right-6 bg-white px-3 py-1 text-sm font-bold text-gray-500 border border-gray-200 rounded-full">
                            ناوەڕۆکی پەیام
                        </div>
                        <p class="whitespace-pre-wrap text-gray-700 leading-relaxed text-lg">{{ $contact->message }}</p>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-wrap gap-4 border-t border-gray-100 pt-6">
                        @if($contact->status == 'new')
                            <form method="POST" action="{{ route('admin.contacts.mark-read', $contact->id) }}">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow-md transition-all duration-300 font-bold hover:-translate-y-1">
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    نیشانکردن وەک خوێندراوە
                                </button>
                            </form>
                        @endif

                        @if($contact->status != 'replied')
                            <form method="POST" action="{{ route('admin.contacts.mark-replied', $contact->id) }}">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl shadow-md transition-all duration-300 font-bold hover:-translate-y-1">
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                    </svg>
                                    نیشانکردن وەک وەڵامدراوە
                                </button>
                            </form>
                        @endif

                        <a href="mailto:{{ $contact->email }}" class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-xl shadow-md transition-all duration-300 font-bold hover:-translate-y-1">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            وەڵامدانەوە بە ئیمەیڵ
                        </a>

                        <form method="POST" action="{{ route('admin.contacts.destroy', $contact->id) }}" onsubmit="return confirm('دڵنیای لە سڕینەوەی ئەم پەیامە؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl shadow-md transition-all duration-300 font-bold hover:-translate-y-1">
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                سڕینەوە
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
