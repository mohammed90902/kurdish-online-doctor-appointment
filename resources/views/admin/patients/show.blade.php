
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            وردەکاری نەخۆش
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="glass-card bg-green-100/80 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl mb-6 flex items-center shadow-lg animate-slideDown">
                    <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center">
                <a href="{{ route('admin.patients.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 font-bold transition-colors">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                    گەڕانەوە بۆ لیستی نەخۆشان
                </a>
                
                <form method="POST" action="{{ route('admin.patients.destroy', $patient->id) }}" onsubmit="return confirm('دڵنیای لە سڕینەوە؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md hover:shadow-lg">
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        سڕینەوەی نەخۆش
                    </button>
                </form>
            </div>

            <!-- Patient Information -->
            <div class="glass-card overflow-hidden shadow-xl rounded-2xl animate-fade-in-up">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="p-2 bg-pink-100 text-pink-600 rounded-lg ml-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </span>
                        <h3 class="text-xl font-bold text-gray-800">زانیاری نەخۆش</h3>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="flex flex-col md:flex-row gap-8">
                        <div class="flex-shrink-0 flex justify-center md:justify-start">
                            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-pink-400 to-rose-500 flex items-center justify-center text-white text-4xl font-bold shadow-lg ring-4 ring-pink-50">
                                {{ substr($patient->user->localized_name, 0, 1) }}
                            </div>
                        </div>
                        
                        <div class="flex-grow grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-1">ناو</p>
                                <p class="text-lg font-bold text-gray-900">{{ $patient->user->localized_name }}</p>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-1">ئیمەیڵ</p>
                                <p class="text-lg font-mono text-gray-700">{{ $patient->user->email }}</p>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-1">تەلەفۆن</p>
                                <p class="text-lg font-mono text-gray-700 dir-ltr">{{ $patient->user->phone ?? 'نییە' }}</p>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-1">ڕۆژی لەدایکبوون</p>
                                <p class="text-lg text-gray-700">{{ $patient->date_of_birth ?? 'دیاری نەکراوە' }}</p>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-1">تەمەن</p>
                                <p class="text-lg font-bold text-gray-900">{{ $patient->age ? $patient->age . ' ساڵ' : 'دیاری نەکراوە' }}</p>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-1">ڕەگەز</p>
                                <div class="mt-1">
                                    @if($patient->gender == 'male')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">نێر</span>
                                    @elseif($patient->gender == 'female')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-pink-100 text-pink-800">مێ</span>
                                    @else
                                        <span class="text-gray-400">دیاری نەکراوە</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-1">جۆری خوێن</p>
                                <p class="text-lg font-bold text-red-600">{{ $patient->blood_group ?? 'دیاری نەکراوە' }}</p>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-1">بەرواری پەیوەندیکردن</p>
                                <p class="text-lg text-gray-700">{{ $patient->created_at->format('Y-m-d') }}</p>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 col-span-1 md:col-span-2 lg:col-span-3">
                                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-1">ناونیشان</p>
                                <p class="text-lg text-gray-700 leading-relaxed">{{ $patient->address ?? 'دیاری نەکراوە' }}</p>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 col-span-1 md:col-span-2 lg:col-span-3">
                                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-1">مێژووی نەشتەرگەری</p>
                                <p class="text-lg text-gray-700 leading-relaxed">{{ $patient->medical_history ?? 'هیچ مێژوویەکی تۆمارکراو نییە' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Appointments -->
            <div class="glass-card overflow-hidden shadow-xl rounded-2xl animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="p-2 bg-blue-100 text-blue-600 rounded-lg ml-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </span>
                        <h3 class="text-xl font-bold text-gray-800">مێژووی کاتەکان</h3>
                    </div>
                    <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-xs font-bold">{{ $patient->appointments->count() }} کات</span>
                </div>
                
                <div class="overflow-x-auto">
                    @if($patient->appointments->count() > 0)
                        <table class="min-w-full divide-y divide-gray-100">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">پزیشک</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">بەروار</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">کات</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">دۆخ</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">نیشانەکان</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white/50 divide-y divide-gray-100">
                                @foreach($patient->appointments as $appointment)
                                <tr class="hover:bg-blue-50/30 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs ml-3">
                                                {{ substr($appointment->doctor->user->localized_name, 0, 1) }}
                                            </div>
                                            <div class="text-sm font-bold text-gray-900">{{ $appointment->doctor->user->localized_name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-mono">{{ $appointment->appointment_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-mono">{{ $appointment->appointment_time }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($appointment->status == 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                چاوەڕوان
                                            </span>
                                        @elseif($appointment->status == 'confirmed')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                پشتڕاست
                                            </span>
                                        @elseif($appointment->status == 'completed')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                تەواو
                                            </span>
                                        @elseif($appointment->status == 'cancelled')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                هەڵوەشاوە
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                نەهاتووە
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ Str::limit($appointment->symptoms ?? 'نییە', 30) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center py-10">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium">هیچ کاتێک تۆمار نەکراوە</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
