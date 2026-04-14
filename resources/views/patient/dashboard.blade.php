<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Patient Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="glass-card bg-green-100/80 border border-green-400/50 text-green-700 px-6 py-4 rounded-2xl mb-6 animate-slideDown">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Welcome Message -->
            <div class="glass-card overflow-hidden shadow-xl rounded-2xl mb-8 animate-slideUp">
                <div class="bg-gradient-to-r from-blue-500 to-teal-500 p-8 text-white">
                    <h3 class="text-3xl font-bold mb-2">{{ __('Welcome patient') }}, {{ $patient->name }} 👋</h3>
                   
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="glass-card rounded-2xl p-6 hover-lift animate-on-scroll">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-gray-600 text-sm font-medium mb-2">{{ __('Total Appointments') }}</h3>
                            <p class="text-4xl font-bold text-blue-600">@digits($stats['total_appointments'])</p>
                        </div>
                        <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="glass-card rounded-2xl p-6 hover-lift animate-on-scroll">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-gray-600 text-sm font-medium mb-2">{{ __('Future Time') }}</h3>
                            <p class="text-4xl font-bold text-orange-600">@digits($stats['upcoming_appointments'])</p>
                        </div>
                        <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="glass-card rounded-2xl p-6 hover-lift animate-on-scroll">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-gray-600 text-sm font-medium mb-2">{{ __('Waiting') }}</h3>
                            <p class="text-4xl font-bold text-yellow-600">{{ $stats['pending_appointments'] }}</p>
                        </div>
                        <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="glass-card rounded-2xl p-6 hover-lift animate-on-scroll">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-gray-600 text-sm font-medium mb-2">{{ __('Completed') }}</h3>
                            <p class="text-4xl font-bold text-green-600">{{ $stats['completed_appointments'] }}</p>
                        </div>
                        <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="glass-card rounded-2xl p-6 mb-8 animate-on-scroll">
                <h3 class="text-xl font-bold mb-4 text-gray-800">{{ __('Clinical Sections') }}</h3>
                <div class="flex gap-4 flex-wrap">
                    <a href="{{ route('patient.doctors') }}" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 font-medium inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                         {{ __('View Doctors') }}
                    </a>
                
                    <a href="{{ route('profile.edit') }}" class="px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 font-medium inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ __('My Profile') }}
                    </a>
                </div>
            </div>

            <!-- Upcoming Appointments -->
            <div class="glass-card rounded-2xl p-6 mb-8 animate-on-scroll">
                <h3 class="text-2xl font-bold mb-6 text-gray-800">{{ __('Future Times') }} ({{ $stats['upcoming_appointments'] }})</h3>
                
                @if($upcomingAppointments->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b-2 border-gray-200 bg-gray-50/50">
                                    <th class="text-right p-4 font-bold text-gray-700">{{ __('Date') }}</th>
                                    <th class="text-right p-4 font-bold text-gray-700">{{ __('Time') }}</th>
                                    <th class="text-right p-4 font-bold text-gray-700">{{ __('Doctor') }}</th>
                                    <th class="text-right p-4 font-bold text-gray-700">{{ __('Specialization') }}</th>
                                    <th class="text-right p-4 font-bold text-gray-700">{{ __('Status') }}</th>
                                    <th class="text-right p-4 font-bold text-gray-700">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white/50">
                                @foreach($upcomingAppointments as $appointment)
                                <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition-colors duration-200">
                                    <td class="p-4 font-medium text-gray-800">@digits($appointment->appointment_date)</td>
                                    <td class="p-4 font-medium text-gray-800">@digits(str_replace(['AM', 'PM'], [__('AM'), __('PM')], $appointment->appointment_time))</td>
                                    <td class="p-4 font-medium text-gray-800">{{ __('Dr.') }} {{ $appointment->doctor->user->localized_name }}</td>
                                    <td class="p-4 text-blue-600 font-semibold">{{ $appointment->doctor->specialization->name }}</td>
                                    <td class="p-4">
                                        @if($appointment->status == 'pending')
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">{{ __('Pending') }}</span>
                                        @elseif($appointment->status == 'confirmed')
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200">{{ __('Confirmed') }}</span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <a href="{{ route('patient.appointments.show', $appointment->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold hover:underline inline-flex items-center gap-1">
                                            <span>{{ __('View') }}</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-gray-500 text-lg">{{ __('No upcoming appointments') }}</p>
                    </div>
                @endif
            </div>

            <!-- Recent Appointments History -->
            <div class="glass-card rounded-2xl p-6 animate-on-scroll">
                <h3 class="text-2xl font-bold mb-6 text-gray-800">{{ __('Appointment History') }}</h3>
                
                @if($recentAppointments->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b-2 border-gray-200 bg-gray-50/50">
                                    <th class="text-right p-4 font-bold text-gray-700">{{ __('Date') }}</th>
                                    <th class="text-right p-4 font-bold text-gray-700">{{ __('Time') }}</th>
                                    <th class="text-right p-4 font-bold text-gray-700">{{ __('Doctor') }}</th>
                                    <th class="text-right p-4 font-bold text-gray-700">{{ __('Status') }}</th>
                                    <th class="text-right p-4 font-bold text-gray-700">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white/50">
                                @foreach($recentAppointments as $appointment)
                                <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition-colors duration-200">
                                    <td class="p-4 font-medium text-gray-800">@digits($appointment->appointment_date)</td>
                                    <td class="p-4 font-medium text-gray-800">@digits(str_replace(['AM', 'PM'], [__('AM'), __('PM')], $appointment->appointment_time))</td>
                                    <td class="p-4 font-medium text-gray-800">{{ __('Dr.') }} {{ $appointment->doctor->user->localized_name }}</td>
                                    <td class="p-4">
                                        @if($appointment->status == 'pending')
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">{{ __('Pending') }}</span>
                                        @elseif($appointment->status == 'confirmed')
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200">{{ __('Confirmed') }}</span>
                                        @elseif($appointment->status == 'completed')
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">{{ __('Completed') }}</span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">{{ __('Cancelled') }}</span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <a href="{{ route('patient.appointments.show', $appointment->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold hover:underline inline-flex items-center gap-1">
                                            <span>{{ __('View') }}</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-gray-500 text-lg mb-4">{{ __('No appointments yet') }}</p>
                        <a href="{{ route('patient.doctors') }}" class="inline-block px-8 py-3 bg-gradient-to-r from-blue-500 to-teal-500 text-white rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 font-bold">
                            {{ __('Get Started - View Doctors') }}
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>