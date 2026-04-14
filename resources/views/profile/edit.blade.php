<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            پرۆفایل
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="glass-card p-4 sm:p-8 shadow-xl rounded-2xl animate-fade-in-up">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="glass-card p-4 sm:p-8 shadow-xl rounded-2xl animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="glass-card p-4 sm:p-8 shadow-xl rounded-2xl animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
