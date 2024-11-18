<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_addresses';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'fullname',
        'number_phone',
        'address_1',
        'address_2',
        'country',
        'city',
        'region',
        'zipcode',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
