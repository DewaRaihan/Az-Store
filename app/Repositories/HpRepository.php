<?php

namespace App\Repositories;

use App\Models\Hp;

class HpRepository
{
    /**
     * Relasi default agar tidak typo dan tidak duplikasi
     */
    protected array $relations = [
        'transactionIn',
        'transactionIn.related',
        'transactionIn.related.hpIn',
        'transactionOut',
        'detail'
    ];

    /**
     * Base query dengan relasi + sorting
     */
    protected function baseQuery()
    {
        return Hp::with($this->relations)
            ->orderBy('created_at', 'desc');
    }

    /**
     * Semua data tanpa paginate
     */
    public function all()
    {
        return $this->baseQuery()->get();
    }

    /**
     * Paginate bawaan
     */
    public function paginate(int $perPage = 10)
    {
        return $this->baseQuery()->paginate($perPage);
    }

    /**
     * Ambil N data pertama
     */
    public function take(int $limit = 3)
    {
        return $this->baseQuery()->take($limit)->get();
    }

    /**
     * Find by id
     */
    public function find(int|string $id)
    {
        return $this->baseQuery()->findOrFail($id);
    }
    public function filter(array $filters)
    {
        return $this->baseQuery()

            // SEARCH
            ->when($filters['search'] ?? null, function ($q, $v) {
                $q->where(function ($q) use ($v) {
                    $q->where('code_hp', 'LIKE', "%$v%")->orWhere('type_hp');
                });
            })

            // TYPE
            ->when($filters['grade'] ?? null, fn($q, $v) =>
                $q->where('grade', $v)
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
