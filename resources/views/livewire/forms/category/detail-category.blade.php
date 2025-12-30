<div class="bg-white rounded-xl shadow border p-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Detail HP</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Brand -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Brand *</label>
            <input type="text" 
                   wire:model="detail.brand"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Contoh: Apple, Samsung, Xiaomi, Oppo"
                   required>
            @error('detail.brand') 
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Storage -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Storage *</label>
            <input type="text" 
                   wire:model="detail.storage"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Contoh: 128GB, 256GB, 512GB"
                   required>
            @error('detail.storage') 
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span> 
            @enderror
        </div>

        <!-- IMEI -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">IMEI</label>
            <input type="text" 
                   wire:model="detail.imei"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="15 digit nomor IMEI">
            @error('detail.imei') 
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Serial Number -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Serial Number</label>
            <input type="text" 
                   wire:model="detail.serial_number"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Nomor seri perangkat">
        </div>

        <!-- Color -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Warna *</label>
            <input type="text" 
                   wire:model="detail.color"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Contoh: Hitam, Putih, Silver, Midnight"
                   required>
            @error('detail.color') 
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Network -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Network</label>
            <select wire:model="detail.network"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Pilih tipe network</option>
                <option value="normal">Normal</option>
                <option value="wifi-only">Wifi Only</option>
                <option value="simlock">SIM Lock</option>
                <option value="global">Global Version</option>
                <option value="dual-sim">Dual SIM</option>
            </select>
        </div>

        <!-- Warranty -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Garansi</label>
            <select wire:model="detail.warranty"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Pilih tipe garansi</option>
                <option value="resmi">Resmi</option>
                <option value="internasional">Internasional</option>
                <option value="tidak-ada">Tidak Ada</option>
                <option value="distributor">Distributor</option>
                <option value="toko">Toko</option>
            </select>
        </div>

        <!-- Display Condition -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi Display</label>
            <select wire:model="detail.display"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Pilih kondisi display</option>
                <option value="mulus">Mulus (No scratch)</option>
                <option value="barettipis">Baret Tipis</option>
                <option value="baretsedang">Baret Sedang</option>
                <option value="barettipis-display">Baret Tipis + Display OK</option>
                <option value="retak">Retak Kecil</option>
                <option value="ganti-lcd">Pernah Ganti LCD</option>
            </select>
        </div>

        <!-- Body Condition -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi Body</label>
            <select wire:model="detail.body"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Pilih kondisi body</option>
                <option value="mulus">Mulus (Like New)</option>
                <option value="bekas-pakai">Bekas Pakai Normal</option>
                <option value="goresan-ringan">Goresan Ringan</option>
                <option value="goresan-sedang">Goresan Sedang</option>
                <option value="penyok">Ada Penyok</option>
                <option value="retak-housing">Retak Housing</option>
            </select>
        </div>

        <!-- Battery Condition -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi Baterai</label>
            <select wire:model="detail.battery"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Pilih kondisi baterai</option>
                <option value="sangat-baik">Sangat Baik</option>
                <option value="baik">Baik</option>
                <option value="cukup">Cukup</option>
                <option value="cepat-habis">Cepat Habis</option>
                <option value="perlu-ganti">Perlu Ganti</option>
            </select>
        </div>

        <!-- Battery Health -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kesehatan Baterai</label>
            <select wire:model="detail.battery_health"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Pilih persentase baterai</option>
                <option value="100%">100% (Baru)</option>
                <option value="95-99%">95-99% (Sangat Baik)</option>
                <option value="90-94%">90-94% (Baik)</option>
                <option value="85-89%">85-89% (Cukup)</option>
                <option value="80-84%">80-84% (Kurang)</option>
                <option value="<80%">Kurang dari 80%</option>
            </select>
        </div>

        <!-- Face ID -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Face ID</label>
            <select wire:model="detail.face_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Pilih status Face ID</option>
                <option value="berfungsi">Berfungsi</option>
                <option value="tidak-berfungsi">Tidak Berfungsi</option>
                <option value="tidak-ada">Tidak Ada</option>
            </select>
        </div>

        <!-- True Tone -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">True Tone</label>
            <select wire:model="detail.true_tone"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Pilih status True Tone</option>
                <option value="aktif">Aktif</option>
                <option value="tidak-aktif">Tidak Aktif</option>
                <option value="tidak-ada">Tidak Ada</option>
            </select>
        </div>

        <!-- Finger Print -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Fingerprint</label>
            <select wire:model="detail.finger_print"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Pilih status fingerprint</option>
                <option value="berfungsi">Berfungsi</option>
                <option value="tidak-berfungsi">Tidak Berfungsi</option>
                <option value="tidak-ada">Tidak Ada</option>
            </select>
        </div>

        <!-- Front Camera Condition -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kamera Depan</label>
            <select wire:model="detail.front_camera"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Pilih kondisi kamera depan</option>
                <option value="berfungsi">Berfungsi Normal</option>
                <option value="berkabut">Berkabut</option>
                <option value="retak">Retak</option>
                <option value="tidak-jelas">Gambar Tidak Jelas</option>
                <option value="tidak-ada">Tidak Ada</option>
            </select>
        </div>

        <!-- Rear Camera Condition -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kamera Belakang</label>
            <select wire:model="detail.rear_camera"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Pilih kondisi kamera belakang</option>
                <option value="semua-berfungsi">Semua Lensa Berfungsi</option>
                <option value="satu-rusak">1 Lensa Rusak</option>
                <option value="berkabut">Lensa Berkabut</option>
                <option value="retak">Lensa Retak</option>
                <option value="tidak-fokus">Tidak Fokus</option>
            </select>
        </div>

        <!-- Other Features/Issues -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Fitur Lain & Masalah</label>
            <textarea wire:model="detail.other"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      rows="3"
                      placeholder="Contoh: 
- Speaker OK
- Microphone OK  
- Charging port OK
- Tombol volume ada yang keras
- Water damage indicator merah"></textarea>
            @error('detail.other') 
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span> 
            @enderror
        </div>
    </div>
</div>