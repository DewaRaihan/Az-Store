<?php

namespace App\Livewire\Components;

use App\Services\Report\SpendingDetail;
use App\Services\Report\SpendingSummary;
use Livewire\Component;
use Log;

class SpendingDetailCard extends Component
{

    public function render()
    {
        $details = app(SpendingDetail::class)->fetch();
        $summaries = app(SpendingSummary::class)->fetch();

        Log::info('[SpendingDetail] cache_key', [
            'detail' => $details,
            'summary' => $summaries
        ]);

        return view('livewire.components.spending-detail-card',[
            'detail' => $details,
            'summary' => $summaries
        ]);
    }
}
