
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Add New Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
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

            <!-- Info Alert -->
            <div class="glass-card bg-blue-50 border-r-4 border-blue-500 text-blue-800 px-6 py-4 rounded-2xl mb-8 shadow-sm flex items-start gap-4 animate-fadeIn">
                <div class="mt-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-lg mb-1">{{ __('Note') }}</p>
                    <p class="text-sm opacity-90 leading-relaxed font-medium">
                        {{ __('Determine how many patients can book in each slot.') }}
                    </p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="glass-card overflow-hidden shadow-2xl rounded-[2.5rem] bg-white border border-gray-100 animate-slideUp">
                <div class="p-8 md:p-12">
                    <div class="flex items-center gap-4 mb-10 border-b border-gray-100 pb-8">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow-lg transform -rotate-3 group-hover:rotate-0 transition-transform duration-500">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-gray-800">{{ __('Section Information') }}</h3>
                            <p class="text-gray-500 font-bold">{{ __('Please fill info carefully') }}</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('doctor.schedules.store') }}" class="space-y-10">
                        @csrf

                        <!-- Day Selector -->
                        <div class="space-y-4">
                            <label class="block text-xl font-bold text-gray-800 flex items-center gap-2">
                                <span class="w-1.5 h-6 bg-green-500 rounded-full"></span>
                                {{ __('Date') }}
                            </label>
                            <div class="relative group">
                                <select name="day_of_week" required class="w-full border-gray-100 rounded-[1.5rem] bg-gray-50/50 py-5 pr-14 pl-6 text-lg font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-green-500/10 focus:border-green-500 transition-all appearance-none cursor-pointer">
                                    <option value="" class="text-gray-400">{{ __('Select') }}</option>
                                    @foreach($upcomingDays as $day)
                                        <option value="{{ $day['name'] }}" {{ old('day_of_week') == $day['name'] ? 'selected' : '' }}>
                                            {{ __($day['name']) }} ({{ $day['date'] }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-5 pointer-events-none text-gray-400 group-hover:text-green-500 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Time Grid -->
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <label class="block text-xl font-bold text-gray-800 flex items-center gap-2">
                                    <span class="w-1.5 h-6 bg-blue-500 rounded-full"></span>
                                    {{ __('Start Time') }}
                                </label>
                                <div class="relative group">
                                    <input type="time" name="start_time" value="{{ old('start_time') }}" required 
                                        class="w-full border-gray-100 rounded-[1.5rem] bg-gray-50/50 py-5 pr-14 pl-6 text-lg font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all cursor-pointer">
                                    <div class="absolute inset-y-0 right-0 flex items-center px-5 pointer-events-none text-gray-400 group-hover:text-blue-500 transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <label class="block text-xl font-bold text-gray-800 flex items-center gap-2">
                                    <span class="w-1.5 h-6 bg-red-500 rounded-full"></span>
                                    {{ __('End Time') }}
                                </label>
                                <div class="relative group">
                                    <input type="time" name="end_time" value="{{ old('end_time') }}" required 
                                        class="w-full border-gray-100 rounded-[1.5rem] bg-gray-50/50 py-5 pr-14 pl-6 text-lg font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-red-500/10 focus:border-red-500 transition-all cursor-pointer">
                                    <div class="absolute inset-y-0 right-0 flex items-center px-5 pointer-events-none text-gray-400 group-hover:text-red-500 transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Capacity Slider-like Input -->
                        <div class="space-y-4">
                            <label class="block text-xl font-bold text-gray-800 flex items-center gap-2">
                                <span class="w-1.5 h-6 bg-amber-500 rounded-full"></span>
                                {{ __('Patients') }}
                            </label>
                            <div class="relative group">
                                <input type="number" name="max_patients" value="{{ old('max_patients', 1) }}" min="1" max="50" required 
                                    class="w-full border-gray-100 rounded-[1.5rem] bg-gray-50/50 py-5 pr-14 pl-6 text-lg font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all">
                                <div class="absolute inset-y-0 right-0 flex items-center px-5 pointer-events-none text-gray-400 group-hover:text-amber-500 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 font-bold mr-4">{{ __('Determine how many patients can book in each slot.') }}</p>
                        </div>

                        <!-- Submit Section -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-10 border-t border-gray-100">
                            <button type="submit" class="flex-1 px-10 py-5 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-[1.5rem] hover:shadow-2xl hover:-translate-y-1 active:scale-95 transition-all duration-300 font-extrabold text-xl flex items-center justify-center gap-3">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ __('Save Section') }}
                            </button>
                            <a href="{{ route('doctor.schedules.index') }}" class="px-10 py-5 bg-gray-100 text-gray-600 rounded-[1.5rem] hover:bg-gray-200 transition-all duration-300 font-extrabold text-xl flex items-center justify-center">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        .animate-fadeIn { animation: fadeIn 0.5s ease-out forwards; }
        .animate-slideUp { animation: slideUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .animate-shake { animation: shake 0.4s ease-in-out; }
    </style>
</x-app-layout>
