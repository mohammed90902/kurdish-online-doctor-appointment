<x-guest-layout>
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 font-bold transition-colors group">
            <svg class="w-5 h-5 ml-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
            گەڕانەوە بۆ سەرەکی
        </a>
    </div>

    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-teal-600 bg-clip-text text-transparent mb-2">
            پاسۆردت بیرچووە؟
        </h2>
        <p class="text-gray-600 text-sm leading-relaxed">
            هیچ کێشە نییە. تەنها ئیمەیڵەکەت بنووسە و ئێمە لینکێکی گۆڕینی پاسۆردت بۆ دەنێرین کە ڕێگەت دەدات پاسۆردێکی نوێ هەڵبژێریت.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('ئیمەیڵ')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center">
                {{ __('ناردنی لینکی گۆڕین') }}
            </x-primary-button>
        </div>

        <div class="text-center pt-4 border-t border-gray-200">
            <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-800 font-bold transition-colors duration-300">
                گەڕانەوە بۆ چوونەژوورەوە
            </a>
        </div>
    </form>
</x-guest-layout>
