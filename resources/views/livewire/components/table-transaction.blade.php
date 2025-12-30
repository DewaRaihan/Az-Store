<div class="relative">
    {{-- LOADING OVERLAY --}}
    <div wire:loading.delay>
        <div class="absolute inset-0 bg-white/60 backdrop-blur-sm flex flex-col items-center justify-center z-50 rounded-lg">
            <div class="w-8 h-8 border-2 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
            <span class="mt-2 text-sm text-gray-600">Memuat data...</span>
        </div>
    </div>
    
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <table class="w-full border-collapse text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="p-3 font-medium text-gray-600 text-left w-20">Kode</th>
                    <th class="p-3 font-medium text-gray-600 text-left w-24">Tanggal</th>
                    <th class="p-3 font-medium text-gray-600 text-left w-48">Hp</th>
                    <th class="p-3 font-medium text-gray-600 text-left w-28">Jenis</th>
                    <th class="p-3 font-medium text-gray-600 text-left w-32">Harga</th>
                    <th class="p-3 font-medium text-gray-600 text-left w-24">Pelanggan</th>
                    <th class="p-3 font-medium text-gray-600 text-left w-24">Dicatat oleh</th>
                    <th class="p-3 font-medium text-gray-600 text-left w-36">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse($trxs as $trx)
                <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                    <!-- Kode -->
                    <td class="p-3">
                        <span class="font-medium text-blue-600 text-sm">{{ $trx['transaction_code'] }}</span>
                    </td>
                    
                    <!-- Tanggal -->
                    <td class="p-3 text-gray-600 text-sm">{{ $trx['date'] }}</td>
                    
                    <!-- HP -->
                    <td class="p-3">
                        <div class="space-y-1">
                            @switch($trx['type_trans'])
                                @case('purchase')
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium text-gray-800">{{ $trx['hp_in']['type_hp'] }}</span>
                                    <span class="text-xs text-gray-500 bg-gray-100 px-1.5 py-0.5 rounded border border-gray-200">{{ $trx['hp_in']['code_hp'] }}</span>
                                </div>
                                @break
                                
                                @case('selling')
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium text-gray-800">{{ $trx['hp_out']['type_hp'] }}</span>
                                    <span class="text-xs text-gray-500 bg-gray-100 px-1.5 py-0.5 rounded border border-gray-200">{{ $trx['hp_out']['code_hp'] }}</span>
                                </div>
                                @break
                                
                                @case('trade')
                                <div class="space-y-1.5">
                                    <!-- HP Masuk -->
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-medium text-gray-800">{{ $trx['hp_in']['type_hp'] }}</span>
                                        <span class="text-xs text-gray-500 bg-gray-100 px-1.5 py-0.5 rounded border border-gray-200">{{ $trx['hp_in']['code_hp'] }}</span>
                                    </div>
                                    <!-- HP Keluar (Trade) -->
                                    <div class="flex items-center gap-1.5 px-2 py-1 bg-amber-50 text-amber-700 text-xs rounded border border-amber-200">
                                        <span class="font-medium">Tukar:</span>
                                        <span>{{ $trx['hp_out']['type_hp'] }}</span>
                                        <span class="w-px h-3 bg-amber-300"></span>
                                        <span class="text-xs text-amber-600">{{ $trx['hp_out']['code_hp'] }}</span>
                                    </div>
                                </div>
                                @break
                                
                                @default
                                <span class="text-xs text-gray-400 italic">Tidak diketahui</span>
                            @endswitch
                        </div>
                    </td>
                    
                    <!-- Jenis Transaksi -->
                    <td class="p-3">
                        @php
                            $typeClasses = [
                                'purchase' => 'bg-blue-50 text-blue-700 border-blue-200',
                                'selling' => 'bg-green-50 text-green-700 border-green-200',
                                'trade' => 'bg-amber-50 text-amber-700 border-amber-200',
                            ];
                            $typeText = [
                                'purchase' => 'Pembelian',
                                'selling' => 'Penjualan',
                                'trade' => 'Tukar Tambah',
                            ];
                            $class = $typeClasses[$trx['type_trans']] ?? 'bg-gray-50 text-gray-700 border-gray-200';
                            $text = $typeText[$trx['type_trans']] ?? 'Tidak diketahui';
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-medium border {{ $class }}">
                            {{ $text }}
                        </span>
                    </td>
                    
                    <!-- Harga -->
                    <td class="p-3">
                        @switch($trx['type_trans'])
                            @case('purchase')
                            <div class="text-right">
                                <span class="text-sm font-medium text-gray-800">Rp {{ number_format($trx['purchase_price'] ?? 0, 0, ',', '.')}}</span>
                            </div>
                            @break
                            
                            @case('selling')
                            <div class="text-right">
                                <span class="text-sm font-medium text-green-600">Rp {{ number_format($trx['selling_price'] ?? 0, 0, ',', '.')}}</span>
                            </div>
                            @break
                            
                            @case('trade')
                            <div class="space-y-1.5">
                                <!-- Extra Fee -->
                                <div class="text-right">
                                    <span class="text-sm font-medium text-amber-600">+ Rp {{ number_format($trx['extra_fee'] ?? 0, 0, ',', '.')}}</span>
                                </div>
                                <!-- Related Transaction -->
                                @if(isset($trx['related']))
                                <div class="px-2 py-1.5 bg-blue-50 text-blue-700 text-xs rounded border border-blue-200">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-blue-600">Relasi:</span>
                                        <span class="font-medium">{{ $trx['related']['transaction_code'] }}</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="font-medium">Rp {{ number_format($trx['related']['price'] ?? 0, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @break
                            
                            @default
                            <span class="text-xs text-gray-400 italic">-</span>
                        @endswitch
                    </td>
                    
                    <!-- Pelanggan -->
                    <td class="p-3">
                        <span class="text-gray-600 text-sm">{{ $trx['customer_id'] !== 'unknown' ? $trx['customer_id'] : '-' }}</span>
                    </td>
                    
                    <!-- Dicatat oleh -->
                    <td class="p-3">
                        <span class="text-gray-600 text-sm">{{ $trx['user_id'] !== 'unknown' ? $trx['user_id'] : '-' }}</span>
                    </td>
                    
                    <!-- Aksi -->
                    <td class="p-3">
                        <div class="flex gap-1.5">
                            <button class="px-3 py-1.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 transition-colors">
                                Detail
                            </button>
                            <button class="px-3 py-1.5 rounded text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200 hover:bg-amber-100 transition-colors">
                                Edit
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="p-8 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-gray-500 mb-1">Tidak ada data transaksi</p>
                            <p class="text-sm text-gray-400">Data akan muncul setelah transaksi dibuat</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if(isset($paginator) && $trxs->count() > 0)
    <div class="mt-6 flex justify-center">
        <x-paginator 
            :paginator="$paginator"
            :maxPages="3"
            :showFirstLast="true"
            :showEllipsis="true"
            containerClass="flex items-center space-x-1"
            activeButtonClass="bg-blue-600 text-white border-blue-600"
            buttonClass="px-3 py-1.5 text-sm border border-gray-300 rounded hover:bg-gray-50 transition-colors"
        />
    </div>
    @endif
</div>