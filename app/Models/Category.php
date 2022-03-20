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

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class , 'attribute_categories' ,
            'category_id', 'attribute_id' );
    }

    public function parent()
    {
        return $this->belongsTo(Category::class , 'parent_id') ;
    }

    public function childerns()
    {
        return $this->hasMany(Category::class , 'parent_id') ;
    }

    public function path()
    {
        return route('panel.products.show' , $this->slug);
    }

    public function StatusName($status = null)
    {
        if (is_null($status)) $status = $this->status ;
        if ($status == self::STATUS_ACTIVE) return 'فعال';
        if ($status == self::STATUS_DEACTIVE) return  'غیر فعال';
    }
    public function getStatusCssClassAttribute()
    {
        if ($this->status == self::STATUS_ACTIVE) return 'success';
        if ($this->status == self::STATUS_DEACTIVE) return  'danger';
    }
}
