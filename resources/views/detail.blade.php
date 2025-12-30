<x-layoutdetail>
    {{-- TEST: tampilkan ID --}}
    <div class="p-4 text-sm text-gray-600">
        ID dari route: {{ $hpId }}
    </div>

    <livewire:hp-detail.hp-detail :hp="$hpId" />
</x-layoutdetail>
