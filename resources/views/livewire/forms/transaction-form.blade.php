<div class="p-4 max-w-4xl mx-auto">
    <!-- HEADER -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">
                @if(($transaction['type_transaction'] ?? null) === 'purchase')
                    📥 Form Pembelian
                @elseif(($transaction['type_transaction'] ?? null) === 'selling')
                    📤 Form Penjualan
                @elseif(($transaction['type_transaction'] ?? null) === 'trade')
                    🔄 Form Tukar Tambah
                @else
                    📝 Pilih Jenis Transaksi
                @endif
            </h1>
            
            @if($transaction['type_transaction'] ?? null)
                <div class="px-3 py-1 rounded-full text-sm font-medium
                    @if($transaction['type_transaction'] === 'purchase')
                        bg-blue-100 text-blue-800
                    @elseif($transaction['type_transaction'] === 'selling')
                        bg-emerald-100 text-emerald-800
                    @elseif($transaction['type_transaction'] === 'trade')
                        bg-amber-100 text-amber-800
                    @endif">
                    {{ match($transaction['type_transaction']) {
                        'purchase' => 'Pembelian',
                        'selling' => 'Penjualan',
                        'trade' => 'Tukar Tambah',
                        default => 'Transaksi'
                    } }}
                </div>
            @endif
        </div>
    </div>

    {{-- ================= FORM ================= --}}
    <form wire:ignore class="space-y-6">
        {{-- ================= INFORMASI TRANSAKSI ================= --}}
        <div class="bg-white rounded-xl shadow border p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">
                Informasi Transaksi
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- KODE TRANSAKSI -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Kode Transaksi
                    </label>
                    <input type="text"
                           wire:model="transaction.transaction_code"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50"
                           readonly>
                </div>

                <!-- TANGGAL -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal *
                    </label>
                    <input type="datetime-local"
                           wire:model="transaction.date"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                    @error('transaction.date')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- CATATAN -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Catatan (Opsional)
                    </label>
                    <textarea wire:model="transaction.note"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                              rows="2"
                              placeholder="Catatan tambahan..."></textarea>
                </div>
            </div>
        </div>

        {{-- ================= KATEGORI TRANSAKSI ================= --}}
        @if(($transaction['type_transaction'] ?? null) === 'purchase')
            <livewire:forms.category.purchase-category 
                wire:key="purchase-category" />
        @elseif(($transaction['type_transaction'] ?? null) === 'selling')
            <livewire:forms.category.selling-category 
                wire:key="selling-category" />
        @elseif(($transaction['type_transaction'] ?? null) === 'trade')
            <livewire:forms.category.trade-category 
                wire:key="trade-category" />
        @else
            <div class="bg-white rounded-xl shadow border p-6 text-center">
                <p class="text-gray-500">Silakan pilih jenis transaksi melalui URL parameter</p>
                <p class="text-sm text-gray-400 mt-2">
                    Contoh: ?type=purchase, ?type=selling, atau ?type=trade
                </p>
            </div>
        @endif

        {{-- ================= DETAIL HP ================= --}}
        @php
            $showDetail = in_array($transaction['type_transaction'] ?? '', ['purchase', 'trade', 'selling']);
        @endphp
        
        @if($showDetail)
            <livewire:forms.category.detail-category 
                wire:key="detail-category" />
        @endif

        {{-- ================= ACTION ================= --}}
        @if($transaction['type_transaction'] ?? null)
            <div class="flex justify-end gap-3">
                <button type="button"
                        wire:click="$refresh"
                        class="px-5 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    Reset
                </button>
                <button
                    type="button"
                    wire:click="requestDetail"
                    wire:loading.attr="disabled"
                    class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50"
                >
                    <span wire:loading.remove>
                        Simpan Transaksi
                    </span>
                
                    <span wire:loading>
                        <svg class="animate-spin h-4 w-4 text-white inline mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                        </svg>
                        Menyimpan...
                    </span>
                </button>
            </div>
        @endif

    </form>

    {{-- ================= FLASH MESSAGE ================= --}}
    @if(session()->has('success'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-200">
            {{ session('error') }}
        </div>
    @endif

    @if(session()->has('debug_data'))
        <div class="mt-4 p-4 bg-gray-100 text-gray-700 rounded-lg border border-gray-200">
            <details>
                <summary class="cursor-pointer font-medium">Debug Data (Klik untuk lihat)</summary>
                <pre class="mt-2 text-xs overflow-auto max-h-60 p-2 bg-gray-800 text-gray-100 rounded">{{ session('debug_data') }}</pre>
            </details>
        </div>
    @endif
</div>