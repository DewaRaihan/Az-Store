<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Hp;
use App\Models\Transaction;
use Illuminate\Support\Carbon;

class DetailUnit extends Component
{
    public $hp;
    public $showInternalNotes = false;
    public $activeTab = 'overview';
    public $isSelling = false;
    public $relatedTransaction = null;
    
    protected $listeners = [
        'hpUpdated' => 'refreshHp',
        'markAsSold' => 'markAsSold',
        'toggleSold' => 'toggleSoldStatus',
    ];
    
    public function mount(Hp $hp)
    {
        $this->hp = $hp->load(['detail', 'images']);
        
        // Get related purchase transaction
        $this->relatedTransaction = Transaction::where('hp_out', $this->hp->id)
            ->where('type_trans', 'purchase')
            ->first();
    }
    
    public function refreshHp($hpId)
    {
        $this->hp = Hp::with(['detail', 'images'])
            ->findOrFail($hpId);
        $this->reset('isSelling');
    }
    
    public function toggleInternalNotes()
    {
        $this->showInternalNotes = !$this->showInternalNotes;
    }
    
    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }
    
    public function markAsSold()
    {
        $this->isSelling = true;
        $this->dispatch('open-selling-modal', hpId: $this->hp->id);
    }
    
    public function toggleSoldStatus()
    {
        $this->hp->update([
            'status' => $this->hp->status === 'sold' ? 'available' : 'sold'
        ]);
        
        $this->dispatch('hpUpdated', $this->hp->id);
        $this->dispatch('notify', 
            type: 'success',
            message: 'Status HP berhasil diubah'
        );
    }
    
    public function editHp()
    {
        return redirect()->route('hps.edit', $this->hp->id);
    }
    
    public function goBack()
    {
        return redirect()->route('hps.index');
    }
    
    public function getFormattedPriceProperty()
    {
        return 'Rp ' . number_format($this->hp->price_in_catalog, 0, ',', '.');
    }
    
    public function getTimeAgoProperty()
    {
        return Carbon::parse($this->hp->created_at)->diffForHumans();
    }
    
    public function getStatusColorProperty()
    {
        return match($this->hp->status) {
            'available' => 'bg-green-100 text-green-700',
            'sold' => 'bg-red-100 text-red-700',
            default => 'bg-blue-100 text-blue-700',
        };
    }
    
    public function getPurchasePriceProperty()
    {
        if ($this->relatedTransaction) {
            return 'Rp ' . number_format($this->relatedTransaction->purchase_price, 0, ',', '.');
        }
        return 'N/A';
    }
    
    public function getProfitProperty()
    {
        if ($this->relatedTransaction && $this->hp->status === 'sold') {
            return 'Rp ' . number_format($this->relatedTransaction->profit, 0, ',', '.');
        }
        return null;
    }
    
    public function getBatteryHealthColorProperty()
    {
        $health = $this->hp->detail->battery_health ?? '100%';
        $percentage = (int) str_replace(['%', '<', '>'], '', $health);
        
        if ($percentage >= 90) return 'text-green-600';
        if ($percentage >= 80) return 'text-yellow-600';
        return 'text-red-600';
    }
    
    public function getFeatureStatusProperty($feature)
    {
        $value = $this->hp->detail->$feature ?? null;
        
        if (in_array($feature, ['face_id', 'true_tone', 'finger_print'])) {
            return $value === '1' || $value === 1 || $value === true ? 'Normal' : 'N/A';
        }
        
        return $value ?? 'N/A';
    }
    
    public function getFeatureColorProperty($feature)
    {
        $value = $this->hp->detail->$feature ?? null;
        
        if (in_array($feature, ['face_id', 'true_tone', 'finger_print'])) {
            return $value === '1' || $value === 1 || $value === true 
                ? 'bg-green-50 text-green-600 border-green-100' 
                : 'bg-gray-50 text-gray-600 border-gray-100';
        }
        
        // For camera features
        if (in_array($feature, ['front_camera', 'rear_camera'])) {
            $value = strtolower($value);
            return str_contains($value, 'normal') || str_contains($value, 'berfungsi') 
                ? 'bg-green-50 text-green-600 border-green-100'
                : 'bg-gray-50 text-gray-600 border-gray-100';
        }
        
        return 'bg-gray-50 text-gray-600 border-gray-100';
    }
    
    public function render()
    {
        return view('livewire.components.hp-preview-card');
    }
}