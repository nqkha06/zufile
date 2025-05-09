<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;
use App\Traits\HasTranslations;
use App\Enums\BaseStatusEnum;

class Level extends Model
{
    use HasFactory, QueryScopes, HasTranslations;
    protected $fillable = [
        'name',
        'click_limit',
        'click_value',
        'description',
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
        return $this->hasMany(StuLink::class);
    }

    public function rates() {
        return $this->hasMany(STULevelRate::class);
    }

}
