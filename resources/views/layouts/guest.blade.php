<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Hệ thống Quản lý Sinh viên') }} - Xác thực</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Inter', sans-serif; }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased flex flex-col min-h-screen">
        @include('layouts.header')
        
        <main class="flex-grow flex items-center justify-center relative py-16" style="background-image: url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-blue-900/80 z-0 backdrop-blur-sm"></div>
            
            <div class="relative z-10 w-full sm:max-w-md px-8 py-10 bg-white/95 shadow-2xl overflow-hidden sm:rounded-[2rem] border border-white/20 backdrop-blur-md">
                {{ $slot }}
            </div>
        </main>

        @include('layouts.footer')
    </body>
</html>
