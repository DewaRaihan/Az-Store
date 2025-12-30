<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository
{
    protected array $relations = [
        'hpOut',
        'hpIn',
        'images',
        'users',
        'customers',
        'related'
    ];

    public function baseQuery()
    {
        return Transaction::with($this->relations)
            ->orderBy('created_at', 'desc');
    }

    public function all()
    {
        return $this->baseQuery()->get();
    }

    public function paginate(int $perPage = 10)
    {
        return $this->baseQuery()->paginate($perPage);
    }

    public function take(int $limit = 3)
    {
        return $this->baseQuery()->limit($limit)
            ->get();
    }
    
    public function find(int|string $id = 10)
    {
        return $this->baseQuery()->findOrFail($id);
    }

    public function amountTypetransAndWhereBetween(string $typeTrans, string $category, $start, $end)
    {
        return Transaction::where('type_trans', $typeTrans)
                    ->whereBetween('created_at', [$start, $end])
                    ->sum($category);
    }

    public function filter(array $filters)
    {
        return $this->baseQuery()

            // SEARCH
            ->when($filters['search'] ?? null, function ($q, $v) {
                $q->where(function ($q) use ($v) {
                    $q->where('transaction_code', 'LIKE', "%$v%")
                        ->orWhereHas('hpIn', fn($h) => $h->where('type_hp', 'LIKE', "%$v%"))
                        ->orWhereHas('hpOut', fn($h) => $h->where('type_hp', 'LIKE', "%$v%"));
                });
            })

            // TYPE
            ->when($filters['type'] ?? null, fn($q, $v) =>
                $q->where('type_trans', $v)
            )

            // STATUS
            ->when($filters['status'] ?? null, fn($q, $v) =>
                $q->where('status', $v)
            )

            // START DATE
            ->when($filters['start_date'] ?? null, function ($q, $v) {
                $q->whereDate('date', '>=', $v);
            })

            // END DATE
            ->when($filters['end_date'] ?? null, function ($q, $v) {
                $q->whereDate('date', '<=', $v);
            });
    }


}