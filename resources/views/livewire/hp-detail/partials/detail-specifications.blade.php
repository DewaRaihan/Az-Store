<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Kolom Kiri: Identitas & Kondisi -->
    <div class="space-y-6">
        <!-- Identitas Unit -->
        <div>
            <h3 class="text-sm font-medium text-gray-500 mb-3">IDENTITAS UNIT</h3>
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                    <p class="text-xs text-gray-500 mb-1">Brand</p>
                    <p class="font-medium">{{ $hp->detail->brand ?? 'N/A' }}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                    <p class="text-xs text-gray-500 mb-1">Storage</p>
                    <p class="font-medium">{{ $hp->detail->storage ?? 'N/A' }}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                    <p class="text-xs text-gray-500 mb-1">Warna</p>
                    <p class="font-medium">{{ $hp->detail->color ?? 'N/A' }}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                    <p class="text-xs text-gray-500 mb-1">Kode HP</p>
                    <p class="font-medium text-sm">{{ $hp->code_hp ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Konfigurasi -->
        <div>
            <h3 class="text-sm font-medium text-gray-500 mb-3">KONFIGURASI</h3>
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                    <p class="text-xs text-gray-500 mb-1">Network</p>
                    <p class="font-medium">{{ $hp->detail->network ?? 'N/A' }}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                    <p class="text-xs text-gray-500 mb-1">Garansi</p>
                    <p class="font-medium">{{ $hp->detail->warranty ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Kondisi Fisik -->
        <div>
            <h3 class="text-sm font-medium text-gray-500 mb-3">KONDISI FISIK</h3>
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                    <p class="text-xs text-gray-500 mb-1">Display</p>
                    <p class="font-medium {{ $displayColor }}">{{ $hp->detail->display ?? 'N/A' }}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                    <p class="text-xs text-gray-500 mb-1">Body</p>
                    <p class="font-medium {{ $bodyColor }}">{{ $hp->detail->body ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Fitur & Lainnya -->
    <div class="space-y-6">
        <!-- Kondisi Baterai -->
        <div>
            <h3 class="text-sm font-medium text-gray-500 mb-3">BATERAI</h3>
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                    <p class="text-xs text-gray-500 mb-1">Kondisi</p>
                    <p class="font-medium {{ $batteryConditionColor }}">{{ $hp->detail->battery ?? 'N/A' }}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                    <p class="text-xs text-gray-500 mb-1">Kesehatan</p>
                    <p class="font-medium {{ $batteryHealthColor }}">{{ $hp->detail->battery_health ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Fitur Utama -->
        <div>
            <h3 class="text-sm font-medium text-gray-500 mb-3">FITUR UTAMA</h3>
            <div class="grid grid-cols-3 gap-3">
                @if($hp->detail)
                    @if($hp->detail->face_id !== null)
                    <div class="{{ $faceIdColor }} p-3 rounded-lg border">
                        <p class="text-xs text-gray-500 mb-1">Face ID</p>
                        <p class="font-medium {{ $faceIdTextColor }}">
                            {{ $hp->detail->face_id ? '✓' : '✗' }}
                        </p>
                    </div>
                    @endif
                    
                    @if($hp->detail->true_tone !== null)
                    <div class="{{ $trueToneColor }} p-3 rounded-lg border">
                        <p class="text-xs text-gray-500 mb-1">True Tone</p>
                        <p class="font-medium {{ $trueToneTextColor }}">
                            {{ $hp->detail->true_tone ? '✓' : '✗' }}
                        </p>
                    </div>
                    @endif
                    
                    @if($hp->detail->finger_print !== null)
                    <div class="{{ $fingerPrintColor }} p-3 rounded-lg border">
                        <p class="text-xs text-gray-500 mb-1">Fingerprint</p>
                        <p class="font-medium {{ $fingerPrintTextColor }}">
                            {{ $hp->detail->finger_print ? '✓' : '✗' }}
                        </p>
                    </div>
                    @endif
                @else
                    <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">Face ID</p>
                        <p class="font-medium text-gray-600">N/A</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">True Tone</p>
                        <p class="font-medium text-gray-600">N/A</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">Fingerprint</p>
                        <p class="font-medium text-gray-600">N/A</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Kamera -->
        <div>
            <h3 class="text-sm font-medium text-gray-500 mb-3">KAMERA</h3>
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                    <p class="text-xs text-gray-500 mb-1">Depan</p>
                    <p class="font-medium">{{ $hp->detail->front_camera ?? 'N/A' }}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                    <p class="text-xs text-gray-500 mb-1">Belakang</p>
                    <p class="font-medium">{{ $hp->detail->rear_camera ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Informasi Lain -->
        @if($hp->detail && $hp->detail->other)
        <div>
            <h3 class="text-sm font-medium text-gray-500 mb-3">INFORMASI LAIN</h3>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <div class="space-y-2">
                    @foreach(explode("\n", $hp->detail->other) as $note)
                        @if(trim($note))
                            <div class="flex items-start">
                                <span class="text-gray-400 mr-2 mt-0.5">•</span>
                                <span class="text-sm text-gray-700">{{ trim($note) }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>