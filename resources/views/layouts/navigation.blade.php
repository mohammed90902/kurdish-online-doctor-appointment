<nav x-data="{ open: false, searchOpen: false }" class="bg-white/80 backdrop-blur-md border-b border-gray-200">
    <!-- Search Overlay Panel -->
    <div x-show="searchOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="absolute top-full left-0 right-0 bg-white shadow-2xl border-b border-gray-200 px-4 py-5 z-50" x-cloak @click.outside="searchOpen = false">
        <form action="{{ route('search') }}" method="GET" class="max-w-2xl mx-auto flex gap-3 items-center">
            <div class="relative flex-1">
                <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                </svg>
                <input x-ref="searchInput" type="text" name="q" autocomplete="off"
                    class="w-full rounded-2xl border-2 border-blue-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 py-3 pr-12 pl-5 text-lg font-medium transition-all"
                    placeholder="{{ __('Search for doctors, specialties...') }}">
            </div>
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-teal-500 text-white rounded-2xl font-black text-lg hover:shadow-lg transition-all">
                {{ __('Search') }}
            </button>
            <button type="button" @click="searchOpen = false" class="p-3 text-gray-400 hover:text-gray-700 rounded-xl hover:bg-gray-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </form>
    </div>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 gap-6">
            <div class="flex">
                <!-- Logo & Back Button -->
                <div class="shrink-0 flex items-center gap-4">
                    @if(!request()->routeIs('home') && !request()->routeIs('dashboard') && !request()->routeIs('admin.dashboard') && !request()->routeIs('doctor.dashboard') && !request()->routeIs('patient.dashboard'))
                        <button onclick="window.history.back()" class="flex items-center gap-2 px-3 py-1.5 bg-gray-50 hover:bg-blue-50 rounded-xl text-blue-600 font-bold border border-blue-100 transition-all shadow-sm group">
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                            <span>{{ __('Back') }}</span>
                        </button>
                    @endif
                    <a href="{{ route('home') }}" class="group">
                        <img src="{{ asset('images/logo.png') }}" alt="سیستەمی پزیشکی" class="h-16 w-auto object-contain group-hover:scale-105 transition-transform duration-300">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 xl:space-x-4 rtl:space-x-reverse xl:-my-px xl:flex justify-center items-center shrink">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="smooth-transition font-bold text-gray-700 whitespace-nowrap">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('home')" class="smooth-transition font-bold text-gray-700">
                        {{ __('Home') }}
                    </x-nav-link>

                    <x-nav-link :href="route('patient.doctors')" :active="request()->routeIs('patient.doctors')" class="smooth-transition font-bold text-gray-700">
                        {{ __('Find Doctors') }}
                    </x-nav-link>

                    <x-nav-link :href="route('specialties.all')" :active="request()->routeIs('specialties.all')" class="smooth-transition font-bold text-gray-700">
                        {{ __('Clinical Sections') }}
                    </x-nav-link>

                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="smooth-transition font-bold text-gray-700">
                        {{ __('Contact') }}
                    </x-nav-link>

                    <x-nav-link :href="route('health-advice')" :active="request()->routeIs('health-advice')" class="smooth-transition font-bold text-gray-700">
                        {{ __('Health Advice') }}
                    </x-nav-link>

                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')" class="smooth-transition font-bold text-gray-700">
                        {{ __('About') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden xl:flex xl:items-center mr-2 gap-2">
                <!-- Language Dropdown -->
                <div class="hidden xl:flex xl:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-blue-50 text-gray-700 hover:text-blue-600 rounded-xl text-sm font-black transition-all border border-gray-200 hover:border-blue-200">
                                <svg class="w-4 h-4 ml-2 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"></path></svg>
                                <span>{{ App::getLocale() === 'ckb' ? 'کوردی' : (App::getLocale() === 'ar' ? 'العربية' : 'English') }}</span>
                                <svg class="w-4 h-4 mr-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="p-2 space-y-1">
                                <x-dropdown-link :href="route('lang.switch', 'ckb')" class="flex items-center justify-end p-3 hover:bg-blue-50 rounded-lg group {{ App::getLocale() === 'ckb' ? 'bg-blue-50 text-blue-600' : '' }}">
                                    <span class="font-bold">کوردی</span>
                                    @if(App::getLocale() === 'ckb')
                                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    @endif
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('lang.switch', 'ar')" class="flex items-center justify-end p-3 hover:bg-emerald-50 rounded-lg group {{ App::getLocale() === 'ar' ? 'bg-emerald-50 text-emerald-600' : '' }}">
                                    <span class="font-bold">العربية</span>
                                    @if(App::getLocale() === 'ar')
                                        <svg class="w-4 h-4 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    @endif
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('lang.switch', 'en')" class="flex items-center justify-end p-3 hover:bg-indigo-50 rounded-lg group {{ App::getLocale() === 'en' ? 'bg-indigo-50 text-indigo-600' : '' }}">
                                    <span class="font-bold">English</span>
                                    @if(App::getLocale() === 'en')
                                        <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    @endif
                                </x-dropdown-link>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Search Button (Both Auth and Guest) -->
                <button @click="searchOpen = !searchOpen; $nextTick(() => { if(searchOpen) $refs.searchInput.focus() })"
                    class="flex items-center gap-2 px-3 py-2 bg-gray-50 hover:bg-blue-50 text-gray-500 hover:text-blue-600 rounded-xl text-sm font-bold border border-gray-200 hover:border-blue-200 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                    </svg>
                    <span>{{ __('Search') }}</span>
                </button>

                @auth
                    <x-dropdown align="right" width="64">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 bg-white border-2 border-blue-50 text-gray-700 font-black rounded-xl hover:bg-blue-50 hover:border-blue-200 transition-all duration-300 shadow-sm hover:shadow-md group">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-teal-500 flex items-center justify-center text-white text-xs shadow-inner">
                                        {{ substr(Auth::user()->name_ku ?? Auth::user()->name ?? 'U', 0, 1) }}
                                    </div>
                                    <span>{{ Auth::user()->localized_name }}</span>
                                </div>

                                <div class="mr-2">
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-2 py-2 space-y-1 text-right" dir="rtl">
                                <!-- Role Label -->
                                <div class="px-3 py-2 text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-gray-100 mb-2">
                                    @if(Auth::user()->isAdmin())
                                        {{ __('Admin') }}
                                    @elseif(Auth::user()->isDoctor())
                                        {{ __('Doctor') }}
                                    @else
                                        {{ __('Patient') }}
                                    @endif
                                </div>

                                <!-- Common Dashboard Link -->
                                <x-dropdown-link :href="route('dashboard')" class="flex items-center justify-end gap-3 p-3 hover:bg-blue-50 rounded-lg group {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                                    <span class="font-bold">{{ __('Dashboard') }}</span>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                </x-dropdown-link>

                                <!-- Role Specific Links -->
                                @if(Auth::user()->isDoctor())
                                    <x-dropdown-link :href="route('doctor.appointments.index')" class="flex items-center justify-end gap-3 p-3 hover:bg-blue-50 rounded-lg group">
                                        <span class="font-bold">{{ __('Appointments') }}</span>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('doctor.schedules.index')" class="flex items-center justify-end gap-3 p-3 hover:bg-blue-50 rounded-lg group">
                                        <span class="font-bold">{{ __('Schedules') }}</span>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </x-dropdown-link>
                                @elseif(Auth::user()->isAdmin())
                                    <x-dropdown-link :href="route('admin.doctors.index')" class="flex items-center justify-end gap-3 p-3 hover:bg-blue-50 rounded-lg group">
                                        <span class="font-bold">{{ __('Manage Doctors') }}</span>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.patients.index')" class="flex items-center justify-end gap-3 p-3 hover:bg-blue-50 rounded-lg group">
                                        <span class="font-bold">{{ __('Manage Patients') }}</span>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </x-dropdown-link>
                                @else
                                    <x-dropdown-link :href="route('patient.doctors')" class="flex items-center justify-end gap-3 p-3 hover:bg-blue-50 rounded-lg group">
                                        <span class="font-bold">{{ __('View Doctors') }}</span>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-100 my-1"></div>

                                <x-dropdown-link :href="route('profile.edit')" class="flex items-center justify-end gap-3 p-3 hover:bg-blue-50 rounded-lg group">
                                    <span class="font-bold">{{ __('Profile') }}</span>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                            class="flex items-center justify-end gap-3 p-3 hover:bg-red-50 text-gray-700 hover:text-red-700 rounded-lg group transition-colors">
                                        <span class="font-bold">{{ __('Logout') }}</span>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="space-x-4 flex items-center rtl:space-x-reverse">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700 hover:text-blue-600 transition">{{ __('Login') }}</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">{{ __('Register') }}</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center xl:hidden shrink-0">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-600 hover:text-gray-800 hover:bg-white/50 focus:outline-none focus:bg-white/80 transition-all duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24 ">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden xl:hidden">
        <div class="pt-2 pb-3 space-y-1 bg-white/30 backdrop-blur-lg">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                {{ __('About') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('patient.doctors')" :active="request()->routeIs('patient.doctors')">
                {{ __('View Doctors') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('specialties.all')" :active="request()->routeIs('specialties.all')">
                {{ __('Clinical Sections') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                {{ __('Contact') }}
            </x-responsive-nav-link>

            <!-- Language Switcher Mobile -->
            <div class="px-4 pt-3 pb-3 border-t border-gray-100 flex gap-4">
                <a href="{{ route('lang.switch', 'ckb') }}" class="text-sm font-black {{ App::getLocale() === 'ckb' ? 'text-blue-600' : 'text-gray-500' }}">کوردی</a>
                <a href="{{ route('lang.switch', 'ar') }}" class="text-sm font-black {{ App::getLocale() === 'ar' ? 'text-blue-600' : 'text-gray-500' }}">العربية</a>
                <a href="{{ route('lang.switch', 'en') }}" class="text-sm font-black {{ App::getLocale() === 'en' ? 'text-blue-600' : 'text-gray-500' }}">English</a>
            </div>

            <x-responsive-nav-link :href="route('health-advice')" :active="request()->routeIs('health-advice')">
                {{ __('Health Advice') }}
            </x-responsive-nav-link>

            <!-- Mobile Search -->
            <div class="px-4 pt-3 pb-2">
                <form action="{{ route('search') }}" method="GET" class="flex gap-2">
                    <div class="relative flex-1">
                        <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                        </svg>
                        <input type="text" name="q"
                            class="w-full rounded-xl border border-gray-200 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 py-2 pr-9 pl-3 text-sm font-medium"
                            placeholder="{{ __('Search') }}...">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-bold shadow-sm">
                        {{ __('Search') }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-white/20 bg-white/30 backdrop-blur-lg">
            @auth
                <div class="px-4 mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-teal-500 flex items-center justify-center text-white font-bold shadow-md">
                            {{ substr(Auth::user()->name_ku ?? Auth::user()->name ?? 'U', 0, 1) }}
                        </div>
                        <div>
                            <div class="font-black text-base text-gray-800">{{ Auth::user()->localized_name }}</div>
                            <div class="font-bold text-xs text-blue-600">
                                @if(Auth::user()->isAdmin())
                                    {{ __('Admin') }}
                                @elseif(Auth::user()->isDoctor())
                                    {{ __('Doctor') }}
                                @else
                                    {{ __('Patient') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>

                    @if(Auth::user()->isDoctor())
                        <x-responsive-nav-link :href="route('doctor.appointments.index')">
                            {{ __('Appointments') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('doctor.schedules.index')">
                            {{ __('Schedules') }}
                        </x-responsive-nav-link>
                    @elseif(Auth::user()->isAdmin())
                        <x-responsive-nav-link :href="route('admin.doctors.index')">
                            {{ __('Manage Doctors') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.patients.index')">
                            {{ __('Manage Patients') }}
                        </x-responsive-nav-link>
                    @else
                        <x-responsive-nav-link :href="route('patient.doctors')">
                            {{ __('View Doctors') }}
                        </x-responsive-nav-link>
                    @endif

                    <div class="border-t border-gray-100 my-2"></div>

                    <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="text-red-600">
                            {{ __('Logout') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1 px-4">
                    <a href="{{ route('login') }}" class="block w-full text-right py-3 text-base font-bold text-gray-700 hover:text-blue-600 transition">{{ __('Login') }}</a>
                    <a href="{{ route('register') }}" class="block w-full text-right py-3 bg-blue-600 text-white rounded-xl px-4 text-base font-bold hover:bg-blue-700 transition">{{ __('Register') }}</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
