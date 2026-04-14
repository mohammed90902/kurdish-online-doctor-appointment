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

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        
        <!-- Local Alpine.js -->
        <script defer src="{{ asset('js/alpine.js') }}"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-50 via-cyan-50 to-teal-50 relative overflow-hidden">
            <!-- Decorative Background Elements -->
            <div class="absolute top-0 left-0 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-teal-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 2s;"></div>
            
            <!-- Logo -->
            <div class="relative z-10 mb-6">
                <a href="/" class="block">
                    <img src="{{ asset('images/logo.png') }}" alt="سیستەمی پزیشکی" class="h-32 w-auto object-contain hover:scale-105 transition-transform duration-300 mx-auto">
                </a>
            </div>

            <!-- Auth Card -->
            <div class="w-full sm:max-w-md relative z-10">
                <div class="glass-card rounded-2xl p-8 shadow-2xl animate-slideUp">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
