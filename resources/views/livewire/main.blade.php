<main class="relative flex-1">
    <!-- Fixed wrapper untuk main content -->
    <div class="fixed inset-0 left-48 top-14 bottom-0 overflow-y-auto">
        <div class="h-full p-6">
            @if($currentPage === 'dashboard')
                <livewire:pages.dashboard-page key="dashboard"/>
            @elseif($currentPage === 'inventory')
                <livewire:pages.inventory-page key="inventory" />
            @elseif($currentPage === 'transaction')
                <livewire:pages.transaction-page key="transaction"/>
            @elseif($currentPage === 'financial_statement')
                <livewire:pages.financial-statement-page key="financial_statement"/>
            @elseif($currentPage === 'manage_catalog')
                <livewire:pages.manage-catalog-page key="manage_catalog"/>
            @endif
            
            <!-- Loading yang tetap di tengah area content saat scroll -->
            <div 
                wire:loading 
                class="fixed inset-0 left-48 top-14 bg-white/70 z-50 flex items-center justify-center"
                x-data="{ show: false }"
                x-init="setTimeout(() => show = true, 50)"
                x-show="show"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >
                <div class="text-center">
                    <div class="w-8 h-8 border-2 border-blue-400 border-t-transparent rounded-full animate-spin mx-auto mb-2"></div>
                    <p class="text-gray-600 text-sm font-medium">Loading...</p>
                </div>
            </div>
        </div>
    </div>
</main>