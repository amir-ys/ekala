<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

   const PAYMENT_METHOD_ZARINPAL = 'zarinpal' ;
   const PAYMENT_METHOD_PAY = 'pay' ;
   const PAYMENT_METHOD_ZIBAL = 'zibal' ;


    const STATUS_PENDING = 0;
    const STATUS_FAILED = -1;
    const STATUS_SUCCESS = 1;

}
