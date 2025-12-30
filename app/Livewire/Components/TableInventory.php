<?php

namespace App\Livewire\Components;

use App\Repositories\HpRepository;
use App\Services\Tabledata\HpFetcher;
use Livewire\Component;
use Livewire\WithPagination;

class TableInventory extends Component
{
    use WithPagination;

    public $mode = 'full';
    public $limit = 3;
    public $paginate = '10';

    public $filters = [
        'search' => null,
        'type' => null,
        'status' => null,
        'grade' => null,
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
        $repo = app(HpRepository::class);
        $fetcher  = app(HpFetcher::class);

        // COMPACT MODE (tanpa pagination)
        if ($this->mode === 'compact') {
            $data = $repo->filter($this->filters)->limit($this->limit)->get();

            return view('livewire.components.table-inventory', [
                'hps' => $fetcher->formatCollection($data),
                'paginator' => null,
                //'elements' => [],
            ]);
        }

        $data = $repo->filter($this->filters)->paginate($this->paginate);

        // FULL MODE (paginate)
        return view('livewire.components.table-inventory', [
            'hps' => $fetcher->formatCollection($data),
            'paginator' => $data
        ]);
    }
}
