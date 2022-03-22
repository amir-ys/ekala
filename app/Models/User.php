<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'email_verified_at' ,
        'otp' ,
        'login_token' ,
        'mobile' ,
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

    public static $statuses = [
        'فعال' => self::STATUS_ACTIVE ,
        'غیر فعال' => self::STATUS_DEACTIVE ,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
        if ($this->status == self::STATUS_DEACTIVE) return  'danger';
    }
}
