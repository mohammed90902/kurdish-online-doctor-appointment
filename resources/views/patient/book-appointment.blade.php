<x-app-layout>
    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        
        .grid-header {
            position: sticky;
            top: 0;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            z-index: 20;
        }
        
        .time-column {
            position: sticky;
            right: 0; /* Since it's RTL */
            background: #f9fafb;
            z-index: 10;
        }

        [dir="rtl"] .time-column {
            left: auto;
            right: 0;
            border-left: 1px solid #e5e7eb;
        }

        .booking-slot {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .booking-slot:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .animate-check {
            animation: checkmark 0.4s ease-in-out forwards;
        }

        @keyframes checkmark {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
    </style>

    <div class="min-h-screen bg-[#F8FAFC] pb-12" 
         x-data="{ 
            selectedDate: '{{ $availability[0]['date'] }}', 
            selectedScheduleId: null,
            selectedTime: null,
            availability: {{ json_encode($availability) }},
            allTimes: {{ json_encode($allTimes) }},
            localizeDigits(val) {
                if ('{{ app()->getLocale() }}' === 'en') return val;
                const digits = {'0':'٠','1':'١','2':'٢','3':'٣','4':'٤','5':'٥','6':'٦','7':'٧','8':'٨','9':'٩'};
                return val.toString().split('').map(char => digits[char] || char).join('');
            }
         }">
        
        <!-- Premium Header -->
        <div class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-30">
            <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('patient.doctors.show', $doctor->user_id) }}" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                            {{ substr($doctor->user->localized_name, 0, 1) }}
                        </div>
                        <h1 class="text-xl font-bold text-gray-800">{{ __('Dr.') }} {{ $doctor->user->localized_name }}</h1>
                    </div>
                </div>
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                    </svg>
                </div>
            </div>
            
            <div class="max-w-5xl mx-auto px-4 pb-4">
                @php
                    $months = [
                        'January' => __('January'), 'February' => __('February'), 'March' => __('March'),
                        'April' => __('April'), 'May' => __('May'), 'June' => __('June'),
                        'July' => __('July'), 'August' => __('August'), 'September' => __('September'),
                        'October' => __('October'), 'November' => __('November'), 'December' => __('December')
                    ];
                    $currentMonth = $months[now()->format('F')] ?? now()->format('F');
                @endphp
                <p class="text-2xl font-bold text-gray-900 mt-2">{{ $currentMonth }} @digits(now()->format('Y'))</p>
            </div>

            <!-- Horizontal Day Selector -->
            <div class="max-w-5xl mx-auto px-4 overflow-x-auto scrollbar-hide py-2">
                <div class="flex gap-4">
                    @foreach(array_reverse($availability) as $day)
                        <button type="button" 
                                @click="selectedDate = '{{ $day['date'] }}'; selectedScheduleId = null"
                                :class="selectedDate === '{{ $day['date'] }}' ? 'bg-white' : 'bg-transparent'"
                                class="flex-shrink-0 flex flex-col items-center min-w-[70px] py-2 rounded-xl transition-all">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                @switch($day['day_name'])
                                    @case('monday') {{ __('Monday') }} @break
                                    @case('tuesday') {{ __('Tuesday') }} @break
                                    @case('wednesday') {{ __('Wednesday') }} @break
                                    @case('thursday') {{ __('Thursday') }} @break
                                    @case('friday') {{ __('Friday') }} @break
                                    @case('saturday') {{ __('Saturday') }} @break
                                    @case('sunday') {{ __('Sunday') }} @break
                                @endswitch
                            </span>
                            <span :class="selectedDate === '{{ $day['date'] }}' ? 'text-blue-600' : 'text-gray-700'" 
                                  class="text-xl font-black mt-1">
                                @digits(date('d', strtotime($day['date'])))
                            </span>
                            <div x-show="selectedDate === '{{ $day['date'] }}'" class="w-1 h-1 bg-blue-600 rounded-full mt-1"></div>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-4 mt-8">
            <!-- Error/Success Messages -->
            @if(session('error'))
                <div class="bg-red-50 border-r-4 border-red-500 text-red-700 px-6 py-4 rounded-2xl mb-6 flex items-center shadow-sm">
                    <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-bold">{{ session('error') }}</span>
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-50 border-r-4 border-green-500 text-green-700 px-6 py-4 rounded-2xl mb-6 flex items-center shadow-sm">
                    <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('patient.appointments.store') }}" method="POST" id="bookingForm">
                @csrf
                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                <input type="hidden" name="schedule_id" x-model="selectedScheduleId">
                <input type="hidden" name="appointment_date" x-model="selectedDate">

                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                    <!-- Scheduling Grid -->
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <tbody>
                                <template x-for="time in allTimes" :key="time">
                                    <tr class="border-b border-gray-50 last:border-0">
                                        <!-- Time Column -->
                                        <td class="py-6 px-4 w-20 text-center bg-gray-50/50">
                                            <span class="text-sm font-bold text-gray-500" x-text="localizeDigits(time)"></span>
                                        </td>
                                        
                                        <!-- Availability Cell -->
                                        <td class="p-2">
                                            <template x-for="day in availability" :key="day.date">
                                                <div x-show="selectedDate === day.date" class="w-full">
                                                    @php $slotExists = false; @endphp
                                                    
                                                    <template x-if="true">
                                                        <div class="flex gap-4">
                                                            <template x-for="slot in day.slots" :key="slot.id">
                                                                <template x-if="slot.start_time.substring(0, 5) === time">
                                                                    <button type="button" 
                                                                            @click="if(!slot.is_full) { selectedScheduleId = slot.id; selectedTime = time; }"
                                                                            :disabled="slot.is_full"
                                                                            :class="{
                                                                                'bg-green-50 border-green-100': !slot.is_full && selectedScheduleId !== slot.id,
                                                                                'bg-red-50 border-red-100 opacity-60': slot.is_full,
                                                                                'bg-blue-600 border-blue-600 relative overflow-hidden': selectedScheduleId === slot.id
                                                                            }"
                                                                            class="booking-slot flex-1 flex items-center justify-between p-4 rounded-2xl border min-h-[70px] text-right">
                                                                        
                                                                        <div class="flex items-center gap-3">
                                                                            <div :class="selectedScheduleId === slot.id ? 'bg-white/20 text-white' : (slot.is_full ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600')"
                                                                                 class="w-10 h-10 rounded-xl flex items-center justify-center transition-colors">
                                                                                <svg x-show="selectedScheduleId !== slot.id" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                                                </svg>
                                                                                <svg x-show="selectedScheduleId === slot.id" class="w-6 h-6 text-white animate-check" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                                                </svg>
                                                                            </div>
                                                                            
                                                                            <div>
                                                                                <p :class="selectedScheduleId === slot.id ? 'text-white' : (slot.is_full ? 'text-red-700' : 'text-green-700')"
                                                                                   class="text-sm font-bold uppercase tracking-wide"
                                                                                   x-text="slot.is_full ? '{{ __('Not Available') }}' : '{{ __('Available') }}'">
                                                                                </p>
                                                                                <p :class="selectedScheduleId === slot.id ? 'text-blue-100' : 'text-gray-400'"
                                                                                   class="text-[10px] font-bold"
                                                                                   x-show="!slot.is_full"
                                                                                   x-text="localizeDigits(slot.remaining) + ' {{ __('spots left') }}'">
                                                                                </p>
                                                                            </div>
                                                                        </div>

                                                                        <div x-show="selectedScheduleId === slot.id" class="absolute right-0 top-0 h-full w-1 bg-white/20"></div>
                                                                    </button>
                                                                </template>
                                                            </template>
                                                            
                                                            <!-- Empty State if no slot for this time -->
                                                            <div x-show="!day.slots.some(s => s.start_time.substring(0, 5) === time)"
                                                                 class="flex-1 bg-gray-50/50 rounded-2xl min-h-[70px] border border-dashed border-gray-100">
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </template>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Footer Action -->
                @if($doctor->consultation_fee)
                    <div class="mt-8 flex items-center justify-between bg-blue-50/50 p-6 rounded-3xl border border-blue-100">
                        <div>
                            <p class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-1">{{ __('Consultation Fee') }}</p>
                            <p class="text-xl font-black text-blue-900">@digits(number_format($doctor->consultation_fee)) {{ __('IQD') }}</p>
                        </div>
                        <div class="text-right py-2 px-4 bg-white border border-blue-200 rounded-2xl shadow-sm">
                            <span class="text-xs font-bold text-gray-500">{{ __('Selected Time') }}</span>
                            <p class="font-bold text-gray-800 text-center" x-text="selectedTime ? localizeDigits(selectedTime) : '{{ __('Not Selected') }}'"></p>
                        </div>
                    </div>
                @endif

                <div class="mt-8 space-y-4">
                    <label class="block text-gray-700 font-bold px-2">{{ __('Symptoms or medical notes') }}</label>
                    <textarea name="symptoms" 
                              rows="3"
                              placeholder="{{ __('Describe your symptoms...') }}"
                              class="w-full border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-3xl p-6 transition-all duration-300 bg-white shadow-sm">{{ old('symptoms') }}</textarea>
                </div>

                <div class="mt-8 flex gap-4">
                    <button type="submit" 
                            :disabled="!selectedScheduleId"
                            :class="!selectedScheduleId ? 'bg-gray-200 cursor-not-allowed opacity-50' : 'bg-blue-600 text-white shadow-xl shadow-blue-200 hover:-translate-y-1 active:scale-95'"
                            class="flex-1 font-bold py-5 rounded-3xl transition-all duration-300 text-lg flex items-center justify-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ __('Confirm and Book Now') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>