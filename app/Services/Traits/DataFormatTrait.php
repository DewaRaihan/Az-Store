<?php

namespace App\Services\Traits;


trait DataFormatTrait
{
    /**
     * Summary of fillData
     * @param array $label
     * @param array $data
     * @return array
     */
    public function fillData(array $label, array $data)
    {
        $result = [];
        foreach ($label as $key) {
            $result[] = $data[$key] ?? 0;
        }
        return $result;
    }
    public function convertPaginateToCollection(array $paginate)
    {
        if ($paginate instanceof \Illuminate\Pagination\AbstractPaginator) {
            $collection = $paginate->getCollection();
            return $collection;
        }

        return $paginate;
    }
    
}