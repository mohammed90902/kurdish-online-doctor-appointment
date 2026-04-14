<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h1 class="text-5xl font-black text-blue-600 mb-6 drop-shadow-sm">{{ __('Health Advice') }}</h1>
            <div class="h-2 w-32 bg-gradient-to-r from-blue-600 to-teal-500 mx-auto rounded-full mb-8"></div>
            <p class="text-gray-500 text-xl font-bold">{{ __('Latest posts from our specialist doctors can be seen here') }}</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($posts as $post)
                <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-xl border border-gray-100 flex flex-col hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 group">
                    @if($post->image)
                        <div class="h-60 overflow-hidden relative">
                            <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $post->title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                    @endif
                    <div class="p-8 flex-1 flex flex-col">
                        <div class="flex items-center gap-4 mb-6">
                            @if($post->user->doctorProfile && $post->user->doctorProfile->profile_image)
                                <img src="{{ asset('storage/' . $post->user->doctorProfile->profile_image) }}" class="w-14 h-14 rounded-full object-cover ring-4 ring-blue-50 shadow-md" alt="{{ $post->user->localized_name }}">
                            @else
                                <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xl ring-4 ring-blue-50">
                                    {{ substr($post->user->localized_name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <p class="font-black text-gray-800 text-lg">{{ $post->user->localized_name }}</p>
                                <p class="text-sm text-blue-500 font-bold tracking-wide">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <h3 class="text-2xl font-black text-gray-900 mb-4 line-clamp-2 leading-tight group-hover:text-blue-600 transition-colors">{{ $post->title }}</h3>
                        <p class="text-gray-600 line-clamp-3 mb-8 flex-1 text-base leading-relaxed">{{ $post->content }}</p>
                        
                        <a href="{{ route('posts.show', $post->id) }}" class="inline-flex items-center justify-center w-full py-4 px-6 bg-gray-50 text-blue-600 font-black rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                            زیاتر بخوێنەوە
                            <svg class="w-5 h-5 mr-2 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-16">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
