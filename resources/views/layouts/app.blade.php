<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Kurdish Doctor Appointment') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

        <!-- Local Fonts -->
        <link rel="stylesheet" href="{{ asset('css/google-fonts.css') }}">
        <link rel="stylesheet" href="{{ asset('css/rabar-font.css') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <style> [x-cloak] { display: none !important; } </style>
        <script defer src="{{ asset('js/alpine.js') }}"></script>

    </head>
    <body class="font-sans antialiased overflow-x-hidden">
        <div class="min-h-screen bg-gradient-to-br from-blue-50 via-cyan-50 to-teal-50">
            <!-- Navigation (Fixed) -->
            <div class="fixed top-0 inset-x-0 z-[100] shadow-xl">
                @include('layouts.navigation')
            </div>

            <!-- Content Area with Padding for Fixed Header -->
            <div class="pt-16">
                <!-- Page Heading (Optional Sub-Header) -->
                @isset($header)
                    <header class="bg-white/95 backdrop-blur-2xl shadow-md border-b border-gray-100">
                        <div class="max-w-7xl mx-auto py-10 px-4 md:px-8 flex flex-col items-center text-center bg-transparent">
                            <div class="mb-4 w-full">
                                {{ $header }}
                            </div>
                            <div class="h-1.5 w-24 bg-gradient-to-r from-blue-600 to-teal-500 rounded-full shadow-sm"></div>
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="animate-fadeIn max-w-[100vw]">
                    {{ $slot }}
                </main>
            </div>

            <!-- Health AI Chat -->
            <x-health-ai-chat />

            <!-- Global Footer -->
            @include('layouts.footer')
        </div>
    </body>
</html>
