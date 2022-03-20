<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $guarded = [];

   const STATUS_ACTIVE = 1;
   const STATUS_DEACTIVE = 0;

   const TYPE_SLIDER = 'slider' ;
   const TYPE_TOP_INDEX=  'top-index' ;
   const TYPE_BOTTOM_INDEX = 'bottom-index' ;

   public static $types = [
     self::TYPE_SLIDER  ,
     self::TYPE_BOTTOM_INDEX ,
     self::TYPE_TOP_INDEX,
   ];

   public static $statuses = [
     'فعال' => self::STATUS_ACTIVE ,
     'غبر فعال' => self::STATUS_DEACTIVE ,
   ];

    public function getStatusNameAttribute()
    {
        return $this->status ? 'فعال' : 'غبر فعال' ;
   }

    public function image()
    {
        return $this->morphOne(Media::class, 'mediable');
   }

}
