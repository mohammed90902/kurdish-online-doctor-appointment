<x-app-layout>
<div class="py-12 bg-gradient-to-br from-gray-50 to-blue-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- Search Header -->
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl font-black text-gray-800 tracking-tight">
                    {{ __('Search results for') }} <span class="text-blue-600">"{{ $query }}"</span>
                </h1>
                <p class="mt-2 text-gray-500 font-medium">{{ __('Search across entire system') }}</p>
            </div>
            <form action="{{ route('search') }}" method="GET" class="w-full md:w-96">
                <div class="relative group">
                    <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                    </svg>
                    <input type="text" name="q" value="{{ $query }}"
                        class="w-full rounded-2xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 py-3 pr-12 pl-4 text-base font-medium transition-all shadow-sm group-hover:border-blue-300"
                        placeholder="گەڕانێکی نوێ...">
                </div>
            </form>
        </div>

        @if($doctors->isEmpty() && $specializations->isEmpty() && $posts->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-3xl p-16 text-center shadow-sm border border-gray-100">
                <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">{{ __('No results found') }}</h2>
                <p class="text-gray-500 mt-2 max-w-md mx-auto">{{ __('No info for search term') }} "{{ $query }}". {{ __('Try again with different words.') }}</p>
                <a href="{{ route('home') }}" class="inline-block mt-8 px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 hover:shadow-lg transition-all">{{ __('Back to Home') }}</a>
            </div>
        @else
            <!-- Doctors Grid -->
            @if($doctors->isNotEmpty())
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <span class="p-2 bg-blue-100 text-blue-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </span>
                    <h2 class="text-2xl font-bold text-gray-800">{{ __('Doctors') }} <span class="text-base font-medium text-gray-400">({{ $doctors->count() }})</span></h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($doctors as $doctor)
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <img src="{{ $doctor->profile_image ? asset('storage/'.$doctor->profile_image) : asset('images/default-doctor.png') }}" alt="{{ $doctor->user->localized_name }}" class="w-16 h-16 rounded-2xl object-cover shadow-inner">
                            <div>
                                <h3 class="font-bold text-lg text-gray-800">{{ $doctor->user->localized_name }}</h3>
                                <p class="text-blue-600 text-sm font-semibold mb-1">{{ $doctor->specialization->name ?? 'پزیشکی گشتی' }}</p>
                                <p class="text-gray-500 text-xs line-clamp-2 leading-relaxed">{{ $doctor->bio }}</p>
                            </div>
                        </div>
                        <a href="{{ route('patient.doctors.show', $doctor->id) }}" class="mt-4 block w-full text-center py-2.5 bg-gray-50 hover:bg-blue-50 text-blue-600 font-bold text-sm rounded-xl transition-colors">بینینی پرۆفایل</a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Specializations List -->
            @if($specializations->isNotEmpty())
            <div class="{{ $doctors->isNotEmpty() ? 'pt-8 border-t border-gray-200/60' : '' }}">
                <div class="flex items-center gap-3 mb-6">
                    <span class="p-2 bg-purple-100 text-purple-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </span>
                    <h2 class="text-2xl font-bold text-gray-800">{{ __('Specializations') }} <span class="text-base font-medium text-gray-400">({{ $specializations->count() }})</span></h2>
                </div>
                <div class="flex flex-wrap gap-4">
                    @foreach($specializations as $spec)
                    <a href="{{ route('specialties.all') }}" class="group flex items-center gap-3 bg-white p-4 rounded-2xl shadow-sm border border-gray-100 hover:border-purple-300 hover:shadow-md transition-all">
                        <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center shrink-0 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                            @if($spec->icon)
                                <i class="{{ $spec->icon }} text-xl"></i>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 group-hover:text-purple-700 transition-colors">{{ $spec->name }}</h3>
                            <p class="text-xs text-gray-500">{{ $spec->doctors_count }} پزیشک هەیە</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Posts Grid -->
            @if($posts->isNotEmpty())
            <div class="{{ ($doctors->isNotEmpty() || $specializations->isNotEmpty()) ? 'pt-8 border-t border-gray-200/60' : '' }}">
                <div class="flex items-center gap-3 mb-6">
                    <span class="p-2 bg-teal-100 text-teal-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </span>
                    <h2 class="text-2xl font-bold text-gray-800">{{ __('Posts') }} <span class="text-base font-medium text-gray-400">({{ $posts->count() }})</span></h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($posts as $post)
                    <div class="bg-white rounded-3xl p-5 shadow-sm border border-gray-100 hover:shadow-lg transition-all flex flex-col sm:flex-row gap-5">
                        <img src="{{ $post->image ? asset('storage/'.$post->image) : asset('images/default-post.jpg') }}" alt="{{ $post->title }}" class="w-full sm:w-1/3 h-32 object-cover rounded-2xl shrink-0">
                        <div class="flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-gray-800 leading-tight line-clamp-2 hover:text-teal-600"><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h3>
                                <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ strip_tags($post->content) }}</p>
                            </div>
                            <div class="mt-4 flex items-center justify-between text-xs font-medium">
                                <span class="text-teal-600 bg-teal-50 px-2 py-1 rounded-lg">بابەتی تەندروستی</span>
                                <a href="{{ route('posts.show', $post->id) }}" class="text-gray-400 hover:text-gray-700 transition-colors">خوێندنەوەی زیاتر...</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        @endif
    </div>
</div>
</x-app-layout>
