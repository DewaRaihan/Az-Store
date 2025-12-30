@if ($paginator && $paginator->lastPage() > 1)
<div class="mt-6 flex justify-center">
    <nav class="flex items-center gap-1">
        <!-- Previous Button -->
        <button wire:click="previousPage" @disabled($paginator->onFirstPage())
            class="px-3.5 py-2 text-sm rounded-md border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-150">
            ‹
        </button>

        <!-- First Page -->
        @if($paginator->currentPage() > 3)
            <button wire:click="gotoPage(1)"
                class="px-4 py-2 text-sm rounded-md border font-medium bg-white border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                1
            </button>
            @if($paginator->currentPage() > 4)
                <span class="px-2 py-2 text-gray-500">...</span>
            @endif
        @endif

        <!-- Page Numbers (max 5) -->
        @php
            $startPage = max(1, $paginator->currentPage() - 2);
            $endPage = min($paginator->lastPage(), $paginator->currentPage() + 2);
            
            // Adjust if near the beginning
            if($paginator->currentPage() <= 3) {
                $endPage = min(5, $paginator->lastPage());
            }
            
            // Adjust if near the end
            if($paginator->currentPage() >= $paginator->lastPage() - 2) {
                $startPage = max(1, $paginator->lastPage() - 4);
            }
        @endphp

        @for($page = $startPage; $page <= $endPage; $page++)
            <button wire:click="gotoPage({{ $page }})"
                class="px-4 py-2 text-sm rounded-md border font-medium
                    @if($page == $paginator->currentPage())
                        bg-indigo-600 border-indigo-600 text-white
                    @else
                        bg-white border-gray-300 text-gray-700 hover:bg-gray-50
                    @endif transition-colors duration-150">
                {{ $page }}
            </button>
        @endfor

        <!-- Last Page -->
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            @if($paginator->currentPage() < $paginator->lastPage() - 3)
                <span class="px-2 py-2 text-gray-500">...</span>
            @endif
            <button wire:click="gotoPage({{ $paginator->lastPage() }})"
                class="px-4 py-2 text-sm rounded-md border font-medium bg-white border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                {{ $paginator->lastPage() }}
            </button>
        @endif

        <!-- Next Button -->
        <button wire:click="nextPage" @disabled(!$paginator->hasMorePages())
            class="px-3.5 py-2 text-sm rounded-md border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-150">
            ›
        </button>
    </nav>
</div>
@endif