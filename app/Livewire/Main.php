<?php

namespace App\Livewire;

use Livewire\Component;

class Main extends Component
{
    public $currentPage = 'dashboard';

    protected $listeners = ['switchPage' => 'handleSwitchPage'];

    protected $queryString = ['currentPage'];

    public function handleSwitchPage($page)
    {
        $this->currentPage = $page;
    }
    
    public function render()
    {
        return view('livewire.main');
    }
}
