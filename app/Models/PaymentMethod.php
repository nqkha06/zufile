<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\BaseStatusEnum;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $casts = [
        'fields' => 'array',
        'status' => BaseStatusEnum::class
    ];

    protected $fillable = ['name', 'fields', 'withdraw_fee', 'min_withdraw_amount', 'status'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('details')->withTimestamps();
    }
}
