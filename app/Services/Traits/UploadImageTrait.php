<?php

namespace App\Services\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadImageTrait
{
    /**
     * Pindahkan file dari temp path ke folder transaksi
     *
     * @param string $mainImagePath
     * @param array $additionalImagePaths
     * @param string $transactionCode
     * @param int $hpId
     * @return array
     */
    protected function storeImages(
        string $mainImagePath,
        array $additionalImagePaths,
        string $transactionCode,
        int $hpId
    ): array {
        $basePath = "transactions/{$transactionCode}/hp-{$hpId}";

        Storage::disk('public')->makeDirectory("{$basePath}/main");
        Storage::disk('public')->makeDirectory("{$basePath}/additional");

        // MAIN IMAGE
        $mainExt = pathinfo($mainImagePath, PATHINFO_EXTENSION);
        $newMainPath = "{$basePath}/main/main.{$mainExt}";

        Storage::disk('public')->move($mainImagePath, $newMainPath);

        // ADDITIONAL IMAGES
        $newAdditionalPaths = [];

        foreach ($additionalImagePaths as $index => $path) {
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $newPath = "{$basePath}/additional/" . ($index + 1) . ".{$ext}";

            Storage::disk('public')->move($path, $newPath);
            $newAdditionalPaths[] = $newPath;
        }

        return [
            'main' => $newMainPath,
            'additional' => $newAdditionalPaths,
        ];
    }
}
