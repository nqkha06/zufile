<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteLevelTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'note_level_translations';
    protected $fillable = [
        'lang_code',
        'level_id',
        'name',
        'description'
    ];
}
