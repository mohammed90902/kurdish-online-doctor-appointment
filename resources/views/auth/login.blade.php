<x-guest-layout>
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 font-bold transition-colors group">
            <svg class="w-5 h-5 ml-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
            {{ __('Back to Main') }}
        </a>
    </div>

    <!-- Login Title -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-teal-600 bg-clip-text text-transparent mb-2">
            {{ __('Login') }}
        </h2>
        <p class="text-gray-600">{{ __('Welcome Back') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="{{ __('Email Address') }}" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="example@gmail.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="{{ __('Password') }}" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        
        <!-- Login Button -->
        <div class="pt-2">
            <x-primary-button class="w-full justify-center text-center font-black text-lg py-3">
                {{ __('Login') }}
            </x-primary-button>
        </div>

        <!-- Register Link -->
        <div class="text-center pt-4 border-t border-gray-200">
            <p class="text-sm text-gray-600 font-bold">
                {{ __('Register Link') }} 
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-black transition-colors duration-300 underline">
                    {{ __('Register Here') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
