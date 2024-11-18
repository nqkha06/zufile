<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryReferral extends Model
{
    use HasFactory;
    protected $table = 'temporary_referrals';

    protected $fillable = [
        'link_id',
        'referrer',
        'ip_address',
        'status',
    ];
}
