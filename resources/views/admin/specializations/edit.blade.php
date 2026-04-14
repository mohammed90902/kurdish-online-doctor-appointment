<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Section') }} {{ $specialization->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Back Button -->
            <div class="mb-8">
                <a href="{{ route('admin.specializations.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-bold transition-all duration-300 group">
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                    {{ __('Back to Sections') }}
                </a>
            </div>

            @if($errors->any())
                <div class="glass-card bg-red-50 border-r-4 border-red-500 text-red-700 px-6 py-4 rounded-2xl mb-8 shadow-lg animate-shake">
                    <div class="flex items-center gap-3 mb-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-black text-lg">{{ __('Please fix errors:') }}</span>
                    </div>
                    <ul class="list-disc list-inside mr-9 font-medium">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Card -->
            <div class="glass-card overflow-hidden shadow-2xl rounded-[2.5rem] bg-white border border-gray-100 animate-slideUp">
                <div class="p-8 md:p-12">
                    <div class="flex items-center gap-4 mb-10 border-b border-gray-100 pb-8">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg transform -rotate-3 group-hover:rotate-0 transition-transform duration-500">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-gray-800">{{ __('Edit Information') }}</h3>
                            <p class="text-gray-500 font-bold">{{ __('Updating info for section') }} {{ $specialization->name }}</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.specializations.update', $specialization->id) }}" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PATCH')

                        <div x-data="{ activeTab: 'ku' }">
                            <div class="flex space-x-4 space-x-reverse mb-8 border-b border-gray-100">
                                <button type="button" @click="activeTab = 'ku'" :class="{'border-blue-500 text-blue-600': activeTab === 'ku', 'border-transparent text-gray-500 cursor-pointer hover:text-gray-700': activeTab !== 'ku'}" class="py-3 px-6 border-b-2 font-bold text-lg transition-colors">{{ __('Kurdish (Main)') }}</button>
                                <button type="button" @click="activeTab = 'ar'" :class="{'border-blue-500 text-blue-600': activeTab === 'ar', 'border-transparent text-gray-500 cursor-pointer hover:text-gray-700': activeTab !== 'ar'}" class="py-3 px-6 border-b-2 font-bold text-lg transition-colors">{{ __('Arabic') }}</button>
                                <button type="button" @click="activeTab = 'en'" :class="{'border-blue-500 text-blue-600': activeTab === 'en', 'border-transparent text-gray-500 cursor-pointer hover:text-gray-700': activeTab !== 'en'}" class="py-3 px-6 border-b-2 font-bold text-lg transition-colors" dir="ltr">{{ __('English') }}</button>
                            </div>

                            <!-- Kurdish -->
                            <div x-show="activeTab === 'ku'" class="space-y-6">
                                <div class="space-y-4">
                                    <label class="block text-xl font-bold text-gray-800 flex items-center gap-2">
                                        <span class="w-1.5 h-6 bg-blue-500 rounded-full"></span>
                                        {{ __('Section Name (Kurdish)') }}
                                    </label>
                                    <input type="text" name="name_ku" value="{{ old('name_ku', $specialization->name_ku) }}" required class="w-full border-gray-100 rounded-[1.5rem] bg-gray-50/50 py-5 px-6 text-lg font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                                </div>
                                <div class="space-y-4">
                                    <label class="block text-xl font-bold text-gray-800 flex items-center gap-2">
                                        <span class="w-1.5 h-6 bg-indigo-500 rounded-full"></span>
                                        {{ __('Description (Kurdish)') }}
                                    </label>
                                    <textarea name="description_ku" rows="4" class="w-full border-gray-100 rounded-[1.5rem] bg-gray-50/50 py-5 px-6 text-lg font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all">{{ old('description_ku', $specialization->description_ku) }}</textarea>
                                </div>
                            </div>

                            <!-- Arabic -->
                            <div x-show="activeTab === 'ar'" class="space-y-6" style="display: none;">
                                <div class="space-y-4">
                                    <label class="block text-xl font-bold text-gray-800 flex items-center gap-2">
                                        <span class="w-1.5 h-6 bg-blue-500 rounded-full"></span>
                                        {{ __('Section Name (Arabic)') }}
                                    </label>
                                    <input type="text" name="name_ar" value="{{ old('name_ar', $specialization->name_ar) }}" dir="rtl" class="w-full border-gray-100 rounded-[1.5rem] bg-gray-50/50 py-5 px-6 text-lg font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                                </div>
                                <div class="space-y-4">
                                    <label class="block text-xl font-bold text-gray-800 flex items-center gap-2">
                                        <span class="w-1.5 h-6 bg-indigo-500 rounded-full"></span>
                                        {{ __('Description (Arabic)') }}
                                    </label>
                                    <textarea name="description_ar" rows="4" dir="rtl" class="w-full border-gray-100 rounded-[1.5rem] bg-gray-50/50 py-5 px-6 text-lg font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all">{{ old('description_ar', $specialization->description_ar) }}</textarea>
                                </div>
                            </div>

                            <!-- English -->
                            <div x-show="activeTab === 'en'" class="space-y-6" style="display: none;">
                                <div class="space-y-4">
                                    <label class="block text-xl font-bold text-gray-800 flex items-center gap-2">
                                        <span class="w-1.5 h-6 bg-blue-500 rounded-full"></span>
                                        {{ __('Section Name (English)') }}
                                    </label>
                                    <input type="text" name="name_en" value="{{ old('name_en', $specialization->name_en) }}" dir="ltr" class="w-full border-gray-100 rounded-[1.5rem] bg-gray-50/50 py-5 px-6 text-lg font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                                </div>
                                <div class="space-y-4">
                                    <label class="block text-xl font-bold text-gray-800 flex items-center gap-2">
                                        <span class="w-1.5 h-6 bg-indigo-500 rounded-full"></span>
                                        {{ __('Description (English)') }}
                                    </label>
                                    <textarea name="description_en" rows="4" dir="ltr" class="w-full border-gray-100 rounded-[1.5rem] bg-gray-50/50 py-5 px-6 text-lg font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all">{{ old('description_en', $specialization->description_en) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="space-y-4">
                            <label class="block text-xl font-bold text-gray-800 flex items-center gap-2">
                                <span class="w-1.5 h-6 bg-purple-500 rounded-full"></span>
                                {{ __('Section Image') }}
                            </label>
                            <div class="relative group">
                                <div id="drop-area" class="w-full h-48 border-4 border-dashed border-gray-100 rounded-[2rem] bg-gray-50/30 flex flex-col items-center justify-center transition-all group-hover:bg-purple-50 group-hover:border-purple-200 cursor-pointer overflow-hidden">
                                    <div id="preview-container" class="{{ $specialization->image ? '' : 'hidden' }} w-full h-full relative">
                                        <img id="preview-image" src="{{ $specialization->image ? asset('storage/' . $specialization->image) : '#' }}" class="w-full h-full object-cover">
                                        <button type="button" onclick="resetImage()" class="absolute top-4 left-4 bg-red-500 text-white p-2 rounded-xl shadow-lg hover:bg-red-600 transition-colors">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div id="upload-instruction" class="{{ $specialization->image ? 'hidden' : '' }} flex flex-col items-center text-center px-6">
                                        <div class="w-16 h-16 bg-white rounded-2xl shadow-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-500">
                                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-gray-600 font-black">{{ __('Change Image') }}</p>
                                    </div>
                                </div>
                                <input type="file" name="image" id="image-input" class="hidden" accept="image/*" onchange="previewImage(this)">
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-8 flex gap-4">
                            <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-5 px-8 rounded-[1.5rem] text-xl font-black shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                                {{ __('Update Section') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.getElementById('preview-image');
                    const previewContainer = document.getElementById('preview-container');
                    const uploadInstruction = document.getElementById('upload-instruction');
                    const dropArea = document.getElementById('drop-area');

                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    uploadInstruction.classList.add('hidden');
                    dropArea.style.border = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function resetImage() {
            const input = document.getElementById('image-input');
            const previewContainer = document.getElementById('preview-container');
            const uploadInstruction = document.getElementById('upload-instruction');
            const dropArea = document.getElementById('drop-area');

            input.value = '';
            previewContainer.classList.add('hidden');
            uploadInstruction.classList.remove('hidden');
            dropArea.style.borderStyle = 'dashed';
            dropArea.style.borderWidth = '4px';
        }

        document.getElementById('drop-area').onclick = function() {
            document.getElementById('image-input').click();
        }
    </script>
</x-app-layout>
