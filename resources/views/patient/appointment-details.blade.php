<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            وردەکاری کات
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-bold transition-colors duration-300">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                    گەڕانەوە بۆ داشبۆرد
                </a>
            </div>

            <!-- Appointment Info Card -->
            <div class="glass-card overflow-hidden shadow-xl rounded-2xl mb-8 animate-slideUp">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-8 border-b border-gray-100 pb-4">
                        زانیاری گشتی کاتەکە
                    </h3>
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Appointment Details -->
                        <div class="bg-blue-50/50 rounded-xl p-6 border border-blue-100">
                            <h4 class="font-bold text-lg text-blue-800 mb-6 flex items-center">
                                <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                وردەکاری کات
                            </h4>
                            
                            <div class="space-y-4">
                                <div class="flex justify-between items-center border-b border-blue-200/50 pb-2">
                                    <p class="text-gray-600 font-medium">بەروار</p>
                                    <p class="text-lg font-bold text-gray-800">{{ $appointment->appointment_date }}</p>
                                </div>
                                
                                <div class="flex justify-between items-center border-b border-blue-200/50 pb-2">
                                    <p class="text-gray-600 font-medium">کات</p>
                                    <p class="text-lg font-bold text-gray-800" dir="ltr">{{ date('h:i A', strtotime($appointment->appointment_time)) }}</p>
                                </div>
                                
                                <div class="flex justify-between items-center pt-1">
                                    <p class="text-gray-600 font-medium">دۆخ</p>
                                    <div class="text-lg font-bold">
                                        @if($appointment->status == 'pending')
                                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-xl text-sm shadow-sm">چاوەڕوان</span>
                                        @elseif($appointment->status == 'confirmed')
                                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-xl text-sm shadow-sm">پشتڕاستکراوە</span>
                                        @elseif($appointment->status == 'completed')
                                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-xl text-sm shadow-sm">تەواوبووە</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-xl text-sm shadow-sm">هەڵوەشاوە</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Doctor Details -->
                        <div class="bg-green-50/50 rounded-xl p-6 border border-green-100">
                            <h4 class="font-bold text-lg text-green-800 mb-6 flex items-center">
                                <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                زانیاری پزیشک
                            </h4>
                            
                            <div class="flex items-center gap-4 mb-6 pb-6 border-b border-green-200/50">
                                <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-white shadow-md">
                                    @if($doctor->profile_image)
                                        <img src="{{ asset('storage/' . $doctor->profile_image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-teal-500 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-xl font-bold text-gray-800">د. {{ $doctor->user->localized_name }}</p>
                                    <p class="text-green-700 font-bold">{{ $doctor->specialization->name }}</p>
                                </div>
                            </div>
                            
                            <div class="space-y-4">
                                @if($doctor->user->phone)
                                <div class="flex justify-between items-center border-b border-green-200/50 pb-2">
                                    <p class="text-gray-600 font-medium">تەلەفۆن</p>
                                    <p class="text-lg font-bold text-gray-800" dir="ltr">{{ $doctor->user->phone }}</p>
                                </div>
                                @endif
                                
                                @if($doctor->consultation_fee)
                                <div class="flex justify-between items-center pt-1">
                                    <p class="text-gray-600 font-medium">کرێ</p>
                                    <p class="text-lg font-bold text-gray-800">{{ number_format($doctor->consultation_fee) }} {{ __('IQD') }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Symptoms -->
            @if($appointment->symptoms)
            <div class="glass-card overflow-hidden shadow-xl rounded-2xl mb-8 animate-slideUp" style="animation-delay: 0.1s;">
                <div class="p-8">
                    <h4 class="font-bold text-lg text-gray-800 mb-4 border-r-4 border-purple-500 pr-3">
                        نیشانەکان
                    </h4>
                    <div class="bg-gray-50 rounded-xl p-4 text-gray-700 leading-relaxed border border-gray-100">
                        {{ $appointment->symptoms }}
                    </div>
                </div>
            </div>
            @endif

            <!-- Diagnosis & Prescription (if completed) -->
            @if($appointment->status == 'completed')
            <div class="grid md:grid-cols-2 gap-8 animate-slideUp" style="animation-delay: 0.2s;">
                @if($appointment->diagnosis)
                <div class="glass-card overflow-hidden shadow-xl rounded-2xl h-full">
                    <div class="p-8">
                        <h4 class="font-bold text-lg text-gray-800 mb-4 border-r-4 border-red-500 pr-3">
                            دەستنیشانکردن
                        </h4>
                        <div class="bg-red-50/50 rounded-xl p-4 text-gray-700 leading-relaxed border border-red-100 h-full">
                            {{ $appointment->diagnosis }}
                        </div>
                    </div>
                </div>
                @endif
                
                @if($appointment->prescription)
                <div class="glass-card overflow-hidden shadow-xl rounded-2xl h-full">
                    <div class="p-8">
                        <h4 class="font-bold text-lg text-gray-800 mb-4 border-r-4 border-orange-500 pr-3">
                            نووسخەی دەرمان
                        </h4>
                        <div class="bg-orange-50/50 rounded-xl p-4 text-gray-700 leading-relaxed border border-orange-100 whitespace-pre-line font-mono text-sm h-full">
                            {{ $appointment->prescription }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endif

            <!-- Cancel Button (only if pending or confirmed) -->
            @if($appointment->status == 'pending' || $appointment->status == 'confirmed')
            <div class="glass-card overflow-hidden shadow-xl rounded-2xl mt-8 animate-slideUp" style="animation-delay: 0.2s;">
                <div class="p-8 flex items-center justify-between">
                    <div>
                        <h4 class="font-bold text-lg text-gray-800 mb-2">پێویستت بە گۆڕانکارییە؟</h4>
                        <p class="text-gray-600">ئەگەر دەتەوێت ئەم کاتە هەڵبوەشێنیتەوە، تکایە پەیوەندی بە پزیشک بکە.</p>
                        <p class="text-sm font-bold text-blue-600 mt-2">{{ __('Phone Number') }}: <span dir="ltr">{{ $doctor->user->phone ?? __('Not available') }}</span></p>
                    </div>
                    <a href="tel:{{ $doctor->user->phone }}" class="px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors">
                        {{ __('Call Now') }}
                    </a>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>