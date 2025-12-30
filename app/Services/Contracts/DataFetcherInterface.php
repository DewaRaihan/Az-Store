<?php

namespace App\Services\Contracts;

interface DataFetcherInterface
{
    /**
     * Summary of format
     * @param mixed $data
     * @return array
     */
    public function format($data):array;

    /**
     * Summary of formatCollection
     * @param mixed $collection
     * @return mixed
     */
    public function formatCollection($collection):mixed;
}