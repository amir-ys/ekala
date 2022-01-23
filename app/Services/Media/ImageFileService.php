<?php

namespace App\Services\Media;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageFileService
{
    public function upload(UploadedFile $file , $filename , $dir , $subDirectory)
    {
        $path = $dir . DIRECTORY_SEPARATOR . $subDirectory;
        Storage::putFileAs($path ,$file ,$file);
        return $path .  $filename;
    }

}
