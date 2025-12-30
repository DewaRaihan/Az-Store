<?php

namespace App\Livewire\Components;

use Livewire\Component;

class NavLink extends Component
{
    public $currentPage = 'dashboard';

    protected $listeners = ['pageChanged' => 'updateCurrentPage'];

    public function mount()
    {
        // Optional: Load from session jika ada
        $this->currentPage = session('current_page', 'dashboard');
    }

    public function updateCurrentPage($page)
    {
        if ($this->isValidPage($page)) {
            $this->currentPage = $page;
            
            // Simpan ke session
            session()->put('current_page', $page);
        }
    }

    public function switchPage($page)
    {
        if ($this->isValidPage($page)) {
            $this->currentPage = $page;
            
            // Simpan ke session
            session()->put('current_page', $page);
            
            // Dispatch event ke parent
            $this->dispatch('switchPage', page: $page);
            
            // Dispatch event ke Alpine.js
            $this->dispatch('pageChanged', page: $page);
        }
    }

    private function isValidPage($page)
    {
        return in_array($page, [
            'dashboard', 
            'inventory', 
            'transaction', 
            'financial_statement',
            'manage_catalog',
            'employee',
            'settings'
        ]);
    }

    public function render()
    {
        return view('livewire.components.nav-link');
    }
}