<?php

namespace App\Livewire\Components;

use Livewire\Component;

class StatsCard extends Component
{
    public $filter = '';       // boleh diisi parent
    public $options = [];
    public $result = null;
    public $icon = null;
    public $title = 'Stats';
    public $cardKey = null;
    public $type = 'amount';

    private function loadStats()
    {
        $key = "{$this->filter}_stats:";

        $this->result = cache()->get($key, 0);

        logger('debug result: ' . $this->result);
    }

    public function mount()
    {
        if (count($this->options) > 0) {
            // jika ada dropdown → filter dari options
            $this->filter = array_key_first($this->options);
        } else {
            // tidak ada dropdown → filter wajib dari parent atau cardKey
            $this->filter = $this->filter ?: ($this->cardKey ?? 'default');
        }

        $this->loadStats();
    }

    public function updatedFilter($value)
    {
        if (count($this->options) > 0) {
            $this->filter = $value;
            $this->loadStats();
        }
    }

    public function render()
    {
        return view('livewire.components.stats-card');
    }
}
