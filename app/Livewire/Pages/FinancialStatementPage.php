<?php

namespace App\Livewire\Pages;

use App\Services\FinancialStatement\FinancialStatementCardStatsService;
use Livewire\Component;

class FinancialStatementPage extends Component
{
    public function mount()
    {
        app(FinancialStatementCardStatsService::class)->handle();
    }
    public function render()
    {
        return view('livewire.pages.financial-statement-page');
    }
}
