<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

    public static $statuses = [
         self::STATUS_ACTIVE ,
          self::STATUS_DEACTIVE ,
    ];

    public function StatusName($status = null)
    {
        if (is_null($status)) $status = $this->status ;
        if ($status == self::STATUS_ACTIVE) return 'فعال';
        if ($status == self::STATUS_DEACTIVE) return  'غیر فعال';
    }
    public function getStatusCssClassAttribute()
    {
        if ($this->status == self::STATUS_ACTIVE) return 'success';
        if ($this->status == self::STATUS_DEACTIVE) return  'warning';
    }
}
