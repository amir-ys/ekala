<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

   public static $statuses = [
     'فعال' => self::STATUS_ACTIVE ,
     'غیر فعال' => self::STATUS_DEACTIVE ,
   ];
}
