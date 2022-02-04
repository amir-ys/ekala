<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class , 'attribute_categories' ,
            'attribute_id'  , 'category_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class , 'attribute_product'
            , 'attribute_id' , 'product_id');
    }
}
