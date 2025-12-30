<div class="p-6 border-t border-gray-100 bg-gray-50 rounded-b-xl">
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="text-sm text-gray-600">
            <i class="fas fa-info-circle mr-1"></i>
            <span>Status: <span class="font-medium">{{ ucfirst($hp->status) }}</span></span>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            <button wire:click="goBack"
                    wire:loading.attr="disabled"
                    class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 flex items-center justify-center gap-2 transition-colors duration-200 disabled:opacity-50 font-medium">
                <i class="fas fa-arrow-left"></i> 
                <span>Kembali</span>
            </button>
            
            @if($hp->status !== 'sold')
                <button wire:click="markAsSold"
                        wire:loading.attr="disabled"
                        class="px-5 py-2.5 bg-green-500 text-white rounded-lg hover:bg-green-600 flex items-center justify-center gap-2 transition-colors duration-200 disabled:opacity-50 font-medium shadow-sm">
                    <i class="fas fa-shopping-cart"></i> 
                    <span wire:loading.remove wire:target="markAsSold">Tandai Terjual</span>
                    <span wire:loading wire:target="markAsSold">
                        <i class="fas fa-spinner fa-spin"></i> Processing...
                    </span>
                </button>
            @else
                <button wire:click="toggleSoldStatus"
                        wire:loading.attr="disabled"
                        class="px-5 py-2.5 bg-blue-500 text-white rounded-lg hover:bg-blue-600 flex items-center justify-center gap-2 transition-colors duration-200 disabled:opacity-50 font-medium shadow-sm">
                    <i class="fas fa-undo"></i> 
                    <span wire:loading.remove wire:target="toggleSoldStatus">Kembalikan ke Stok</span>
                    <span wire:loading wire:target="toggleSoldStatus">
                        <i class="fas fa-spinner fa-spin"></i> Processing...
                    </span>
                </button>
            @endif
        </div>
    </div>
</div>