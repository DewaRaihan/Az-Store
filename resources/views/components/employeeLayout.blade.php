<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen flex flex-col">

        <!-- Header -->
        <header class="w-full sticky top-0 z-40">
            <livewire:components.header-layout />
        </header>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-y-auto">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>

    </div>

    <!-- Global Loading Overlay -->
    <div wire:loading
         class="fixed inset-0 bg-black/10 backdrop-blur-[2px] z-50 flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-xl p-6 flex flex-col items-center">
            <div class="w-12 h-12 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mb-4"></div>
            <p class="text-gray-700 font-medium">Loading...</p>
        </div>
    </div>

    @livewireScripts

</body>
</html>
