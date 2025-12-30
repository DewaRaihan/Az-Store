<div class="mt-4 text-center text-xs text-gray-500">
    <div class="flex flex-wrap justify-center items-center gap-4">
        <div class="flex items-center gap-1">
            <i class="fas fa-calendar-plus"></i>
            <span>Created: {{ $hp->created_at->format('d M Y H:i') }}</span>
        </div>
        
        <div class="w-1 h-1 bg-gray-300 rounded-full"></div>
        
        <div class="flex items-center gap-1">
            <i class="fas fa-calendar-edit"></i>
            <span>Updated: {{ $hp->updated_at->diffForHumans() }}</span>
        </div>
        
        <div class="w-1 h-1 bg-gray-300 rounded-full"></div>
        
        <div class="flex items-center gap-1">
            <i class="fas fa-barcode"></i>
            <span>Stock ID: {{ $hp->code_hp ?? 'N/A' }}</span>
        </div>
    </div>
    
    @if($hp->detail && $hp->detail->imei)
    <div class="mt-2 flex justify-center items-center gap-1">
        <i class="fas fa-microchip"></i>
        <span>IMEI: {{ $hp->detail->imei }}</span>
    </div>
    @endif
</div>