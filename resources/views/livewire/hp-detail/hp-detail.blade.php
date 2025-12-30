<div class="min-h-screen p-4 bg-gray-50">
    <div class="max-w-4xl mx-auto">
        
        <!-- Header -->
        <div class="mb-6">
            <div class="mb-2">
                <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-blue-600">
                    <i class="fas fa-home mr-1"></i> Dashboard
                </a>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-sm font-medium text-blue-600">Detail HP</span>
            </div>
            
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-xl font-bold">Detail HP</h1>
                    <p class="text-gray-600">{{ $hp->type_hp }}</p>
                </div>
                <button wire:click="goBack" class="px-3 py-2 bg-gray-200 rounded hover:bg-gray-300">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </button>
            </div>
        </div>

        <!-- Card Utama -->
        <div class="bg-white rounded-lg border shadow-sm">
            
            <!-- Header Card -->
            <div class="p-4 border-b">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-lg font-bold">{{ $hp->type_hp }}</h2>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-sm text-gray-600">
                                Status: <span class="font-medium">{{ ucfirst($hp->status) }}</span>
                            </span>
                            <span class="text-sm text-gray-600">
                                Grade: {{ $hp->grade ?? 'A' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="text-right">
                        <p class="text-xl font-bold">{{ $this->formattedPrice ?? 'Rp 0' }}</p>
                        <p class="text-sm text-gray-500">Harga Katalog</p>
                    </div>
                </div>
            </div>

            <!-- Detail -->
            <div class="p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <!-- Kolom Kiri -->
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium mb-2">Identitas</h4>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <p class="text-sm text-gray-500">Brand</p>
                                    <p class="font-medium">{{ $hp->detail->brand ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Storage</p>
                                    <p class="font-medium">{{ $hp->detail->storage ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Warna</p>
                                    <p class="font-medium">{{ $hp->detail->color ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Kode HP</p>
                                    <p class="font-medium">{{ $hp->code_hp ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-medium mb-2">Kondisi</h4>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <p class="text-sm text-gray-500">Display</p>
                                    <p class="font-medium">{{ $hp->detail->display ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Body</p>
                                    <p class="font-medium">{{ $hp->detail->body ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium mb-2">Baterai</h4>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <p class="text-sm text-gray-500">Kondisi</p>
                                    <p class="font-medium">{{ $hp->detail->battery ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Kesehatan</p>
                                    <p class="font-medium">{{ $hp->detail->battery_health ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-medium mb-2">Fitur</h4>
                            <div class="grid grid-cols-3 gap-2">
                                <div>
                                    <p class="text-sm text-gray-500">Face ID</p>
                                    <p class="font-medium">{{ $hp->detail->face_id ? '✓' : '✗' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">True Tone</p>
                                    <p class="font-medium">{{ $hp->detail->true_tone ? '✓' : '✗' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Fingerprint</p>
                                    <p class="font-medium">{{ $hp->detail->finger_print ? '✓' : '✗' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Lain -->
                @if($hp->detail && $hp->detail->other)
                <div class="mt-6 p-4 bg-gray-50 rounded border">
                    <h4 class="font-medium mb-2">Catatan</h4>
                    <div class="text-sm">
                        @foreach(explode("\n", $hp->detail->other) as $note)
                            @if(trim($note))
                                <p class="mb-1">• {{ trim($note) }}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Harga -->
                <div class="mt-6 pt-4 border-t">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div>
                            <p class="text-sm text-gray-500">Harga Beli</p>
                            <p class="text-lg font-bold">{{ $this->purchasePrice ?? 'Rp 0' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Harga Jual</p>
                            <p class="text-lg font-bold">{{ $this->formattedPrice ?? 'Rp 0' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Estimasi Profit</p>
                            <p class="text-lg font-bold text-green-600">{{ $this->profit ?? 'Rp 0' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aksi -->
            <div class="p-4 border-t bg-gray-50">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        {{ $hp->created_at->format('d M Y') }}
                    </div>
                    <div class="flex gap-2">
                        @if($hp->status !== 'sold')
                            <button wire:click="markAsSold" 
                                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                Tandai Terjual
                            </button>
                        @else
                            <button wire:click="toggleSoldStatus" 
                                    class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                Kembalikan ke Stok
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>