<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> @yield('title') - {{ config('app.name', 'Adelysia Coffee') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-white antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-r from-[#724B31] via -[#C9B09A] to-[#BFA188]">
            <div>
                <a href="/" style="font-size: 30px; font-weight: bold"; >Adelysia Coffee</a>
                    
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gradient-to-b from-[#E69947] via-[#CB752A] to-[#A95A1E] shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
