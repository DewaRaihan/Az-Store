<div class="bg-white rounded-xl p-5 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h3 class="text-sm font-medium text-gray-600">Laporan Arus Kas</h3>
            <p class="text-xs text-gray-500 mt-1">Ringkasan kas masuk dan keluar</p>
        </div>
        <select class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
            <option>Bulan Ini (Nov 2023)</option>
            <option>Bulan Lalu (Oct 2023)</option>
            <option>Kuartal Ini (Q4 2023)</option>
        </select>
    </div>
    
    <div class="space-y-5">
        <!-- Kas Masuk -->
        <div>
            <h4 class="text-sm font-medium text-green-700 mb-3">Kas Masuk (Pendapatan)</h4>
            <div class="space-y-3 ml-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Penjualan HP Tunai</span>
                    <span class="text-sm font-medium text-green-600">Rp {{ number_format($statement['income'], 2, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Trade-in Extra Fee</span>
                    <span class="text-sm font-medium text-green-600">Rp {{ number_format($statement['extra_fee'], 2, ',', '.') }}</span>
                </div>
                <div class="pt-3 border-t border-gray-100">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-green-700">Total Kas Masuk</span>
                        <span class="text-lg font-bold text-green-700">Rp {{ number_format($statement['totalIncome'], 2, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Kas Keluar -->
        <div>
            <h4 class="text-sm font-medium text-red-700 mb-3">Kas Keluar (Pengeluaran)</h4>
            <div class="space-y-3 ml-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Pembelian HP Baru</span>
                    <span class="text-sm font-medium text-red-600">(Rp {{ number_format($statement['spending'], 2, ',', '.') }})</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Biaya Operasional Toko</span>
                    <span class="text-sm font-medium text-red-600">(Rp {{ number_format($statement['oprasional'], 2, ',', '.') }})</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Service</span>
                    <span class="text-sm font-medium text-red-600">(Rp {{ number_format($statement['service'], 2, ',', '.') }})</span>
                </div>
                <div class="pt-3 border-t border-gray-100">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-red-700">Total Kas Keluar</span>
                        <span class="text-lg font-bold text-red-700">(Rp {{ number_format($statement['totalSpending'], 2, ',', '.') }})</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Arus Kas Bersih -->
        <div class="p-4 rounded-lg bg-blue-50 border border-blue-100">
            <div class="flex justify-between items-center">
                <div>
                    <h4 class="text-sm font-medium text-blue-700">Arus Kas Bersih</h4>
                    <p class="text-xs text-blue-600 mt-1">Kas Masuk - Kas Keluar</p>
                </div>
                <span class="text-xl font-bold text-blue-700">Rp {{ number_format($statement['netCashFlow'], 2, ',', '.') }}</span>
            </div>
            <div class="mt-2 text-xs text-green-600">
                Positif: Kas masuk lebih besar dari keluar
            </div>
        </div>
        
        <!-- Saldo Kas Awal & Akhir -->
        <div class="pt-4 border-t border-gray-200">
            <h4 class="text-sm font-medium text-gray-700 mb-3">Saldo Kas</h4>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                    <div class="text-sm text-gray-600">Saldo Kas Awal</div>
                    <div class="text-lg font-bold text-gray-800">Rp 5.000.000</div>
                </div>
                <div class="bg-green-50 rounded-lg p-4 border border-green-100">
                    <div class="text-sm text-green-600">Saldo Kas Akhir</div>
                    <div class="text-lg font-bold text-green-700">Rp 18.220.000</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-xs text-gray-400 mt-6 pt-4 border-t border-gray-100">
        <div class="flex justify-between">
            <span>Periode: 1 - {{now()->endOfMonth()}}</span>
            <span>Update: hari ini</span>
        </div>
    </div>
</div>