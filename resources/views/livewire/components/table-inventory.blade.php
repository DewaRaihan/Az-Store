<div class="relative">
    <!-- LOADING OVERLAY -->
    <div wire:loading.delay>
        <div class="absolute inset-0 bg-white/70 backdrop-blur-sm flex flex-col items-center justify-center z-50 rounded-lg">
            <div class="w-8 h-8 border-2 border-blue-500 border-t-transparent rounded-full animate-spin mb-2"></div>
            <span class="text-sm text-gray-600 font-medium">Memuat data...</span>
        </div>
    </div>
    
    <!-- TABLE CONTAINER -->
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <table class="w-full border-collapse text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="p-3 font-medium text-gray-600 text-center w-16">Foto</th>
                    <th class="p-3 font-medium text-gray-600 w-20">Kode</th>
                    <th class="p-3 font-medium text-gray-600 w-40">Tipe</th>
                    <th class="p-3 font-medium text-gray-600 w-24">Kondisi</th>
                    <th class="p-3 font-medium text-gray-600 text-right w-32">Harga Beli</th>
                    <th class="p-3 font-medium text-gray-600 text-right w-32">Harga Jual</th>
                    <th class="p-3 font-medium text-gray-600 text-center w-24">Status</th>
                    <th class="p-3 font-medium text-gray-600 text-center w-36">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse($hps as $hp)
                <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                    <!-- Foto -->
                    <td class="p-3 text-center">
                        <div class="relative">
                            <img src="{{ !empty($hp['photo_url']) ? $hp['photo_url'] : 'https://via.placeholder.com/80?text=No+Image' }}" 
                                class="w-12 h-12 object-cover rounded-md mx-auto border border-gray-200 shadow-sm">
                            @if($hp['status'] === 'sold')
                                <div class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs">✓</span>
                                </div>
                            @endif
                        </div>
                    </td>
                    
                    <!-- Kode -->
                    <td class="p-3">
                        <span class="font-medium text-gray-800 text-sm" title="{{ $hp['code_hp'] }}">
                            {{ $hp['code_hp'] }}
                        </span>
                    </td>
                    
                    <!-- Tipe -->
                    <td class="p-3">
                        <div class="text-gray-700 text-sm">
                            <span class="line-clamp-2" title="{{ $hp['type_hp'] }}">
                                {{ $hp['type_hp'] }}
                            </span>
                        </div>
                    </td>
                    
                    <!-- Kondisi -->
                    <td class="p-3">
                        @php
                            $gradeClasses = [
                                'A' => 'bg-green-50 text-green-700 border-green-200',
                                'B' => 'bg-blue-50 text-blue-700 border-blue-200',
                                'C' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                'D' => 'bg-orange-50 text-orange-700 border-orange-200',
                                'E' => 'bg-red-50 text-red-700 border-red-200',
                            ];
                            $class = $gradeClasses[$hp['grade']] ?? 'bg-gray-50 text-gray-700 border-gray-200';
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-medium border {{ $class }}">
                            Grade {{ $hp['grade'] }}
                        </span>
                    </td>
                    
                    <!-- Harga Beli -->
                    <td class="p-3 text-right">
                        @if(!empty($hp['transaction']['purchase']['is_trade']))
                            <div class="flex flex-col items-end">
                                <div class="flex items-center gap-1.5 mb-1">
                                    <span class="text-green-600 font-semibold text-sm whitespace-nowrap">
                                        Rp {{ number_format($hp['transaction']['purchase']['purchase_price'] ?? 0, 0, ',', '.') }}
                                    </span>
                                    <span class="px-1.5 py-0.5 bg-green-50 text-green-700 text-[10px] rounded-full border border-green-200">
                                        Trade
                                    </span>
                                </div>
                                <span class="text-xs text-gray-500 truncate max-w-[100px]" title="{{ $hp['transaction']['purchase']['is_trade'] }}">
                                    {{ $hp['transaction']['purchase']['is_trade'] }}
                                </span>
                            </div>
                        @else
                            <span class="text-gray-800 whitespace-nowrap">
                                Rp {{ number_format($hp['transaction']['purchase']['purchase_price'] ?? 0, 0, ',', '.') }}
                            </span>
                        @endif
                    </td>
                    
                    <!-- Harga Jual -->
                    <td class="p-3 text-right">
                        @if(!empty($hp['transaction']['selling']['selling_price']))
                            <div class="flex flex-col items-end">
                                <span class="text-blue-600 font-semibold whitespace-nowrap">
                                    Rp {{ number_format($hp['transaction']['selling']['selling_price'], 0, ',', '.') }}
                                </span>
                                @if(!empty($hp['transaction']['purchase']['is_trade']))
                                    <span class="text-xs text-green-600 mt-0.5">
                                        +{{ $hp['transaction']['purchase']['is_trade'] }}
                                    </span>
                                @endif
                            </div>
                        @else
                            <span class="text-gray-400 text-sm italic">-</span>
                        @endif
                    </td>
                    
                    <!-- Status -->
                    <td class="p-3 text-center">
                        @php
                            $statusClasses = [
                                'available' => 'bg-gray-100 text-gray-800 border-gray-300',
                                'sold' => 'bg-red-100 text-red-800 border-red-300',
                            ];
                            $statusText = [
                                'available' => 'Tersedia',
                                'sold' => 'Terjual',
                            ];
                            $class = $statusClasses[$hp['status']] ?? 'bg-gray-100 text-gray-800 border-gray-300';
                            $text = $statusText[$hp['status']] ?? ucfirst($hp['status']);
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-medium border {{ $class }}">
                            {{ $text }}
                        </span>
                    </td>
                    
                    <!-- Aksi -->
                    <td class="p-3">
                        <div class="flex gap-1 justify-center">
                            <a href="/hp/{{ $hp['id'] }}"
                            class="px-3 py-1.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 transition-colors duration-150 shadow-sm whitespace-nowrap">
                                Detail
                            </a>
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
                            <p class="text-gray-500 mb-1">Tidak ada data HP</p>
                            <p class="text-sm text-gray-400">Data akan muncul setelah ditambahkan</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if(isset($paginator) && $hps->count() > 0)
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