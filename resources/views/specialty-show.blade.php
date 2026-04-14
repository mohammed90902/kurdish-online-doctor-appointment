<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <main class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
            <!-- Specialization Banner -->
            <div class="bg-white/90 backdrop-blur-xl rounded-[3.5rem] p-10 md:p-20 mb-16 shadow-2xl border border-white overflow-hidden relative min-h-[400px] flex items-center">
                <!-- Background Decoration -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/5 rounded-full -mr-32 -mt-32 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-teal-500/5 rounded-full -ml-32 -mb-32 blur-3xl"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-center gap-12 w-full">
                    <!-- Icon/Image Box -->
                    <div class="shrink-0 animate-scaleIn">
                        <div class="w-36 h-36 md:w-56 md:h-56 bg-white rounded-[2.5rem] shadow-2xl flex items-center justify-center border-8 border-gray-50/50 overflow-hidden transform -rotate-2 hover:rotate-0 transition-all duration-500 hover:scale-105">
                            @if($specialization->image)
                                <img src="{{ asset('storage/' . $specialization->image) }}" alt="{{ $specialization->name }}" class="w-full h-full object-cover">
                            @elseif($specialization->icon)
                                <img src="{{ asset('storage/' . $specialization->icon) }}" alt="{{ $specialization->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="bg-blue-50 w-full h-full flex items-center justify-center">
                                    <svg class="w-24 h-24 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Text Content -->
                    <div class="text-right flex-1">
                        <div class="inline-flex items-center px-5 py-2 bg-blue-600 text-white rounded-full text-sm font-black mb-8 shadow-xl shadow-blue-200">
                            <span class="tracking-wide">پسپۆڕی پزیشکی</span>
                        </div>
                        <h1 class="text-5xl md:text-8xl font-black text-gray-900 mb-8 tracking-tight leading-tight">{{ $specialization->name }}</h1>
                        <p class="text-xl md:text-2xl text-gray-600 leading-relaxed font-medium max-w-3xl">
                            {{ $specialization->description ?? 'لەم بەشەدا باشترین پزیشکەکان خزمەتگوزاری پێشکەش دەکەن بۆ چارەسەرکردنی نەخۆشییەکانی ئەم پسپۆڕییە.' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mb-12">
                <h2 class="text-4xl font-black text-gray-900">پزیشکەکانی ئەم پسپۆڕییە</h2>
                <div class="h-1 flex-1 bg-gradient-to-r from-transparent via-gray-200 to-transparent mx-8 hidden md:block"></div>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($specialization->doctors as $doctor)
                    <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-500 group relative overflow-hidden">
                        <!-- Card Glow -->
                        <div class="absolute -top-10 -right-10 w-24 h-24 bg-blue-500/5 rounded-full blur-2xl group-hover:bg-blue-500/10 transition-colors"></div>

                        <div class="flex items-center gap-6 mb-8 relative z-10">
                            <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-blue-50 shadow-inner group-hover:border-blue-200 transition-all duration-300">
                                @if($doctor->profile_image)
                                    <img src="{{ asset('storage/' . $doctor->profile_image) }}" alt="{{ $doctor->user->localized_name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-50 to-indigo-50 flex items-center justify-center">
                                        <span class="text-3xl font-bold text-blue-300">{{ substr($doctor->user->localized_name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-2xl font-black text-gray-900 mb-1">د. {{ $doctor->user->localized_name }}</h3>
                                <p class="text-blue-600 font-bold flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.382 0z"/>
                                    </svg>
                                    {{ $doctor->experience_years }} ساڵ ئەزموون
                                </p>
                            </div>
                        </div>
                        
                        <div class="space-y-4 mb-8 bg-gray-50/50 p-4 rounded-2xl border border-gray-100 relative z-10">
                            <div class="flex items-center justify-between text-gray-700">
                                <span class="font-bold">نرخی بینین:</span>
                                <span class="text-lg font-black text-gray-900">{{ number_format($doctor->consultation_fee) }} د.ع</span>
                            </div>
                        </div>

                        <a href="{{ route('patient.doctors.show', $doctor->user_id) }}" class="block w-full py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-center rounded-[1.25rem] font-black text-lg hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 relative z-10">
                            بینینی زانیاری و دانانی کات
                        </a>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-[3rem] border-4 border-dashed border-gray-100">
                        <svg class="w-20 h-20 text-gray-200 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <p class="text-2xl font-bold text-gray-400">پزیشک هێشتا زیاد نەکراوە بۆ ئەم پسپۆڕییە.</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
</x-app-layout>
