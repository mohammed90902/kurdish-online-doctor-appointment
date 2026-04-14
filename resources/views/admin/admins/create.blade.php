<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.admins.index') }}" class="p-2 bg-white/50 hover:bg-white rounded-xl shadow-sm transition-all text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Add New Admin') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card shadow-2xl rounded-3xl overflow-hidden animate-fade-in-up">
                <div class="p-8 md:p-12">
                    <form method="POST" action="{{ route('admin.admins.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 gap-8">
                            <!-- Name -->
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">{{ __('Name') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" required 
                                    class="w-full rounded-2xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm py-4 px-6 transition-all"
                                    placeholder="{{ __('Enter full name') }}">
                                @error('name') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">{{ __('Email') }} <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" required 
                                    class="w-full rounded-2xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm py-4 px-6 transition-all"
                                    placeholder="example@mail.com">
                                @error('email') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">{{ __('Phone Number') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="phone" value="{{ old('phone') }}" required 
                                    class="w-full rounded-2xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm py-4 px-6 transition-all font-mono"
                                    placeholder="0750xxxxxxx">
                                @error('phone') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Password -->
                                <div>
                                    <label class="block text-gray-700 font-bold mb-2">{{ __('Password') }} <span class="text-red-500">*</span></label>
                                    <input type="password" name="password" required 
                                        class="w-full rounded-2xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm py-4 px-6 transition-all"
                                        placeholder="********">
                                    @error('password') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label class="block text-gray-700 font-bold mb-2">{{ __('Confirm Password') }} <span class="text-red-500">*</span></label>
                                    <input type="password" name="password_confirmation" required 
                                        class="w-full rounded-2xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm py-4 px-6 transition-all"
                                        placeholder="********">
                                </div>
                            </div>
                        </div>

                        <div class="mt-12">
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-indigo-700 hover:to-blue-600 py-4 rounded-2xl text-white font-extrabold text-lg shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                {{ __('Save Admin') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
