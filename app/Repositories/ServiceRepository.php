<?php

namespace App\Repositories;

use App\Models\ServiceHp;



class ServiceRepository
{
    public function sumCostAndWhereBetween($start, $end)
    {
        return ServiceHp::whereBetween('created_at', [$start, $end])
                    ->sum('cost');
    }
}


