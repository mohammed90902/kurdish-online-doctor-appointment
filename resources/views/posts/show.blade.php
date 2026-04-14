<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-2xl border border-gray-100 animate-fade-in">
                @if($post->image)
                    <div class="w-full h-[400px] overflow-hidden">
                        <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover" alt="{{ $post->title }}">
                    </div>
                @endif

                <div class="p-10 md:p-16">
                    <div class="flex items-center gap-4 mb-8">
                        @if($post->user->isDoctor() && $post->user->doctorProfile && $post->user->doctorProfile->profile_image)
                            <img src="{{ asset('storage/' . $post->user->doctorProfile->profile_image) }}" class="w-14 h-14 rounded-full object-cover border-2 border-blue-500 shadow-md" alt="">
                        @elseif($post->user->isAdmin())
                            <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center border-2 border-indigo-500 shadow-md">
                                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                        @else
                            <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center border-2 border-blue-500 shadow-md">
                                <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                        @endif
                        
                        <div>
                            <h4 class="font-bold text-xl text-gray-900">
                                @if($post->user->isAdmin())
                                    {{ __('System Management') }}
                                @else
                                    {{ $post->user->localized_name }}
                                @endif
                            </h4>
                            <p class="text-sm text-gray-500 font-medium">
                                @if($post->user->isDoctor())
                                    {{ $post->user->doctorProfile->specialization->name ?? __('Specialist') }}
                                @else
                                    {{ __('Official Announcement') }}
                                @endif
                                <span class="mx-2">•</span>
                                {{ $post->created_at->translatedFormat('d M Y') }}
                            </p>
                        </div>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-8 leading-tight">
                        {{ $post->title }}
                    </h1>

                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed space-y-6 text-xl">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    <div class="mt-16 pt-8 border-t border-gray-100 flex justify-end items-center">
                        
                        <div class="flex gap-4">
                            <!-- Share Button -->
                            <button onclick="sharePost()" class="p-4 bg-blue-50 text-blue-600 rounded-2xl hover:bg-blue-100 transition-all duration-300 shadow-sm border border-blue-100 group">
                                <svg class="w-7 h-7 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                                </svg>
                            </button>

                            <script>
                                function sharePost() {
                                    if (navigator.share) {
                                        navigator.share({
                                            title: "{{ $post->title }}",
                                            text: "{{ __('Reading post:') }} {{ $post->title }} {{ __('at medical system') }}",
                                            url: window.location.href
                                        }).catch(console.error);
                                    } else {
                                        // Fallback if browser doesn't support Web Share API
                                        navigator.clipboard.writeText(window.location.href);
                                        alert("{{ __('Post link copied') }}");
                                    }
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
    </style>
</x-app-layout>
