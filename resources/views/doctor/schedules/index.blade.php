
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Manage Schedules') }}
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

            <div class="flex justify-end items-center mb-6">
                <a href="{{ route('doctor.schedules.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 font-bold">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    {{ __('Add New Schedule') }}
                </a>
            </div>

            <div class="glass-card overflow-hidden shadow-xl rounded-2xl animate-on-scroll">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center">
                        <span class="w-2 h-8 bg-blue-500 rounded-full ml-3"></span>
                        {{ __('Time Schedule') }}
                    </h3>
                </div>

                <div class="p-0">
                    @if($schedules->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50/50">
                                    <tr>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Day') }} / {{ __('Date') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Start Time') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('End Time') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Patients') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white/50 divide-y divide-gray-100">
                                    @foreach($schedules as $schedule)
                                    <tr class="hover:bg-blue-50/30 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-bold text-gray-800">
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
                                                </span>
                                                <span class="text-xs text-blue-600 font-bold mt-1">
                                                    @php
                                                        $date = \Carbon\Carbon::parse($schedule->day_of_week);
                                                        if ($date->isPast() && !$date->isToday()) {
                                                            $date = $date->addWeek();
                                                        }
                                                    @endphp
                                                    @digits($date->format('d/m/Y'))
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700" dir="ltr">@digits(str_replace(['AM', 'PM'], [__('AM'), __('PM')], $schedule->start_time))</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700" dir="ltr">@digits(str_replace(['AM', 'PM'], [__('AM'), __('PM')], $schedule->end_time))</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700 text-center font-bold">@digits($schedule->max_patients)</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($schedule->is_available)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                                    <span class="w-2 h-2 bg-green-500 rounded-full ml-2 animate-pulse"></span>
                                                    {{ __('Available') }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                                    {{ __('Inactive') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                                <form method="POST" action="{{ route('doctor.schedules.toggle', $schedule->id) }}">
                                                    @csrf
                                                    @if($schedule->is_available)
                                                        <button type="submit" class="text-yellow-600 hover:text-yellow-900 font-bold transition-colors hover:underline">
                                                            {{ __('Deactivate') }}
                                                        </button>
                                                    @else
                                                        <button type="submit" class="text-green-600 hover:text-green-900 font-bold transition-colors hover:underline">
                                                            {{ __('Activate') }}
                                                        </button>
                                                    @endif
                                                </form>
                                                
                                                <form method="POST" action="{{ route('doctor.schedules.destroy', $schedule->id) }}" onsubmit="return confirm('{{ __('Are you sure you want to delete?') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold transition-colors hover:underline">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium mb-4">{{ __('No records found') }}</p>
                            <a href="{{ route('doctor.schedules.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition font-bold">
                                {{ __('Add First Section') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>  

            <!-- Info Box -->
            <div class="glass-card bg-blue-50/50 border border-blue-100 p-6 mt-8 rounded-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-bold text-blue-800">{{ __('Note') }}</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <ul class="list-disc leading-relaxed space-y-1 pr-5">
                                <li>{{ __('Click to edit your schedule settings.') }}</li>
                                <li>{{ __('You can deactivate schedules without deleting them.') }}</li>
                                <li>{{ __('Determine how many patients can book in each slot.') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>













