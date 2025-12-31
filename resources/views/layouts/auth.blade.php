<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-[Poppins] text-slate-800 antialiased bg-gray-50">

        <div class="fixed inset-0 -z-10 overflow-hidden">
             <div class="absolute -top-[20%] -left-[10%] w-[70%] h-[70%] rounded-full bg-gradient-to-r from-slate-200 to-gray-200 opacity-50 blur-[100px]"></div>
            <div class="absolute top-[20%] -right-[10%] w-[60%] h-[60%] rounded-full bg-gradient-to-r from-blue-50 to-purple-50 opacity-60 blur-[100px]"></div>
        </div>

        <a href="/" wire:navigate class="absolute top-8 left-8 flex items-center gap-2 text-slate-600 cursor-pointer hover:text-slate-900 transition z-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            <span class="text-xl font-bold">Logo</span>
        </a>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 p-6">
            <div class="w-full sm:max-w-[480px] mt-6 px-8 py-10 bg-white/80 backdrop-blur-md shadow-2xl shadow-slate-200/50 rounded-[2rem] border border-white/50 relative z-0">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
