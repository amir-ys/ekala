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
    private static $isPrivate;
    private static $model;
    public static function privateUpload(UploadedFile $file , $model , $subDirectory ,  $primary = false )
    {
        static::$dir = 'private';
        static::$model = $model;
        static::$isPrimary = $primary;
        static::$isPrivate = 'private';
        static::$file = $file;
        static::$subDirectory = $subDirectory;
        static::upload();

    }

    public static function publicUpload(UploadedFile $file , $model , $subDirectory ,  $primary = false )
    {
        static::$dir = 'public';
        static::$model = $model;
        static::$isPrimary = $primary;
        static::$isPrivate = 'public';
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
        $media->mediable_id = static::$model->id;
        $media->mediable_type = get_class(static::$model);
        $media->client_file_name = static::getClientFileName(static::$file);
        $media->is_primary = static::$isPrimary;
        $media->is_private = static::$isPrivate == 'private' ? 1 : 0;
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

    public static function delete(Media $file)
    {
        if ($file->is_private == true){
          return ImageFileService::delete( 'private\\' . $file->files);
        }else{
          return ImageFileService::delete( 'public\\' . $file->files);
        }
    }

}
