<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <main class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white/90 backdrop-blur-xl rounded-[3rem] p-10 md:p-14 mb-16 text-center shadow-2xl border border-white animate-slideUp relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/5 rounded-full -mr-16 -mt-16 blur-2xl"></div>
                <div class="relative z-10">
                    <h1 class="text-4xl md:text-6xl font-black text-gray-900 mb-6 bg-gradient-to-r from-blue-600 to-teal-600 bg-clip-text text-transparent leading-tight">
                        {{ __('Clinic Sections') }}
                    </h1>
                    <div class="h-1.5 w-24 bg-gradient-to-r from-blue-600 to-teal-600 mx-auto rounded-full mb-6"></div>
                    <p class="text-gray-500 text-xl font-bold max-w-2xl mx-auto uppercase tracking-wide">
                        {{ __('Clinic Sections Description') }}
                    </p>
                </div>
            </div>

            <!-- Specializations Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($specializations as $spec)
                    <a href="{{ route('specialty.show', $spec->id) }}" class="group relative bg-white rounded-[2.5rem] shadow-xl transition-all duration-500 hover:-translate-y-3 hover:shadow-2xl border border-gray-100 overflow-hidden">
                        <div class="aspect-[11/10] w-full relative overflow-hidden">
                            @if($spec->image)
                                <img src="{{ asset('storage/' . $spec->image) }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $spec->name }}">
                            @else
                                <div class="h-full w-full bg-gradient-to-br from-blue-50 to-teal-50 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-8">
                                <span class="bg-white text-blue-600 font-black px-6 py-2.5 rounded-2xl shadow-xl flex items-center gap-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                    {{ __('View Doctors') }}
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-10 text-center">
                            <h3 class="text-3xl font-black text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">{{ $spec->name }}</h3>
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-gray-50 rounded-full border border-gray-100">
                                <div class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></div>
                                <span class="text-gray-500 font-bold text-sm">@digits($spec->doctors_count) {{ __('Specialist Doctors Available') }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </main>
    </div>
</x-app-layout>
