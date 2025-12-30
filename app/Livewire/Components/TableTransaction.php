<?php

namespace App\Livewire\Components;

use App\Repositories\TransactionRepository;
use App\Services\Tabledata\TransactionFetcher;
use Livewire\Component;
use Livewire\WithPagination;

class TableTransaction extends Component
{
    use WithPagination;

    public $mode = 'full';
    public $limit = 3;
    public $paginate = 10;

    public $filters = [
        'search' => null,
        'type' => null,
        'status' => null,
    ];

    protected $listeners = [
        'filterChanged' => 'applyFilter',
    ];

    public function applyFilter($filters)
    {
        $this->filters = $filters;
        $this->resetPage(); // penting supaya paginate tidak salah halaman
    }

    public function render()
    {
        $repo = app(TransactionRepository::class);
        $fetcher = app(TransactionFetcher::class);

        // MODE COMPACT
        if ($this->mode === 'compact') {
            $data = $repo
                ->filter($this->filters)
                ->limit($this->limit)
                ->get();

            return view('livewire.components.table-transaction', [
                'trxs' => $fetcher->formatCollection($data),
                'paginator' => null,
            ]);
        }

        // MODE FULL (PAGINATE)
        $data = $repo
            ->filter($this->filters)
            ->paginate($this->paginate);

        return view('livewire.components.table-transaction', [
            'trxs' => $fetcher->formatCollection($data->getCollection()),
            'paginator' => $data,
        ]);
    }
}
