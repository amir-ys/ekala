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

   public static $statuses = [
     'فعال' => self::STATUS_ACTIVE ,
     'غبر فعال' => self::STATUS_DEACTIVE ,
   ];

    public function getStatusNameAttribute()
    {
        return $this->status ? 'فعال' : 'غبر فعال' ;
   }

}
