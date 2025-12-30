<div class="flex flex-col gap-6 flex-1 min-h-0">
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 w-full">
        <livewire:components.stats-card
            title="Total Hp Terjual"
            :options="['monthlyUnitSold' => 'Bulanan', 'unitSold' => 'Hari ini', 'totalUnitSold' => 'Keseluruhan']"
            icon=""
            card-key="card-UnitSold"
            type="number" 
        />
        <livewire:components.stats-card
            title="Total Hp Tersedia"
            :options="['monthlyUnitBought' => 'Bulanan', 'unitBought' => 'Hari ini', 'totalUnitBought' => 'Keseluruhan']"
            icon=""
            card-key="card-UnitBought"
            type="number"
        />
        <livewire:components.stats-card
            title="Total Unit"
            filter="totalUnit"
            :options="[]"
            icon=""
            card-key="card-TotalUnits"
            type="number"
        />
        <livewire:components.card-date />
    </div>
    <livewire:components.filter-global
        :enableType="false"
        :enableStatus="true"
        :enableGrade="true"
        :dropdownB="[
            '' => 'Semua Tipe',
            'available' => 'Tersedia',
            'sold' => 'Terjual',
        ]"
        :dropdownC="[
            '' => 'Semua Kondisi',
            'A' => 'A',
            'B' => 'B',
            'C' => 'C',
            'D' => 'D',
            'E' => 'E',
        ]"
        />
    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-xl font-semibold mb-6 text-gray-800">Daftar HP</h2>
        <livewire:components.table-inventory 
            mode="full"
            paginate="10"
        />
    </div>
</div>