<?php

namespace App\Services\Forms\Handler;

use App\Models\Detail;
use Illuminate\Support\Facades\Log;

class DetailHandler
{
    public function handle(array $data): ?Detail
    {
        Log::info('DETAIL HANDLER INPUT', [
            'type' => gettype($data),
            'data' => $data,
        ]);

        if (empty($data)) {
            Log::warning('DETAIL HANDLER EMPTY DATA');
            return null;
        }

        $detail = Detail::create($data);

        Log::info('DETAIL CREATED', [
            'detail_id' => $detail->id,
            'detail' => $detail
        ]);

        return $detail;
    }
}
