<x-app-layout>
    <!-- Splash Screen Styles -->
    <style>
        .ecg-viewport {
            width: 250px;
            height: 80px;
            margin: 0 auto;
            position: relative;
        }
        .ecg-path-bg {
            fill: none;
            stroke: rgba(20, 184, 166, 0.1);
            stroke-width: 4;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .ecg-path-active {
            fill: none;
            stroke: #14b8a6;
            stroke-width: 5;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 80, 400; /* 80px visible pulse, 400px gap */
            animation: ecg-sweep 2.5s linear infinite;
            filter: drop-shadow(0 0 8px rgba(20, 184, 166, 0.8));
        }
        @keyframes ecg-sweep {
            from { stroke-dashoffset: -480; } /* Moves right to left */
            to { stroke-dashoffset: 0; }
        }
    </style>

    <!-- Splash Screen -->
    <div id="splash-screen" class="fixed inset-0 z-[9999] flex items-center justify-center bg-gradient-to-br from-blue-50 via-cyan-50 to-teal-50 transition-opacity duration-700">
        <div class="text-center">
            <!-- Logo Section -->
            <div class="mb-8 animate-bounce-slow text-center">
                <img src="{{ asset('images/logo.png') }}" alt="سیستەمی پزیشکی" class="h-40 w-auto mx-auto drop-shadow-2xl">
            </div>
            
            <!-- Heartbeat ECG Animation -->
            <div class="ecg-viewport mb-6">
                <svg viewBox="0 0 250 80" class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <!-- Background static line -->
                    <path class="ecg-path-bg" d="M0 40 H100 L115 10 L130 70 L145 25 L160 40 H250" />
                    <!-- Animated sweeping pulse -->
                    <path class="ecg-path-active" d="M0 40 H100 L115 10 L130 70 L145 25 L160 40 H250" />
                </svg>
            </div>
            
            <!-- Loading Text -->
            <p class="text-teal-700 text-lg font-medium tracking-wide animate-pulse" style="font-family: 'Noto Sans Arabic', sans-serif;">
                {{ __('Please wait...') }}
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto">

        <!-- Hero Slideshow Section -->
        <section class="relative mb-12 px-4 mt-8" x-data="{ 
            activeSlide: 1, 
            slides: 3,
            autoPlay() {
                this.timer = setInterval(() => {
                    this.activeSlide = this.activeSlide === this.slides ? 1 : this.activeSlide + 1;
                }, 6000);
            },
            resetTimer() {
                clearInterval(this.timer);
                this.autoPlay();
            }
        }" x-init="autoPlay()">
            <div class="relative h-[850px] sm:h-[600px] md:h-[650px] overflow-hidden rounded-[3rem] shadow-2xl group">
                
                <!-- Slide 1 -->
                <div x-show="activeSlide === 1" 
                     x-transition:enter="transition ease-out duration-1000"
                     x-transition:enter-start="opacity-0 scale-105"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-800"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0">
                    <img src="{{ asset('images/slider/banner1.png') }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/30 to-transparent flex items-center justify-start px-8 md:px-20 overflow-hidden">
                        <div class="max-w-xl text-right animate-slideUp">
                            <h1 class="text-4xl md:text-6xl font-black text-white mb-6 leading-tight drop-shadow-2xl">
                                {{ __('Best medical service in Kurdistan') }}
                            </h1>
                            <p class="text-xl md:text-2xl text-gray-100 mb-10 font-bold opacity-90 drop-shadow-lg">
                                {{ __('Easily and quickly book with experts') }}
                            </p>
                            <div class="flex justify-start gap-5">
                                <a href="{{ Auth::check() ? route('patient.doctors') : '#doctors' }}" class="px-10 py-5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-2xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 font-black text-xl shadow-blue-500/20">
                                    {{ __('View Doctors') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div x-show="activeSlide === 2" 
                     x-transition:enter="transition ease-out duration-1000"
                     x-transition:enter-start="opacity-0 scale-105"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-800"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0" x-cloak>
                    <img src="{{ asset('images/slider/banner2.png') }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/30 to-transparent flex items-center justify-start px-8 md:px-20 overflow-hidden">
                        <div class="max-w-xl text-right animate-slideUp">
                            <h1 class="text-4xl md:text-6xl font-black text-white mb-6 leading-tight drop-shadow-2xl">
                                {{ __('Specialist doctors at your service') }}
                            </h1>
                            <p class="text-xl md:text-2xl text-gray-100 mb-10 font-bold opacity-90 drop-shadow-lg">
                                {{ __('Choose doctors by specialty') }}
                            </p>
                            <div class="flex justify-start gap-5">
                                <a href="#specialties" class="px-10 py-5 bg-gradient-to-r from-teal-500 to-emerald-600 text-white rounded-2xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 font-black text-xl shadow-teal-500/20">
                                    {{ __('Clinical Sections') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3: About Us -->
                <div x-show="activeSlide === 3" 
                     x-transition:enter="transition ease-out duration-1000"
                     x-transition:enter-start="opacity-0 scale-105"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-800"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0 bg-gradient-to-br from-slate-900 via-indigo-900 to-slate-900" x-cloak>
                    <div class="absolute inset-0 opacity-30">
                        <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-500 rounded-full blur-[120px]"></div>
                        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-teal-500 rounded-full blur-[120px]"></div>
                    </div>
                    <div class="relative h-full flex flex-col items-center justify-center text-center px-4 md:px-6 py-12 md:py-0">
                        <h2 class="text-3xl md:text-6xl font-black text-white mb-6 md:mb-12 drop-shadow-2xl">{{ __('Why Choose Us') }}</h2>
                        <div class="grid md:grid-cols-3 gap-4 md:gap-8 max-w-6xl w-full">
                            <div class="glass-card p-6 md:p-10 rounded-[2rem] md:rounded-[2.5rem] border border-white/20 hover:bg-white/10 transition-colors group/card">
                                <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl md:rounded-3xl flex items-center justify-center mx-auto mb-4 md:mb-8 text-white shadow-xl group-hover/card:scale-110 transition-transform">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h3 class="text-2xl font-black text-white mb-4">{{ __('Speed and Time') }}</h3>
                                <p class="text-white/80 font-bold leading-relaxed">{{ __('No more long waiting') }}</p>
                            </div>
                            <div class="glass-card p-6 md:p-10 rounded-[2rem] md:rounded-[2.5rem] border border-white/20 hover:bg-white/10 transition-colors group/card">
                                <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-2xl md:rounded-3xl flex items-center justify-center mx-auto mb-4 md:mb-8 text-white shadow-xl group-hover/card:scale-110 transition-transform">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                </div>
                                <h3 class="text-2xl font-black text-white mb-4">{{ __('Trust and Safety') }}</h3>
                                <p class="text-white/80 font-bold leading-relaxed">{{ __('Only licensed doctors here') }}</p>
                            </div>
                            <div class="glass-card p-6 md:p-10 rounded-[2rem] md:rounded-[2.5rem] border border-white/20 hover:bg-white/10 transition-colors group/card">
                                <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl md:rounded-3xl flex items-center justify-center mx-auto mb-4 md:mb-8 text-white shadow-xl group-hover/card:scale-110 transition-transform">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <h3 class="text-2xl font-black text-white mb-4">{{ __('Full Support') }}</h3>
                                <p class="text-white/80 font-bold leading-relaxed">{{ __('Advanced patient management system') }}</p>
                            </div>
                        </div>
                        <div class="mt-16">
                            <a href="{{ route('about') }}" class="px-12 py-5 bg-white text-indigo-900 rounded-2xl font-black text-xl shadow-2xl hover:scale-110 transition-transform duration-300">{{ __('Read More') }}</a>
                        </div>
                    </div>
                </div>

                <!-- Navigation Arrows -->
                <button @click="activeSlide = activeSlide === 1 ? slides : activeSlide - 1; resetTimer()" class="absolute left-6 top-1/2 -translate-y-1/2 w-14 h-14 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 hover:bg-white hover:text-black">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button @click="activeSlide = activeSlide === slides ? 1 : activeSlide + 1; resetTimer()" class="absolute right-6 top-1/2 -translate-y-1/2 w-14 h-14 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 hover:bg-white hover:text-black">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                </button>

                <!-- Indicator Dots -->
                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center gap-6 z-20">
                    <template x-for="i in slides" :key="i">
                        <button @click="activeSlide = i; resetTimer()" 
                                :class="activeSlide === i ? 'w-12 bg-white ring-4 ring-white/20' : 'w-3 bg-white/40 hover:bg-white/60'"
                                class="h-3 rounded-full transition-all duration-500"></button>
                    </template>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="py-12 px-4">
            <div class="max-w-7xl mx-auto">
                <div class="grid md:grid-cols-2 gap-8 mb-12">
                    <div class="glass-card p-8 rounded-2xl hover-lift animate-on-scroll">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-600 text-lg mb-2">{{ __('Total Doctors') }}</h3>
                                <p class="text-5xl font-bold bg-gradient-to-r from-blue-600 to-teal-600 bg-clip-text text-transparent">{{ $stats['total_doctors'] }}</p>
                            </div>
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-500 to-teal-500 flex items-center justify-center shadow-lg">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="glass-card p-8 rounded-2xl hover-lift animate-on-scroll">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-600 text-lg mb-2">{{ __('Total Specializations') }}</h3>
                                <p class="text-5xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">{{ $stats['total_specializations'] }}</p>
                            </div>
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center shadow-lg">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Specializations Section -->
                <div id="specialties" class="mb-20 animate-on-scroll scroll-mt-24">
                    <div class="text-center mb-20 bg-white/50 backdrop-blur-md p-12 rounded-[3.5rem] shadow-sm border border-white/40">
                        <h2 class="text-5xl md:text-6xl font-black text-blue-600 mb-6 drop-shadow-sm">{{ __('Clinical Sections') }}</h2>
                        <div class="h-2 w-32 bg-gradient-to-r from-blue-600 to-teal-500 mx-auto rounded-full mb-8"></div>
                        <p class="text-gray-500 text-lg md:text-xl font-bold tracking-wide">{{ __('See all medical specialties here') }}</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($specializations as $spec)
                            <a href="{{ route('specialty.show', $spec->id) }}" class="group relative overflow-hidden rounded-3xl bg-white shadow-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl">
                                <div class="aspect-[4/3] w-full overflow-hidden relative">
                                    <!-- Background Image -->
                                    <div class="absolute inset-0 bg-gray-200">
                                        @if($spec->image)
                                            <img src="{{ asset('storage/' . $spec->image) }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $spec->name }}">
                                        @else
                                            <div class="h-full w-full bg-gradient-to-br from-blue-100 to-teal-50"></div>
                                        @endif
                                    </div>
                                    
                                    <!-- Overlay -->
                                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-500"></div>

                                    @if(!$spec->image)
                                        <!-- Icon Circle - Only show if no background image -->
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div class="w-24 h-24 rounded-full bg-teal-500/90 backdrop-blur-md flex items-center justify-center border-4 border-white/30 shadow-2xl transition-transform duration-500 group-hover:scale-110">
                                                @if($spec->icon)
                                                    <img src="{{ asset('storage/' . $spec->icon) }}" class="w-12 h-12 invert brightness-0" alt="">
                                                @else
                                                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.628.282a2 2 0 01-1.806 0l-.628-.282a6 6 0 00-3.86-.517l-2.387.477a2 2 0 00-1.022.547l-.953 2.14a2 2 0 00.327 2.242l1.625 1.625a2 2 0 002.242.327l2.14-.953z"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="p-6 text-center">
                                    <h3 class="text-2xl font-bold text-gray-800 mb-1 group-hover:text-teal-600 transition-colors">{{ $spec->name }}</h3>
                                    <p class="text-xs text-gray-500 font-bold italic">{{ $spec->doctors_count }} {{ __('Specialist Registered') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- View All Specialties Button -->
                    <div class="mt-16 text-center">
                        <a href="{{ route('specialties.all') }}" class="inline-flex items-center gap-3 px-10 py-5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-[2rem] font-black text-xl shadow-2xl shadow-blue-200 hover:shadow-blue-300 hover:-translate-y-2 transition-all duration-500 group">
                            {{ __('See All') }}
                            <svg class="w-7 h-7 transform group-hover:translate-x-2 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Featured Doctors Section -->
                <div id="doctors" class="mb-20 animate-on-scroll scroll-mt-24">
                    <div class="text-center mb-20 bg-white/50 backdrop-blur-md p-12 rounded-[3.5rem] shadow-sm border border-white/40">
                        <h2 class="text-5xl md:text-6xl font-black text-blue-600 mb-6 drop-shadow-sm">{{ __('All Doctors') }}</h2>
                        <div class="h-2 w-32 bg-gradient-to-r from-blue-600 to-teal-500 mx-auto rounded-full mb-8"></div>
                        <p class="text-gray-500 text-lg md:text-xl font-bold tracking-wide">{{ __('Find Doctors Intro') }}</p>
                    </div>
                    <div class="grid md:grid-cols-3 gap-8">
                        @foreach($featuredDoctors as $doctor)
                            <div class="group relative bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-500 card-hover">
                                <div class="relative w-32 h-32 mx-auto mb-6">
                                    <div class="absolute inset-0 bg-blue-500 rounded-full blur-2xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                                    <div class="relative w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-lg">
                                        @if($doctor->profile_image)
                                            <img src="{{ asset('storage/' . $doctor->profile_image) }}" alt="د. {{ $doctor->user->localized_name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-teal-500 flex items-center justify-center">
                                                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <h3 class="text-2xl font-bold text-center text-gray-800 mb-2">{{ __('Dr.') }} {{ $doctor->user->localized_name }}</h3>
                                <div class="flex justify-center mb-4">
                                    <span class="px-4 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-bold">{{ $doctor->specialization->name }}</span>
                                </div>
                                <p class="text-center text-gray-600 mb-6 flex items-center justify-center">
                                    <svg class="w-5 h-5 ml-2 text-teal-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $doctor->experience_years }} {{ __('years of experience') }}
                                </p>
                                <div class="space-y-3">
                                    <a href="{{ route('patient.doctors.show', $doctor->user->id) }}" class="block w-full py-4 bg-gradient-to-r from-blue-600 to-teal-600 text-white text-center rounded-2xl font-bold shadow-lg hover:shadow-blue-500/30 transition-all duration-300">
                                        {{ __('View Profile') }}
                                    </a>
                                    
                                    @guest
                                        <a href="{{ route('patient.doctors.book', $doctor->user->id) }}" class="block w-full py-3 bg-green-50 text-green-600 text-center rounded-2xl font-bold hover:bg-green-100 transition-all duration-300">
                                            {{ __('Book Now') }}
                                        </a>
                                    @else
                                        @if(!Auth::user()->isDoctor() && !Auth::user()->isAdmin())
                                            <a href="{{ route('patient.doctors.book', $doctor->user->id) }}" class="block w-full py-3 bg-green-50 text-green-600 text-center rounded-2xl font-bold hover:bg-green-100 transition-all duration-300">
                                                {{ __('Book Now') }}
                                            </a>
                                        @endif
                                    @endguest
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- View All Doctors Button -->
                    <div class="mt-16 text-center">
                        <a href="{{ route('patient.doctors') }}" class="inline-flex items-center gap-3 px-10 py-5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-[2rem] font-black text-xl shadow-2xl shadow-blue-200 hover:shadow-blue-300 hover:-translate-y-2 transition-all duration-500 group">
                            {{ __('See All') }}
                            <svg class="w-7 h-7 transform group-hover:translate-x-2 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Latest Posts Section -->
                <div class="animate-on-scroll">
                    <div class="flex justify-between items-end mb-10">
                        <div>
                            <h2 class="text-4xl font-extrabold text-gray-900 mb-2">{{ __('Latest Posts') }}</h2>
                            <p class="text-gray-600">{{ __('Medical Info from Experts') }}</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        @foreach($posts as $post)
                            <div class="bg-white rounded-[2rem] overflow-hidden shadow-lg border border-gray-100 flex flex-col md:flex-row h-full">
                                @if($post->image)
                                    <div class="md:w-1/3 h-48 md:h-auto overflow-hidden">
                                        <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover" alt="{{ $post->title }}">
                                    </div>
                                @endif
                                <div class="p-8 flex-1 flex flex-col">
                                    <div class="flex items-center gap-3 mb-4">
                                        @if($post->user->isDoctor())
                                            @if($post->user->doctorProfile && $post->user->doctorProfile->profile_image)
                                                <img src="{{ asset('storage/' . $post->user->doctorProfile->profile_image) }}" class="w-12 h-12 rounded-full object-cover border-2 border-blue-500 shadow-sm" alt="{{ $post->user->localized_name }}">
                                            @else
                                                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center border-2 border-blue-200">
                                                    <span class="text-blue-500 font-bold">{{ substr($post->user->localized_name, 0, 1) }}</span>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="flex items-center gap-2 mb-1">
                                                    <p class="font-bold text-gray-800 leading-none text-sm">{{ $post->user->localized_name }}</p>
                                                    <span class="text-[10px] text-blue-600 font-bold bg-blue-50 px-1.5 py-0.5 rounded-md">{{ __('Specialist') }}</span>
                                                </div>
                                                <p class="text-[10px] text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                            </div>
                                        @else
                                            {{-- Admin Post: Hide Name and Avatar --}}
                                            <div>
                                                <p class="text-[10px] text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-snug">{{ $post->title }}</h3>
                                    <p class="text-gray-600 line-clamp-3 mb-6 flex-1 text-sm leading-relaxed">{{ $post->content }}</p>
                                    <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 font-bold text-sm w-fit hover:underline flex items-center gap-1 group">
                                        {{ __('Read More') }}
                                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Hospital Location Section -->
                <div class="mt-32 mb-20 animate-on-scroll">
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-12 text-center">{{ __('Our Hospital Location') }}</h2>
                    <div class="glass-card rounded-[3rem] overflow-hidden shadow-2xl border border-white/50">
                        <div class="grid lg:grid-cols-12">
                            <div class="lg:col-span-4 p-12 bg-gradient-to-br from-blue-600 to-teal-600 text-white flex flex-col justify-center">
                                <div class="mb-10">
                                    <h3 class="text-3xl font-bold mb-4">{{ __('Contact Us') }}</h3>
                                    <p class="text-blue-50 font-medium text-lg">{{ __('We are here to serve you') }}</p>
                                </div>
                                <div class="space-y-8">
                                    <div class="flex items-start gap-5">
                                        <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center shrink-0 shadow-inner">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="font-bold opacity-70 text-xs uppercase mb-1">{{ __('Address') }}</p>
                                            <p class="font-bold text-xl italic leading-tight">HCGW+RF2, Sulaymaniyah</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-5">
                                        <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center shrink-0 shadow-inner">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="font-bold opacity-70 text-xs uppercase tracking-wider mb-1">{{ __('Phone Number') }}</p>
                                            <p class="font-bold text-xl" dir="ltr">0750 000 0000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="lg:col-span-8 h-[500px]">
                                <iframe 
                                    class="w-full h-full grayscale hover:grayscale-0 transition-all duration-1000"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3234.343!2d45.432!3d35.567!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzXCsDM0JzAxLjIiTiA0NcKwMjUnNTUuMiJF!5e0!3m2!1sen!2siq!4v1620000000000!5m2!1sen!2siq&q=HCGW+RF2%2C+Sulaymaniyah" 
                                    frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    <!-- Splash Screen Script -->
    <script>
        // Hide splash screen when page is fully loaded
        window.addEventListener('load', function() {
            const splashScreen = document.getElementById('splash-screen');
            
            // Wait a minimum of 1 second to show the splash screen
            setTimeout(function() {
                splashScreen.style.opacity = '0';
                
                // Remove splash screen from DOM after fade out
                setTimeout(function() {
                    splashScreen.style.display = 'none';
                }, 500);
            }, 1000);
        });
    </script>

</x-app-layout>