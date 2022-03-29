<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];

    const STATUS_NEW = 0;
    const STATUS_APPROVED = 1;
    const STATUS_NOT_APPROVED = -1;

     static array $statuses = [
         self::STATUS_NEW,
         self::STATUS_APPROVED,
         self::STATUS_NOT_APPROVED,
    ];

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeApproved(Builder $query)
    {
        return $query->where('is_approved' , static::STATUS_APPROVED);
    }


}
