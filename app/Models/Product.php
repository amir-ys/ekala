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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function status($attribute = 'cssClass')
    {
        if($attribute == 'name') {
            return $this->status  == 1 ? 'فعال' : 'غیرفعال' ;
        }
        if ($attribute == 'cssClass') {
            return $this->status  == 1 ? 'success' : 'danger' ;
        }
    }

    public function images()
    {
        return $this->morphMany(Media::class , 'mediable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }

    public function wishes()
    {
        return $this->hasMany(Wishlist::class  , 'product_id');
    }

}
