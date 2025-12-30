@props([
    'paginator',
    'maxPages' => 5,
    'showFirstLast' => true,
    'showEllipsis' => true,
    'containerClass' => 'mt-6 flex justify-center',
    'navClass' => 'flex items-center gap-1',
    'buttonClass' => 'px-4 py-2 text-sm rounded-md border font-medium transition-colors duration-150',
    'activeButtonClass' => 'bg-indigo-600 border-indigo-600 text-white',
    'inactiveButtonClass' => 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50',
    'disabledButtonClass' => 'px-3.5 py-2 text-sm rounded-md border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed',
    'ellipsisClass' => 'px-2 py-2 text-gray-500'
])

@if ($paginator && $paginator->lastPage() > 1)
<div class="{{ $containerClass }}">
    <nav class="{{ $navClass }}">
        <!-- Previous Button -->
        <button 
            wire:click="previousPage" 
            @disabled($paginator->onFirstPage())
            class="{{ $disabledButtonClass }}"
        >
            ‹
        </button>

        <!-- First Page -->
        @if($showFirstLast && $paginator->currentPage() > 3)
            <button 
                wire:click="gotoPage(1)"
                class="{{ $buttonClass }} {{ $inactiveButtonClass }}"
            >
                1
            </button>
            @if($showEllipsis && $paginator->currentPage() > 4)
                <span class="{{ $ellipsisClass }}">...</span>
            @endif
        @endif

        <!-- Page Numbers -->
        @php
            $startPage = max(1, $paginator->currentPage() - floor($maxPages / 2));
            $endPage = min($paginator->lastPage(), $startPage + $maxPages - 1);
            
            // Adjust if near the beginning
            if($paginator->currentPage() <= floor($maxPages / 2)) {
                $startPage = 1;
                $endPage = min($maxPages, $paginator->lastPage());
            }
            
            // Adjust if near the end
            if($paginator->currentPage() >= $paginator->lastPage() - floor($maxPages / 2)) {
                $endPage = $paginator->lastPage();
                $startPage = max(1, $endPage - $maxPages + 1);
            }
        @endphp

        @for($page = $startPage; $page <= $endPage; $page++)
            <button 
                wire:click="gotoPage({{ $page }})"
                class="{{ $buttonClass }} {{ $page == $paginator->currentPage() ? $activeButtonClass : $inactiveButtonClass }}"
            >
                {{ $page }}
            </button>
        @endfor

        <!-- Last Page -->
        @if($showFirstLast && $paginator->currentPage() < $paginator->lastPage() - 2)
            @if($showEllipsis && $paginator->currentPage() < $paginator->lastPage() - 3)
                <span class="{{ $ellipsisClass }}">...</span>
            @endif
            <button 
                wire:click="gotoPage({{ $paginator->lastPage() }})"
                class="{{ $buttonClass }} {{ $inactiveButtonClass }}"
            >
                {{ $paginator->lastPage() }}
            </button>
        @endif

        <!-- Next Button -->
        <button 
            wire:click="nextPage" 
            @disabled(!$paginator->hasMorePages())
            class="{{ $disabledButtonClass }}"
        >
            ›
        </button>
    </nav>
</div>
@endif