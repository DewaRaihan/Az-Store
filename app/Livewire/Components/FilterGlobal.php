<?php

namespace App\Livewire\Components;

use Livewire\Component;

class FilterGlobal extends Component
{
    // FILTER PROPERTIES
    public $search = '';
    public $type = '';
    public $status = '';
    public $grade = '';
    public $start_date = '';
    public $end_date = '';

    // OPTIONAL: enable/disable dropdown
    public $enableSearch = true;
    public $enableType = true;
    public $enableStatus = true;
    public $enableGrade = true;

    // OPTIONAL: dropdown data
    public $dropdownA = [];
    public $dropdownB = [];
    public $dropdownC = [];

    public function mount(
        $enableSearch = true,
        $enableType = true,
        $enableStatus = true,
        $enableGrade = true,
        $dropdownA = [],
        $dropdownB = [],
        $dropdownC = [],
    ) {
        $this->enableSearch = $enableSearch;
        $this->enableType = $enableType;
        $this->enableStatus = $enableStatus;
        $this->enableGrade = $enableGrade;

        $this->dropdownA = $dropdownA;
        $this->dropdownB = $dropdownB;
        $this->dropdownC = $dropdownC;
    }

    public function updated($field)
    {
        // setiap field berubah, langsung broadcast
        $this->broadcast();
    }

    public function applyFilters()
    {
        $this->broadcast();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->type = '';
        $this->status = '';
        $this->start_date = '';
        $this->end_date = '';

        $this->broadcast();
    }

    protected function broadcast()
    {
        // kirim semua filter ke tabel
        $this->dispatch('filterChanged', [
            'search'     => $this->search ? $this->search : null,
            'type'       => $this->enableType ? $this->type : null,
            'status'     => $this->enableStatus ? $this->status : null,
            'grade'      => $this->enableGrade ? $this->grade : null,
            'start_date' => $this->start_date,
            'end_date'   => $this->end_date,
        ]);
    }

    public function render()
    {
        return view('livewire.components.filter-global');
    }
}
