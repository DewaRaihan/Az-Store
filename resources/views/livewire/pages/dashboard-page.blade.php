<div class="flex flex-col gap-6">
    <!-- Stats Cards dengan grid responsive -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 w-full">
        <livewire:components.stats-card
            title="Total"
            :options="['income'=>'pendapatan','spending'=>'pengeluaran','profit'=>'profit']"
            icon=""
            card-key="card-financial"
            type="amount"
        />

        <livewire:components.stats-card
            title="Total Unit"
            :options="['unitSold'=>'Hp Keluar','unitBought'=>'Hp Masuk']"
            icon=""
            card-key="card-Units"
            type="number"
        />
        
        <livewire:components.stats-card
            filter="readyUnitCount"
            title="Unit Tersedia"
            :options="[]"
            icon=""
            card-key="card-unitReady"
            type="number"
        />

        <livewire:components.card-date />
    </div>

    <!-- Tables Section atas bawah -->
    <div class="flex flex-col gap-6">
        <!-- Daftar HP -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Daftar HP</h2>
            <div class="overflow-x-auto">
                <livewire:components.table-inventory 
                    mode="compact"
                    limit="3"
                />
            </div>
        </div>

        <!-- Daftar Transaksi -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Daftar Transaksi</h2>
            <div class="overflow-x-auto">
                <livewire:components.table-transaction 
                    mode="compact"
                    limit="3" 
                />
            </div>
        </div>
    </div>
</div>