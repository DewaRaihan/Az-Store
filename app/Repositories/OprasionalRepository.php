<?php

namespace App\Repositories;

use App\Models\Oprasional;


class OprasionalRepository
{
    public function sumCostAndWhereBetween($start, $end)
    {
        return Oprasional::whereBetween('created_at', [$start, $end])
                    ->sum('cost');
    }
    public function sumQtyAndWhereBetween($start, $end)
    {
        return Oprasional::whereBetween('created_at', [$start, $end])
                    ->sum('qty');
    }
}


