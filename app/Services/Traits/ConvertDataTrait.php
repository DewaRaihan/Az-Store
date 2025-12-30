<?php

namespace App\Services\Traits;

use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;

trait ConvertDataTrait
{
    /**
     * Convert LengthAwarePaginator/Paginator → Collection
     * Jika sudah Collection, langsung return.
     * Jika Array, ubah jadi Collection.
     */
    public function convertToCollection($data): Collection
    {
        if ($data instanceof AbstractPaginator) {
            return $data->getCollection();
        }

        if ($data instanceof Collection) {
            return $data;
        }

        // Jika array → jadikan collection
        if (is_array($data)) {
            return collect($data);
        }

        throw new \Exception("convertToCollection() expects Paginator, Collection, or array. Got: " . gettype($data));
    }
}
