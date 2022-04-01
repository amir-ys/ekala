<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded = [];

    const TYPE_AMOUNT = 'amount' ;
    const TYPE_PERCENT = 'percent' ;

    public static array $types = [
      'درصدی' =>  self::TYPE_PERCENT ,
     'مبلفی' =>  self::TYPE_AMOUNT ,
    ];
}
