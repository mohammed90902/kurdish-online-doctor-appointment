<section>
    <header>
        <h2 class="text-xl font-bold text-gray-800">
            زانیاری پرۆفایل
        </h2>

        <p class="mt-2 text-sm text-gray-600">
            زانیاری پرۆفایل و ئیمەیڵی هەژمارەکەت نوێ بکەوە.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="name_ku" :value="__('Name') . ' (' . __('Kurdish') . ')' " />
                <x-text-input id="name_ku" name="name_ku" type="text" class="mt-1 block w-full" :value="old('name_ku', $user->name_ku)" required autocomplete="name_ku" />
                <x-input-error class="mt-2" :messages="$errors->get('name_ku')" />
            </div>

            <div>
                <x-input-label for="name_ar" :value="__('Name') . ' (' . __('Arabic') . ')' " />
                <x-text-input id="name_ar" name="name_ar" type="text" class="mt-1 block w-full" :value="old('name_ar', $user->name_ar)" autocomplete="name_ar" />
                <x-input-error class="mt-2" :messages="$errors->get('name_ar')" />
            </div>

            <div>
                <x-input-label for="name_en" :value="__('Name') . ' (' . __('English') . ')' " />
                <x-text-input id="name_en" name="name_en" type="text" class="mt-1 block w-full" :value="old('name_en', $user->name_en)" autocomplete="name_en" />
                <x-input-error class="mt-2" :messages="$errors->get('name_en')" />
            </div>


            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        @if($user->isDoctor())
            <div class="border-t border-gray-100 pt-8 mt-8">
                <h3 class="text-lg font-bold text-gray-800 mb-6">زانیاری پسپۆڕی پزیشک</h3>
                
                <!-- Profile Image -->
                <div class="flex items-center gap-6 mb-8">
                    <div class="relative group">
                        <div class="w-32 h-32 rounded-3xl overflow-hidden bg-gray-100 border-4 border-white shadow-xl">
                            @if($user->doctorProfile && $user->doctorProfile->profile_image)
                                <img id="image_preview" src="{{ asset('storage/' . $user->doctorProfile->profile_image) }}" class="w-full h-full object-cover">
                            @else
                                <div id="image_placeholder" class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <label for="profile_image" class="absolute -bottom-2 -right-2 bg-blue-600 text-white p-2 rounded-xl cursor-pointer hover:bg-blue-700 transition shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <input type="file" id="profile_image" name="profile_image" class="hidden" accept="image/*" onchange="previewProfileImage(this)">
                        </label>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-gray-800">وێنەی پرۆفایل</h4>
                        <p class="text-xs text-gray-500 mt-1">وێنەیەک هەڵبژێرە کە لە وردەکاری پزیشک و پۆستەکانت نیشان دەدرێت.</p>
                    </div>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Specialization -->
                    <div>
                        <x-input-label for="specialization_id" :value="'پسپۆڕی'" />
                        <select id="specialization_id" name="specialization_id" class="mt-1 block w-full border-gray-100 bg-gray-50 rounded-xl focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all py-3">
                            @foreach($specializations as $specialization)
                                <option value="{{ $specialization->id }}" {{ old('specialization_id', $user->doctorProfile->specialization_id ?? '') == $specialization->id ? 'selected' : '' }}>
                                    {{ $specialization->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('specialization_id')" />
                    </div>

                    <!-- Experience Years -->
                    <div>
                        <x-input-label for="experience_years" :value="'ساڵانی ئەزموون'" />
                        <x-text-input id="experience_years" name="experience_years" type="number" class="mt-1 block w-full" :value="old('experience_years', $user->doctorProfile->experience_years ?? 0)" required min="0" />
                        <x-input-error class="mt-2" :messages="$errors->get('experience_years')" />
                    </div>

                    <!-- Consultation Fee -->
                    <div>
                        <x-input-label for="consultation_fee" :value="'کرێی بینین (دینار)'" />
                        <x-text-input id="consultation_fee" name="consultation_fee" type="number" step="0.01" class="mt-1 block w-full" :value="old('consultation_fee', $user->doctorProfile->consultation_fee ?? 0)" required min="0" />
                        <x-input-error class="mt-2" :messages="$errors->get('consultation_fee')" />
                    </div>
                </div>

                <!-- Bio -->
                <div class="mt-6">
                    <x-input-label for="bio" :value="'کورتەیەک دەربارەی پزیشک'" />
                    <textarea id="bio" name="bio" class="mt-1 block w-full border-gray-100 bg-gray-50 rounded-xl focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all p-3" rows="4">{{ old('bio', $user->doctorProfile->bio ?? '') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                </div>
            </div>

            <script>
                function previewProfileImage(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            const preview = document.getElementById('image_preview');
                            if (preview) {
                                preview.src = e.target.result;
                            } else {
                                const placeholder = document.getElementById('image_placeholder');
                                if (placeholder) {
                                    const img = document.createElement('img');
                                    img.id = 'image_preview';
                                    img.src = e.target.result;
                                    img.className = 'w-full h-full object-cover';
                                    placeholder.parentNode.replaceChild(img, placeholder);
                                }
                            }
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>
        @endif

        <div class="flex items-center gap-4 border-t border-gray-50 pt-6">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
