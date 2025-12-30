<div 
    x-data="{
        now: new Date(),
        init() {
            setInterval(() => {
                this.now = new Date();
            }, 1000); // update tiap 1 detik
        },
        days() { 
            return this.now.toLocaleDateString('id-ID', { weekday: 'long' }); 
        },
        date() {
            return this.now.toLocaleDateString('id-ID', { day: '2-digit' });
        },
        monthYears() {
            return this.now.toLocaleDateString('id-ID', { month: 'long', year: 'numeric' });
        },
        times() {
            return this.now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        }
    }"
    class="bg-white rounded-xl p-5 w-full"
>

    <!-- Title -->
    <div class="flex justify-between items-center mb-3">
        <h3 class="text-sm font-medium text-gray-700">Tanggal & Waktu</h3>
        <div class="text-blue-500 text-lg">📅</div>
    </div>

    <!-- Content -->
    <div class="flex items-center gap-3">
        <!-- Date -->
        <div class="text-center">
            <div class="text-3xl font-bold text-blue-600" x-text="date()"></div>
            <div class="text-xs text-gray-500" x-text="monthYears().split(' ')[0]"></div>
        </div>

        <!-- Details -->
        <div class="flex-grow">
            <div class="text-lg font-semibold text-gray-800" x-text="days()"></div>
            <div class="text-sm text-gray-600" x-text="monthYears()"></div>
            <div class="text-xs text-gray-500 font-mono mt-1" x-text="times()"></div>
        </div>
    </div>

</div>