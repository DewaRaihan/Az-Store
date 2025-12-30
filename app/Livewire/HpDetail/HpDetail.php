<?php

namespace App\Livewire\HpDetail;

use Livewire\Component;
use App\Models\Hp;
use App\Repositories\HpRepository;
use App\Services\HpService;
use Illuminate\Support\Facades\Log;

class HpDetail extends Component
{
    public $hp;
    public $hpId; // Public property untuk terima parameter
    public $formattedPrice = 'Rp 0';
    public $purchasePrice = 'Rp 0';
    public $profit = 'Rp 0';

    /**
     * Mount dengan parameter OPTIONAL $hpId
     * Livewire akan otomatis mengisi $hpId dari attribute component
     */
    public function mount($hpId = null, HpRepository $repository = null)
    {
        Log::info('HP Detail Mount Called', [
            'hpId_from_param' => $hpId,
            'hpId_property' => $this->hpId,
            'route_params' => request()->route()->parameters(),
        ]);

        // Priority: 1. Parameter $hpId, 2. Property $this->hpId, 3. Route parameter
        $resolvedHpId = $hpId ?? $this->hpId ?? request()->route('hp') ?? request()->route('id');
        
        if (!$resolvedHpId) {
            Log::warning('HP ID not found');
            $this->createDummyHp();
            return;
        }

        // Jika repository tidak di-inject, buat instance
        if (!$repository) {
            $repository = app(HpRepository::class);
        }

        $this->hp = $repository->find($resolvedHpId);
        
        if ($this->hp) {
            Log::info('HP Found', ['hp_id' => $this->hp->id, 'type' => $this->hp->type_hp]);
            $this->calculatePrices();
        } else {
            Log::warning('HP Not Found', ['hp_id' => $resolvedHpId]);
            $this->createDummyHp('HP tidak ditemukan');
        }
    }

    /**
     * Hook: Ketika $hpId property berubah (jika di-update dari luar)
     */
    public function updatedHpId($value)
    {
        if ($value) {
            $this->loadHpData($value);
        }
    }

    /**
     * Load data HP berdasarkan ID
     */
    private function loadHpData($hpId)
    {
        $repository = app(HpRepository::class);
        $this->hp = $repository->find($hpId);
        
        if ($this->hp) {
            $this->calculatePrices();
        }
    }

    /**
     * Hitung harga
     */
    private function calculatePrices()
    {
        $price = $this->hp->price_in_catalog ?? 0;
        $this->formattedPrice = 'Rp ' . number_format($price, 0, ',', '.');
        
        $buyPrice = $this->hp->transactionIn?->first()?->purchase_price ?? 0;
        $this->purchasePrice = $buyPrice > 0 
            ? 'Rp ' . number_format($buyPrice, 0, ',', '.') 
            : 'Rp 0';
        
        $profit = $price - $buyPrice;
        $this->profit = 'Rp ' . number_format($profit, 0, ',', '.');
    }

    /**
     * Buat dummy HP jika tidak ditemukan
     */
    private function createDummyHp($message = 'HP tidak ditemukan')
    {
        $this->hp = new \stdClass();
        $this->hp->id = $this->hpId ?? 0;
        $this->hp->type_hp = $message;
        $this->hp->code_hp = 'N/A';
        $this->hp->grade = 'N/A';
        $this->hp->status = 'unknown';
        $this->hp->price_in_catalog = 0;
        $this->hp->created_at = now();
        $this->hp->updated_at = now();
        
        // Detail dummy
        $detail = new \stdClass();
        $detail->brand = 'N/A';
        $detail->storage = 'N/A';
        $detail->color = 'N/A';
        $detail->network = 'N/A';
        $detail->warranty = 'N/A';
        $detail->display = 'N/A';
        $detail->body = 'N/A';
        $detail->battery = 'N/A';
        $detail->battery_health = 'N/A';
        $detail->face_id = null;
        $detail->true_tone = null;
        $detail->finger_print = null;
        $detail->front_camera = 'N/A';
        $detail->rear_camera = 'N/A';
        $detail->other = null;
        
        $this->hp->detail = $detail;
    }

    /**
     * Actions
     */
    public function goBack()
    {
        return redirect()->route('dashboard');
    }

    public function markAsSold(HpService $service)
    {
        if ($this->hp instanceof Hp) {
            $this->hp = $service->markAsSold($this->hp);
            session()->flash('success', 'HP berhasil ditandai sebagai terjual.');
        } else {
            session()->flash('error', 'Tidak dapat menandai HP: Data tidak valid.');
        }
    }

    public function toggleSoldStatus(HpService $service)
    {
        if ($this->hp instanceof Hp) {
            if ($this->hp->status === 'sold') {
                $this->hp = $service->markAsAvailable($this->hp);
                session()->flash('success', 'HP berhasil dikembalikan ke stok.');
            } else {
                $this->hp = $service->markAsSold($this->hp);
                session()->flash('success', 'HP berhasil ditandai sebagai terjual.');
            }
        } else {
            session()->flash('error', 'Tidak dapat mengubah status HP: Data tidak valid.');
        }
    }

    public function render()
    {
        return view('livewire.hp-detail.hp-detail');
    }
}