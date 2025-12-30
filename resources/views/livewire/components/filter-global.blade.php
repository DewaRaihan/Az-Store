<div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
    <div class="flex items-center gap-3 flex-wrap">

        {{-- Search --}}
        @if ($enableSearch)
        <div class="relative flex-1 min-w-[180px]">
            <input type="text" 
                wire:model.debounce.300ms="search"
                placeholder="Cari..." 
                class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors">

            <svg class="absolute left-2.5 top-2.5 w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        @endif

        {{-- Type Dropdown --}}
        @if ($enableType)
        <div class="relative">
            <select 
                wire:model="type"
                class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm min-w-[120px] appearance-none bg-white transition-colors"
            >
                @foreach ($dropdownA as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
            <div class="absolute right-2 top-1/2 transform -translate-y-1/2 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </div>
        @endif

        {{-- Status Dropdown --}}
        @if ($enableStatus)
        <div class="relative">
            <select 
                wire:model="status"
                class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm min-w-[120px] appearance-none bg-white transition-colors"
            >
                @foreach ($dropdownB as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
            <div class="absolute right-2 top-1/2 transform -translate-y-1/2 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </div>
        @endif

        @if ($enableGrade)
        <div class="relative">
            <select 
                wire:model="grade"
                class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm min-w-[120px] appearance-none bg-white transition-colors"
            >
                @foreach ($dropdownC as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
            <div class="absolute right-2 top-1/2 transform -translate-y-1/2 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </div>
        @endif

        {{-- Date Range --}}
        <div class="flex items-center gap-2 min-w-[250px]">
            <input 
                type="date"
                wire:model="start_date"
                class="flex-1 px-2 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors">

            <span class="text-gray-500 text-sm font-medium">s/d</span>

            <input 
                type="date"
                wire:model="end_date"
                class="flex-1 px-2 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors">
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-2">
            <button 
                wire:click="applyFilters"
                class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 font-medium transition-colors shadow-sm hover:shadow">
                Terapkan
            </button>

            <button 
                wire:click="resetFilters"
                class="px-4 py-2 text-gray-600 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700 font-medium transition-colors">
                Reset
            </button>
        </div>

    </div>
</div>