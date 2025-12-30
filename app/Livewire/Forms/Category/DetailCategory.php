<?php

namespace App\Livewire\Forms\Category;

use Livewire\Attributes\On;
use Livewire\Component;

class DetailCategory extends Component
{
    public array $detail = [
        'brand' => 'Apple',
        'storage' => '128b',
        'color' => 'hitam',
        'imei' => '121413131',
        'serial_number' => 's32425',
        'network' => null,
        'warranty' => null,
        'display' => null,
        'body' => null,
        'battery' => null,
        'battery_health' => null,
        'face_id' => null,
        'true_tone' => null,
        'finger_print' => null,
        'front_camera' => null,
        'rear_camera' => null,
        'other' => null,
    ];

    
    // 🔥 DIPANGGIL SAAT SUBMIT
    #[On('requestDetail')]
    public function sendDetail(): void
    {
        logger()->info('DETAIL DIKIRIM SAAT SUBMIT', $this->detail);

        $this->dispatch('detailCollected', detail: $this->detail);
    }
    
    public function render()
    {
        return view('livewire.forms.category.detail-category');
    }
}