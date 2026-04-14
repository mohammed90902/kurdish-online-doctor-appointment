<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Doctor Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            

            <!-- Doctor Profile Card -->
            <div class="glass-card overflow-hidden shadow-xl rounded-2xl mb-8 animate-slideUp">
                <div class="p-8">
                    <div class="grid md:grid-cols-1 gap-6">
                        <!-- Doctor Info -->
                        <div>
                            <div class="flex items-center gap-6 mb-8">
                                <div class="w-24 h-24 md:w-32 md:h-32 rounded-2xl bg-gradient-to-br from-blue-500 to-teal-500 flex items-center justify-center shadow-lg overflow-hidden border-4 border-white">
                                    @if($doctor->profile_image)
                                        <img src="{{ asset('storage/' . $doctor->profile_image) }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h1 class="text-3xl md:text-4xl font-black text-gray-800 mb-2 tracking-tight">{{ __('Dr.') }} {{ $doctor->user->localized_name }}</h1>
                                    <p class="text-xl md:text-2xl text-blue-600 font-bold px-4 py-1.5 bg-blue-50 w-fit rounded-xl">{{ $doctor->specialization->name }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                                @if($doctor->experience_years)
                                <div class="bg-blue-50/50 rounded-2xl p-6 border border-blue-100 flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-500 mb-1">{{ __('Experience') }}</p>
                                        <p class="text-xl font-black text-gray-800">{{ $doctor->experience_years }} {{ __('Years') }}</p>
                                    </div>
                                </div>
                                @endif

                                @if($doctor->consultation_fee)
                                <div class="bg-green-50/50 rounded-2xl p-6 border border-green-100 flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-500 mb-1">{{ __('Consultation Fee') }}</p>
                                        <p class="text-xl font-black text-gray-800">{{ number_format($doctor->consultation_fee) }} {{ __('IQD') }}</p>
                                    </div>
                                </div>
                                @endif

                                <div class="bg-purple-50/50 rounded-2xl p-6 border border-purple-100 flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-sm font-bold text-gray-500 mb-1">{{ __('Email') }}</p>
                                        <p class="text-lg font-black text-gray-800 truncate">{{ $doctor->user->email }}</p>
                                    </div>
                                </div>

                                @if($doctor->phone)
                                <div class="bg-orange-50/50 rounded-xl p-4 border border-orange-100">
                                    <p class="text-sm font-bold text-gray-500 mb-1">{{ __('Phone Number') }}</p>
                                    <p class="text-xl font-bold text-gray-800" dir="ltr">{{ $doctor->phone }}</p>
                                </div>
                                @endif
                            </div>

                            <!-- Book Button -->
                            @if(!Auth::user()->isDoctor() && !Auth::user()->isAdmin())
                                <div>
                                    <a href="{{ route('patient.doctors.book', $doctor->user_id) }}" 
                                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-500 to-green-600 text-white text-lg font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                        <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ __('Book Now') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Available Schedules -->
            <div class="glass-card overflow-hidden shadow-xl rounded-2xl animate-slideUp" style="animation-delay: 0.1s;">
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-r-4 border-blue-500 pr-3 flex items-center">
                        {{ __('Available Schedules') }}
                    </h2>
                    
                    @if($schedules->count() > 0)
                        <div class="grid md:grid-cols-2 gap-4 mb-8">
                            @foreach($schedules as $schedule)
                                <div class="group border border-gray-200 rounded-2xl p-6 hover:border-blue-500 hover:bg-blue-50/30 transition-all duration-300 shadow-sm hover:shadow-md">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-black text-xl text-gray-800 group-hover:text-blue-700 transition">
                                                @switch(strtolower($schedule->day_of_week))
                                                    @case('monday') {{ __('Monday') }} @break
                                                    @case('tuesday') {{ __('Tuesday') }} @break
                                                    @case('wednesday') {{ __('Wednesday') }} @break
                                                    @case('thursday') {{ __('Thursday') }} @break
                                                    @case('friday') {{ __('Friday') }} @break
                                                    @case('saturday') {{ __('Saturday') }} @break
                                                    @case('sunday') {{ __('Sunday') }} @break
                                                    @default {{ ucfirst($schedule->day_of_week) }}
                                                @endswitch
                                            </p>
                                            <div class="mt-3 text-gray-600 space-y-2">
                                                <p class="flex items-center text-sm font-bold">
                                                    <span class="w-8 h-8 rounded-lg bg-white flex items-center justify-center border border-gray-100 ml-2 group-hover:border-blue-200 transition">
                                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    </span>
                                                    <span dir="ltr">
                                                        @digits(str_replace(['AM', 'PM'], [__('AM'), __('PM')], date('h:i A', strtotime($schedule->start_time)))) - 
                                                        @digits(str_replace(['AM', 'PM'], [__('AM'), __('PM')], date('h:i A', strtotime($schedule->end_time))))
                                                    </span>
                                                </p>
                                                <p class="flex items-center text-sm font-bold">
                                                    <span class="w-8 h-8 rounded-lg bg-white flex items-center justify-center border border-gray-100 ml-2 group-hover:border-blue-200 transition">
                                                        <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                        </svg>
                                                    </span>
                                                    {{ __('Patients') }} @digits($schedule->max_patients)
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="bg-green-100 text-green-800 px-4 py-2 rounded-xl text-xs font-black shadow-sm uppercase tracking-wide">
                                                {{ __('ACTIVE') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Book Appointment Button -->
                        @if(!Auth::user()->isDoctor() && !Auth::user()->isAdmin())
                            <div class="text-center pt-4 border-t border-gray-100">
                                <a href="{{ route('patient.doctors.book', $doctor->user_id) }}" 
                                   class="inline-flex items-center px-10 py-4 bg-gradient-to-r from-blue-500 to-teal-500 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-lg">
                                    {{ __('Book appointment with this doctor') }}
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium">{{ __('No available schedules for this doctor') }}</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>