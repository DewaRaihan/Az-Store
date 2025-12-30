<div>
    <div class="space-y-6">
        <!-- Card untuk Foto -->
        <div class="bg-white rounded-xl shadow border overflow-hidden">
            <!-- Header Card Foto -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Foto Unit</h2>
                        <p class="text-sm text-gray-600 mt-1">Upload foto utama dan foto detail unit</p>
                    </div>
                    <div class="text-sm text-gray-500">
                        <span class="font-medium">{{ count($additionalImages ?? []) }}</span>/6 foto
                    </div>
                </div>
            </div>
            
            <!-- Content Foto -->
            <div class="p-6">
                <!-- Main Photo Section -->
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        <span class="text-red-500">*</span> Foto Utama (Cover)
                        <span class="text-gray-500 text-sm font-normal ml-2">Wajib diisi</span>
                    </label>
                    
                    @if($mainImage)
                        <!-- Show uploaded file -->
                        <div class="flex items-center justify-between p-4 border-2 border-green-200 bg-green-50 rounded-lg hover:bg-green-100 transition">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" 
                                         stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $mainImage->getClientOriginalName() }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ round($mainImage->getSize() / 1024) }} KB</p>
                                </div>
                            </div>
                            <button type="button" 
                                    wire:click="removeMainImage"
                                    class="text-red-500 hover:text-red-700 p-2 hover:bg-red-50 rounded-lg transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" 
                                     stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @else
                        <!-- Upload box -->
                        <div class="border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-400 hover:bg-blue-50 transition cursor-pointer">
                            <input type="file" 
                                wire:model="mainImage"
                                class="hidden"
                                id="mainImageInput"
                                accept="image/*">
                            <label for="mainImageInput" class="cursor-pointer block p-8 text-center">
                                <div class="w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" 
                                         viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" 
                                              d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" 
                                              d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                    </svg>
                                </div>
                                <p class="text-gray-700 font-medium mb-1">Upload foto utama</p>
                                <p class="text-sm text-gray-500">Format: JPG, PNG | Maks. 2MB</p>
                                <p class="text-xs text-gray-400 mt-2">Foto yang akan ditampilkan sebagai thumbnail</p>
                            </label>
                        </div>
                    @endif
                    
                    @error('mainImage') 
                        <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Additional Photos Section -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        Foto Detail (Opsional)
                        <span class="text-gray-500 text-sm font-normal ml-2">Maksimal 6 foto</span>
                    </label>
                    
                    <!-- Upload Button -->
                    @if(count($additionalImages ?? []) < 6)
                        <div class="border-2 border-dashed border-gray-300 rounded-lg hover:border-gray-400 hover:bg-gray-50 transition cursor-pointer mb-6">
                            <input type="file" 
                                   wire:model="additionalImagesTemp"
                                   multiple
                                   class="hidden"
                                   id="additionalImagesInput"
                                   accept="image/*">
                            <label for="additionalImagesInput" class="cursor-pointer block p-6 text-center">
                                <div class="w-12 h-12 mx-auto mb-3 bg-gray-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" 
                                         viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </div>
                                <p class="text-gray-600 font-medium">Tambah foto detail</p>
                                <p class="text-sm text-gray-500 mt-1">Pilih foto atau drag & drop</p>
                            </label>
                        </div>
                    @endif
                    <!-- Uploaded Additional Images -->
                    @if (!empty($additionalImages))
                        <div class="space-y-3">
                            <h4 class="text-sm font-medium text-gray-700 mb-2">
                                Foto yang sudah diupload:
                            </h4>

                            @foreach ($additionalImages as $index => $image)
                                @if ($image)
                                    <div
                                        class="flex items-center justify-between p-3 bg-gray-50 border border-gray-200 rounded-lg hover:bg-gray-100 transition"
                                    >
                                        <div class="flex items-center space-x-3 min-w-0">
                                            <div
                                                class="w-8 h-8 bg-white border border-gray-300 rounded flex items-center justify-center"
                                            >
                                                <svg
                                                    class="w-4 h-4 text-gray-500"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"
                                                    />
                                                </svg>
                                            </div>

                                            <div class="min-w-0">
                                                <p class="text-sm font-medium text-gray-800 truncate">
                                                    {{ $image->getClientOriginalName() }}
                                                </p>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ round($image->getSize() / 1024) }} KB
                                                </p>
                                            </div>
                                        </div>

                                        <button
                                            type="button"
                                            wire:click="removeAdditionalImage({{ $index }})"
                                            class="text-red-500 hover:text-red-700 p-1 hover:bg-red-50 rounded transition"
                                        >
                                            ✕
                                        </button>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    @error('additionalImages.*')
                        <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span>
                    @enderror

                </div>
            </div>
        </div>

        <!-- Card untuk Form Data -->
        <div class="bg-white rounded-xl shadow border overflow-hidden">
            <!-- Header Card Form -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Detail Pembelian</h2>
                <p class="text-sm text-gray-600 mt-1">Informasi lengkap tentang HP yang dibeli</p>
            </div>
            
            <!-- Content Form -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama HP -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="text-red-500">*</span> Nama HP
                        </label>
                        <input type="text" 
                               wire:model.blur="hp_in"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="Contoh: iPhone 13 Pro Max, Samsung Galaxy S23"
                               required>
                        @error('hp_in') 
                            <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> 
                        @enderror
                    </div>
                
                    <!-- Harga Beli -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="text-red-500">*</span> Harga Beli
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                            <input type="number" 
                                   wire:model="purchase_price"
                                   class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                   placeholder="0"
                                   required>
                        </div>
                        @error('purchase_price') 
                            <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> 
                        @enderror
                    </div>
                
                    <!-- Harga Katalog -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga Katalog</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                            <input type="number" 
                                   wire:model="catalog_price"
                                   class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                   placeholder="0">
                        </div>
                    </div>
                
                    <!-- Catatan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                        <textarea wire:model="notes"
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none"
                                  placeholder="Catatan tambahan tentang pembelian..."></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>