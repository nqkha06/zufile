<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    use HasFactory;
    protected $table = 'user_payments';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'payment_method',
        'payment_account_number',
        'payment_account_name',
        'payment_bank_name'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
