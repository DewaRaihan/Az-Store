<div class="bg-gray-50 min-h-screen p-4">
    <div class="max-w-6xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Detail HP
            </h1>
            <p class="text-gray-600">
                {{ $hp->type_hp }}
                {{ $hp->detail->storage ?? '' }}
                {{ $hp->detail->color ?? '' }}
            </p>
        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-xl shadow border">
            <div class="p-6 border-b flex justify-between">
                <div>
                    <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded">
                        {{ $hp->detail->brand ?? 'Brand' }}
                    </span>

                    <h2 class="text-xl font-bold mt-2">
                        {{ $hp->type_hp }}
                    </h2>
                </div>

                <div class="text-right">
                    <p class="text-2xl font-bold">
                        Rp {{ number_format($hp->price, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-gray-500">Harga Jual</p>
                </div>
            </div>

            {{-- IDENTITAS --}}
            <div class="p-6 grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-gray-500">Storage</p>
                    <p class="font-medium">{{ $hp->detail->storage ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Warna</p>
                    <p class="font-medium">{{ $hp->detail->color ?? 'N/A' }}</p>
                </div>
            </div>

            {{-- ACTION --}}
            <div class="p-6 border-t bg-gray-50 text-right">
                <button
                    wire:click="goBack"
                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                    Kembali
                </button>
            </div>
        </div>

    </div>
</div>
