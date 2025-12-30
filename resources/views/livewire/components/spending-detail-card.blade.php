<div class="bg-white rounded-xl p-5 border border-gray-200 hover:border-blue-300 transition-colors duration-200 shadow-sm hover:shadow-md">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h3 class="text-sm font-semibold text-gray-700">Detail Pengeluaran</h3>
            <span class="text-xs text-gray-500">Bulan Ini</span>
        </div>
        <div class="text-right">
            <p class="text-xs text-gray-500">Total Bulan Ini</p>
            <p class="text-lg font-bold text-gray-800">Rp {{ number_format($summary['total'] / 1000000, 1, ',', '.') }}jt</p>
        </div>
    </div>
    
    <div class="space-y-5">
        
        <!-- Badge Periode -->
        <div class="mb-2">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                Periode: 1 {{ date('M') }} - {{ date('d M Y') }}
            </span>
        </div>
        
        @foreach($detail as $details)
        <div class="group hover:bg-gray-50 p-3 rounded-xl transition-all duration-300 border border-gray-100 hover:border-blue-100">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-800">{{ $details['name'] }}</h4>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-700">
                                {{ $details['count'] }} transaksi
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="text-right">
                    <p class="text-sm font-bold text-gray-800">Rp {{ number_format($details['amount'] / 1000000, 1, ',', '.') }}jt</p>
                    <p class="text-xs text-gray-500">{{ $details['percent'] }}% dari total</p>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="relative">
                <div class="flex justify-between text-xs text-gray-500 mb-2">
                    <span>0%</span>
                    <span class="font-medium">{{ $details['percent'] }}%</span>
                    <span>100%</span>
                </div>
                
                <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                    <div class="h-2.5 bg-green-600 rounded-full relative transition-all duration-700 ease-out"
                         style="width: {{ $details['percent'] }}%">
                        <!-- Progress Indicator -->
                        <div class="absolute right-0 top-1/2 transform -translate-y-1/2 w-1 h-3 bg-white/50"></div>
                    </div>
                </div>
            </div>
            
            <!-- Detail per hari -->
            <div class="mt-3 grid grid-cols-2 gap-4 text-xs">
                <div class="text-gray-600">
                    <span class="block text-gray-400 mb-1">Rata-rata per hari</span>
                    <span class="font-medium text-gray-800">
                        Rp {{ number_format($details['avgPerDays'] , 0, ',', '.') }}
                    </span>
                </div>
                <div class="text-right text-gray-600">
                    <span class="block text-gray-400 mb-1">Rata-rata per transaksi</span>
                    <span class="font-medium text-gray-800">
                        Rp {{ number_format($details['avgTransaction'], 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
        @endforeach
        
        <!-- Statistik Bulan Ini -->
        <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl p-4 border border-gray-200">
        <div class="grid grid-cols-3 gap-4">
            <div class="text-center">
                <p class="text-xs text-gray-500 mb-1">Hari Ini</p>
                <p class="text-sm font-bold text-gray-800">
                    Rp {{ number_format(($summary['today'] ?? 0) / 1000000 , 1, ',', '.') }} jt
                </p>
            </div>

            <div class="text-center">
                <p class="text-xs text-gray-500 mb-1">Minggu Ini</p>
                <p class="text-sm font-bold text-gray-800">
                    Rp {{ number_format(($summary['week'] ?? 0) / 1000000, 1, ',', '.') }} jt
                </p>
            </div>

            <div class="text-center">
                <p class="text-xs text-gray-500 mb-1">Rata-rata/hari</p>
                <p class="text-sm font-bold text-gray-800">
                    Rp {{ number_format(($summary['avg_per_day'] ?? 0) / 1000000, 1, ',', '.') }} jt
                </p>
            </div>
        </div>

        <div class="mt-3 pt-3 border-t border-gray-200">
            <div class="flex items-center justify-between text-xs">
                <span class="text-gray-600">Progress Bulan</span>
                <span class="font-medium text-blue-600">
                    {{ $today ?? 10 }}/{{ $daysInMonth ?? 30 }} hari
                    ({{ $summary['progress_percent'] }}%)
                </span>
            </div>

            <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                <div class="bg-blue-500 h-1.5 rounded-full"
                    style="width: {{ $summary['progress_percent'] }}%">
                </div>
            </div>
        </div>
        </div>

    </div>
    
    <!-- Footer -->
    <div class="mt-6 pt-4 border-t border-gray-100">
        <div class="flex justify-between items-center">
            <div class="text-xs text-gray-400">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Update otomatis per hari
                </div>
            </div>
        </div>
    </div>
</div>