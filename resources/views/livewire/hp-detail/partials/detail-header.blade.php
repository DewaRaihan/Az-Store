<div class="mb-6">
    <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-4">
        <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">
            <i class="fas fa-home"></i>
        </a>
        <span>/</span>
        <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">HP Inventory</a>
        <span>/</span>
        <span class="text-blue-600 font-medium">Detail HP</span>
    </nav>
    
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail HP</h1>
            <p class="text-gray-600 mt-1">{{ $hp->type_hp }} {{ $hp->detail->storage ?? '' }} {{ $hp->detail->color ?? '' }}</p>
        </div>
        <button wire:click="goBack"
                wire:loading.attr="disabled"
                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 flex items-center gap-2 transition-colors duration-200 disabled:opacity-50">
            <i class="fas fa-arrow-left"></i> 
            <span wire:loading.remove wire:target="goBack">Kembali</span>
            <span wire:loading wire:target="goBack">
                <i class="fas fa-spinner fa-spin"></i>
            </span>
        </button>
    </div>
</div>