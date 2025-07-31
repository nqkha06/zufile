<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;
use App\Enums\BaseStatusEnum;

class NOTELevel extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'note_levels';
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
    public function links() {
        return $this->hasMany(NOTELink::class, 'level_id');
    }
    public function translations()
    {
        return $this->hasMany(NoteLevelTranslation::class, 'level_id');
    }
    public function rates() {
        return $this->hasMany(NOTELevelRate::class, 'level_id');
    }
}
