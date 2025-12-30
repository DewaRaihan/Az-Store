<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class HeaderLayout extends Component
{
    public $selectedType = null;

    public function createTransaction(string $type)
    {
        return redirect()->route('transaction-form', [
            'type' => $type,
        ]);
    }

    public function render()
    {
        return view('livewire.components.header-layout');
    }
}
