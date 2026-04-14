<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            

            <!-- Page Header -->
            <div class="text-center mb-16 bg-white/50 backdrop-blur-md p-12 rounded-[3.5rem] shadow-sm border border-white/40 animate-slideDown">
                <h3 class="text-5xl md:text-6xl font-black text-blue-600 mb-6 drop-shadow-sm">{{ __('All Doctors') }}</h3>
                <div class="h-2 w-32 bg-gradient-to-r from-blue-600 to-teal-500 mx-auto rounded-full mb-8"></div>
                <p class="text-gray-500 text-lg md:text-xl font-bold tracking-wide">{{ __('Find Doctors Intro') }}</p>
            </div>

            @if($doctors->count() > 0)
                <!-- Doctors Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($doctors as $doctor)
                        <div class="glass-card rounded-2xl p-6 card-hover">
                            <!-- Doctor Info -->
                            <div class="text-center">
                                <!-- Avatar -->
                                <div class="relative w-32 h-32 mx-auto mb-6">
                                    <div class="absolute inset-0 bg-blue-500 rounded-full blur-2xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                                    <div class="relative w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-lg mx-auto">
                                        @if($doctor->profile_image)
                                            <img src="{{ asset('storage/' . $doctor->profile_image) }}" alt="د. {{ $doctor->user->localized_name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-teal-500 flex items-center justify-center">
                                                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ __('Dr.') }} {{ $doctor->user->localized_name }}</h3>
                                <p class="text-blue-600 font-semibold text-lg mb-4">{{ $doctor->specialization->name }}</p>
                                
                                <div class="space-y-2 mb-6">
                                    @if($doctor->experience_years)
                                        <div class="flex items-center justify-center gap-2 text-gray-700">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z"></path>
                                            </svg>
                                            <span class="font-medium">{{ $doctor->experience_years }} {{ __('years of experience') }}</span>
                                        </div>
                                    @endif
                                    
                                    @if($doctor->consultation_fee)
                                        <div class="flex items-center justify-center gap-2 text-gray-700">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="font-medium">{{ number_format($doctor->consultation_fee) }} {{ __('IQD') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                <a href="{{ route('patient.doctors.show', $doctor->user->id) }}" 
                                   class="block w-full bg-white/80 text-gray-800 text-center px-6 py-3 rounded-xl hover:bg-white hover:shadow-lg transition-all duration-300 font-semibold border border-gray-200">
                                     {{ __('View Details') }}
                                 </a>
                                @auth
                                    @if(!Auth::user()->isDoctor() && !Auth::user()->isAdmin())
                                        <a href="{{ route('patient.doctors.book', $doctor->user->id) }}" 
                                           class="block w-full bg-gradient-to-r from-green-500 to-emerald-500 text-white text-center px-6 py-3 rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 font-bold">
                                             {{ __('Book Now') }}
                                         </a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="glass-card rounded-2xl p-6">
                    {{ $doctors->links() }}
                </div>

            @else
                <!-- No Doctors Found -->
                <div class="glass-card rounded-2xl p-12">
                    <div class="text-center">
                        <svg class="mx-auto h-24 w-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <h3 class="mt-2 text-2xl font-bold text-gray-800 mb-2">{{ __('No doctors found') }}</h3>
                        <p class="mt-1 text-gray-600 mb-6">{{ __('No doctors available at this time') }}</p>
                        <a href="{{ route('home') }}" 
                           class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-500 to-teal-500 text-white rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 font-bold">
                            {{ __('Back to Main') }}
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>