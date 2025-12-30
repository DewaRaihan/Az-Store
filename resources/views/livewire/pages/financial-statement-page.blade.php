<!-- Di halaman laporan -->
<div id="financial-report-page">
    <div class="flex flex-col gap-6">
        <!-- Summary Cards menggunakan stat card component -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Total Pendapatan -->
            <livewire:components.stats-card
                title="Total Pendapatan"
                :options="['monthlyIncome'=>'Bulan Ini','quarterIncome'=>'Kuartal Ini', 'income' => 'Hari Ini' ,'totalIncome'=>'Keseluruhan']"
                icon="💰"
                card-key="card-FinacialIncome"
                type="amount"
            />
            
            <!-- Total Pengeluaran -->
            <livewire:components.stats-card
                title="Total Pengeluaran"
                :options="['monthlySpending'=>'Bulan Ini','quarterSpending'=>'Kuartal Ini', 'spending' => 'Hari Ini', 'totalSpending'=>'Keseluruhan']"
                icon="💸"
                card-key="total-expense"
                type="amount"
            />
            
            <!-- Laba Bersih -->
            <livewire:components.stats-card
                title="Laba Bersih"
                :options="['monthlyNetProfit'=>'Bulan Ini','quarterNetProfit'=>'Kuartal Ini', 'netProfit' => 'Hari Ini' ,'totalNetProfit'=>'keseluruhan']"
                icon="📈"
                card-key="net-profit"
                type="amount"
            />
            
            <!-- Margin Profit -->
            <livewire:components.stats-card
                title="Margin Profit"
                :options="['monthlyProfitMargin'=>'Bulan Ini','quarterProfitMargin'=>'Kuartal Ini','totalProfitMargin'=>'keseluruhan']"
                icon="📊"
                card-key="profit-margin"
                type="percent"
            />
        </div>

        <!-- Additional Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Transaksi Berhasil -->
            <livewire:components.stats-card
                filter="transactionCount"
                title="Transaksi Berhasil"
                :options="[]"
                icon="✅"
                card-key="successful-transactions"
                type="number"
            />
            
            <!-- Rata-rata Penjualan -->
            <livewire:components.stats-card
                title="Rata-rata Penjualan"
                :options="['avgSpending'=>'Per Hari', 'monthlyAvgSpending'=>'Per Bulan']"
                icon="📱"
                card-key="avg-sales"
                type="amount"
            />
            
            <!-- HP Terjual -->
            <livewire:components.stats-card
                filter="totalUnitSold"
                title="HP Terjual"
                :options="[]"
                icon="📦"
                card-key="units-sold"
                type="number"
            />
            
            <!-- ROI -->
            <livewire:components.stats-card
                title="ROI"
                :options="['monthly'=>'Bulan Ini','quarterly'=>'Kuartal Ini','yearly'=>'Tahun Ini']"
                icon="📉"
                card-key="roi"
                type="percent"
            />
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Income vs Expense Chart Card -->
            <livewire:components.cash-flow-chart-card />
            
            <!-- Profit Margin by Category -->
            <livewire:components.profit-margin-chart-card />
        </div>

        <!-- Detailed Reports -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Top Selling Products Card -->
            <livewire:components.top-selling-product-card />
            
            <!-- Expense Breakdown Card -->
            <livewire:components.spending-detail-card />
            
        </div>

        <!-- Cash Flow Statement (Ganti Transaction Summary) -->
        <livewire:components.cash-flow-statement />
    </div>
</div>