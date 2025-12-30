<div class="bg-white shadow rounded-xl p-6">
    <h2 class="text-xl font-semibold mb-6 text-gray-800">Daftar HP</h2>

    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full border-collapse text-sm">
            <thead>
                <tr class="bg-gray-100 text-left text-gray-700">
                    <th class="p-4 font-medium text-center">Foto</th>
                    <th class="p-4 font-medium">Kode</th>
                    <th class="p-4 font-medium">Tipe</th>
                    <th class="p-4 font-medium">Kondisi</th>
                    <th class="p-4 font-medium text-right">Harga Beli</th>
                    <th class="p-4 font-medium text-right">Harga Jual</th>
                    <th class="p-4 font-medium text-center">Status</th>
                    <th class="p-4 font-medium text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse($hps as $hp)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="p-4 text-center">
                        <img src="{{ !empty($hp['photo_url']) ? $hp['photo_url'] : 'https://via.placeholder.com/80' }}" 
                            class="w-14 h-14 object-cover rounded-md shadow-sm mx-auto">
                    </td>
                    <td class="p-4 font-medium text-gray-800">{{ $hp['code_hp'] }}</td>
                    <td class="p-4 text-gray-700">{{ $hp['type_hp'] }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1.5 rounded-full text-xs font-medium
                            @if($hp['grade'] === 'Normal') bg-green-100 text-green-800
                            @elseif($hp['grade'] === 'Minus') bg-amber-100 text-amber-800
                            @else bg-rose-100 text-rose-800 @endif">
                            {{ $hp['grade'] }}
                        </span>
                    </td>
                    <td class="p-4 text-gray-800 text-right font-medium">
                        Rp {{ number_format($hp['transaction']['purchase']['purchase_price'] ?? 0, 0, ',', '.') }}
                    </td>
                    <td class="p-4 text-gray-800 text-right font-medium">
                        @if(!empty($hp['transaction']['selling']['selling_price']))
                            Rp {{ number_format($hp['transaction']['selling']['selling_price'], 0, ',', '.') }}
                        @else
                            <span class="text-gray-400 italic">-</span>
                        @endif
                    </td>
                    <td class="p-4 text-center">
                        <span class="px-3 py-1.5 rounded-full text-xs font-medium border
                            @if($hp['status'] === 'stock') bg-gray-100 text-gray-800 border-gray-300
                            @elseif($hp['status'] === 'sold') bg-rose-100 text-rose-800 border-rose-300
                            @else bg-slate-100 text-slate-800 border-slate-300 @endif">
                            {{ ucfirst($hp['status']) }}
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="flex gap-2 justify-center">
                            <button class="px-4 py-2 rounded-md text-xs font-medium border bg-indigo-100 border-indigo-300 text-indigo-800 hover:bg-indigo-200 transition-colors duration-150">
                                Detail
                            </button>
                            <button class="px-4 py-2 rounded-md text-xs font-medium border bg-amber-100 border-amber-300 text-amber-800 hover:bg-amber-200 transition-colors duration-150">
                                Edit
                            </button>
                            <button class="px-4 py-2 rounded-md text-xs font-medium border bg-rose-100 border-rose-300 text-rose-800 hover:bg-rose-200 transition-colors duration-150">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="p-8 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p>Tidak ada data HP</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
        <!-- Atau pagination dengan customization -->
    <x-paginator 
        :paginator="$paginator"
        :maxPages="7"
        :showFirstLast="true"
        :showEllipsis="true"
        containerClass="mt-6 flex justify-center"
        activeButtonClass="bg-blue-600 border-blue-600 text-white"
    />

</div>