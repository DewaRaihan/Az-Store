<div class="lg:w-64 flex-shrink-0" 
     x-data="{
         currentTab: 'informasi_dasar',
         
         init() {
             const savedTab = localStorage.getItem('formCurrentTab');
             if (savedTab) {
                 this.currentTab = savedTab;
             }
             
             this.$wire.on('tabChanged', (tab) => {
                 if (tab && this.currentTab !== tab) {
                     this.currentTab = tab;
                 }
             });
             
             this.$watch('currentTab', (value) => {
                 if (value) {
                     localStorage.setItem('formCurrentTab', value);
                 }
             });
         },
         
         switchTab(tab) {
             this.currentTab = tab;
             if (this.$wire) {
                 this.$wire.switchTab(tab);
             }
         }
     }">
     
    <!-- Clean Navigation -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <!-- Navigation Header -->
        <div class="px-5 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800 text-sm uppercase tracking-wider">Form Navigation</h3>
            <p class="text-xs text-gray-500 mt-1">Pilih bagian yang ingin diisi</p>
        </div>
        
        <!-- Navigation Items -->
        <div class="p-3 space-y-2">
            <!-- Tab 1 -->
            <button 
                @click="switchTab('informasi_dasar')"
                type="button"
                class="w-full px-4 py-3.5 flex items-center gap-3 rounded-lg transition-all duration-200"
                :class="currentTab === 'informasi_dasar' 
                    ? 'bg-gradient-to-r from-blue-50 to-blue-50/50 text-blue-700 border-l-4 border-blue-500' 
                    : 'text-gray-600 hover:bg-gray-50 hover:pl-5'">
                <div class="w-8 h-8 rounded-full flex items-center justify-center"
                     :class="currentTab === 'informasi_dasar' 
                        ? 'bg-blue-100 text-blue-600' 
                        : 'bg-gray-100 text-gray-500'">
                    <i class="fas fa-info-circle text-sm"></i>
                </div>
                <div class="flex-1 text-left">
                    <div class="font-medium">Informasi Dasar</div>
                    <div class="text-xs" :class="currentTab === 'informasi_dasar' ? 'text-blue-500' : 'text-gray-400'">
                        Data transaksi utama
                    </div>
                </div>
                <i class="fas fa-check-circle text-sm ml-auto" 
                   :class="currentTab === 'informasi_dasar' ? 'text-blue-500' : 'text-gray-300'"></i>
            </button>
            
            <!-- Tab 2 -->
            <button 
                @click="switchTab('detail_unit')"
                type="button"
                class="w-full px-4 py-3.5 flex items-center gap-3 rounded-lg transition-all duration-200"
                :class="currentTab === 'detail_unit' 
                    ? 'bg-gradient-to-r from-blue-50 to-blue-50/50 text-blue-700 border-l-4 border-blue-500' 
                    : 'text-gray-600 hover:bg-gray-50 hover:pl-5'">
                <div class="w-8 h-8 rounded-full flex items-center justify-center"
                     :class="currentTab === 'detail_unit' 
                        ? 'bg-blue-100 text-blue-600' 
                        : 'bg-gray-100 text-gray-500'">
                    <i class="fas fa-box-open text-sm"></i>
                </div>
                <div class="flex-1 text-left">
                    <div class="font-medium">Detail Unit</div>
                    <div class="text-xs" :class="currentTab === 'detail_unit' ? 'text-blue-500' : 'text-gray-400'">
                        Spesifikasi produk
                    </div>
                </div>
                <i class="fas fa-check-circle text-sm ml-auto" 
                   :class="currentTab === 'detail_unit' ? 'text-blue-500' : 'text-gray-300'"></i>
            </button>
        </div>
        
        <!-- Navigation Footer -->
        <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/50 rounded-b-xl">
            <div class="text-xs text-gray-500 flex items-center justify-between">
                <span>Progress</span>
                <span class="font-medium" x-text="currentTab === 'informasi_dasar' ? '1/2' : '2/2'"></span>
            </div>
        </div>
    </div>
</div>