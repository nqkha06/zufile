<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StuLogReferral extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'link_id',
        'ip_address',
        'referrer_url',
        'device',
        'operating_system',
        'browser',
        'country',
        'detection',
        'visited_at'
    ];
}
