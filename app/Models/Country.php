<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;

    protected $table = 'geo_countries';

    protected $fillable = [
        'name',
        'abv',
        'abv3',
        'abv3_alt',
        'code',
        'slug'
    ];
}
