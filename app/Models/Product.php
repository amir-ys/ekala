<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory , Sluggable;
    protected $guarded = [];

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

    public static $statuses = [
        'فعال' => self::STATUS_ACTIVE ,
        'غیر فعال' => self::STATUS_DEACTIVE ,
    ];

    public function sluggable(): array
    {
        return  [
            'slug' => [
                'source' => 'name'
            ]
        ] ;
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class , 'attribute_product'
            , 'product_id' , 'attribute_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class , 'tag_product'
            , 'product_id' , 'tag_id');
    }
}
