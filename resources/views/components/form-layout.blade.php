<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Az Store') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200/50 py-4 px-6">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="/dashboard" class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium no-underline transition-all hover:bg-gray-50 hover:border-gray-400 shadow-sm">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Form Transaksi</h1>
                    <p class="text-gray-600 text-sm mt-1">Mengumpulkan informasi transaksi agar tercatat dengan akurat</p>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="text-sm text-gray-500">Az Store</div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="pt-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{ $slot }}
    </div>

    @livewireScripts
</body>
</html>