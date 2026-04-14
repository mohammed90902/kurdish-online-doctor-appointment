
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            وردەکاری پزیشک
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

            <div class="mb-6">
                <a href="{{ route('admin.doctors.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 font-bold transition-colors">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                    گەڕانەوە بۆ لیستی پزیشکان
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Sidebar Info -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="glass-card p-6 rounded-2xl shadow-xl text-center animate-fade-in-up" style="animation-delay: 0.1s;">
                        <div class="w-32 h-32 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-4xl shadow-lg mx-auto mb-4">
                            {{ substr($doctor->user->localized_name, 0, 1) }}
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $doctor->user->localized_name }}</h3>
                        <p class="text-indigo-600 font-medium mb-2">{{ $doctor->specialization->name }}</p>
                        
                        <div class="flex justify-center mb-6">
                            @if($doctor->status == 'pending')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-lg text-sm font-bold shadow-sm">چاوەڕوان</span>
                            @elseif($doctor->status == 'approved')
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-lg text-sm font-bold shadow-sm">پەسەندکراو</span>
                            @elseif($doctor->status == 'rejected')
                                <span class="px-3 py-1 bg-red-100 text-red-800 rounded-lg text-sm font-bold shadow-sm">ڕەتکراوە</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-lg text-sm font-bold shadow-sm">ڕاگیراو</span>
                            @endif
                        </div>

                        <div class="border-t border-gray-100 pt-6">
                            <h4 class="text-right text-sm font-bold text-gray-500 uppercase mb-4">کردارەکان بەڕێوەبەر</h4>
                            <div class="flex flex-col gap-3">
                                @if($doctor->status == 'pending')
                                    <form method="POST" action="{{ route('admin.doctors.approve', $doctor->id) }}">
                                        @csrf
                                        <button type="submit" class="w-full py-2 bg-green-500 text-white rounded-xl hover:bg-green-600 transition font-bold shadow-md">پەسەندکردن</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.doctors.reject', $doctor->id) }}">
                                        @csrf
                                        <button type="submit" class="w-full py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 transition font-bold shadow-md">ڕەتکردنەوە</button>
                                    </form>
                                @endif

                                @if($doctor->status == 'approved')
                                    <form method="POST" action="{{ route('admin.doctors.suspend', $doctor->id) }}">
                                        @csrf
                                        <button type="submit" class="w-full py-2 bg-orange-500 text-white rounded-xl hover:bg-orange-600 transition font-bold shadow-md">ڕاگرتن</button>
                                    </form>
                                @endif

                                @if($doctor->status == 'suspended')
                                    <form method="POST" action="{{ route('admin.doctors.activate', $doctor->id) }}">
                                        @csrf
                                        <button type="submit" class="w-full py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition font-bold shadow-md">چالاککردنەوە</button>
                                    </form>
                                @endif

                                <form method="POST" action="{{ route('admin.doctors.destroy', $doctor->id) }}" onsubmit="return confirm('دڵنیای لە سڕینەوە؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition font-bold">سڕینەوە</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- General Info -->
                    <div class="glass-card p-6 rounded-2xl shadow-xl animate-fade-in-up" style="animation-delay: 0.2s;">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center border-b border-gray-100 pb-3">
                            <span class="p-2 bg-indigo-100 text-indigo-600 rounded-lg ml-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </span>
                            زانیاری گشتی
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <p class="text-sm text-gray-500">ئیمەیڵ</p>
                                <p class="font-bold text-gray-800 break-all">{{ $doctor->user->email }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-sm text-gray-500">تەلەفۆن</p>
                                <p class="font-bold text-gray-800 dir-ltr">{{ $doctor->user->phone ?? 'نییە' }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-sm text-gray-500">ژمارەی مۆڵەت</p>
                                <p class="font-bold text-gray-800 font-mono">{{ $doctor->license_number }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-sm text-gray-500">ساڵانی ئەزموون</p>
                                <p class="font-bold text-gray-800">{{ $doctor->experience_years }} ساڵ</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-sm text-gray-500">کرێی چاوپێکەوتن</p>
                                <p class="font-bold text-gray-800">{{ number_format($doctor->consultation_fee) }} IQD</p>
                            </div>
                        </div>

                        <div class="mt-6 space-y-4">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">بڕوانامەکان</p>
                                <div class="bg-gray-50 p-3 rounded-xl text-gray-700 leading-relaxed">
                                    {{ $doctor->qualifications ?? 'نییە' }}
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">باسی کەسی</p>
                                <div class="bg-gray-50 p-3 rounded-xl text-gray-700 leading-relaxed">
                                    {{ $doctor->bio ?? 'نییە' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Schedules -->
                    <div class="glass-card overflow-hidden shadow-xl rounded-2xl animate-fade-in-up" style="animation-delay: 0.3s;">
                        <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 ml-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                خشتەی کات
                            </h3>
                            <span class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-xs font-bold">{{ $doctor->schedules->count() }}</span>
                        </div>
                        
                        <div class="p-0">
                            @if($doctor->schedules->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-100">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">ڕۆژ</th>
                                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">دەستپێکردن</th>
                                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">کۆتایی</th>
                                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">ماوە</th>
                                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">دۆخ</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            @foreach($doctor->schedules as $schedule)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="px-6 py-3 text-sm font-bold text-gray-800">{{ $schedule->day_of_week }}</td>
                                                <td class="px-6 py-3 text-sm text-gray-600 font-mono">{{ $schedule->start_time }}</td>
                                                <td class="px-6 py-3 text-sm text-gray-600 font-mono">{{ $schedule->end_time }}</td>
                                                <td class="px-6 py-3 text-sm text-gray-600">{{ $schedule->slot_duration }} خولەک</td>
                                                <td class="px-6 py-3 text-sm">
                                                    @if($schedule->is_available)
                                                        <span class="text-green-600 font-bold flex items-center">
                                                            <span class="w-2 h-2 bg-green-500 rounded-full ml-2"></span>
                                                            بەردەستە
                                                        </span>
                                                    @else
                                                        <span class="text-red-600 font-bold flex items-center">
                                                            <span class="w-2 h-2 bg-red-500 rounded-full ml-2"></span>
                                                            بەردەست نییە
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="p-6 text-center text-gray-500">هیچ خشتەیەکی کات دانەنراوە</div>
                            @endif
                        </div>
                    </div>

                    <!-- Appointments -->
                    <div class="glass-card overflow-hidden shadow-xl rounded-2xl animate-fade-in-up" style="animation-delay: 0.4s;">
                        <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 ml-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                دواین کاتەکان
                            </h3>
                            <span class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-xs font-bold">{{ $doctor->appointments->count() }}</span>
                        </div>
                        
                        <div class="p-0">
                            @if($doctor->appointments->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-100">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">نەخۆش</th>
                                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">بەروار</th>
                                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">کات</th>
                                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">دۆخ</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            @foreach($doctor->appointments->take(5) as $appointment)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="px-6 py-3 text-sm font-bold text-gray-800">{{ $appointment->patient->user->localized_name }}</td>
                                                <td class="px-6 py-3 text-sm text-gray-600">{{ $appointment->appointment_date }}</td>
                                                <td class="px-6 py-3 text-sm text-gray-600 font-mono">{{ $appointment->appointment_time }}</td>
                                                <td class="px-6 py-3 text-sm">
                                                    @if($appointment->status == 'pending')
                                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-bold">چاوەڕوان</span>
                                                    @elseif($appointment->status == 'confirmed')
                                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-bold">پشتڕاست</span>
                                                    @elseif($appointment->status == 'completed')
                                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-bold">تەواو</span>
                                                    @else
                                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-bold">هەڵوەشاوە</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="p-6 text-center text-gray-500">هیچ کاتێک تۆمار نەکراوە</div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
