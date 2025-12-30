<div>
    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-xl font-semibold mb-6 text-gray-800">Daftar HP</h2>
        <livewire:components.table-inventory 
            mode="full"
            paginate="10"
        />
    </div>
    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-xl font-semibold mb-6 text-gray-800">Daftar Transaksi</h2>
        <livewire:components.table-transaction 
            mode="full"
            paginate="10" 
        />
    </div>
</div>