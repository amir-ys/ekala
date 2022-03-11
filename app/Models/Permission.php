<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;
    const GUARD_WEB = 'web' ;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $model->guard_name = self::GUARD_WEB ;
        });
    }
}
