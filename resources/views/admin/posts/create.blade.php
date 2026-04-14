<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Publish New Post') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 font-bold transition-colors">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                    {{ __('Back to Dashboard') }}
                </a>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-2xl mb-6 shadow-sm font-bold animate-shake">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="glass-card bg-white rounded-[2rem] shadow-2xl p-8 md:p-12 border border-gray-100 animate-fade-in">
                <div class="flex items-center gap-4 mb-10 border-b border-gray-100 pb-6">
                    <div class="p-4 bg-indigo-50 text-indigo-600 rounded-2xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-gray-800">{{ __('Publish New Post') }}</h3>
                        <p class="text-gray-500 font-medium">{{ __('Publish Post Note') }}</p>
                    </div>
                </div>

                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    <div class="space-y-6">
                        <div x-data="{ activeTab: 'ku' }">
                            <div class="flex space-x-4 space-x-reverse mb-6 border-b border-gray-200">
                                <button type="button" @click="activeTab = 'ku'" :class="{'border-blue-500 text-blue-600': activeTab === 'ku', 'border-transparent text-gray-500 cursor-pointer hover:text-gray-700': activeTab !== 'ku'}" class="py-2 px-4 border-b-2 font-bold text-lg">{{ __('Kurdish (Main)') }}</button>
                                <button type="button" @click="activeTab = 'ar'" :class="{'border-blue-500 text-blue-600': activeTab === 'ar', 'border-transparent text-gray-500 cursor-pointer hover:text-gray-700': activeTab !== 'ar'}" class="py-2 px-4 border-b-2 font-bold text-lg">{{ __('Arabic') }}</button>
                                <button type="button" @click="activeTab = 'en'" :class="{'border-blue-500 text-blue-600': activeTab === 'en', 'border-transparent text-gray-500 cursor-pointer hover:text-gray-700': activeTab !== 'en'}" class="py-2 px-4 border-b-2 font-bold text-lg" dir="ltr">{{ __('English') }}</button>
                            </div>

                            <!-- Kurdish -->
                            <div x-show="activeTab === 'ku'" class="space-y-6">
                                <div>
                                    <label class="block text-lg font-bold text-gray-700 mb-2">{{ __('Post Title (Kurdish)') }}</label>
                                    <input type="text" name="title_ku" required 
                                        class="w-full rounded-2xl border-gray-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 py-4 px-6 text-lg transition-all" 
                                        placeholder="{{ __('Example for users') }}">
                                </div>
                                <div>
                                    <label class="block text-lg font-bold text-gray-700 mb-2">{{ __('Post Content (Kurdish)') }}</label>
                                    <textarea name="content_ku" rows="8" required 
                                        class="w-full rounded-2xl border-gray-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 py-4 px-6 text-lg transition-all" 
                                        placeholder="{{ __('Write info here') }}"></textarea>
                                </div>
                            </div>

                            <!-- Arabic -->
                            <div x-show="activeTab === 'ar'" class="space-y-6" style="display: none;">
                                <div>
                                    <label class="block text-lg font-bold text-gray-700 mb-2">{{ __('Post Title (Arabic)') }}</label>
                                    <input type="text" name="title_ar" 
                                        class="w-full rounded-2xl border-gray-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 py-4 px-6 text-lg transition-all" 
                                        placeholder="{{ __('Example for users') }}" dir="rtl">
                                </div>
                                <div>
                                    <label class="block text-lg font-bold text-gray-700 mb-2">{{ __('Post Content (Arabic)') }}</label>
                                    <textarea name="content_ar" rows="8" 
                                        class="w-full rounded-2xl border-gray-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 py-4 px-6 text-lg transition-all" 
                                        placeholder="{{ __('Write info here') }}" dir="rtl"></textarea>
                                </div>
                            </div>

                            <!-- English -->
                            <div x-show="activeTab === 'en'" class="space-y-6" style="display: none;">
                                <div>
                                    <label class="block text-lg font-bold text-gray-700 mb-2">{{ __('Post Title (English)') }}</label>
                                    <input type="text" name="title_en" 
                                        class="w-full rounded-2xl border-gray-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 py-4 px-6 text-lg transition-all" 
                                        placeholder="{{ __('Example for users') }}" dir="ltr">
                                </div>
                                <div>
                                    <label class="block text-lg font-bold text-gray-700 mb-2">{{ __('Post Content (English)') }}</label>
                                    <textarea name="content_en" rows="8" 
                                        class="w-full rounded-2xl border-gray-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 py-4 px-6 text-lg transition-all" 
                                        placeholder="{{ __('Write info here') }}" dir="ltr"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Image Upload (Applies to all languages) -->
                        <div>
                            <label class="block text-lg font-bold text-gray-700 mb-2">{{ __('Post Image') }}</label>
                            <div class="relative group">
                                <input type="file" name="image" id="post_image" class="hidden" onchange="previewImage(this)">
                                <label for="post_image" class="flex flex-col items-center justify-center border-4 border-dashed border-gray-200 rounded-3xl p-10 cursor-pointer group-hover:border-blue-400 group-hover:bg-blue-50 transition-all">
                                    <div id="image_placeholder" class="text-center">
                                        <svg class="w-16 h-16 text-gray-400 mb-4 mx-auto group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-gray-500 font-bold">{{ __('Click to upload image') }}</p>
                                        <p class="text-xs text-gray-400 mt-2">{{ __('PNG, JPG under 2MB') }}</p>
                                    </div>
                                    <img id="image_preview" class="hidden w-full max-h-[300px] object-contain rounded-2xl shadow-lg">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-6">
                        <button type="submit" class="group relative px-12 py-5 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-2xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 font-black text-xl flex items-center overflow-hidden">
                            <span class="relative z-10 flex items-center">
                                {{ __('Save Post') }}
                                <svg class="w-6 h-6 mr-3 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </span>
                            <div class="absolute inset-0 bg-white/20 transform skew-x-12 translate-x-full group-hover:translate-x-[-100%] transition-transform duration-700"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image_preview').src = e.target.result;
                    document.getElementById('image_preview').classList.remove('hidden');
                    document.getElementById('image_placeholder').classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
    </style>
</x-app-layout>
