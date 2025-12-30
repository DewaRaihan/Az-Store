<?php

namespace App\Livewire\Forms\Category;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PurchaseCategory extends Component
{
    use WithFileUploads;

    /* ================= DATA ================= */
    public string $hp_in = 'Iphone 13';
    public ?float $purchase_price = 6700000;
    public ?float $catalog_price = 7000000;
    public string $notes = 'error lagi';

    /* ================= FILE INPUT ================= */
    public $mainImage = null;
    public $additionalImagesTemp = null;

    /* ================= STORED PATH ================= */
    public ?string $mainImagePath = null;
    public array $additionalImagePaths = [];

    /* ================= VALIDATION ================= */
    protected function rules(): array
    {
        return [
            'hp_in'                  => 'required|string|min:3',
            'purchase_price'         => 'required|numeric|min:0',
            'catalog_price'          => 'nullable|numeric|min:0',
            'notes'                  => 'nullable|string|max:500',

            'mainImage'              => 'required|image|max:2048',
            'additionalImagesTemp.*' => 'image|max:2048',
        ];
    }

    /* ================= MAIN IMAGE ================= */

    public function updatedMainImage(): void
    {
        $this->validateOnly('mainImage');

        // Hapus file lama jika ada
        if ($this->mainImagePath && Storage::disk('public')->exists($this->mainImagePath)) {
            Storage::disk('public')->delete($this->mainImagePath);
        }

        // Simpan file ke storage
        $this->mainImagePath = $this->mainImage->store(
            'purchase/main',
            'public'
        );

        logger()->info('Main image uploaded', [
            'path' => $this->mainImagePath,
        ]);

        $this->dispatchForm();
    }

    /* ================= ADDITIONAL IMAGES ================= */

    public function updatedAdditionalImagesTemp(): void
    {
        if (!is_array($this->additionalImagesTemp)) {
            return;
        }

        foreach ($this->additionalImagesTemp as $image) {
            if (count($this->additionalImagePaths) >= 6) {
                break;
            }

            $path = $image->store('purchase/additional', 'public');
            $this->additionalImagePaths[] = $path;

            logger()->info('Additional image uploaded', [
                'path' => $path,
            ]);
        }

        $this->additionalImagesTemp = null;
        $this->dispatchForm();
    }

    /* ================= REMOVE IMAGE ================= */

    public function removeMainImage(): void
    {
        if ($this->mainImagePath && Storage::disk('public')->exists($this->mainImagePath)) {
            Storage::disk('public')->delete($this->mainImagePath);
        }

        $this->mainImage = null;
        $this->mainImagePath = null;

        $this->dispatchForm();
    }

    public function removeAdditionalImage(int $index): void
    {
        if (!isset($this->additionalImagePaths[$index])) {
            return;
        }

        $path = $this->additionalImagePaths[$index];

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        unset($this->additionalImagePaths[$index]);
        $this->additionalImagePaths = array_values($this->additionalImagePaths);

        $this->dispatchForm();
    }

    /* ================= FIELD UPDATE ================= */

    public function updated(string $property): void
    {
        if (!in_array($property, ['mainImage', 'additionalImagesTemp'])) {
            $this->validateOnly($property);
            $this->dispatchForm();
        }
    }

    /* ================= DISPATCH ================= */

    public function dispatchForm(): void
    {
        logger()->info('PURCHASE FORM DISPATCH', [
            'hp_in' => $this->hp_in,
            'purchase_price' => $this->purchase_price,
            'main_image_path' => $this->mainImagePath,
            'additional_count' => count($this->additionalImagePaths),
        ]);

        $this->dispatch(
            'formUpdated',
            type: 'purchase',
            data: [
                'transaction' => [
                    'purchase_price' => $this->purchase_price,
                ],
                'hp' => [
                    'hp_in'         => $this->hp_in,
                    'catalog_price' => $this->catalog_price,
                    'notes'         => $this->notes,
                ],
                'images' => [
                    'main'       => $this->mainImagePath,        // ✅ STRING
                    'additional' => $this->additionalImagePaths, // ✅ ARRAY STRING
                ],
            ]
        );
    }

    public function render()
    {
        return view('livewire.forms.category.purchase-category');
    }
}
