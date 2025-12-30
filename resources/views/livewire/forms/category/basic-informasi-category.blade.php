<div class="space-y-6">
    {{-- ================= INFORMASI DASAR ================= --}}
    <div class="bg-white rounded-lg border border-gray-200 p-5">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">
            Informasi Dasar
        </h2>

        <div class="flex flex-wrap items-end gap-4">
            {{-- TANGGAL --}}
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Tanggal
                </label>
                <input
                    type="date"
                    wire:model.live="transaction.date"
                    class="w-full border border-gray-300 rounded px-3 py-2
                           focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                @error('transaction.date')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- ================= FORM PEMBELIAN ================= --}}
    <div class="bg-white rounded-lg border border-gray-200 p-5">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">
            Detail Pembelian
        </h2>

        <div class="space-y-6">
            {{-- ================= FOTO ================= --}}
            <div class="md:col-span-2">
                <!-- Foto Header -->
                <div class="flex items-center gap-2.5 mb-4">
                    <div class="w-8 h-8 rounded-md bg-blue-50 flex items-center justify-center">
                        <i class="fas fa-camera text-blue-600 text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">Foto Unit</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Upload foto unit (maksimal 7 foto)</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <!-- Kotak Besar - Foto Utama -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-800 mb-2">
                            <span class="flex items-center gap-1">
                                Foto Utama
                                <span class="text-red-500">*</span>
                            </span>
                            <span class="text-xs text-gray-600 font-normal">Tampilkan sebagai cover produk</span>
                        </label>

                        <div class="relative border-2 border-dashed border-blue-400 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors">
                            <input type="file"
                                wire:model="mainImage"
                                accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                            @if ($mainImage)
                                <div class="aspect-video flex items-center justify-center p-4">
                                    <img src="{{ $mainImage->temporaryUrl() }}"
                                        class="w-full h-full object-contain rounded-md">
                                    
                                    <!-- Hover Overlay -->
                                    <div class="absolute inset-0 bg-black/20 opacity-0 hover:opacity-100 transition-opacity rounded-md flex items-center justify-center">
                                        <span class="px-3 py-1.5 bg-white/90 text-gray-800 text-xs font-medium rounded shadow-sm">
                                            <i class="fas fa-sync-alt mr-1.5 text-xs"></i>
                                            Ganti Foto
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Badge Utama -->
                                <div class="absolute top-3 left-3 z-20">
                                    <span class="px-2 py-1 bg-blue-600 text-white text-xs font-medium rounded-full shadow-sm">
                                        <i class="fas fa-star mr-1 text-xs"></i>
                                        Utama
                                    </span>
                                </div>
                            @else
                                <div class="aspect-video flex flex-col items-center justify-center p-4 text-center">
                                    <div class="w-12 h-12 rounded-full bg-white border-2 border-blue-300 flex items-center justify-center mb-3">
                                        <i class="fas fa-camera text-blue-500"></i>
                                    </div>
                                    
                                    <p class="text-sm font-medium text-blue-800 mb-1.5">Upload Foto Utama</p>
                                    <p class="text-blue-600 text-xs mb-2">Cover produk</p>
                                    <p class="text-blue-500 text-xs">Format: JPG, PNG | Maks. 2MB</p>
                                </div>
                            @endif
                        </div>
                        
                        @error('mainImage')
                            <p class="text-xs text-red-500 mt-2 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <!-- Kotak Kecil - Foto Tambahan -->
                    <div class="lg:col-span-1">
                        <label class="block text-sm font-medium text-gray-800 mb-2">
                            <span>Foto Tambahan</span>
                            <span class="text-xs text-gray-600 font-normal">(Opsional, maksimal 6 foto)</span>
                        </label>
                        
                        <!-- Kontainer utama untuk kotak kecil -->
                        <div class="space-y-3">
                            <!-- Upload Box -->
                            <div class="relative border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                                <input
                                    type="file"
                                    wire:model="additionalImagesTemp"
                                    multiple
                                    accept="image/*"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                />
                                <div class="p-4 text-center">
                                    <div class="w-10 h-10 rounded-full bg-white border-2 border-gray-300 flex items-center justify-center mb-2 mx-auto">
                                        <i class="fas fa-plus text-gray-500"></i>
                                    </div>
                                    <p class="text-gray-700 text-sm font-medium mb-1">Upload Foto</p>
                                    <p class="text-gray-500 text-xs">Klik atau drag & drop</p>
                                </div>
                            </div>
                            
                            <!-- Counter & Info -->
                            <div>
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-gray-600">
                                        <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                                        Tersisa: <span class="font-medium text-gray-800">{{ 6 - count($additionalImages) }}</span>
                                    </span>
                                    <span class="text-gray-600">
                                        <span class="font-medium text-gray-800">{{ count($additionalImages) }}/6</span>
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Preview Grid Additional Images -->
                            <div class="grid grid-cols-3 gap-2">
                                @foreach($additionalImages as $index => $image)
                                    <div class="relative aspect-square rounded-md overflow-hidden border border-gray-200 group">
                                        <div class="w-full h-full flex items-center justify-center p-1">
                                            <img src="{{ $image->temporaryUrl() }}" 
                                                 class="w-full h-full object-contain rounded-sm">
                                        </div>
                                        
                                        <!-- Hover Overlay -->
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <button type="button" 
                                                    wire:click="removeAdditionalImage({{ $index }})"
                                                    wire:confirm="Hapus foto ini?"
                                                    class="p-1 bg-white/90 rounded-full hover:bg-white transition-colors">
                                                <i class="fas fa-times text-red-500 text-xs"></i>
                                            </button>
                                        </div>
                                        
                                        <!-- Number Badge -->
                                        <div class="absolute top-1 right-1">
                                            <span class="px-1 py-0.5 bg-gray-800 text-white text-xs rounded-full font-medium">
                                                {{ $index + 1 }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                                
                                <!-- Empty Slots -->
                                @for($i = count($additionalImages); $i < 6; $i++)
                                    <div class="aspect-square border border-dashed border-gray-300 rounded-md bg-gray-50 flex flex-col items-center justify-center">
                                        <i class="fas fa-plus text-gray-400 text-xs mb-1"></i>
                                        <span class="text-xs text-gray-500">{{ $i + 1 }}</span>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        
                        @error('additionalImagesTemp.*')
                            <p class="text-xs text-red-500 mt-2 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>
                                {{ $message }}
                            </p>
                        @enderror
                        
                        @error('additionalImagesTemp')
                            <p class="text-xs text-red-500 mt-2 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                
                <!-- Status Upload -->
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="text-xs text-gray-600">
                            <i class="fas fa-info-circle text-blue-500 mr-1.5"></i>
                            <span>Total foto: <span class="font-medium text-gray-800">
                                {{ ($mainImage ? 1 : 0) + count($additionalImages) }}/7
                            </span></span>
                            <span class="mx-2 text-gray-300">•</span>
                            <span>Foto utama: <span class="font-medium text-gray-800">
                                {{ $mainImage ? 'Sudah diupload' : 'Belum diupload' }}
                            </span></span>
                        </div>
                        @if(count($additionalImages) > 0)
                            <button type="button" 
                                    wire:click="removeAllAdditionalImages"
                                    wire:confirm="Hapus semua foto tambahan?"
                                    class="px-3 py-1.5 text-xs bg-red-50 text-red-600 font-medium rounded-md hover:bg-red-100 transition-colors">
                                <i class="fas fa-trash-alt mr-1"></i>
                                Hapus Semua
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ================= DATA PEMBELIAN ================= --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- ================= TIPE HP ================= --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        Tipe HP <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <i class="fas fa-mobile-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input
                            type="text"
                            wire:model.live="purchase.hp_in"
                            class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-sm"
                            placeholder="Contoh: iPhone 13 Pro Max"
                        >
                    </div>
                    @error('purchase.hp_in')
                        <p class="text-xs text-red-500 mt-2 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- ================= HARGA BELI ================= --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        Harga Beli <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-600 text-sm">Rp</span>
                        <input
                            type="number"
                            wire:model.live="purchase.purchase_price"
                            min="0"
                            step="1000"
                            class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-sm"
                            placeholder="0"
                        >
                    </div>
                    @error('purchase.purchase_price')
                        <p class="text-xs text-red-500 mt-2 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- ================= HARGA KATALOG ================= --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        Harga di Katalog
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-600 text-sm">Rp</span>
                        <input
                            type="number"
                            wire:model.live="purchase.catalog_price"
                            min="0"
                            step="1000"
                            class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-sm"
                            placeholder="0 (opsional)"
                        >
                    </div>
                </div>

                {{-- ================= CATATAN ================= --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        Catatan
                    </label>
                    <div class="relative">
                        <textarea
                            wire:model.live="purchase.notes"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-sm"
                            rows="3"
                            placeholder="Tambahkan catatan tentang unit atau transaksi..."
                        ></textarea>
                        <div class="absolute bottom-2 right-2 text-xs text-gray-400">
                            <i class="fas fa-pen mr-1"></i>
                            Opsional
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= TOMBOL SIMPAN ================= --}}
            <div class="bg-white rounded-lg border border-gray-200 p-5 mt-6">
                <div class="flex justify-end">
                    <button
                        type="button"
                        wire:click="save"
                        wire:loading.attr="disabled"
                        wire:target="save"
                        class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg 
                               hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 
                               focus:ring-offset-2 disabled:opacity-50 
                               disabled:cursor-not-allowed transition-colors"
                    >
                        <span wire:loading.remove wire:target="save">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Lanjut ke Detail Unit
                        </span>
                        <span wire:loading wire:target="save">
                            <i class="fas fa-spinner fa-spin mr-2"></i>
                            Memproses...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>