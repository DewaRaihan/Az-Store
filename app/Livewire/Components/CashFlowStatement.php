<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Log;

class CashFlowStatement extends Component
{
    public function render()
    {
        $statement = app(\App\Services\Report\cashFlowStatement::class)->fetch();
        Log::info('[SpendingDetail] cache_key', [
            'statement' => $statement
        ]);
        
        return view('livewire.components.cash-flow-statement', [
            'statement' => $statement
        ]);
    }
}
