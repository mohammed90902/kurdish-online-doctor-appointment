<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Manage Sections') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="glass-card bg-green-100/80 border-r-4 border-green-500 text-green-700 px-6 py-4 rounded-xl mb-8 shadow-lg animate-slideDown">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="font-bold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="glass-card bg-red-100/80 border-r-4 border-red-500 text-red-700 px-6 py-4 rounded-xl mb-8 shadow-lg animate-shake">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-bold">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 h-20">
                <div>
                    <h3 class="text-3xl font-black text-gray-800">{{ __('Clinical Sections') }}</h3>
                    <p class="text-gray-500 font-bold mt-1">{{ __('Add and edit clinical sections') }}</p>
                </div>
                <a href="{{ route('admin.specializations.create') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-black rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
                    <svg class="w-6 h-6 ml-2 group-hover:rotate-90 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    {{ __('Add New Section') }}
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($specializations as $spec)
                    <div class="glass-card overflow-hidden shadow-xl rounded-[2.5rem] bg-white border border-gray-100 group hover:shadow-2xl transition-all duration-500 animate-slideUp">
                        <!-- Image Container -->
                        <div class="h-48 overflow-hidden relative">
                            @if($spec->image)
                                <img src="{{ asset('storage/' . $spec->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            @endif
                            <!-- Overlay Badge -->
                            <div class="absolute top-4 right-4 px-4 py-2 bg-white/90 backdrop-blur text-blue-700 rounded-xl text-sm font-black shadow-lg">
                                {{ $spec->doctors_count }} {{ __('Doctors') }}
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-8">
                            <h4 class="text-2xl font-black text-gray-800 mb-3">{{ $spec->name }}</h4>
                            <p class="text-gray-500 font-medium mb-6 line-clamp-2 leading-relaxed h-12">
                                {{ $spec->description ?? 'هیچ تێبینییەک نەنوسراوە.' }}
                            </p>

                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.specializations.edit', $spec->id) }}" class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-blue-50 text-blue-700 rounded-xl font-bold hover:bg-blue-100 transition-colors">
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('admin.specializations.destroy', $spec->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete?') }}');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-3 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($specializations->isEmpty())
                <div class="glass-card p-20 text-center rounded-[3rem] bg-white border border-gray-100 animate-fadeIn">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h4 class="text-2xl font-black text-gray-800 mb-2">{{ __('No sections found') }}</h4>
                    <p class="text-gray-500 font-bold mb-8">{{ __('No medical sections added yet') }}</p>
                    <a href="{{ route('admin.specializations.create') }}" class="inline-flex items-center px-10 py-4 bg-indigo-600 text-white font-black rounded-2xl shadow-xl hover:bg-indigo-700 transition-all">
                        {{ __('Add First Section') }}
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
