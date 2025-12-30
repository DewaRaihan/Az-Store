<?php

namespace App\Services\Contracts;

/**
 * Summary of CardStatsInterface
 */

interface CardStatsInterface
{
    /**
     * Summary of calculate
     * @param mixed $filter
     * @return void
     */
    public function calculate(?string $filter = null):mixed;
    public function cacheKey(?string $filter = null):string;

}