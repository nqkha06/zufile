<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class STULevelRate extends Model
{
    public $timestamps = false;

    protected $table = 'stu_level_rates';

    protected $fillable = [
        'level_id',
        'country_code',
        'rate',
        'daily_limit'
    ];
    protected $casts = [
        'rate' => 'array',
        'daily_limit' => 'array',
    ];
    public function country(){
        return $this->hasOne(Country::class, 'abv', 'country_code')->withDefault([
            'name' => __('Worldwide Deal(All Countries)'),
            'abv' => 'ALL'
        ]);
    }
}
