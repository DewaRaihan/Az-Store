<div class="p-6 border-b border-gray-100">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <div class="flex items-center gap-2 mb-3 flex-wrap">
                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-medium">
                    {{ $hp->detail->brand ?? 'Brand' }}
                </span>

                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $this->statusColor }}">
                    <i class="fas {{ $this->statusIcon }} mr-1"></i>
                    {{ ucfirst($hp->status) }}
                </span>

                <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-sm">
                    Grade {{ $hp->grade ?? 'A' }}
                </span>
            </div>

            <h2 class="text-xl font-bold text-gray-800">
                {{ $hp->type_hp }}
            </h2>

            @if($hp->code_hp)
                <p class="text-sm text-gray-500 mt-1">
                    Kode: {{ $hp->code_hp }}
                </p>
            @endif
        </div>

        <div class="text-right">
            <p class="text-2xl font-bold text-gray-800">
                {{ $this->formattedPrice }}
            </p>
            <p class="text-sm text-gray-500">Harga Katalog</p>

            @if($hp->status === 'sold')
                <p class="text-sm text-red-600 font-medium mt-1">
                    <i class="fas fa-check-circle mr-1"></i> Terjual
                </p>
            @endif
        </div>
    </div>
</div>
