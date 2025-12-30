<div class="mt-6 pt-6 border-t border-gray-100">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 hover:shadow-sm transition-shadow">
            <p class="text-xs text-gray-500 mb-1">Harga Beli</p>
            <p class="text-lg font-bold text-gray-800">{{ $purchasePrice }}</p>
            <p class="text-xs text-gray-500 mt-1">Harga Pembelian Awal</p>
        </div>
        
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 hover:shadow-sm transition-shadow">
            <p class="text-xs text-gray-500 mb-1">Harga Jual</p>
            <p class="text-lg font-bold text-gray-800">{{ $formattedPrice }}</p>
            <p class="text-xs text-gray-500 mt-1">Harga yang Dijual</p>
        </div>
        
        <div class="bg-green-50 p-4 rounded-lg border border-green-100 hover:shadow-sm transition-shadow">
            <p class="text-xs text-gray-500 mb-1">Estimasi Profit</p>
            <p class="text-lg font-bold text-green-700">{{ $profit }}</p>
            <p class="text-xs text-green-600 mt-1">Keuntungan Bersih</p>
        </div>
    </div>
    
    @if($hp->notes && $hp->notes !== 'tidak ada catatan')
    <div class="mt-4 pt-4 border-t border-gray-200">
        <h4 class="text-sm font-medium text-gray-500 mb-2">Catatan Tambahan</h4>
        <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-100">
            <p class="text-sm text-gray-700">{{ $hp->notes }}</p>
        </div>
    </div>
    @endif
</div>