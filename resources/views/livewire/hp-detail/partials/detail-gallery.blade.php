<div class="p-6 border-b">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <div class="flex items-center gap-2 mb-3 flex-wrap">
                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm">
                    {{ $hp->detail->brand ?? 'Brand' }}
                </span>
                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statusColor }}">
                    <i class="fas {{ $statusIcon }} mr-1"></i> {{ ucfirst($hp->status) }}
                </span>
                <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-sm">
                    Grade {{ $hp->grade ?? 'A' }}
                </span>
            </div>
            <h2 class="text-xl font-bold text-gray-800">{{ $hp->type_hp }}</h2>
            @if($hp->code_hp)
                <p class="text-sm text-gray-500 mt-1">Kode: {{ $hp->code_hp }}</p>
            @endif
        </div>
        
        <div class="text-right">
            <p class="text-2xl font-bold text-gray-800">{{ $formattedPrice }}</p>
            <p class="text-sm text-gray-500">Harga Katalog</p>
        </div>
    </div>
    
    {{-- Gallery Sederhana (jika ada images) --}}
    @if($images && $images->count() > 0)
    <div class="mt-4 pt-4 border-t">
        <h4 class="text-sm font-medium text-gray-500 mb-2">Foto HP</h4>
        <div class="grid grid-cols-4 gap-2">
            @foreach($images->take(4) as $image)
                <img src="{{ Storage::url($image->path) }}" 
                     alt="Foto HP" 
                     class="w-full h-20 object-cover rounded-lg border">
            @endforeach
        </div>
    </div>
    @endif
</div>