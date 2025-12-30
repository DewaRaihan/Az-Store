<?php

namespace App\Livewire\Forms\Category;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Hp;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Services\Forms\Handler\SellingTransactionService;

class SellingCategory extends Component
{
    use WithFileUploads;

    public $transaction = [
        'transaction_code' => '',
        'date' => '',
        'hp_out' => '',
        'selling_price' => '',
        'notes' => '',
    ];

    public $customerName = '';
    public $customerPhone = '';

    public $salesImagesTemp = [];
    public $salesImages = [];

    public $availableHps = [];
    public $selectedHp = null;

    /* =============================
     | MOUNT
     |=============================*/
    public function mount()
    {
        $this->transaction['date'] = now()->format('Y-m-d\TH:i');
        $this->generateTransactionCode();
        $this->loadAvailableHps();
    }

    /* =============================
     | UPDATED HANDLER (SPESIFIK)
     |=============================*/
    public function updatedTransactionDate()
    {
        $this->generateTransactionCode();
    }

    public function updatedSalesImagesTemp()
    {
        foreach ($this->salesImagesTemp as $image) {
            if (count($this->salesImages) < 5) {
                $this->salesImages[] = $image;
            }
        }

        $this->salesImagesTemp = [];
    }

    public function updatedTransactionHpOut()
    {
        $this->loadSelectedHp();
    }

    /* =============================
     | LOAD HP
     |=============================*/
    protected function loadAvailableHps()
    {
        $purchasePrices = Transaction::where('type_trans', 'purchase')
            ->pluck('purchase_price', 'hp_in');

        $this->availableHps = Hp::where('status', 'available')
            ->with('detail')
            ->get()
            ->map(function ($hp) use ($purchasePrices) {
                $hp->purchase_price = $purchasePrices[$hp->id] ?? 0;
                return $hp;
            });
    }

    protected function loadSelectedHp()
    {
        if (!$this->transaction['hp_out']) {
            $this->selectedHp = null;
            return;
        }

        $this->selectedHp = Hp::with('detail')->find($this->transaction['hp_out']);

        if ($this->selectedHp) {
            $this->selectedHp->purchase_price =
                Transaction::where('type_trans', 'purchase')
                    ->where('hp_in', $this->selectedHp->id)
                    ->value('purchase_price') ?? 0;
        }
    }

    /* =============================
     | TRANSACTION CODE
     |=============================*/
    protected function generateTransactionCode()
    {
        $date = $this->transaction['date']
            ? date('Ymd', strtotime($this->transaction['date']))
            : date('Ymd');

        $this->transaction['transaction_code'] =
            'TRX-SELL-' . $date . '-' . strtoupper(Str::random(6));
    }

    /* =============================
     | IMAGE
     |=============================*/
    public function removeSalesImage($index)
    {
        if (isset($this->salesImages[$index])) {
            unset($this->salesImages[$index]);
            $this->salesImages = array_values($this->salesImages);
        }
    }

    /* =============================
     | SAVE
     |=============================*/
    public function save()
    {
        $this->validate([
            'transaction.date' => 'required|date',
            'transaction.hp_out' => 'required|exists:hps,id',
            'transaction.selling_price' => 'required|numeric|min:0',
            'salesImages.*' => 'image|max:2048',
        ]);

        $data = [
            'transaction' => $this->transaction,
            'customer' => [
                'name' => $this->customerName,
                'phone' => $this->customerPhone,
            ],
            'images' => $this->salesImages,
        ];

        try {
            $result = app(SellingTransactionService::class)
                ->createSelling($data);

            $this->resetOnlyForm();

            session()->flash('success', 'Transaksi penjualan berhasil disimpan!');

            return redirect()->route('transactions.selling.show', $result->id);
        } catch (\Throwable $e) {
            session()->flash('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    /* =============================
     | SAVE DRAFT
     |=============================*/
    public function saveAsDraft()
    {
        $this->validate([
            'transaction.date' => 'required|date',
            'transaction.hp_out' => 'required|exists:hps,id',
            'salesImages.*' => 'image|max:2048',
        ]);

        $data = [
            'transaction' => $this->transaction,
            'customer' => [
                'name' => $this->customerName,
                'phone' => $this->customerPhone,
            ],
            'images' => $this->salesImages,
        ];

        try {
            $result = app(SellingTransactionService::class)
                ->createSelling($data);

            $this->resetOnlyForm();

            session()->flash('success', 'Draft penjualan berhasil disimpan!');

            return redirect()->route('transactions.selling.edit', $result->id);
        } catch (\Throwable $e) {
            session()->flash('error', 'Gagal menyimpan draft: ' . $e->getMessage());
        }
    }

    /* =============================
     | RESET RINGAN
     |=============================*/
    protected function resetOnlyForm()
    {
        $this->reset([
            'customerName',
            'customerPhone',
            'salesImages',
            'salesImagesTemp',
            'selectedHp',
        ]);

        $this->transaction['date'] = now()->format('Y-m-d\TH:i');
        $this->generateTransactionCode();
        $this->loadAvailableHps();
    }

    public function render()
    {
        return view('livewire.forms.category.selling-category');
    }
}
