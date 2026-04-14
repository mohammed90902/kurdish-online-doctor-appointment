
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Doctor Dashboard') }}
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

            <!-- Welcome Message - Premium Design -->
            <div class="glass-card overflow-hidden shadow-2xl rounded-[2.5rem] mb-10 animate-slideUp relative">
                <!-- Decorative background elements -->
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 bg-blue-400/20 rounded-full blur-3xl"></div>
                
                <div class="bg-gradient-to-br from-blue-700 via-indigo-700 to-blue-800 p-8 md:p-12 text-white relative z-10">
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <!-- Profile Image -->
                        <div class="relative">
                            <div class="w-32 h-32 md:w-40 md:h-40 bg-white/20 backdrop-blur-xl rounded-[2.5rem] flex items-center justify-center overflow-hidden border-4 border-white/30 shadow-2xl transform -rotate-3 hover:rotate-0 transition-transform duration-500">
                                @if($doctor->profile_image)
                                    <img src="{{ asset('storage/' . $doctor->profile_image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <!-- Status Badge -->
                            <div class="absolute -bottom-2 -right-2 bg-green-500 border-4 border-indigo-700 w-10 h-10 rounded-2xl flex items-center justify-center shadow-lg transform rotate-12" title="{{ __('Active') }}">
                                <div class="w-3 h-3 bg-white rounded-full animate-pulse"></div>
                            </div>
                        </div>

                        <!-- Text Content -->
                        <div class="text-right flex-1">
                            <div class="inline-flex items-center px-4 py-1.5 bg-white/10 backdrop-blur-md border border-white/20 rounded-full mb-4">
                                <span class="flex h-2 w-2 rounded-full bg-green-400 ml-2"></span>
                                <span class="text-sm font-bold text-blue-50">{{ __('Doctor profile is active') }}</span>
                            </div>
                            <h3 class="text-4xl md:text-5xl font-black mb-3 tracking-tight">{{ __('Welcome') }}  {{ $doctor->user->localized_name }} 👋</h3>
                            <div class="flex flex-wrap items-center justify-start gap-4 text-blue-100">
                                <div class="flex items-center gap-2 text-xl font-bold">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    {{ $doctor->specialization->name }}
                                </div>
                            </div>
                        </div>

                        <!-- Quick Action -->
                        <div class="md:shrink-0 w-full md:w-auto">
                            <a href="{{ route('profile.edit') }}" class="flex items-center justify-center px-8 py-4 bg-white text-blue-700 rounded-2xl font-black shadow-xl hover:bg-blue-50 hover:-translate-y-1 transition-all duration-300">
                                <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                 {{ __('Profile Settings') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                <!-- Total Appointments -->
                <div class="glass-card rounded-2xl p-6 hover-lift animate-on-scroll">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <span class="text-blue-600 bg-blue-50 px-2 py-1 rounded-lg text-xs font-bold">{{ __('Total sum') }}</span>
                    </div>
                    <div>
                        <h3 class="text-gray-500 text-sm font-bold mb-1">{{ __('Total Appointments') }}</h3>
                        <p class="text-3xl font-bold text-gray-800">@digits($stats['total_appointments'])</p>
                    </div>
                </div>

                <!-- Today's Appointments -->
                <div class="glass-card rounded-2xl p-6 hover-lift animate-on-scroll" style="animation-delay: 0.1s;">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span class="text-orange-600 bg-orange-50 px-2 py-1 rounded-lg text-xs font-bold">{{ __('Today') }}</span>
                    </div>
                    <div>
                        <h3 class="text-gray-500 text-sm font-bold mb-1">{{ __('Today\'s Times') }}</h3>
                        <p class="text-3xl font-bold text-gray-800">@digits($stats['today_appointments'])</p>
                    </div>
                </div>

                <!-- Pending -->
                <div class="glass-card rounded-2xl p-6 hover-lift animate-on-scroll" style="animation-delay: 0.2s;">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-yellow-600 bg-yellow-50 px-2 py-1 rounded-lg text-xs font-bold">{{ __('Waiting') }}</span>
                    </div>
                    <div>
                        <h3 class="text-gray-500 text-sm font-bold mb-1">{{ __('Waiting') }}</h3>
                        <p class="text-3xl font-bold text-gray-800">@digits($stats['pending_appointments'])</p>
                    </div>
                </div>

                <!-- Completed -->
                <div class="glass-card rounded-2xl p-6 hover-lift animate-on-scroll" style="animation-delay: 0.3s;">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-green-600 bg-green-50 px-2 py-1 rounded-lg text-xs font-bold">{{ __('Completed') }}</span>
                    </div>
                    <div>
                        <h3 class="text-gray-500 text-sm font-bold mb-1">{{ __('Completed') }}</h3>
                        <p class="text-3xl font-bold text-gray-800">@digits($stats['completed_appointments'])</p>
                    </div>
                </div>

                <!-- Schedules -->
                <div class="glass-card rounded-2xl p-6 hover-lift animate-on-scroll" style="animation-delay: 0.4s;">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span class="text-purple-600 bg-purple-50 px-2 py-1 rounded-lg text-xs font-bold">{{ __('Schedules') }}</span>
                    </div>
                    <div>
                        <h3 class="text-gray-500 text-sm font-bold mb-1">{{ __('Time Schedule') }}</h3>
                        <p class="text-3xl font-bold text-gray-800">@digits($stats['total_schedules'])</p>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="glass-card overflow-hidden shadow-xl rounded-2xl mb-8 animate-on-scroll">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center">
                            <span class="w-2 h-8 bg-blue-500 rounded-full ml-3"></span>
                            {{ __('Management and Quick Actions') }}
                        </h3>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                        <a href="{{ route('doctor.appointments.index') }}" class="flex flex-col items-center justify-center p-6 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-2xl transition-all shadow-sm border border-blue-100 group">
                            <div class="p-3 bg-white rounded-xl mb-3 shadow-sm group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="font-bold">{{ __('View Appointments') }}</span>
                        </a>
                        
                        <a href="{{ route('doctor.schedules.create') }}" class="flex flex-col items-center justify-center p-6 bg-purple-50 hover:bg-purple-100 text-purple-700 rounded-2xl transition-all shadow-sm border border-purple-100 group">
                            <div class="p-3 bg-white rounded-xl mb-3 shadow-sm group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <span class="font-bold">{{ __('Add New Schedule') }}</span>
                        </a>

                        <a href="{{ route('doctor.schedules.index') }}" class="flex flex-col items-center justify-center p-6 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 rounded-2xl transition-all shadow-sm border border-indigo-100 group">
                            <div class="p-3 bg-white rounded-xl mb-3 shadow-sm group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <span class="font-bold">{{ __('Manage Schedules') }}</span>
                        </a>

                        <a href="{{ route('doctor.posts.create') }}" class="flex flex-col items-center justify-center p-6 bg-amber-50 hover:bg-amber-100 text-amber-700 rounded-2xl transition-all shadow-sm border border-amber-100 group">
                            <div class="p-3 bg-white rounded-xl mb-3 shadow-sm group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <span class="font-bold">{{ __('Write Subject') }}</span>
                        </a>

                        <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center p-6 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 rounded-2xl transition-all shadow-sm border border-emerald-100 group">
                            <div class="p-3 bg-white rounded-xl mb-3 shadow-sm group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span class="font-bold">{{ __('Profile Settings') }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Create Post Info Card -->
                <div class="lg:col-span-1">
                    <div class="glass-card bg-gradient-to-br from-indigo-500 to-blue-600 rounded-2xl p-8 text-white h-full relative overflow-hidden group">
                        <div class="relative z-10">
                            <h3 class="text-2xl font-black mb-4">{{ __('Publish Medical Posts Message Header') }}</h3>
                            <p class="text-white/80 mb-8 leading-relaxed">
                                {{ __('Publish medical posts description') }}
                            </p>
                            <a href="{{ route('doctor.posts.create') }}" class="inline-flex items-center px-6 py-3 bg-white text-indigo-600 rounded-xl font-bold hover:shadow-lg transition-all group-hover:translate-x-2">
                                {{ __('Publish Post') }}
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-all group-hover:scale-150"></div>
                    </div>
                </div>

                <!-- Latest Posts Link Card -->
                <div class="lg:col-span-2">
                    <div class="glass-card bg-white rounded-2xl p-8 border border-gray-100 flex flex-col justify-between h-full">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-xl font-bold text-gray-800">{{ __('Manage Medical Articles') }}</h4>
                            <a href="{{ route('doctor.posts.index') }}" class="text-blue-600 font-bold hover:underline">{{ __('See All') }}</a>
                        </div>
                        <p class="text-gray-500 mb-8">{{ __('Manage medical articles description') }}</p>
                        <div class="flex gap-4">
                            <div class="flex-1 p-4 bg-gray-50 rounded-xl text-center">
                                <span class="block text-2xl font-black text-gray-800 mb-1">...</span>
                                <span class="text-sm text-gray-500 font-bold">{{ __('Published Posts') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Appointments -->
            <div class="glass-card overflow-hidden shadow-xl rounded-2xl mb-8 animate-on-scroll">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center">
                        <span class="w-2 h-8 bg-blue-500 rounded-full ml-3"></span>
                        {{ __('Today\'s Times') }} ({{ $stats['today_appointments'] }})
                    </h3>
                    
                    @if($todayAppointments->count() > 0)
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold animate-pulse">
                            {{ __('Active') }}
                        </span>
                    @endif
                </div>
                
                <div class="p-0">
                    @if($todayAppointments->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50/50">
                                    <tr>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Queue') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Time') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Patient') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Symptoms') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white/50 divide-y divide-gray-100">
                                    @foreach($todayAppointments as $todayAppointment)
                                    <tr class="hover:bg-blue-50/30 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-50 text-blue-700 font-bold text-xs border border-blue-100 italic">
                                                {{ $todayAppointment->queue_number }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900" dir="ltr">{{ $todayAppointment->appointment_time }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gradient-to-r from-blue-400 to-blue-500 flex items-center justify-center text-white font-bold text-xs shadow-sm">
                                                    {{ substr($todayAppointment->patient->user->localized_name, 0, 1) }}
                                                </div>
                                                <div class="mr-3">
                                                    <div class="text-sm font-bold text-gray-900">{{ $todayAppointment->patient->user->localized_name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-600 max-w-xs truncate">{{ Str::limit($todayAppointment->symptoms ?? __('None'), 40) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($todayAppointment->status == 'pending')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800">{{ __('Pending') }}</span>
                                            @elseif($todayAppointment->status == 'confirmed')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-blue-100 text-blue-800">{{ __('Confirmed') }}</span>
                                            @elseif($todayAppointment->status == 'completed')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800">{{ __('Completed') }}</span>
                                            @else
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-red-100 text-red-800">{{ __('Cancelled') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('doctor.appointments.show', $todayAppointment->id) }}" class="text-blue-600 hover:text-blue-900 font-bold hover:underline transition-all">{{ __('View') }}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium">{{ __('No appointments for today') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Upcoming Appointments -->
            <div class="glass-card overflow-hidden shadow-xl rounded-2xl animate-on-scroll">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center">
                        <span class="w-2 h-8 bg-purple-500 rounded-full ml-3"></span>
                        {{ __('Future Times') }}
                    </h3>
                </div>
                
                <div class="p-0">
                    @if($upcomingAppointments->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50/50">
                                    <tr>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Date') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Time') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Patient') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white/50 divide-y divide-gray-100">
                                    @foreach($upcomingAppointments as $upcomingAppointment)
                                    <tr class="hover:bg-purple-50/30 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-700">{{ $upcomingAppointment->appointment_date }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900" dir="ltr">{{ $upcomingAppointment->appointment_time }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-3">
                                                    <div class="text-sm font-bold text-gray-900">{{ $upcomingAppointment->patient->user->localized_name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($upcomingAppointment->status == 'pending')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800">{{ __('Pending') }}</span>
                                            @elseif($upcomingAppointment->status == 'confirmed')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-blue-100 text-blue-800">{{ __('Confirmed') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('doctor.appointments.show', $upcomingAppointment->id) }}" class="text-blue-600 hover:text-blue-900 font-bold hover:underline transition-all">{{ __('View') }}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 font-medium">{{ __('No upcoming appointments') }}</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
