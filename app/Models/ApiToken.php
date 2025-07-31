<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ApiToken\StatusEnum;
use App\Enums\ApiToken\APITypeEnum;
class ApiToken extends Model
{
    use HasFactory;
    protected $table = 'api_tokens';

    protected $fillable = [
        'user_id',
        'name',
        'token',
        'type',
        'level_id',
        'status',
    ];

    protected $casts = [
        'status' => StatusEnum::class,
        'type' => APITypeEnum::class,
    ];

    protected $attributes = [
        'status' => StatusEnum::ACTIVE,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function level()
    {
        if ($this->type->value === APITypeEnum::STU->value) {
            return $this->belongsTo(Level::class, 'level_id');
        } elseif ($this->type->value === APITypeEnum::NOTE->value) {
            return $this->belongsTo(NoteLevel::class, 'level_id');
        }
    }
}
