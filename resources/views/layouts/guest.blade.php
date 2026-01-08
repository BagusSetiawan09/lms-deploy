<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Lerning') }}</title>

        <link rel="icon" href="{{ asset('image/icon-logo.png') }}" type="image/png">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen pt-6 sm:pt-0 bg-[#F8FBFF]">
            <div class="px-7 @stack('logo')">
                <a href="/">
                    <x-application-logo class="h-[120px] w-auto" />
                </a>
            </div>

            <div class="@stack('posisi')">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
