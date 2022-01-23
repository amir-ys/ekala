<?php

namespace App\Services\Media;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageFileService
{
    public static function upload(UploadedFile $file , $filename , $dir , $subDirectory = null)
    {
        if(is_null($subDirectory)) {
            $path = $dir ;
        }else{
            $path = $dir . DIRECTORY_SEPARATOR . $subDirectory;
        }
        $filename = $filename . '.' . $file->getClientOriginalExtension();
        Storage::putFileAs($path , $file ,$filename);
        return $path . DIRECTORY_SEPARATOR .  $filename;
    }

}
