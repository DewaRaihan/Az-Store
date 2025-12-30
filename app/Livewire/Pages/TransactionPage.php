<?php

namespace App\Livewire\Pages;

use App\Services\TransactionPage\TransactionCardStatsService;
use Livewire\Component;

class TransactionPage extends Component
{
    public function mount()
    {
        app(TransactionCardStatsService::class)->handle();
    }
    public function render()
    {
        return view('livewire.pages.transaction-page');
    }
}
