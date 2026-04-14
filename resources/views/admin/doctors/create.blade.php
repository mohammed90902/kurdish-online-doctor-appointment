<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Add New Doctor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="mb-6">
                <a href="{{ route('admin.doctors.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 font-bold transition-colors">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                    {{ __('Back to Doctors') }}
                </a>
            </div>

            @if($errors->any())
                <div class="glass-card bg-red-100/80 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-xl mb-6 shadow-lg animate-slideDown">
                    <div class="font-bold mb-2">{{ __('Please fix errors:') }}</div>
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.doctors.store') }}" enctype="multipart/form-data" class="space-y-8 animate-fade-in-up">
                @csrf

                <!-- Account Info -->
                <div class="glass-card overflow-hidden shadow-xl rounded-2xl">
                    <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex items-center">
                        <span class="p-2 bg-blue-100 text-blue-600 rounded-lg ml-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </span>
                        <h3 class="text-xl font-bold text-gray-800">{{ __('User Information') }}</h3>
                    </div>
                    
                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name (Kurdish) -->
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-gray-700 font-bold mb-2" for="name_ku">{{ __('Name') }} ({{ __('Kurdish') }}) <span class="text-red-500">*</span></label>
                            <input type="text" id="name_ku" name="name_ku" value="{{ old('name_ku') }}" required
                                class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all py-3 px-4">
                        </div>

                        <!-- Name (Arabic) -->
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-gray-700 font-bold mb-2" for="name_ar">{{ __('Name') }} ({{ __('Arabic') }})</label>
                            <input type="text" id="name_ar" name="name_ar" value="{{ old('name_ar') }}" 
                                class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all py-3 px-4">
                        </div>

                        <!-- Name (English) -->
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-gray-700 font-bold mb-2" for="name_en">{{ __('Name') }} ({{ __('English') }})</label>
                            <input type="text" id="name_en" name="name_en" value="{{ old('name_en') }}" 
                                class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all py-3 px-4">
                        </div>

                        <!-- Email -->
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-gray-700 font-bold mb-2" for="email">{{ __('Email') }} <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                                class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all py-3 px-4">
                        </div>

                        <!-- Phone -->
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-gray-700 font-bold mb-2" for="phone">{{ __('Phone') }} <span class="text-red-500">*</span></label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required 
                                class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all py-3 px-4 dir-ltr text-right" placeholder="0750xxxxxxx">
                        </div>

                        <!-- Password -->
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-gray-700 font-bold mb-2" for="password">{{ __('Password') }} <span class="text-red-500">*</span></label>
                            <input type="password" id="password" name="password" required 
                                class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all py-3 px-4"
                                placeholder="{{ __('Minimum 8 characters') }}">
                            <p class="text-xs text-gray-500 mt-1">{{ __('Note: Give this password to the doctor') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Professional Info -->
                <div class="glass-card overflow-hidden shadow-xl rounded-2xl">
                    <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex items-center">
                        <span class="p-2 bg-indigo-100 text-indigo-600 rounded-lg ml-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </span>
                        <h3 class="text-xl font-bold text-gray-800">{{ __('Professional Info') }}</h3>
                    </div>
                    
                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Specialization -->
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-gray-700 font-bold mb-2" for="specialization_id">{{ __('Specialist') }} <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select id="specialization_id" name="specialization_id" required 
                                    class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all py-3 px-4 appearance-none">
                                    <option value="">{{ __('Select Specialization') }}</option>
                                    @foreach($specializations as $spec)
                                        <option value="{{ $spec->id }}" {{ old('specialization_id') == $spec->id ? 'selected' : '' }}>
                                            {{ $spec->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-4 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>

                        <!-- License Number -->
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-gray-700 font-bold mb-2" for="license_number">{{ __('License Number') }} <span class="text-red-500">*</span></label>
                            <input type="text" id="license_number" name="license_number" value="{{ old('license_number') }}" required 
                                class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all py-3 px-4">
                        </div>

                        <!-- Experience Years -->
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-gray-700 font-bold mb-2" for="experience_years">{{ __('Experience Years') }} <span class="text-red-500">*</span></label>
                            <input type="number" id="experience_years" name="experience_years" value="{{ old('experience_years') }}" required min="0" 
                                class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all py-3 px-4">
                        </div>

                        <!-- Consultation Fee -->
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-gray-700 font-bold mb-2" for="consultation_fee">{{ __('Consultation Fee (IQD)') }} <span class="text-red-500">*</span></label>
                            <input type="number" id="consultation_fee" name="consultation_fee" value="{{ old('consultation_fee') }}" required min="0" step="1000" 
                                class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all py-3 px-4">
                        </div>

                        <!-- Qualifications -->
                        <div class="col-span-2">
                            <label class="block text-gray-700 font-bold mb-2" for="qualifications">{{ __('Qualifications') }} <span class="text-red-500">*</span></label>
                            <textarea id="qualifications" name="qualifications" rows="3" required 
                                class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all py-3 px-4"
                                placeholder="{{ __('Doctor qualifications short...') }}">{{ old('qualifications') }}</textarea>
                        </div>

                        <!-- Bio -->
                        <div class="col-span-2">
                            <label class="block text-gray-700 font-bold mb-2" for="bio">{{ __('Bio (Optional)') }}</label>
                            <textarea id="bio" name="bio" rows="4" 
                                class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all py-3 px-4"
                                placeholder="{{ __('Short bio about doctor...') }}">{{ old('bio') }}</textarea>
                        </div>

                        <!-- Profile Image -->
                        <div class="col-span-2">
                            <label class="block text-gray-700 font-bold mb-2" for="profile_image">{{ __('Doctor Profile Image (Optional)') }}</label>
                            <input type="file" id="profile_image" name="profile_image" 
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.doctors.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition font-bold shadow-sm">
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 font-bold flex items-center shadow-md">
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        {{ __('Save Doctor') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
