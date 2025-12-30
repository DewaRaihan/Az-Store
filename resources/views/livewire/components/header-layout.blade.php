<header class="sticky top-0 bg-white/95 backdrop-blur-sm border-b border-gray-200 h-16 flex items-center px-6 z-50">
    <div class="w-full max-w-7xl mx-auto flex items-center justify-between">
        <!-- Logo/Brand -->
        <div class="text-gray-900 font-semibold">
        </div>
        
        <!-- Menu Actions -->
        <div class="flex items-center gap-3">
            <!-- Dropdown Transaksi -->
            <div class="relative group">
                <!-- Tombol Utama -->
                <button type="button"
                        class="inline-flex items-center gap-2 px-4 py-2.5 text-white bg-blue-600 hover:bg-blue-700 
                               rounded-lg transition-all duration-200 text-sm font-medium shadow-sm group-hover:rounded-b-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Transaksi Baru
                    <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                
                <!-- Dropdown Menu -->
                <div class="absolute right-0 mt-0 w-56 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50 
                            opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:mt-2
                            transition-all duration-200 origin-top-right transform scale-95 group-hover:scale-100">
                    
                    <!-- Header Dropdown -->
                    <div class="px-4 py-2 border-b border-gray-100">
                        <div class="text-sm font-semibold text-gray-700">Pilih Jenis Transaksi</div>
                        <div class="text-xs text-gray-500">Pilih untuk melanjutkan</div>
                    </div>
                    
                    <!-- Option 1: Pembelian -->
                    <button type="button"
                            wire:click="createTransaction('purchase')"
                            wire:loading.attr="disabled"
                            wire:target="createTransaction('purchase')"
                            class="flex items-center gap-3 w-full px-4 py-3 text-gray-700 hover:bg-blue-50 
                                   hover:text-blue-600 transition-colors duration-150 text-left">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" 
                                 stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">Pembelian</div>
                            <div class="text-xs text-gray-500">Beli barang dari supplier</div>
                        </div>
                        <!-- Loading indicator -->
                        <div wire:loading wire:target="createTransaction('purchase')">
                            <div class="w-5 h-5 border-2 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
                        </div>
                    </button>
                    
                    <!-- Option 2: Penjualan -->
                    <button type="button"
                            wire:click="createTransaction('selling')"
                            wire:loading.attr="disabled"
                            wire:target="createTransaction('selling')"
                            class="flex items-center gap-3 w-full px-4 py-3 text-gray-700 hover:bg-emerald-50 
                                   hover:text-emerald-600 transition-colors duration-150 text-left">
                        <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" 
                                 stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" 
                                      d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">Penjualan</div>
                            <div class="text-xs text-gray-500">Jual barang ke customer</div>
                        </div>
                        <!-- Loading indicator -->
                        <div wire:loading wire:target="createTransaction('selling')">
                            <div class="w-5 h-5 border-2 border-emerald-600 border-t-transparent rounded-full animate-spin"></div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Flash Message -->
@if (session()->has('message'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform translate-y-2"
         x-init="setTimeout(() => show = false, 3000)"
         class="fixed top-20 right-6 z-50">
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg shadow-lg">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('message') }}</span>
            </div>
        </div>
    </div>
@endif