<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-cyan-50 to-teal-50">
        <!-- Content -->
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div class="animate-slideUp">
                    <h1 class="text-4xl md:text-5xl font-extrabold mb-8 bg-gradient-to-r from-blue-600 to-teal-600 bg-clip-text text-transparent leading-tight">
                        {{ __('Contact Us') }}
                    </h1>
                    <p class="text-xl text-gray-600 mb-10 leading-relaxed font-medium">
                        {{ __('Contact Intro') }}
                    </p>

                    <div class="space-y-6">
                        <!-- Location -->
                        <div class="bg-white/90 backdrop-blur-xl p-6 rounded-2xl flex items-center gap-5 border border-white shadow-xl hover-lift">
                            <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">{{ __('Address') }}</h3>
                                <p class="text-gray-600">{{ __('Sulaymaniyah, Salim Street') }}</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="bg-white/90 backdrop-blur-xl p-6 rounded-2xl flex items-center gap-5 border border-white shadow-xl hover-lift">
                            <div class="w-14 h-14 rounded-full bg-teal-100 flex items-center justify-center shrink-0">
                                <svg class="w-7 h-7 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">{{ __('Phone Number') }}</h3>
                                <p class="text-gray-600 font-medium" dir="ltr">+964 750 123 4567</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="bg-white/90 backdrop-blur-xl p-6 rounded-2xl flex items-center gap-5 border border-white shadow-xl hover-lift">
                            <div class="w-14 h-14 rounded-full bg-purple-100 flex items-center justify-center shrink-0">
                                <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">{{ __('Email') }}</h3>
                                <p class="text-gray-600">info@doctor-appointment.krd</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-white/95 backdrop-blur-2xl p-10 rounded-[2.5rem] shadow-2xl border border-white animate-scaleIn">
                    @if(session('success'))
                        <div class="mb-8 bg-green-50 border-r-4 border-green-500 p-5 rounded-2xl flex items-center gap-4">
                            <div class="bg-green-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-green-900 text-lg">{{ __('Sent') }}</p>
                                <p class="text-green-700 font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <h2 class="text-3xl font-bold text-gray-900 mb-8 border-b border-gray-100 pb-4">{{ __('Contact Form') }}</h2>

                    <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block font-bold text-sm text-gray-700 mb-2 mr-1">{{ __('Name') }}</label>
                                <input type="text" name="name" value="{{ old('name') }}" required class="w-full border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-2xl px-4 py-3.5 transition-all bg-gray-50/50 hover:bg-white">
                                @error('name') <p class="text-red-500 text-xs mt-1 mr-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block font-bold text-sm text-gray-700 mb-2 mr-1">{{ __('Email') }}</label>
                                <input type="email" name="email" value="{{ old('email') }}" required class="w-full border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-2xl px-4 py-3.5 transition-all bg-gray-50/50 hover:bg-white">
                                @error('email') <p class="text-red-500 text-xs mt-1 mr-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-sm text-gray-700 mb-2 mr-1">{{ __('Subject') }}</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" required class="w-full border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-2xl px-4 py-3.5 transition-all bg-gray-50/50 hover:bg-white">
                            @error('subject') <p class="text-red-500 text-xs mt-1 mr-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block font-bold text-sm text-gray-700 mb-2 mr-1">{{ __('Message') }}</label>
                            <textarea name="message" rows="5" required class="w-full border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-2xl px-4 py-3.5 transition-all bg-gray-50/50 hover:bg-white">{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-500 text-xs mt-1 mr-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-teal-600 text-white font-black py-4 rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 text-lg">
                            {{ __('Send Message') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>