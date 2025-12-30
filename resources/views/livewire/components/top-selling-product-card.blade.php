<div class="bg-white rounded-xl p-5 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
    <div class="flex justify-between items-start mb-4">
        <h3 class="text-sm font-medium text-gray-600">Produk Terlaris</h3>
        <span class="text-xs text-gray-500">Bulan Ini</span>
    </div>

    <div class="space-y-3">
        @forelse($product as $index => $item)
            <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                <div class="flex items-center gap-3">
                    
                    <!-- Badge Ranking -->
                    <div class="w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold
                        @if($index === 0) bg-yellow-100 text-yellow-800
                        @elseif($index === 1) bg-gray-200 text-gray-800
                        @elseif($index === 2) bg-orange-100 text-orange-800
                        @else bg-blue-50 text-blue-700
                        @endif">
                        {{ $index + 1 }}
                    </div>

                    <!-- Icon -->
                    <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                        <span class="text-blue-600">📱</span>
                    </div>

                    <!-- Info Produk -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-800">
                            {{ $item['label'] }}
                        </h4>
                        <p class="text-xs text-gray-500">
                            {{ $item['total'] }} terjual
                        </p>
                    </div>
                </div>

                <!-- Total Pendapatan -->
                <div class="text-right">
                    <p class="text-sm font-semibold text-green-600">
                        Rp {{ number_format($item['amount'], 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-gray-500">Total pendapatan</p>
                </div>
            </div>
        @empty
            <div class="text-center text-sm text-gray-400 py-6">
                Tidak ada data penjualan
            </div>
        @endforelse
    </div>

    <div class="text-xs text-gray-400 mt-4 pt-3 border-t border-gray-100">
        Diperbarui otomatis (cache 3 jam)
    </div>
</div>
