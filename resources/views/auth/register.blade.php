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

    <!-- Registration Title -->
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-teal-600 bg-clip-text text-transparent mb-2">
            {{ __('Register') }}
        </h2>
        <p class="text-gray-600">{{ __('Patient Dashboard Welcome') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="{{ __('Full Name') }}" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="ناوەکەت لێرە بنووسە" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" value="{{ __('Email Address') }}" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="example@gmail.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" value="{{ __('Phone Number') }}" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required placeholder="07XX XXX XX XX" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Two Column Grid for Date/Gender -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Date of Birth -->
            <div>
                <x-input-label for="date_of_birth" value="{{ __('Date of Birth') }}" />
                <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth')" required />
                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
            </div>

            <!-- Gender -->
            <div>
                <x-input-label for="gender" value="ڕەگەز" />
                <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 rounded-xl shadow-sm px-4 py-3 transition-all duration-300 bg-white/80 hover:bg-white font-bold" required>
                    <option value="">{{ __('Select') }}</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>
        </div>

        <!-- Blood Group -->
        <div>
            <x-input-label for="blood_group" value="{{ __('Blood Group (Optional)') }}" />
            <select id="blood_group" name="blood_group" class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 rounded-xl shadow-sm px-4 py-3 transition-all duration-300 bg-white/80 hover:bg-white font-bold">
                <option value="">{{ __('Select') }}</option>
                <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
                <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
                <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+</option>
                <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-</option>
                <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+</option>
                <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-</option>
                <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+</option>
                <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-</option>
            </select>
            <x-input-error :messages="$errors->get('blood_group')" class="mt-2" />
        </div>

        <!-- Password Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" value="{{ __('Password') }}" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex flex-col gap-4 mt-8">
            <x-primary-button class="w-full justify-center text-center font-black text-lg py-3">
                {{ __('Register') }}
            </x-primary-button>

            <a class="text-sm text-gray-600 font-bold hover:text-gray-900 text-center transition-colors underline" href="{{ route('login') }}">
                {{ __('Already have account?') }}
            </a>
        </div>
    </form>
</x-guest-layout>