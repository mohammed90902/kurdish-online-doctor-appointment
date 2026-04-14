<!-- Advanced Unique Footer -->
<footer class="mt-32 relative bg-slate-900 text-white pt-24 pb-12 overflow-hidden w-full">
    <!-- Decorative Mesh Gradient Background -->
    <div class="absolute inset-0 opacity-20 pointer-events-none">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-indigo-500 rounded-full blur-[120px]"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-blue-600 rounded-full blur-[120px]"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 lg:gap-12 mb-24 text-right" dir="rtl">
            
            <!-- Column 1: Brand & Mission -->
            <div class="space-y-8">
                <div>
                    <img src="{{ asset('images/logo.png') }}" alt="سیستەمی پزیشکی" class="h-16 w-auto object-contain ml-auto brightness-110 contrast-125">
                </div>
                <p class="text-gray-400 font-medium leading-relaxed text-sm opacity-90">
                    {{ __('Platform bio') }}
                </p>
            </div>

            <!-- Column 2: Quick Navigation -->
            <div>
                <h4 class="text-sm font-black uppercase tracking-[0.2em] mb-10 text-indigo-400/90">{{ __('Quick Links') }}</h4>
                <ul class="space-y-5 text-gray-400 font-bold text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white hover:translate-x-[-4px] inline-block transition-all duration-300">{{ __('Home') }}</a></li>
                    <li><a href="{{ route('patient.doctors') }}" class="hover:text-white hover:translate-x-[-4px] inline-block transition-all duration-300">{{ __('Find Doctors') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white hover:translate-x-[-4px] inline-block transition-all duration-300">{{ __('Contact') }}</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white hover:translate-x-[-4px] inline-block transition-all duration-300">{{ __('About') }}</a></li>
                </ul>
            </div>

            <!-- Column 3: Medical Specialties -->
            <div class="lg:col-span-1">
                <h4 class="text-sm font-black uppercase tracking-[0.2em] mb-10 text-indigo-400/90">{{ __('Specialties') }}</h4>
                <div class="grid grid-cols-2 gap-x-10 gap-y-5 text-gray-400 font-bold text-xs uppercase tracking-wider">
                    @foreach($specializations as $spec)
                        <a href="{{ route('specialty.show', $spec->id) }}" class="hover:text-white transition-colors duration-300 whitespace-nowrap">
                            {{ $spec->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Column 4: Location & Contact -->
            <div class="space-y-10">
                <h4 class="text-sm font-black uppercase tracking-[0.2em] mb-10 text-indigo-400/90">{{ __('Address') }}</h4>
                <ul class="space-y-6 text-gray-400 font-bold text-xs">
                    <li class="flex items-start gap-4 group">
                        <span class="leading-relaxed group-hover:text-gray-200 transition-colors">{{ __('Sulaymaniyah, Salim Street') }}</span>
                        <div class="w-8 h-8 rounded-lg bg-indigo-500/10 flex items-center justify-center border border-indigo-500/20 shrink-0">
                            <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                    </li>
                    <li class="flex items-center gap-4 group">
                        <span dir="ltr" class="font-sans text-sm group-hover:text-gray-200 transition-colors">+964 750 000 0000</span>
                        <div class="w-8 h-8 rounded-lg bg-indigo-500/10 flex items-center justify-center border border-indigo-500/20 shrink-0">
                            <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Social Section -->
        <div class="flex flex-col items-center gap-10">
            <div class="flex items-center gap-6 w-full">
                <div class="h-px bg-gradient-to-l from-transparent via-white/20 to-transparent flex-1"></div>
                <span class="text-gray-400 font-black italic tracking-widest uppercase text-xs">{{ __('Follow Us') }}</span>
                <div class="h-px bg-gradient-to-r from-transparent via-white/20 to-transparent flex-1"></div>
            </div>
            
            <div class="flex gap-6">
                <a href="#" class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-blue-600 hover:scale-110 transition-all duration-500 group">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3l-.5 3h-2.5v6.8c4.56-.93 8-4.96 8-9.8z"/></svg>
                </a>
                <a href="#" class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-gradient-to-tr hover:from-yellow-400 hover:via-red-500 hover:to-purple-600 hover:scale-110 transition-all duration-500 group">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="#" class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-red-600 hover:scale-110 transition-all duration-500 group">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
                <a href="#" class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-black hover:scale-110 transition-all duration-500 group">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-24 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6 text-gray-500 text-xs font-bold">
            <p>© 2026 {{ __('All rights reserved') }}</p>
            <div class="flex gap-6">
                <a href="#" class="hover:text-white transition">{{ __('Designed with love') }}</a>
            </div>
        </div>
    </div>
</footer>
