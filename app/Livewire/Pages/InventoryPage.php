<?php

namespace App\Livewire\Pages;

use App\Services\InventoryPage\InventoryCardStatsService;
use Livewire\Component;

class InventoryPage extends Component
{
    public function mount()
    {
        app(InventoryCardStatsService::class)->handle();
    }
    public function render()
    {
        return view('livewire.pages.inventory-page');
    }
}
