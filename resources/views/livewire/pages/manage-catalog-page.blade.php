<div class="flex flex-col gap-6">
    <!-- Status Tabs -->
    <div class="bg-white rounded-xl p-1 border border-gray-200 mb-5">
        <div class="flex">
            <button class="flex-1 px-4 py-3 text-sm font-medium rounded-lg bg-blue-500 text-white transition">
                Aktif (24)
            </button>
            <button class="flex-1 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 transition rounded-lg">
                Draft (8)
            </button>
            <button class="flex-1 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 transition rounded-lg">
                Terjual (12)
            </button>
            <button class="flex-1 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 transition rounded-lg">
                Arsip (5)
            </button>
        </div>
    </div>
    
    <!-- Stats Cards -->
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

    <!-- Search and Actions -->
    <livewire:components.filter-global 
    :enableType="false" 
    />
    
    <!-- Products Grid -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div class="text-sm text-gray-500">24 barang aktif ditemukan</div>
            <div class="flex items-center gap-3">
                <select class="text-xs border-gray-300 rounded-lg">
                    <option>Terbaru</option>
                    <option>Harga Tertinggi</option>
                    <option>Harga Terendah</option>
                </select>
                <span class="text-xs text-gray-500">Halaman 1 dari 5</span>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">
            <!-- Product Card 1 -->
            <div class="bg-white rounded-xl p-5 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
                <div class="flex justify-between items-start mb-4">
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                        Aktif
                    </span>
                    <div class="flex gap-1">
                        <button class="p-1.5 text-gray-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-16 h-16 bg-blue-50 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7 2a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H7zm3 14a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-sm font-medium text-gray-800 mb-1">Samsung S23 Ultra</div>
                        <div class="text-xs text-gray-500 mb-3">256GB • Garansi 3 bulan</div>
                        
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-600">Harga</span>
                                <span class="text-sm font-semibold text-gray-800">Rp 18.5jt</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-600">Kondisi</span>
                                <span class="text-xs text-blue-600">Mulus</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex gap-2 pt-4 border-t border-gray-100">
                    <button class="flex-1 px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-xs font-medium flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Preview
                    </button>
                    <button class="flex-1 px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition text-xs font-medium flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Tandai Terjual
                    </button>
                </div>
            </div>
            
            <!-- Product Card 2 -->
            <div class="bg-white rounded-xl p-5 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
                <div class="flex justify-between items-start mb-4">
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                        Aktif
                    </span>
                    <div class="flex gap-1">
                        <button class="p-1.5 text-gray-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-16 h-16 bg-gray-50 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7 2a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H7zm3 14a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-sm font-medium text-gray-800 mb-1">iPhone 14 Pro Max</div>
                        <div class="text-xs text-gray-500 mb-3">256GB • Garansi 1 tahun</div>
                        
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-600">Harga</span>
                                <span class="text-sm font-semibold text-gray-800">Rp 22.8jt</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-600">Kondisi</span>
                                <span class="text-xs text-green-600">Sealed</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex gap-2 pt-4 border-t border-gray-100">
                    <button class="flex-1 px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-xs font-medium flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Preview
                    </button>
                    <button class="flex-1 px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition text-xs font-medium flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Tandai Terjual
                    </button>
                </div>
            </div>
            
            <!-- Product Card 3 -->
            <div class="bg-white rounded-xl p-5 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
                <div class="flex justify-between items-start mb-4">
                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                        Draft
                    </span>
                    <div class="flex gap-1">
                        <button class="p-1.5 text-gray-400 hover:text-green-500 hover:bg-green-50 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                        <button class="p-1.5 text-gray-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-16 h-16 bg-yellow-50 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-sm font-medium text-gray-800 mb-1">Oppo Find X5 Pro</div>
                        <div class="text-xs text-gray-500 mb-3">256GB/12GB • Belum dicek</div>
                        
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-600">Harga Draft</span>
                                <span class="text-sm font-semibold text-gray-800">Rp 14.2jt</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-600">Ditambahkan</span>
                                <span class="text-xs font-medium text-gray-700">Kemarin</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex gap-2 pt-4 border-t border-gray-100">
                    <button class="flex-1 px-3 py-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition text-xs font-medium flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </button>
                    <button class="flex-1 px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition text-xs font-medium flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Publish
                    </button>
                </div>
            </div>
            
            <!-- Product Card 4 -->
            <div class="bg-white rounded-xl p-5 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
                <div class="flex justify-between items-start mb-4">
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                        Aktif
                    </span>
                    <div class="flex gap-1">
                        <button class="p-1.5 text-gray-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-16 h-16 bg-purple-50 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-sm font-medium text-gray-800 mb-1">AirPods Pro 2</div>
                        <div class="text-xs text-gray-500 mb-3">Original • Sealed</div>
                        
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-600">Harga</span>
                                <span class="text-sm font-semibold text-gray-800">Rp 3.2jt</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-600">Kondisi</span>
                                <span class="text-xs text-green-600">Baru</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex gap-2 pt-4 border-t border-gray-100">
                    <button class="flex-1 px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-xs font-medium flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Preview
                    </button>
                    <button class="flex-1 px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition text-xs font-medium flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Tandai Terjual
                    </button>
                </div>
            </div>
            
            <!-- Product Card 5 -->
            <div class="bg-white rounded-xl p-5 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
                <div class="flex justify-between items-start mb-4">
                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                        Terjual
                    </span>
                    <div class="flex gap-1">
                        <button class="p-1.5 text-gray-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-16 h-16 bg-blue-50 rounded-lg flex items-center justify-center opacity-70">
                        <svg class="w-8 h-8 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-sm font-medium text-gray-800 mb-1 line-through">Samsung S22+</div>
                        <div class="text-xs text-gray-500 mb-3">128GB/8GB • Terjual</div>
                        
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-600">Harga Jual</span>
                                <span class="text-sm font-semibold text-gray-800">Rp 9.5jt</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-600">Laba</span>
                                <span class="text-xs font-medium text-green-600">+Rp 800rb</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="pt-4 border-t border-gray-100">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">Status</span>
                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                            Lunas
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Product Card 6 -->
            <div class="bg-white rounded-xl p-5 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
                <div class="flex justify-between items-start mb-4">
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                        Aktif
                    </span>
                    <div class="flex gap-1">
                        <button class="p-1.5 text-gray-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-16 h-16 bg-orange-50 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-sm font-medium text-gray-800 mb-1">Xiaomi 13 Pro</div>
                        <div class="text-xs text-gray-500 mb-3">256GB/12GB • Bekas</div>
                        
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-600">Harga</span>
                                <span class="text-sm font-semibold text-gray-800">Rp 11.5jt</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-600">Kondisi</span>
                                <span class="text-xs text-orange-600">Ringan</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex gap-2 pt-4 border-t border-gray-100">
                    <button class="flex-1 px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-xs font-medium flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Preview
                    </button>
                    <button class="flex-1 px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition text-xs font-medium flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Tandai Terjual
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="flex items-center justify-between mt-6 pt-6 border-t border-gray-200">
            <div class="text-sm text-gray-500">
                Menampilkan 6 dari 24 barang
            </div>
            <div class="flex items-center gap-2">
                <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-sm text-gray-700 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Sebelumnya
                </button>
                
                <div class="flex items-center gap-1">
                    <button class="w-8 h-8 rounded-lg bg-blue-500 text-white text-sm">1</button>
                    <button class="w-8 h-8 rounded-lg hover:bg-gray-100 text-sm text-gray-700">2</button>
                    <button class="w-8 h-8 rounded-lg hover:bg-gray-100 text-sm text-gray-700">3</button>
                    <span class="px-2 text-gray-400">...</span>
                    <button class="w-8 h-8 rounded-lg hover:bg-gray-100 text-sm text-gray-700">5</button>
                </div>
                
                <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-sm text-gray-700 flex items-center gap-1">
                    Selanjutnya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>