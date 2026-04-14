<!-- Doctor Registration Form -->
<x-guest-layout>
    <!-- Title -->
    <div class="text-center mb-6">
        <h2 class="text-3xl font-bold bg-gradient-to-r from-teal-600 to-blue-600 bg-clip-text text-transparent mb-2">
            تۆمارکردنی پزیشک
        </h2>
        <p class="text-gray-600 text-sm">تکایە زانیارییەکانت پڕبکەرەوە</p>
    </div>

    @if($errors->any())
        <div class="mb-6 glass-card bg-red-50 border-l-4 border-red-500 p-4 rounded-xl">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 text-red-500 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="font-bold text-red-800">هەڵەکان:</h3>
            </div>
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('doctor.register.submit') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <!-- Personal Information -->
        <div class="space-y-4">
            <!-- Names Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="name_ku" value="Doctor Name (Kurdish)" />
                    <x-text-input id="name_ku" class="block mt-1 w-full" type="text" name="name_ku" :value="old('name_ku')" required />
                    <x-input-error :messages="$errors->get('name_ku')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="name_ar" value="Doctor Name (Arabic)" />
                    <x-text-input id="name_ar" class="block mt-1 w-full" type="text" name="name_ar" :value="old('name_ar')" required />
                    <x-input-error :messages="$errors->get('name_ar')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="name_en" value="Doctor Name (English)" />
                    <x-text-input id="name_en" class="block mt-1 w-full" type="text" name="name_en" :value="old('name_en')" required />
                    <x-input-error :messages="$errors->get('name_en')" class="mt-2" />
                </div>
            </div>

            <!-- Email & Phone Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="email" value="ئیمەیڵ" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="phone" value="تەلەفۆن" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
            </div>

            <!-- Password Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="password" value="وشەی نهێنی" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" value="پشتڕاستکردنەوە" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Professional Information -->
        <div class="pt-4 border-t border-gray-200 space-y-4">
            <h3 class="font-bold text-gray-800 text-lg">زانیاری پیشەیی</h3>
            
            <!-- Specialization -->
            <div>
                <x-input-label for="specialization_id" value="پسپۆڕی" />
                <select id="specialization_id" name="specialization_id" class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 rounded-xl shadow-sm px-4 py-3 transition-all duration-300 bg-white/80 hover:bg-white" required>
                    <option value="">پسپۆڕی هەڵبژێرە</option>
                    @foreach($specializations as $spec)
                        <option value="{{ $spec->id }}" {{ old('specialization_id') == $spec->id ? 'selected' : '' }}>
                            {{ $spec->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('specialization_id')" class="mt-2" />
            </div>

            <!-- License & Experience Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="license_number" value="ژمارەی مۆڵەت" />
                    <x-text-input id="license_number" class="block mt-1 w-full" type="text" name="license_number" :value="old('license_number')" required />
                    <x-input-error :messages="$errors->get('license_number')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="experience_years" value="ساڵانی ئەزموون" />
                    <x-text-input id="experience_years" class="block mt-1 w-full" type="number" name="experience_years" :value="old('experience_years')" required min="0" />
                    <x-input-error :messages="$errors->get('experience_years')" class="mt-2" />
                </div>
            </div>

            <!-- Consultation Fee -->
            <div>
                <x-input-label for="consultation_fee" value="کرێی چاوپێکەوتن (IQD)" />
                <x-text-input id="consultation_fee" class="block mt-1 w-full" type="number" name="consultation_fee" :value="old('consultation_fee')" required min="0" step="1000" />
                <x-input-error :messages="$errors->get('consultation_fee')" class="mt-2" />
            </div>

            <!-- Qualifications -->
            <div>
                <x-input-label for="qualifications" value="بڕوانامەکان" />
                <textarea id="qualifications" name="qualifications" class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 rounded-xl shadow-sm px-4 py-3 transition-all duration-300 bg-white/80 hover:bg-white" rows="3" required>{{ old('qualifications') }}</textarea>
                <x-input-error :messages="$errors->get('qualifications')" class="mt-2" />
            </div>

            <!-- Bio (Optional) -->
            <div>
                <x-input-label for="bio" value="باسی کەسی (ئارەزوومەندانە)" />
                <textarea id="bio" name="bio" class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 rounded-xl shadow-sm px-4 py-3 transition-all duration-300 bg-white/80 hover:bg-white" rows="3">{{ old('bio') }}</textarea>
                <x-input-error :messages="$errors->get('bio')" class="mt-2" />
            </div>

            <!-- Profile Image -->
            <div>
                <x-input-label for="profile_image" value="وێنەی پزیشک (ئارەزوومەندانە)" />
                <input id="profile_image" name="profile_image" type="file" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                <x-input-error :messages="$errors->get('profile_image')" class="mt-2" />
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <x-primary-button class="w-full justify-center text-center">
                تۆمارکردن
            </x-primary-button>
        </div>

        <!-- Login Links -->
        <div class="text-center pt-4 border-t border-gray-200 space-y-2">
            <p class="text-sm text-gray-600">
                پێشتر تۆمارکراوی؟ 
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-bold transition-colors duration-300">
                    چوونە ژوورەوە
                </a>
            </p>
            <p class="text-sm text-gray-600">
                تۆمارکردن وەک نەخۆش؟ 
                <a href="{{ route('register') }}" class="text-teal-600 hover:text-teal-800 font-bold transition-colors duration-300">
                    کلیک لێرە بکە
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>