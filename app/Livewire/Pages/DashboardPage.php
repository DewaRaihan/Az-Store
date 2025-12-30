<?php

namespace App\Livewire\Pages;

use App\Services\DashboardCardStat;
use Livewire\Attributes\On;
use Livewire\Component;

class DashboardPage extends Component
{
    // Gunakan array keyed by cardKey supaya bisa support banyak card
    public $results = [];

    public function mount()
    {
        app(\App\Services\DashboardPage\DashboardCardStatsService::class)->handle();
    }

    public function render()
    {
        return view('livewire.pages.dashboard-page', [
            'results' => $this->results,
        ]);
    }
}
