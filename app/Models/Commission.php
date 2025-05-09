<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'user_id',
        'from_user_id',
        'amount',
        'rate',
        'commissionable_type',
        'commissionable_id',
        'note',
    ];
}
