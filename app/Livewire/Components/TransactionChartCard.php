<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Carbon\Carbon;

class TransactionChartCard extends Component
{
    public $mode = 'daily';       // daily / monthly
    public $selectedDate;         // tanggal filter harian
    public $selectedMonth;        // bulan filter bulanan

    public $labels = [];
    public $jual = [];
    public $beli = [];

    public function mount()
    {
        $this->selectedDate = Carbon::today()->toDateString();
        $this->selectedMonth = Carbon::today()->format('Y-m');

        $this->generateChart();
    }

    public function updated($field)
    {
        $this->generateChart();
    }

    public function previousDay()
    {
        $this->selectedDate = Carbon::parse($this->selectedDate)->subDay()->toDateString();
        $this->generateChart();
    }

    public function nextDay()
    {
        $this->selectedDate = Carbon::parse($this->selectedDate)->addDay()->toDateString();
        $this->generateChart();
    }

    public function previousMonth()
    {
        $this->selectedMonth = Carbon::parse($this->selectedMonth . '-01')->subMonth()->format('Y-m');
        $this->generateChart();
    }

    public function nextMonth()
    {
        $this->selectedMonth = Carbon::parse($this->selectedMonth . '-01')->addMonth()->format('Y-m');
        $this->generateChart();
    }

    public function generateChart()
    {
        if ($this->mode === 'daily') {
            // Labels per jam 00-23
            $this->labels = array_map(fn($h) => str_pad($h, 2, '0', STR_PAD_LEFT), range(0, 23));

            // Dummy data jual & beli 24 jam
            $this->jual = array_map(fn() => rand(5, 20), range(0, 23));
            $this->beli = array_map(fn() => rand(1, 15), range(0, 23));

        } else {
            // Labels per tanggal bulan ini / selected
            $daysInMonth = Carbon::parse($this->selectedMonth . '-01')->daysInMonth;
            $this->labels = range(1, $daysInMonth);

            // Dummy data jual & beli per tanggal
            $this->jual = array_map(fn() => rand(10, 40), range(1, $daysInMonth));
            $this->beli = array_map(fn() => rand(5, 25), range(1, $daysInMonth));
        }
    }

    public function render()
    {
        return view('livewire.components.transaction-chart-card');
    }
}
