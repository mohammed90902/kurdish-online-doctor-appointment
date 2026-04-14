
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            وردەکاری کات
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="glass-card bg-green-100/80 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl mb-6 flex items-center shadow-lg animate-slideDown">
                    <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="glass-card bg-red-100/80 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-xl mb-6 shadow-lg animate-slideDown">
                    @foreach($errors->all() as $error)
                        <p class="flex items-center">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif

            <div class="mb-6 flex justify-between items-center relative z-10">
                <a href="{{ route('doctor.appointments.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 font-bold transition-colors group py-2">
                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                    گەڕانەوە بۆ لیستی کاتەکان
                </a>

                <div class="flex gap-3">
                    @if($appointment->isPending())
                        <form method="POST" action="{{ route('doctor.appointments.confirm', $appointment->id) }}">
                            @csrf
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition shadow-md font-bold flex items-center">
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                پشتڕاستکردنەوە
                            </button>
                        </form>
                    @endif

                    @if($appointment->canBeCancelled())
                        <button onclick="document.getElementById('cancel-modal').classList.remove('hidden')" 
                                class="px-6 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 transition shadow-md font-bold flex items-center">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            هەڵوەشاندنەوە
                        </button>
                    @endif
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <!-- Appointment Info -->
                <div class="glass-card p-6 rounded-2xl shadow-xl animate-fade-in-up" style="animation-delay: 0.1s;">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center border-b border-gray-100 pb-3">
                        <span class="p-2 bg-indigo-100 text-indigo-600 rounded-lg ml-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </span>
                        زانیاری کات
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-xl">
                            <p class="text-gray-500 font-medium">بەروار</p>
                            <p class="font-bold text-gray-800">{{ $appointment->appointment_date }}</p>
                        </div>
                        
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-xl">
                            <p class="text-gray-500 font-medium">کات</p>
                            <p class="font-bold text-gray-800" dir="ltr">{{ $appointment->appointment_time }}</p>
                        </div>
                        
                        <div class="flex justify-between items-center p-3 bg-indigo-50 border border-indigo-100 rounded-xl">
                            <p class="text-indigo-600 font-bold">ژمارەی سەرە (Queue)</p>
                            <p class="font-black text-indigo-900 text-lg">{{ $appointment->queue_number }}</p>
                        </div>
                        
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-xl">
                            <p class="text-gray-500 font-medium">دۆخ</p>
                            <div>
                                @if($appointment->status == 'pending')
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-lg text-xs font-bold">چاوەڕوان</span>
                                @elseif($appointment->status == 'confirmed')
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-lg text-xs font-bold">پشتڕاست</span>
                                @elseif($appointment->status == 'completed')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-lg text-xs font-bold">تەواو</span>
                                @elseif($appointment->status == 'cancelled')
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-lg text-xs font-bold">هەڵوەشاوە</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-lg text-xs font-bold">نەهاتووە</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-xl">
                            <p class="text-gray-500 font-medium">کاتی دروستکردن</p>
                            <p class="font-bold text-gray-800" dir="ltr">{{ $appointment->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Patient Info -->
                <div class="glass-card p-6 rounded-2xl shadow-xl animate-fade-in-up" style="animation-delay: 0.2s;">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center border-b border-gray-100 pb-3">
                        <span class="p-2 bg-pink-100 text-pink-600 rounded-lg ml-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </span>
                        زانیاری نەخۆش
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg ml-4">
                                {{ substr($appointment->patient->user->localized_name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">{{ $appointment->patient->user->localized_name }}</p>
                                <p class="text-sm text-gray-500">{{ $appointment->patient->user->email }}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-3 bg-gray-50 rounded-xl">
                                <p class="text-xs text-gray-500 mb-1">تەلەفۆن</p>
                                <p class="font-bold text-gray-800 dir-ltr">{{ $appointment->patient->user->phone ?? 'نییە' }}</p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-xl">
                                <p class="text-xs text-gray-500 mb-1">تەمەن</p>
                                <p class="font-bold text-gray-800">{{ $appointment->patient->age ?? 'نییە' }}</p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-xl">
                                <p class="text-xs text-gray-500 mb-1">ڕەگەز</p>
                                <p class="font-bold text-gray-800">
                                    @if($appointment->patient->gender == 'male')
                                        نێر
                                    @elseif($appointment->patient->gender == 'female')
                                        مێ
                                    @else
                                        نییە
                                    @endif
                                </p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-xl">
                                <p class="text-xs text-gray-500 mb-1">جۆری خوێن</p>
                                <p class="font-bold text-gray-800">{{ $appointment->patient->blood_group ?? 'نییە' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Symptoms -->
            <div class="glass-card p-6 rounded-2xl shadow-xl mb-6 animate-fade-in-up" style="animation-delay: 0.3s;">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 text-red-500 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    نیشانەکان
                </h3>
                <div class="bg-red-50 p-4 rounded-xl text-gray-700 leading-relaxed border border-red-100">
                    {{ $appointment->symptoms ?? 'نیشانەیەک نەنووسراوە' }}
                </div>
            </div>

            <!-- Diagnosis & Prescription Form -->
            @if(in_array($appointment->status, ['pending', 'confirmed']))
            <div class="glass-card p-8 rounded-2xl shadow-xl mb-6 border-2 border-indigo-100 animate-slideDown">
                <h3 class="text-2xl font-bold text-indigo-900 mb-6 flex items-center">
                    <span class="p-2 bg-indigo-500 text-white rounded-lg ml-3 shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </span>
                    تەواوکردنی کات و چارەسەر
                </h3>
                
                <form method="POST" action="{{ route('doctor.appointments.complete', $appointment->id) }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">دەستنیشانکردن (دایگنۆسیس) *</label>
                        <textarea name="diagnosis" rows="3" required 
                            class="w-full border-gray-200 rounded-xl shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-4 placeholder-gray-400"
                            placeholder="دەستنیشانکردنی نەخۆشییەکە بنووسە...">{{ old('diagnosis', $appointment->diagnosis) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">نووسخەی دەرمان</label>
                        <textarea name="prescription" rows="4" 
                            class="w-full border-gray-200 rounded-xl shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-4 placeholder-gray-400"
                            placeholder="دەرمانەکان و چۆنیەتی بەکارهێنانیان...">{{ old('prescription', $appointment->prescription) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">تێبینیەکان</label>
                        <textarea name="notes" rows="2" 
                            class="w-full border-gray-200 rounded-xl shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-4"
                            placeholder="هەر تێبینییەکی تر...">{{ old('notes', $appointment->notes) }}</textarea>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-xl hover:shadow-xl hover:-translate-y-1 transition-all duration-300 font-bold text-lg flex items-center">
                            <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            تەواوکردنی کات
                        </button>
                    </div>
                </form>
            </div>
            @endif

            <!-- Completed Appointment Details -->
            @if($appointment->isCompleted())
            <div class="glass-card p-8 rounded-2xl shadow-xl mb-6 bg-gradient-to-l from-green-50 to-white border border-green-100">
                <h3 class="text-2xl font-bold text-green-800 mb-6 flex items-center">
                    <span class="p-2 bg-green-100 rounded-full ml-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </span>
                    وردەکاری چارەسەر
                </h3>
                
                <div class="space-y-6">
                    <div class="bg-white p-4 rounded-xl border border-green-100 shadow-sm">
                        <p class="text-green-700 font-bold mb-2 text-sm uppercase tracking-wide">دەستنیشانکردن</p>
                        <p class="text-gray-800 leading-relaxed text-lg">{{ $appointment->diagnosis }}</p>
                    </div>

                    @if($appointment->prescription)
                    <div class="bg-white p-4 rounded-xl border border-green-100 shadow-sm">
                        <p class="text-green-700 font-bold mb-2 text-sm uppercase tracking-wide">نووسخەی دەرمان</p>
                        <p class="text-gray-800 leading-relaxed whitespace-pre-line">{{ $appointment->prescription }}</p>
                    </div>
                    @endif

                    @if($appointment->notes)
                    <div class="bg-white p-4 rounded-xl border border-green-100 shadow-sm">
                        <p class="text-green-700 font-bold mb-2 text-sm uppercase tracking-wide">تێبینیەکان</p>
                        <p class="text-gray-700 italic">{{ $appointment->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- History -->
            @if($appointment->history->count() > 0)
            <div class="glass-card overflow-hidden shadow-xl rounded-2xl">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-lg font-bold text-gray-700 flex items-center">
                        <svg class="w-5 h-5 ml-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        مێژووی گۆڕانکارییەکان
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-right p-4 text-xs font-bold text-gray-500 uppercase">دۆخی پێشوو</th>
                                <th class="text-right p-4 text-xs font-bold text-gray-500 uppercase">دۆخی نوێ</th>
                                <th class="text-right p-4 text-xs font-bold text-gray-500 uppercase">هۆکار</th>
                                <th class="text-right p-4 text-xs font-bold text-gray-500 uppercase">گۆڕدرا لەلایەن</th>
                                <th class="text-right p-4 text-xs font-bold text-gray-500 uppercase">کات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($appointment->history as $history)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 text-sm text-gray-600">{{ $history->previous_status }}</td>
                                <td class="p-4 text-sm font-bold text-gray-800">{{ $history->new_status }}</td>
                                <td class="p-4 text-sm text-gray-600 italic">{{ $history->reason ?? 'نییە' }}</td>
                                <td class="p-4 text-sm text-gray-700">{{ $history->changedByUser->localized_name }}</td>
                                <td class="p-4 text-sm text-gray-500" dir="ltr">{{ $history->changed_at->format('Y-m-d H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

        </div>
    </div>

    <!-- Cancel Modal -->
    <div id="cancel-modal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-filter backdrop-blur-sm" 
                 onclick="document.getElementById('cancel-modal').classList.add('hidden')" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form method="POST" action="{{ route('doctor.appointments.cancel', $appointment->id) }}">
                    @csrf
                    <div class="bg-white p-6 sm:p-8">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl leading-6 font-bold text-gray-900 text-center mb-2" id="modal-title">
                            هەڵوەشاندنەوەی کات
                        </h3>
                        <p class="text-sm text-gray-500 text-center mb-6">
                            ئایا دڵنیای لە هەڵوەشاندنەوەی ئەم کاتە؟ ئەم کردارە ناکرێت پاشگەز بکرێتەوە.
                        </p>
                        
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">هۆکاری هەڵوەشاندنەوە *</label>
                            <textarea name="reason" rows="3" required 
                                class="w-full border-gray-300 rounded-xl shadow-sm focus:border-red-500 focus:ring-red-500 p-3"
                                placeholder="تکایە هۆکارەکە بنووسە..."></textarea>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse gap-3">
                        <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-bold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:w-auto sm:text-sm transition">
                            هەڵوەشاندنەوە
                        </button>
                        <button type="button" onclick="document.getElementById('cancel-modal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-bold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm transition">
                            داخستن
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
