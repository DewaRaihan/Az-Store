<div class="bg-white shadow-md rounded-2xl p-4 w-full">

    {{-- Filter Mode --}}
    <div class="flex flex-wrap items-center gap-2 mb-4">
        <select wire:model.live="mode" class="border px-2 py-1 rounded">
            <option value="daily">Harian</option>
            <option value="monthly">Bulanan</option>
        </select>

        {{-- Daily Controls --}}
        @if($mode === 'daily')
            <button wire:click="previousDay" class="px-2 py-1 border rounded bg-gray-100 hover:bg-gray-200">Hari Sebelumnya</button>
            <button wire:click="nextDay" class="px-2 py-1 border rounded bg-gray-100 hover:bg-gray-200">Hari Berikutnya</button>
            <input type="date" wire:model.live="selectedDate" class="border px-2 py-1 rounded">
        @endif

        {{-- Monthly Controls --}}
        @if($mode === 'monthly')
            <button wire:click="previousMonth" class="px-2 py-1 border rounded bg-gray-100 hover:bg-gray-200">Bulan Sebelumnya</button>
            <button wire:click="nextMonth" class="px-2 py-1 border rounded bg-gray-100 hover:bg-gray-200">Bulan Berikutnya</button>
            <input type="month" wire:model.live="selectedMonth" class="border px-2 py-1 rounded">
        @endif
    </div>

    {{-- Chart --}}
    <div class="w-full h-64">
        <canvas id="transactionChart" wire:ignore></canvas>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("livewire:updated", renderChart);
document.addEventListener("DOMContentLoaded", renderChart);

let chartInstance;

function renderChart() {
    const ctx = document.getElementById("transactionChart");
    if (!ctx) return;

    if (chartInstance) chartInstance.destroy();

    const labels = @js($labels);
    const jual = @js($jual);
    const beli = @js($beli);

    chartInstance = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Jual',
                    data: jual,
                    borderWidth: 3,
                    borderColor: "rgba(99,102,241,1)",  // Indigo
                    backgroundColor: "rgba(99,102,241,0.2)",
                    tension: 0.4,
                    pointRadius: 3
                },
                {
                    label: 'Beli',
                    data: beli,
                    borderWidth: 3,
                    borderColor: "rgba(239,68,68,1)",   // Merah
                    backgroundColor: "rgba(239,68,68,0.2)",
                    tension: 0.4,
                    pointRadius: 3
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                tooltip: { mode: 'index', intersect: false }
            },
            interaction: { mode: 'nearest', axis: 'x', intersect: false },
            scales: {
                x: {
                    title: { display: true, text: '{{ $mode === "daily" ? "Jam" : "Tanggal" }}' }
                },
                y: {
                    title: { display: true, text: 'Jumlah Transaksi' },
                    beginAtZero: true
                }
            }
        }
    });
}
</script>