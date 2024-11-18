<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;

class UserWithdraw extends Model
{
    use HasFactory, QueryScopes;
    const UPDATED_AT = null;
    protected $attributes = [
        'status' => 'pending',
        'paid_at' => null
    ];
    protected $fillable = [
        'amount',
        'costs',
        'type',
        'user_id',
        'status',
        'payment_method',
        'payment_details',
        'paid_at'
    ];
    protected $table = 'user_withdrawals';
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
