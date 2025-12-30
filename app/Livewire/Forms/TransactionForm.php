<?php

namespace App\Livewire\Forms;

use App\Services\Forms\TransactionFormService;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class TransactionForm extends Component
{
    use WithFileUploads;

    /* ================= ROOT TRANSACTION ================= */
    public array $transaction = [
        'date' => '',
        'type_transaction' => '',
        'note' => '',
    ];

    /* ================= SEMUA FORM ================= */
    public array $forms = [
        'purchase' => [],
        'selling' => [],
        'trade' => [],
        'service' => [],
        'operational' => [],
    ];

    /* ================= DETAIL ================= */
    public array $detail = [];

    public function mount()
    {
        if ($type = request()->query('type')) {
            $this->transaction['type_transaction'] = $type;
        }

        $this->transaction['date'] = now()->format('Y-m-d\TH:i');
    }

    /* ================= TERIMA FORM DARI CHILD ================= */

    #[On('formUpdated')]
    public function setForm(string $type, array $data): void
    {
        if (!isset($this->forms[$type])) {
            return;
        }

        $this->forms[$type] = array_replace_recursive(
            $this->forms[$type],
            $data
        );

        logger()->info("FORM UPDATED: {$type}");
    }

    /* ================= TOMBOL SIMPAN ================= */

    public function requestDetail(): void
    {
        logger()->info('REQUEST DETAIL');
        $this->dispatch('requestDetail');
    }

    /* ================= TERIMA DETAIL → BARU SAVE ================= */

    #[On('detailCollected')]
    public function receiveDetail(array $detail): void
    {
        logger()->info('DETAIL DITERIMA DI PARENT', [
            'filled' => !empty($detail),
        ]);

        if (empty($detail)) {
            session()->flash('error', '❌ Detail HP belum diisi');
            return;
        }

        $this->detail = $detail;

        $this->saveNow();
    }

    /* ================= SAVE SEBENARNYA ================= */

    protected function saveNow(): void
    {
        try {
            $type = $this->transaction['type_transaction'];

            if (!$type) {
                throw new \Exception('Jenis transaksi belum dipilih');
            }

            if (empty($this->forms[$type])) {
                throw new \Exception("Form {$type} belum diisi");
            }

            if ($type === 'purchase') {
                $this->validatePurchase();
            }

            $payload = [
                'transaction' => $this->transaction,
                $type         => $this->forms[$type],
                'detail'      => $this->detail,
            ];

            logger()->info('STORE PAYLOAD READY', [
                'detail_filled' => !empty($this->detail),
            ]);

            app(TransactionFormService::class)->store($payload);

            session()->flash('success', '✅ Transaksi berhasil disimpan');
            $this->resetForm();

        } catch (\Throwable $e) {
            logger()->error('TRANSACTION SAVE ERROR', [
                'message' => $e->getMessage(),
            ]);

            session()->flash('error', '❌ ' . $e->getMessage());
        }
    }

    /* ================= VALIDASI ================= */

    protected function validatePurchase(): void
    {
        $purchase = $this->forms['purchase'];

        if (empty($purchase['hp']['hp_in'])) {
            throw new \Exception('Nama HP wajib diisi');
        }

        if (empty($purchase['transaction']['purchase_price'])) {
            throw new \Exception('Harga beli wajib diisi');
        }

        if (empty($purchase['images']['main'])) {
            throw new \Exception('Foto utama wajib diupload');
        }

        if (!is_array($purchase['images']['additional'])) {
            throw new \Exception('Format foto tambahan tidak valid');
        }
    }

    /* ================= RESET ================= */

    protected function resetForm(): void
    {
        $type = $this->transaction['type_transaction'];

        if ($type) {
            $this->forms[$type] = [];
        }

        $this->detail = [];

        $this->transaction = [
            'date' => now()->format('Y-m-d\TH:i'),
            'type_transaction' => $type,
            'note' => '',
        ];
    }

    public function render()
    {
        return view('livewire.forms.transaction-form');
    }
}
