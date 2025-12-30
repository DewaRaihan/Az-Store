<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Paginate extends Component
{
    public $paginator;

    public function render()
    {
        return view('livewire.components.paginate');
    }
}
