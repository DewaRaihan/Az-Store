<?php

namespace App\Livewire\Components;

use App\Repositories\TransactionReportRepository;
use App\Services\Report\TopSellingProduct;
use Livewire\Component;
use Log;

class TopSellingProductCard extends Component
{
    public function render()
    {
        $products = app(TopSellingProduct::class)->handle();

        Log::info('[TopSellingProduct] cache_key', [
            'product' => $products
        ]);

        return view('livewire.components.top-selling-product-card', 
            ['product' => $products]);
    }
}