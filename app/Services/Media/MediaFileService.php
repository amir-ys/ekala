<?php

namespace App\Services\Media;

use App\Models\Media;
use Illuminate\Http\UploadedFile;

class MediaFileService
{
    private static $dir;
    private static $file;
    private static $subDirectory;
    private static $isPrimary;
    private static $productId;
    public static function privateUpload(UploadedFile $file , $productId , $subDirectory ,  $primary = false )
    {
        static::$dir = 'private';
        static::$productId = $productId;
        static::$isPrimary = $primary;
        static::$file = $file;
        static::$subDirectory = $subDirectory;
        static::upload();

    }

    public static function publicUpload(UploadedFile $file , $productId , $subDirectory ,  $primary = false )
    {
        static::$dir = 'public';
        static::$productId = $productId;
        static::$isPrimary = $primary;
        static::$file = $file;
        static::$subDirectory = $subDirectory;
        static::upload();
    }


    private static function upload()
    {
        $fileName = static::filenameGenerator();
        $media = new Media();
        $media->files = ImageFileService::upload(static::$file , $fileName , static::$dir , static::$subDirectory);
        $media->type = static::getFileType(static::$file);
        $media->user_id = auth()->id();
        $media->product_id = static::$productId;
        $media->client_file_name = static::getClientFileName(static::$file);
        $media->is_primary = static::$isPrimary;
        $media->save();

    }

    private static function getFileType(UploadedFile $file)
    {
         if (in_array($file->getClientOriginalExtension() , ['jpg' , 'jpeg' , 'png' ])); return 'image' ;
         if (in_array($file->getClientOriginalExtension() , ['zip' , 'rar'  ])); return 'zip' ;
         if (in_array($file->getClientOriginalExtension() , ['mp4' , 'wma' , 'png' ])); return 'video' ;
    }

    private static function getClientFileName(UploadedFile $file)
    {
      return $file->getClientOriginalName();
    }

    private static function filenameGenerator()
    {
        return uniqid();
    }

}
