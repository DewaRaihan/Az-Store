<div class="flex flex-col" 
     x-data="{
         currentPage: '{{ $currentPage }}',
         
         init() {
             console.log('NavLink initialized. Livewire page:', '{{ $currentPage }}');
             
             // Sync dari Livewire ke Alpine.js
             this.currentPage = '{{ $currentPage }}';
             
             // Listen untuk perubahan dari Livewire
             this.$wire.on('pageChanged', (page) => {
                 console.log('Alpine received pageChanged:', page);
                 if (page && this.currentPage !== page) {
                     this.currentPage = page;
                 }
             });
             
             // Simpan ke localStorage saat perubahan
             this.$watch('currentPage', (value) => {
                 if (value) {
                     localStorage.setItem('sidebarCurrentPage', value);
                     console.log('Saved to localStorage:', value);
                 }
             });
         }
     }">
     
    <nav class="flex flex-col gap-1 cursor-pointer px-3">
        
        <!-- Dashboard -->
        <a @click.prevent="
            currentPage = 'dashboard'; 
            $wire.switchPage('dashboard')
        "
           class="flex items-center px-4 py-3 rounded-lg transition-all duration-200"
           :class="currentPage === 'dashboard' 
                ? 'bg-blue-500/20 text-white border-l-4 border-white shadow-md' 
                : 'text-blue-100 hover:bg-blue-500/30 hover:text-white hover:pl-6'">
        
            <svg class="w-5 h-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
    
            <span class="text-sm font-medium">Dashboard</span>
        </a>
    
        <!-- Inventaris -->
        <a @click.prevent="
            currentPage = 'inventory'; 
            $wire.switchPage('inventory')
        "
           class="flex items-center px-4 py-3 rounded-lg transition-all duration-200"
           :class="currentPage === 'inventory' 
                ? 'bg-blue-500/20 text-white border-l-4 border-white shadow-md' 
                : 'text-blue-100 hover:bg-blue-500/30 hover:text-white hover:pl-6'">
        
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
            </svg>
        
            <span class="text-sm font-medium">Inventaris</span>
        </a>
        
        <!-- Transaksi -->
        <a @click.prevent="
            currentPage = 'transaction'; 
            $wire.switchPage('transaction')
        "
           class="flex items-center px-4 py-3 rounded-lg transition-all duration-200"
           :class="currentPage === 'transaction' 
                ? 'bg-blue-500/20 text-white border-l-4 border-white shadow-md' 
                : 'text-blue-100 hover:bg-blue-500/30 hover:text-white hover:pl-6'">
        
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
            </svg>
        
            <span class="text-sm font-medium">Transaksi</span>
        </a>
        
        <!-- Laporan Keuangan -->
        <a @click.prevent="
            currentPage = 'financial_statement'; 
            $wire.switchPage('financial_statement')
        "
           class="flex items-center px-4 py-3 rounded-lg transition-all duration-200"
           :class="currentPage === 'financial_statement' 
                ? 'bg-blue-500/20 text-white border-l-4 border-white shadow-md' 
                : 'text-blue-100 hover:bg-blue-500/30 hover:text-white hover:pl-6'">
        
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm12 2a1 1 0 10-2 0v4a1 1 0 102 0V6zm-5 1a1 1 0 011 1v1a1 1 0 11-2 0V8a1 1 0 011-1zm-2 1a1 1 0 10-2 0v1a1 1 0 102 0V8z" clip-rule="evenodd"/>
                <path d="M4 14a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2z"/>
            </svg>
        
            <span class="text-sm font-medium">Laporan Keuangan</span>
        </a>

        <!-- Kelola Katalog -->
        <a @click.prevent="
            currentPage = 'manage_catalog'; 
            $wire.switchPage('manage_catalog')
        "
           class="flex items-center px-4 py-3 rounded-lg transition-all duration-200"
           :class="currentPage === 'manage_catalog' 
                ? 'bg-blue-500/20 text-white border-l-4 border-white shadow-md' 
                : 'text-blue-100 hover:bg-blue-500/30 hover:text-white hover:pl-6'">
        
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
            </svg>
        
            <span class="text-sm font-medium">Kelola Katalog</span>
        </a>

        <!-- Kelola Karyawan -->
        <a @click.prevent="
            currentPage = 'employee'; 
            $wire.switchPage('employee')
        "
           class="flex items-center px-4 py-3 rounded-lg transition-all duration-200"
           :class="currentPage === 'employee' 
                ? 'bg-blue-500/20 text-white border-l-4 border-white shadow-md' 
                : 'text-blue-100 hover:bg-blue-500/30 hover:text-white hover:pl-6'">
        
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
            </svg>
        
            <span class="text-sm font-medium">Kelola Karyawan</span>
        </a>
    </nav>
    
    <!-- Bagian Bawah Sidebar -->
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="flex items-center w-full px-4 py-3 text-blue-100 hover:text-red-100 hover:bg-red-500/20 rounded-lg hover:pl-6 transition-all duration-200">
        <svg class="w-5 h-5 mr-3">...</svg>
        <span class="text-sm font-medium">Logout</span>
    </button>
</form>
</div>