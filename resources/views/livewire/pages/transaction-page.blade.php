<div class="flex flex-col gap-6 flex-1 min-h-0">
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 w-full">
        <livewire:components.stats-card
            title="Total Pendapatan"
            :options="['monthlyIncome' => 'Bulanan', 'income' => 'Hari ini', 'totalIncome' => 'Keseluruhan']"
            icon=""
            card-key="card-Income"
            type="amount" 
        />
        <livewire:components.stats-card
            title="Total Pengeluaran"
            :options="['monthlySpending' => 'Bulanan', 'spending' => 'Hari ini', 'totalSpending' => 'Keseluruhan']"
            icon=""
            card-key="card-Spending"
            type="amount" 
        />
        <livewire:components.stats-card
            title="Total Transaksi"
            :options="['monthlyTransactionCount' => 'bulanan', 'dailyTransactionCount' => 'Hari ini', 'transactionCount' => 'keseluruhan']"
            icon=""
            card-key="card-transaction"
            type="number"
        />
        <livewire:components.card-date />
    </div>
    <livewire:components.filter-global
        :enableType="true"
        :enableStatus="false"
        :enableGrade="false"
        :dropdownA="[
            '' => 'Semua Tipe',
            'purchase' => 'Pembelian',
            'selling' => 'Penjualan',
            'trade' => 'Tukar Tambah',
        ]"
    />

    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-xl font-semibold mb-6 text-gray-800">Daftar Transaksi</h2>
        <livewire:components.table-transaction 
            mode="full"
            paginate="10" 
        />
    </div>
</div>