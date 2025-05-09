<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'stu_level_translations';
    protected $fillable = [
        'lang_code',
        'level_id',
        'name',
        'description'
    ];
}
