<div 
    wire:poll.10s
    x-data="{
        result: @entangle('result').live,
        filter: @entangle('filter').live,
        type: '{{ $type ?? 'amount' }}',
        options: @js($options),
        hasOptions: Object.keys(@js($options)).length > 0,
        format(value) {
            if (value === null || value === undefined) return 'Tidak Ada Data';
            switch (this.type) {
                case 'amount':
                    return new Intl.NumberFormat('id-ID',{style:'currency',currency:'IDR'}).format(value);
                case 'percent':
                    return value.toFixed(2)+'%';
                case 'number':
                    return new Intl.NumberFormat('id-ID').format(value);
                default: return value;
            }
        }
    }"
    class="bg-white rounded-xl p-5 w-full flex flex-col justify-between border border-gray-200 hover:border-blue-300 transition-colors duration-200"
>

    {{-- Header dengan atau tanpa dropdown --}}
    <div class="flex justify-between items-start mb-4">
        <h3 class="text-sm font-medium text-gray-600">{{ $title }}</h3>
        <div x-show="hasOptions">
            <x-dropdown x-model="filter" :options="$options" class="text-xs" />
        </div>
        <div x-show="!hasOptions" class="w-6"></div> {{-- Spacer untuk alignment --}}
    </div>

    {{-- Konten utama --}}
    <div class="flex-grow">
        <div class="flex items-start gap-3">
            <!-- Icon sederhana -->
            <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                <span class="text-blue-600 text-lg"
                    wire:loading.remove
                    wire:target="filter, result">
                    {!! $icon ?: '💰' !!}
                </span>
                
                <!-- Loading Icon minimalis -->
                <div wire:loading wire:target="filter, result"
                    class="w-4 h-4 border border-blue-400 border-t-transparent rounded-full animate-spin">
                </div>
            </div>

            <!-- Nilai -->
            <div class="min-w-0 flex-1">
                <h1 class="text-xl font-semibold text-gray-800 truncate"
                    x-text="format(result)"
                    wire:loading.remove
                    wire:target="filter, result">
                </h1>

                <!-- Loading text minimalis -->
                <div wire:loading wire:target="filter, result"
                    class="text-sm text-gray-400">
                    Loading...
                </div>
                
                <!-- Filter label jika ada -->
                <template x-if="filter && options[filter]">
                    <p class="text-xs text-blue-600 mt-1 truncate"
                        x-text="options[filter]">
                    </p>
                </template>
                
                <!-- Untuk yang tanpa filter, tetap tampilkan title kecil di sini -->
                <template x-if="!hasOptions">
                    <p class="text-xs text-gray-500 mt-1 truncate">
                        {{ $title }}
                    </p>
                </template>
            </div>
        </div>
    </div>

    {{-- Footer minimalis --}}
    <div class="text-xs text-gray-400 mt-4 pt-3 border-t border-gray-100">
        <div class="flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Diperbarui setiap 10 detik
        </div>
    </div>

</div>