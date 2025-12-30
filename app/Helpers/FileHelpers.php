<?php

use Illuminate\Support\Facades\Storage;



if (! function_exists('UploadFile')) {
    /**
    *
    * @param \Illuminate\Http\UploadedFile $file
    * @param string $folder
    * @param string $name
    * @param string $disk (storage or public)
    * @return string $path
    */
    function FileHelpers(\Illuminate\Http\UploadedFile $file , string $folder, string $name, string $disk = "public") {
        
        // path 1 catalog(hp)/code_hp/file hp, path 2 transaksi/file transaksi dengan nama code transaksi
        $path = $file->storeAs($folder, $name, $disk);

        return $path;
    }
}
if (! function_exists('getPublicUrl')) {
    function getPublicUrl(string $path){
        return asset("storage/" . $path);
    }
}
if (! function_exists('delateFile')) {
    function delateFile(string $path){

        Storage::disk("public")->delete($path);
    }
}