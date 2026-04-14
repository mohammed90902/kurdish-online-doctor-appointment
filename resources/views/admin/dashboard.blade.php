
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
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

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Doctors -->
                <div class="glass-card p-6 rounded-2xl shadow-xl hover:-translate-y-2 transition-transform duration-300 relative overflow-hidden group animate-fade-in-up" style="animation-delay: 0.1s;">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-green-100/50 rounded-full -mr-16 -mt-16 transition-all group-hover:bg-green-200/50"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-gray-600 font-bold text-lg">{{ __('Total Doctors') }}</h3>
                            <div class="p-3 bg-green-100 rounded-xl text-green-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-4xl font-extrabold text-green-600">{{ $stats['total_doctors'] }}</p>
                        <p class="text-xs text-green-500 mt-2 font-medium">{{ __('Specialist Registered') }}</p>
                    </div>
                </div>


                <!-- Total Patients -->
                <div class="glass-card p-6 rounded-2xl shadow-xl hover:-translate-y-2 transition-transform duration-300 relative overflow-hidden group animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-blue-100/50 rounded-full -mr-16 -mt-16 transition-all group-hover:bg-blue-200/50"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-gray-600 font-bold text-lg">{{ __('Total Patients') }}</h3>
                            <div class="p-3 bg-blue-100 rounded-xl text-blue-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-4xl font-extrabold text-blue-600">{{ $stats['total_patients'] }}</p>
                        <p class="text-xs text-blue-500 mt-2 font-medium">{{ __('Patient Registered') }}</p>
                    </div>
                </div>

                <!-- Total Appointments -->
                <div class="glass-card p-6 rounded-2xl shadow-xl hover:-translate-y-2 transition-transform duration-300 relative overflow-hidden group animate-fade-in-up" style="animation-delay: 0.3s;">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-purple-100/50 rounded-full -mr-16 -mt-16 transition-all group-hover:bg-purple-200/50"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-gray-600 font-bold text-lg">{{ __('Total Appointments') }}</h3>
                            <div class="p-3 bg-purple-100 rounded-xl text-purple-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-4xl font-extrabold text-purple-600">{{ $stats['total_appointments'] }}</p>
                        <p class="text-xs text-purple-500 mt-2 font-medium">{{ __('All Types') }}</p>
                    </div>
                </div>

                <!-- Total Admins -->
                <div class="glass-card p-6 rounded-2xl shadow-xl hover:-translate-y-2 transition-transform duration-300 relative overflow-hidden group animate-fade-in-up" style="animation-delay: 0.4s;">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-orange-100/50 rounded-full -mr-16 -mt-16 transition-all group-hover:bg-orange-200/50"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-gray-600 font-bold text-lg">{{ __('Total Admins') }}</h3>
                            <div class="p-3 bg-orange-100 rounded-xl text-orange-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-4xl font-extrabold text-orange-600">{{ $stats['total_admins'] }}</p>
                        <p class="text-xs text-orange-500 mt-2 font-medium">{{ __('Admin Registered') }}</p>
                    </div>
                </div>
            </div>

            <!-- Create Post Section -->
            <div class="glass-card rounded-2xl p-6 mb-8 animate-fade-in-up" style="animation-delay: 0.35s;">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 flex items-center mb-1">
                            <svg class="w-6 h-6 ml-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            {{ __('Publish Posts & News') }}
                        </h3>
                        <p class="text-gray-500 text-sm">{{ __('Dashboard Intro Message') }}</p>
                    </div>
                    <a href="{{ route('admin.posts.create') }}" class="px-8 py-4 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 font-bold flex items-center">
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        {{ __('Publish New Post') }}
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="glass-card overflow-hidden shadow-xl rounded-2xl mb-8 animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <span class="w-2 h-8 bg-indigo-500 rounded-full ml-3"></span>
                        {{ __('Sections') }}
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
                        <a href="{{ route('admin.doctors.index') }}" class="flex items-center justify-center px-6 py-4 bg-blue-50 text-blue-700 rounded-xl hover:bg-blue-100 transition shadow-sm font-bold border border-blue-200 hover:shadow-md">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ __('Manage Doctors') }}
                        </a>
                        <a href="{{ route('admin.doctors.create') }}" class="flex items-center justify-center px-6 py-4 bg-green-50 text-green-700 rounded-xl hover:bg-green-100 transition shadow-sm font-bold border border-green-200 hover:shadow-md">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            {{ __('Add New Doctor') }}
                        </a>
                        <a href="{{ route('admin.patients.index') }}" class="flex items-center justify-center px-6 py-4 bg-teal-50 text-teal-700 rounded-xl hover:bg-teal-100 transition shadow-sm font-bold border border-teal-200 hover:shadow-md">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            {{ __('Manage Patients') }}
                        </a>
                        <a href="{{ route('admin.contacts.index') }}" class="flex items-center justify-center px-6 py-4 bg-violet-50 text-violet-700 rounded-xl hover:bg-violet-100 transition shadow-sm font-bold border border-violet-200 hover:shadow-md">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                            {{ __('Messages') }}
                        </a>
                        <a href="{{ route('admin.admins.index') }}" class="flex items-center justify-center px-6 py-4 bg-indigo-50 text-indigo-700 rounded-xl hover:bg-indigo-100 transition shadow-sm font-bold border border-indigo-200 hover:shadow-md">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            {{ __('Manage Admins') }}
                        </a>
                        <a href="{{ route('admin.specializations.index') }}" class="flex items-center justify-center px-6 py-4 bg-purple-50 text-purple-700 rounded-xl hover:bg-purple-100 transition shadow-sm font-bold border border-purple-200 hover:shadow-md">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                           {{ __('Specializations') }}  
                        </a>
                        <a href="{{ route('admin.posts.index') }}" class="flex items-center justify-center px-6 py-4 bg-amber-50 text-amber-700 rounded-xl hover:bg-amber-100 transition shadow-sm font-bold border border-amber-200 hover:shadow-md">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                            {{ __('Manage Posts') }}
                        </a>
                    </div>
                </div>
            </div>


            <!-- Recent Contacts -->
            <div class="glass-card overflow-hidden shadow-xl rounded-2xl animate-fade-in-up" style="animation-delay: 0.5s;">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center justify-between">
                        <span class="flex items-center">
                            <span class="w-2 h-8 bg-purple-500 rounded-full ml-3"></span>
                            {{ __('New Messages') }}
                        </span>
                        <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-bold">{{ $stats['new_contacts'] }}</span>
                    </h3>
                </div>
                
                <div class="p-0">
                    @if($recentContacts->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50/50">
                                    <tr>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Email') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Subject') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Date') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white/50 divide-y divide-gray-100">
                                    @foreach($recentContacts as $contact)
                                    <tr class="hover:bg-purple-50/30 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-800">{{ $contact->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $contact->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ Str::limit($contact->subject, 30) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($contact->status == 'new')
                                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">{{ __('New') }}</span>
                                            @elseif($contact->status == 'read')
                                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-bold">{{ __('Read') }}</span>
                                            @else
                                                <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-bold">{{ __('Replied') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" dir="ltr">{{ $contact->created_at->diffForHumans() }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.contacts.show', $contact->id) }}" class="text-blue-600 hover:text-blue-900 font-bold hover:underline">{{ __('View') }}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-10">
                            <p class="text-gray-500">{{ __('No messages') }}</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>