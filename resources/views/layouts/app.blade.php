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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <div class="fixed left-0 top-0 h-screen w-48 z-30">
                <livewire:components.sidebar :current-page="session('current_page', 'dashboard')" />
            </div>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col ml-48">
                <!-- Page Heading -->
                <livewire:components.header-layout />      
                <!-- Page Content -->
                <main class="flex-1 p-6 overflow-y-auto">
                    <div class="max-w-full mx-auto">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
        
        <!-- Loading Overlay Global -->
        <div wire:loading class="fixed inset-0 bg-black/10 backdrop-blur-[2px] z-50 flex items-center justify-center">
            <div class="bg-white rounded-xl shadow-xl p-6 flex flex-col items-center justify-center">
                <div class="w-12 h-12 border-3 border-blue-500 border-t-transparent rounded-full animate-spin mb-4"></div>
                <p class="text-gray-700 font-medium">Loading...</p>
            </div>
        </div>
        
        @livewireScripts
        
        <script>
            // Clear local storage saat logout atau session berakhir
            window.addEventListener('beforeunload', function() {
                // Optional: Hapus local storage jika diperlukan
                // localStorage.removeItem('sidebarCurrentPage');
            });
        </script>
    </body>
</html>