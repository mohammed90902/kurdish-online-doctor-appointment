<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-cyan-50 to-teal-50">
        <!-- Main Content -->
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            
            <!-- Hero Section -->
            <div class="text-center mb-20 animate-slideUp">
                <h1 class="text-4xl md:text-6xl font-extrabold mb-8 bg-gradient-to-r from-blue-700 via-teal-600 to-purple-600 bg-clip-text text-transparent leading-relaxed">
                    {{ __('About Online Medical System') }}
                </h1>
                <p class="text-xl text-gray-700 max-w-4xl mx-auto leading-loose font-medium">
                    {{ __('Platform Intro Message') }}
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-2 gap-10 mb-20">
                <!-- Our Goal Card -->
                <div class="bg-white/90 backdrop-blur-xl p-10 rounded-[2.5rem] border border-white shadow-xl hover-lift">
                    <div class="w-16 h-16 rounded-2xl bg-blue-500/10 flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">{{ __('Our Goal') }}</h3>
                    <p class="text-gray-700 leading-loose text-lg">
                        {{ __('Goal Description') }}
                    </p>
                </div>

                <!-- Why Us Card -->
                <div class="bg-white/90 backdrop-blur-xl p-10 rounded-[2.5rem] border border-white shadow-xl hover-lift">
                    <div class="w-16 h-16 rounded-2xl bg-teal-500/10 flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">{{ __('Why Us?') }}</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-4 text-gray-700 font-medium">
                            <div class="p-1 bg-teal-100 rounded-full">
                                <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            {{ __('Secure and safe system') }}
                        </li>
                        <li class="flex items-center gap-4 text-gray-700 font-medium">
                            <div class="p-1 bg-teal-100 rounded-full">
                                <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            {{ __('24h availability') }}
                        </li>
                        <li class="flex items-center gap-4 text-gray-700 font-medium">
                            <div class="p-1 bg-teal-100 rounded-full">
                                <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            {{ __('Ease of finding doctors') }}
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Stats Section - Fixed Contrast -->
            <div class="bg-white/80 backdrop-blur-2xl rounded-[3rem] p-12 border border-white shadow-2xl animate-on-scroll">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
                    <div class="group">
                        <div class="text-5xl font-black text-blue-600 mb-2 group-hover:scale-110 transition-transform">+50</div>
                        <div class="text-gray-500 font-bold uppercase tracking-widest text-xs">{{ __('Specialist Doctors') }}</div>
                    </div>
                    <div class="group border-r border-gray-100 pr-4 md:pr-0">
                        <div class="text-5xl font-black text-teal-600 mb-2 group-hover:scale-110 transition-transform">+1000</div>
                        <div class="text-gray-500 font-bold uppercase tracking-widest text-xs">{{ __('Registered Patients') }}</div>
                    </div>
                    <div class="group border-r border-gray-100 pr-4 md:border-none md:pr-0">
                        <div class="text-5xl font-black text-purple-600 mb-2 group-hover:scale-110 transition-transform">+500</div>
                        <div class="text-gray-500 font-bold uppercase tracking-widest text-xs">{{ __('Successful Visits') }}</div>
                    </div>
                    <div class="group border-r border-gray-100 pr-4 md:border-none md:pr-0">
                        <div class="text-5xl font-black text-indigo-600 mb-2 group-hover:scale-110 transition-transform">24/7</div>
                        <div class="text-gray-500 font-bold uppercase tracking-widest text-xs">{{ __('Service') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
