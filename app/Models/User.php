<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable, HasRoles, QueryScopes;
    protected static function boot()
    {
        parent::boot();

        // static::creating(function ($user) {
        //     $user->membership = 0;
        // });
    }
    protected $fillable = [
        'name',
        'email',
        'password'
    ];
    protected $hidden = [
        'password',
        'remember_token'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function address()
    {
        return $this->hasOne(UserAddress::class);
    }
    public function paymentMethod()
    {
        return $this->hasOne(UserPaymentMethod::class);
    }
    public function paymentMethods()
    {
        return $this->belongsToMany(PaymentMethod::class, 'user_payment_methods', 'user_id', 'payment_method_id')
                    ->withPivot('details')
                    ->withTimestamps();
    }
    public function userPaymentMethod()
    {
        return $this->hasMany(UserPaymentMethod::class, 'user_id');
    }
    public function withdraw()
    {
        return $this->hasMany(UserWithdraw::class);
    }
    public function invoices()
    {
        return $this->hasMany(UserWithdraw::class);
    }
    public function STUlinks()
    {
        return $this->hasMany(StuLink::class);
    }
    public function NOTELinks()
    {
        return $this->hasMany(NOTELink::class);
    }

    public function STUstats()
    {
        return $this->hasManyThrough(
            StuLinkClick::class,
            StuLink::class,
            'user_id',
            'link_id',
        );
    }
    public function NOTEStats()
    {
        return $this->hasManyThrough(
            NOTEStatistics::class,
            NOTELink::class,
            'user_id',
            'link_id',
        );
    }
}
