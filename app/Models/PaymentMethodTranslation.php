<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethodTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'payment_method_translations';
    protected $casts = [
        'fields' => 'array',
    ];
    protected $fillable = [
        'lang_code',
        'payment_method_id',
        'name',
        'fields'
    ];
}
