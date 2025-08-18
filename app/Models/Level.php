<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;
use App\Enums\BaseStatusEnum;

class Level extends Model
{
    use HasFactory, HasTranslations;
    protected $fillable = [
        'pageload_config',
        'test_link',
        'minimum_pages',
    ];
    protected $casts = [
        'status' => BaseStatusEnum::class
    ];
    protected $attributes = [
        'status' => BaseStatusEnum::DRAFT
    ];

    public function rates() {
        return $this->hasMany(STULevelRate::class, 'level_id', 'id');
    }
}
